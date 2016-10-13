<?php

namespace App\Http\Controllers\APITrainee;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\User;

class PushNotificationController extends Controller
{
    public function registerDeviceTokenForUser(Request $requests) {
        $account = $requests->input('account');
        $device_token = $requests->input('device_token');
        $user = User::where('name', '=', $account)->first();
        $result = "Added";
        if ($user === null)
        {
            $user = new User;
            $user->name = $account;
            $user->device_token = $device_token;
            $user->save();
        }
        else
        {
            $user->device_token = $device_token;
            $user->save();
            $result = "Updated";
        }

        return response()->json([
            'result' => "Success",
            'content' => $result
        ]);
    }
}
