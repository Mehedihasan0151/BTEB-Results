<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;



class BombingController extends Controller
{
    public function showPasswordForm()
    {
        return view('password');
    }

    public function handlePassword(Request $request)
    {
        if ($request->input('password') === 'juthi') {
            $request->session()->put('authenticated', true);
            return redirect('/call');
        }
        return redirect('/password')->withErrors(['Invalid password']);
    }

    public function showForm()
    {
        return view('bombing');
    }

    public function sendCall(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required',
            'key' => 'required',
            'limit' => 'required|integer|min:1',
        ]);

        $url = "https://call-bombers.vercel.app/send-call";
        $response = Http::get($url, [
            'key' => $validated['key'],
            'number' => $validated['number'],
            'repeat' => $validated['limit'],
        ]);

        $log = "Number: {$validated['number']}, Limit: {$validated['limit']}, Time: " . now()->toDateTimeString() . "\n";
        Storage::append('call_logs.txt', $log);

        return back()->with('status', 'Call request sent successfully!');
    }


}
