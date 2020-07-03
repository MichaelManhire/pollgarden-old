<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Notifications extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $unreadNotifications = Auth::user()->unreadNotifications;
        $readNotifications = Auth::user()->readNotifications->take(20);

        Auth::user()->unreadNotifications->markAsRead();

        return view('notifications.index', compact(['unreadNotifications', 'readNotifications']));
    }
}
