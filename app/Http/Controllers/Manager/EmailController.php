<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ManagerEmail;

class EmailController extends Controller
{
    public function index()
    {
        return view('manager.email.form');
    }

    public function send(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        try {
            Mail::to($request->to)
                ->send(new ManagerEmail($request->subject, $request->message));

            return back()->with('success', 'Email berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email: ' . $e->getMessage())
                        ->withInput();
        }
    }
} 