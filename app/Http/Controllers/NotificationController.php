<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()
            ->orderBy('created_at', 'desc')
            ->get();

        $unread_count = $notifications->where('read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unread_count
        ]);
    }

    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', auth()->id())
            ->findOrFail($id);
            
        $notification->update(['read' => true]);

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())
            ->where('read', false)
            ->update(['read' => true]);

        return response()->json(['success' => true]);
    }
}
