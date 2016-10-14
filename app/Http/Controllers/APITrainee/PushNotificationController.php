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

    function pushNotification() {
        // Put your device token here (without spaces):
        $deviceToken = 'dfc0b7ae143f82275bc031148bea8d15ce7b64c646ba2151abbfcd7f63debf8e';

        // Put your private key's passphrase here:
        $passphrase = env('iOS_NOTIFICATION_PASS');

        // Put your alert message here:
        $message = "New article just arrived";
        $url = "http://blog.nhathm.com";

        if (!$message || !$url) {
            Log::info('Message or Url null');
            exit();
        }

        $ctx = stream_context_create();
        $pemFile = storage_path() . '/app/apitraineedata/NextMoveChat.pem';
        Log::info('PEM PATH'.$pemFile);
        stream_context_set_option($ctx, 'ssl', 'local_cert', $pemFile);
        Log::info($ctx);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        // Open a connection to the APNS server
        Log::info('Open Connection Start');
        $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        Log::info('Open Connection Success');
        if (!$fp) {
            Log::info("Failed to connect: $err $errstr" . PHP_EOL);
            exit();
        }

        Log::info('Connected to APNS' . PHP_EOL);

        // Create the payload body
        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default',
            'link_url' => $url,
            'category' => "NEWS_CATEGORY",
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        if (!$result)
            Log::info('Message not delivered' . PHP_EOL);
        else
            Log::info('Message successfully delivered' . PHP_EOL);

        // Close the connection to the server
        fclose($fp);
    }
}
