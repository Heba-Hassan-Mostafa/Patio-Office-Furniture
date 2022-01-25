<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminOrderMail extends Notification
{
    use Queueable;
    protected $orders;
    protected $admin;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($orders,$admin)
    {
        $this->orders = $orders;
        $this->admin = $admin;


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
                        ->greeting('Hello Admin, ' .$this->admin->name)
                        ->line('You received an order from :' . $this->orders->first_name . ' '. $this->orders->last_name  )
                        ->line('Here are the details: ' )
                        ->line('Name: '. $this->orders->first_name . ' '. $this->orders->last_name  )
                        ->line('Email: '. $this->orders->email  )
                        ->line('Phone: '. $this->orders->phone  )
                        ->line('Address: '. $this->orders->address  )
                        ->line('Notes: '. $this->orders->note  )
                        ->line('Thank you !');
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