<?php

namespace App\Http\Controllers;

use App\Yourwoo;
use Illuminate\Http\Request;

class DeleteOnBoardingController extends Controller
{
    public function deleteEmaildatabase() {

        $deletedEmaildatabase = Yourwoo::where([['filesAccountId', '=', '$agency'], ['filesActive', '=', 0]])->delete();

        if ($deletedEmaildatabase) {
            return response()->json([], 204);
        } else {
            return response()->json(['error' => "The resource could not be found"], 404);
        }

    }

    public function deleteKeyplayerlist() {

        $deletedKeyplayerlist = Yourwoo::where([['filesAccountId', '=', '$agency'], ['filesActive', '=', 0]])->delete();

        if ($deletedKeyplayerlist) {
            return response()->json([], 204);
        } else {
            return response()->json(['error' => "The resource could not be found"], 404);
        }

    }

}
