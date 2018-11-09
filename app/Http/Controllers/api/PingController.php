<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PingController extends Controller
{
    public function ping(){
        return response()
            ->json(['ping' => 'pong'],200);
    }
}
