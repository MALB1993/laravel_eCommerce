<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Wishlist;
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

    public function wishlist()
    {
        $wishlists = Wishlist::query()->where('user_id',auth()->user()->id)->get();
        return view('home.users_profile.wishlist',[
            'wishlists'  => $wishlists
        ]);
    }

}
