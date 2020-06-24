<?php

namespace App\Http\Controllers;

use App\Yourwoo;
use Illuminate\Http\Request;

class GetOnBoardingController extends Controller
{
    public function getFileDetails(request $request) {

        // Query to find the keyplayerlist that is active
        $getEmailResult = Yourwoo::where([['filesSort', '=', 'emaildatabases'], ['filesActive', '=', 1]])->get('filesFileName');
        $getKeyplayerResult = Yourwoo::where([['filesSort', '=', 'social'], ['filesActive', '=', 1]])->get('filesFileName');

        $fullList = [
            'emailDatabase' => [
                'filename' => $getEmailResult->first()->filesFileName,
                'signedUrl' => 'Test',
            ],
            'socialSharing' => [
                'filename' => $getKeyplayerResult->first()->filesFileName,
                'signedUrl' => 'Test',
            ],
        ];

        // Return 404 when keyplayerlist is not found else return a 200
        if (empty($getEmailResult[0])) {
            return response()->json(['error' => "The resource could not be found"], 404);
        } else {

            return response()->json(['data' => $fullList], 200, [], JSON_UNESCAPED_SLASHES);
        }

    }
}
