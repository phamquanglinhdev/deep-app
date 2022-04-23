<?php

namespace App\Http\Controllers\api;

use App\Events\CreateNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendNotificaton extends Controller
{
    public function create(Request $request)
    {
        broadcast(new CreateNotification($request->message))->toOthers();
    }
}
