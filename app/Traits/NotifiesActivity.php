<?php

namespace App\Traits;

use App\Models\Notification;

trait NotifiesActivity
{
    /**
     * Create a new notification
     *
     * @param string $subject
     * @param string $message
     * @param int|null $userId
     * @return void
     */
    protected function createNotification($subject, $message, $userId = null)
    {
        Notification::create([
            'user_id' => $userId ?? auth()->id(),
            'subject' => $subject,
            'message' => $message,
            'read' => false
        ]);
    }

    /**
     * Create a notification for multiple users
     *
     * @param array $userIds
     * @param string $subject
     * @param string $message
     * @return void
     */
    protected function createNotificationForUsers(array $userIds, $subject, $message)
    {
        foreach ($userIds as $userId) {
            $this->createNotification($subject, $message, $userId);
        }
    }

    /**
     * Create a notification for all users with a specific role
     *
     * @param string $role
     * @param string $subject
     * @param string $message
     * @return void
     */
    protected function createNotificationForRole($role, $subject, $message)
    {
        $users = \App\Models\User::where('role', $role)->get();
        
        foreach ($users as $user) {
            $this->createNotification($subject, $message, $user->id);
        }
    }
} 