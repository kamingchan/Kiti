<?php

namespace App\Http\Controllers;

use App\big_news;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends Controller
{
    public function index()
    {
        return view('all_news')->withBigNews(big_news::all()->sortByDesc('id')->take(100));
    }
}
