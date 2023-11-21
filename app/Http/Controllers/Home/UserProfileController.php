<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Wishlist;
use Illuminate\Contracts\Foundation\Application as FoundationApplication;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * @return View|Application|Factory|FoundationApplication
     */
    public function index(): View|Application|Factory|FoundationApplication
    {
        return view('home.users_profile.index');
    }


    /**
     * @return View|Application|Factory|FoundationApplication
     */
    public function comment(): View|Application|Factory|FoundationApplication
    {
        $comments = Comment::query()->where([['user_id',auth()->id()],['approved',1]])->get();
        return view('home.users_profile.comments',[
            'comments'   =>  $comments
        ]);
    }

    /**
     * @return View|Application|Factory|FoundationApplication
     */
    public function wishlist(): View|Application|Factory|FoundationApplication
    {
        $wishlists = Wishlist::query()->where('user_id',auth()->user()->id)->get();
        return view('home.users_profile.wishlist',[
            'wishlists'  => $wishlists
        ]);
    }

}
