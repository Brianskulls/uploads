<?php

namespace App\Http\Controllers;

use App\Yourwoo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadOnBoardingController extends Controller
{
    public function saveKeyplayerlist(request $request, $account_id) {

        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'keyplayerlist' => 'required|mimes:xls,xlsx,csv,txt|file|max:1048576']);

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
        $fileName = $request->file('keyplayerlist')->getClientOriginalName();

        // Name of the location
        $filesNameLocation = "keyplayerlist-" . '$agency' . "-" . $fileName;

        // Create filesString
        $filesString = md5(uniqid(mt_rand(), true));

        // Set filesActive to 0 if a new file is uploaded with the same filesAccountId
        Yourwoo::where([['filesAccountId', '=', '$agency'], ['filesSort', '=', 'social']])->update(['filesActive' => 0]);

        // Content of the file
        $file = $request->file('keyplayerlist');

        // Save file to the AWS S3 Bucket
        $respond = Storage::disk('s3_emaildatabase')->put($filesNameLocation, file_get_contents($file), 'private');

        // Give an error if the file was not saved to the AWS S3 Bucket correctly else save to database
        if (!$respond) {
            return response()->json(['error' => 'There was an error uploading the file']);
        } else {
            $createdKeyplayerlist = Yourwoo::create([
                'filesFileName' => $fileName,
                'filesSort' => 'social',
                'filesAccountId' => '$agency',
                'filesString' => $filesString,
                'filesActive' => 1,
                'filesAddedBy' => $account_id,
            ]);
        }

        // If adding to the database and saving to the AWS S3 Bucket was successful return a 201 if not return a 400
        if ($createdKeyplayerlist && $respond) {

            return response()->json(['filesFileName' => $fileName, 'filesSort' => 'social', 'filesAccountId' => '$agency', 'filesPath' => "https://test-brian.s3.eu-central-1.amazonaws.com/" . $filesNameLocation], 201, [], JSON_UNESCAPED_SLASHES);
        } else {
            return response()->json(['error' => "There was an error inserting the record"], 400);
        }

    }

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

        // Name of the location
        $filesNameLocation = "emaildatabase-" . '$agency' . "-" . $fileName;

        // Create filesString
        $filesString = md5(uniqid(mt_rand(), true));

        // Set filesActive to 0 if a new file is uploaded with the same filesAccountId
        Yourwoo::where([['filesAccountId', '=', '$agency'], ['filesSort', '=', 'emaildatabases']])->update(['filesActive' => 0]);

        // Content of the file
        $file = $request->file('emaildatabase');

        // Save file to the AWS S3 Bucket
        $respond = Storage::disk('s3_emaildatabase')->put($filesNameLocation, file_get_contents($file), 'private');

        // Give an error if the file was not saved to the AWS S3 Bucket correctly else save to database
        if (!$respond) {
            return response()->json(['error' => 'There was an error uploading the file']);
        } else {
            $createdEmaildatabase = Yourwoo::create([
                'filesFileName' => $fileName,
                'filesSort' => 'emaildatabases',
                'filesAccountId' => '$agency',
                'filesString' => $filesString,
                'filesActive' => 1,
                'filesAddedBy' => $account_id,
            ]);
        }

        // If adding to the database and saving to the AWS S3 Bucket was successful return a 201 if not return a 400
        if ($createdEmaildatabase && $respond) {

            return response()->json(['filesFileName' => $fileName, 'filesSort' => 'emaildatabase', 'filesAccountId' => '$agency', 'filesString' => $filesString, 'filesAddedBy' => $account_id, 'filesPath' => "https://test-brian.s3.eu-central-1.amazonaws.com/" . $filesNameLocation], 201, [], JSON_UNESCAPED_SLASHES);
        } else {
            return response()->json(['error' => "There was an error inserting the record"], 400);
        }

    }

}
