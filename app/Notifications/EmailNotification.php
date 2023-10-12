<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;


class EmailNotification extends Notification
{
    use Queueable;
    protected $project;
   
    public function __construct($project)
    {
        //
        $this->project = $project;
      /*  echo $this->project;
        exit;
       */

    }

    public function via($notifiable)
    {

        return ['mail'];
    }

  
    public function toMail($notifiable)
    { 

        return (new MailMessage)
            //->to("ritesh.khatri@iflair.com")
                ->subject('User Login')
                ->from('priya.shah@iflair.com','Priya')
                //->cc('ritesh.khatri@iflair.com','Ritesh Khatri')
              //  ->to('arpita.parmar@iflair.com','Arpita')

                ->greeting('Hello! ' . Auth::user()->name)
                ->line('You are logged in.')
                ->action('Notification Action', url('/'))
                ->line('Thank you');      

    }
}
