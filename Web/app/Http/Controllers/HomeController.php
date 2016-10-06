<?php

namespace App\Http\Controllers;

use App\big_news;
use App\topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome')->with([
            'topics' => topic::all()->sortByDesc('id')->take(10),
            'big_news' => big_news::all()->sortByDesc('id')->take(10),
        ]);
    }
}
