<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index()
    {
        return view('home.users_profile.index');
    }


    public function comment()
    {
        $comments = Comment::query()->where([['user_id',auth()->id()],['approved',1]])->get();
        return view('home.users_profile.comments',[
            'comments'   =>  $comments
        ]);
    }

}
