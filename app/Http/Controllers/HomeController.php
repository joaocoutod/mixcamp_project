<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Streamers;

class HomeController extends Controller
{
    public function indexHome(){

        $streamers = Streamers::all();

        return view('home', ['streamers' => $streamers]);

    }
}
