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
        $result = 'Succeess';
        if (!$file_content) {
            $result = 'Failed';
        }
        return response()->json([
            'result' => $result,
            'content' => $file_content
        ]);
    }

    public function employee(Request $requests) {
        $content = json_decode('{"employees":[{"lastName":"Doe","firstName":"John"},{"lastName":"Smith","firstName":"Anna"},{"lastName":"Jones","firstName":"Peter"}]}');

        return response()->json([
            'result' => 'Success',
            'content' => $content
        ]);
    }
}
