<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('frontend.pages.feedback');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        Mail::raw("Сообщение от {$data['name']} ({$data['email']}):\n\n{$data['message']}", function ($msg) use ($data) {
            $msg->to(config('mail.from.address'))->subject('Обратная связь с сайта');
        });

        return redirect()->route('frontend.feedback.form')->with('success', 'Спасибо за сообщение!');
    }
}

