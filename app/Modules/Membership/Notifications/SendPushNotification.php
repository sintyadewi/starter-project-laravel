<?php

namespace App\Modules\Membership\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;

class SendPushNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected string $title,
        protected string $body,
        protected ?string $image = '',
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class, 'database'];
    }

    /**
     * Get the firebase representation of the notification.
     * 
     * @return FcmMessage
     */
    public function toFcm($notifiable): FcmMessage
    {
        return (new FcmMessage(notification: new FcmNotification(
            title: 'Account Activated',
            body: 'Your account has been activated.',
            image: 'https://picsum.photos/200',
        )))
            ->data(['data1' => 'value', 'data2' => 'value2'])
            ->custom([
                'android' => [
                    'notification' => [
                        'color' => '#0A0A0A',
                        "click_action" => "http://localhost:8081"
                    ],
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
                'apns' => [
                    'fcm_options' => [
                        'analytics_label' => 'analytics',
                    ],
                ],
                'webpush' => [
                    'notification' => [
                        'color' => '#0A0A0A',
                        "click_action" => "http://localhost:8081"
                    ],
                ],
            ]);
        // return (new FcmMessage(
        //     notification: new FcmNotification(
        //         title: $this->title,
        //         body: $this->body,
        //         image: $this->image,
        //     )
        // ))
        //     ->data(['data1' => 'value', 'data2' => 'value2'])
        //     ->custom([
        //         'android' => [
        //             'notification' => [
        //                 'color' => '#0A0A0A',
        //             ],
        //             'fcm_options' => [
        //                 'analytics_label' => 'analytics',
        //             ],
        //         ],
        //         'apns' => [
        //             'fcm_options' => [
        //                 'analytics_label' => 'analytics',
        //             ],
        //         ],
        //     ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'notification' => [
                'title' => $this->title,
                'bobdy' => $this->body,
                'image' => $this->image,
            ]
        ];
    }

    /**
     * Get the notification's database type.
     *
     * @return string
     */
    public function databaseType(object $notifiable): string
    {
        return 'activated_account';
    }
}
