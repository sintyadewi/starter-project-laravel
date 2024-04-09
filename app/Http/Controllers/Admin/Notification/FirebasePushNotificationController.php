<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebasePushNotificationController extends Controller
{
    protected $notification;

    public function __construct()
    {
        $this->notification = Firebase::messaging();
    }

    public function notification()
    {
        $title = 'Subscription';
        $body = 'Thanks for subscribe to our channel!!!';
        $message = CloudMessage::fromArray([
            'token' => env('FCM_TOKEN'),
            'notification' => [
                'title' => $title,
                'body' => $body
            ],
        ]);

        $this->notification->send($message);
    }
}
