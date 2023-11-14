<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\ProductRate;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::latest()->paginate(5,['*'],'comments');

        return view('admin.comments.index',[
            'comments'  =>  $comments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $rate = ProductRate::query()->where('user_id',$comment->user->id)->first();

        return view('admin.comments.show',[
            'comment'   => $comment,
            'rate'      =>  $rate
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        Alert::success(__('Confirm'), __('The comment was correctly deleted !'));
        return redirect()->route('admin-panel.comments.index');
    }

    public function changeApprove(Request $request, Comment $comment)
    {
        if($comment->getRawOriginal('approved') == 0)
        {
            $comment->approved = 1;
        }elseif($comment->getRawOriginal('approved') == 1){
            $comment->approved = 0;
        }

        $comment->update();
        Alert::success(__('Confirm'), __('The situation changed correctly!'));
        return redirect()->route('admin-panel.comments.index');
    }

}
