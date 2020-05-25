<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function add()
    {
        return view('BBS.add');
    }

    public function question()
    {
        return view('BBS.question');
    }

    public function regist(Request $request)
    {
        $post_data = [
            'user'=>$request->username,
            'content'=>$request->content,
            'file'=>$request->file
        ];
        return view('BBS.regist', $post_data);
    }
}
