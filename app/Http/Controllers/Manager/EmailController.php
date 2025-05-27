<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ManagerEmail;
use App\Models\User;

class EmailController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['perawat', 'logistik'])
                    ->orderBy('role')
                    ->get()
                    ->groupBy('role');
                    
        return view('manager.email.form', compact('users'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'to' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        try {
            $user = User::findOrFail($request->to);
            Mail::to($user->email)
                ->send(new ManagerEmail($request->subject, $request->message, $user));

            return back()->with('success', 'Email berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage())
                        ->withInput();
        }
    }
} 