<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CouponMail extends Notification
{
    use Queueable;
    protected $coupon;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                            ->greeting('Hello, Subscriber')
                            ->line('You Received aCoupon with name: ' .$this->coupon->coupon)
                            ->line('You Received aCoupon with value: ' .$this->coupon->discount .' %')
                            ->line('Thanks For Subscribe Us.')
                            ->action('Click Here To Return To The Site.', url('/'))
                            ->line('Thank You For Using Our Site.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}