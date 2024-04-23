<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Modules\Membership\Models\User;
use App\Modules\Membership\Notifications\SendPushNotification;
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

    public function channel()
    {
        // $user = User::with('fcmTokens')->find(2);

        // foreach ($user->fcmTokens as $fcmToken) {
        //     $user->addFcmToken($fcmToken);
        // }


        $user = User::find(2);

        $user->notify(new SendPushNotification(
            'Account Activated',
            'Your account has been activated.',
            'https://picsum.photos/200',
        ));
    }
}
