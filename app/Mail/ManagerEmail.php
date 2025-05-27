<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;
use App\Models\User;

class ManagerEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailSubject;
    public $emailMessage;
    public $user;

    public function __construct($subject, $message, User $user)
    {
        $this->emailSubject = $subject;
        $this->emailMessage = $message;
        $this->user = $user;
    }

    public function build()
    {
        // Simpan notifikasi
        Notification::create([
            'user_id' => $this->user->id,
            'subject' => $this->emailSubject,
            'message' => $this->emailMessage
        ]);

        return $this->subject($this->emailSubject)
                    ->markdown('emails.manager-email');
    }
} 