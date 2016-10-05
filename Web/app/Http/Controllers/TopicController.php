<?php

namespace App\Http\Controllers;

use App\topic;
use Illuminate\Http\Request;

use App\Http\Requests;

class TopicController extends Controller
{
    public function index()
    {
        return view('all_topic')-withTopics(topic::all());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'author' => 'max:16',
            'text' => 'required|max:144',
        ]);

        $topic = new topic;
        $topic->author = $request->get('author');
        $topic->text = $request->get('text');
        if ($topic->save())
            return redirect('/');
        else
            return redirect()->back()->withInput()->withErrors('Fail!');
    }
}
