<?php

namespace App\Http\Controllers\APITrainee;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Response;
use App\Http\Controllers\Controller;

class APITraineeController extends Controller
{
    public function listBooks(Request $requests) {
        $path = storage_path()."/app/apitraineedata/listbooks.json";
        $file_content = json_decode(@file_get_contents($path), true);
//        return $file_content;
        return response()->json([
            'result' => 'Success',
            'content' => $file_content
        ]);
    }
}
