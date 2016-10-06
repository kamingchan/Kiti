<?php

namespace App\Http\Controllers;

use App\big_news;
use Illuminate\Http\Request;

use App\Http\Requests;

class ApiController extends Controller
{
    public function postBigNews(Request $request)
    {
        $news = new big_news;
        $news->name = $request->get('name');
        $news->url = $request->get('url');
        if ($news->save())
            return response('OK!', 200);
        else
            return response('Fail', 500);
    }
}
