<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emaildatabase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class EmaildatabaseController extends Controller
{

    public function index() {
        return view('welcome');
    }

//    public function getEmaildatabase(request $request, $account_id) {
//
//        // Query to find the emaildatabase that is active
//        $getResult = Emaildatabase::where([['filesAccountId', '=', $account_id], ['filesActive', '=', 1]])->get();
//
//        // When the correct emaildatabase is not found return a 404 else return a 200
//        if (empty($getResult[0])) {
//            return response()->json(['error' => "The resource could not be found"], 404);
//        } else {
//            $foundResult = $getResult->toArray();
//            return response()->json(['result' => $foundResult], 200);
//        }
//
//    }

    public function saveEmaildatabase(request $request, $account_id) {

        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'emaildatabase' => 'required|mimes:xls,xlsx,csv,txt|file|max:1048576']);

        // Give error if the uploaded file did not meet the validation requirements
        if ($validator->fails()) {
            $errorArray = array();
            foreach ($validator->errors()->toArray() as $error)  {
                foreach($error as $subError){
                    array_push($errorArray, $subError);
                }
            }
            return response()->json(['error' => $errorArray], 400);
        }

        // Name of the uploaded file without extention
        $fileName = $request->file('emaildatabase')->getClientOriginalName();
        $filesFileName = pathinfo($fileName,PATHINFO_FILENAME);

        // Extention of the uploaded file
        $filesSort = $request->file('emaildatabase')->getClientOriginalExtension();

        // Set filesActive to 0 if a new file is uploaded with the same filesAccountId
        Emaildatabase::where('filesAccountId', '=', $account_id)->update(['filesActive' => 0]);

        // Content of the file
        $file = $request->file('emaildatabase');

        // Save file to the AWS S3 Bucket
        $respond = Storage::disk('s3')->put($fileName, file_get_contents($file), 'public');

        // Give an error if the file was not saved to the AWS S3 Bucket correctly else save to database
        if (!$respond) {
            return response()->json(['error' => 'There was an error uploading the file']);
        } else {
            $createdEmaildatabase = Emaildatabase::create([
                'filesFileName' => $filesFileName,
                'filesSort' => $filesSort,
                'filesAccountId' => $account_id,
                'filesActive' => 1,
            ]);
        }

        // If adding to the database and saving to the AWS S3 Bucket was successful return a 201 if not return a 400
        if ($createdEmaildatabase && $respond) {

            return response()->json(['filesFileName' => $filesFileName, 'filesSort' => $filesSort, 'filesAccountId' => $account_id], 201);
        } else {
            return response()->json(['error' => "There was an error inserting the record"], 400);
        }

    }

    public function deleteEmaildatabase($account_id) {

        $deletedEmaildatabase = Emaildatabase::where([['filesAccountId', '=', $account_id], ['filesActive', '=', 0]])->delete();

        if ($deletedEmaildatabase) {
            return response()->json([], 204);
        } else {
            return response()->json(['error' => "The resource could not be found"], 404);
        }

    }

}
