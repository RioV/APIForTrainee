<?php

namespace App\Http\Controllers\APITrainee;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class APITraineeController extends Controller
{
    public function listBooks(Request $requests) {
        $account = $requests->input('account');
        Log::info($account);
        $result = 'Failed';
        $file_content = null;
        if (strlen($account) > 0) {
            $path = storage_path() . "/app/apitraineedata/listbooks.json";
            $file_content = json_decode(@file_get_contents($path), true);
            if ($file_content) {
                $result = 'Success';
            }
        }

        return response()->json([
            'result' => $result,
            'content' => $file_content
        ]);
    }

    public function dataSync(Request $requests) {
        sleep(5);

        return response()->json([
            'result' => "Success"
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
