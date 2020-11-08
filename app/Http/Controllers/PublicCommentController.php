<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class PublicCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Comment::create([
            'comment'=>$request->comment,
            'prod_id'=>$request->prod_id,
            'user_id'=>$request->user_id
        ]);
        $user = session()->get('user');
        $comments = Comment::where('prod_id',$request->prod_id)->orderBy('created_at','desc')->get();
        $output = "";
        foreach($comments as $comment){
            if($comment->user_id == $user['user_id']){
                $output.='<div class="review_item">
                        <div class="media">
                            <div class="media-body">
                                <h4>'.$comment->user->name.'</h4>
                                <h5>'.$comment->created_at->format('Y-m-d').'</h5>
                                <a class="btn-danger text-light reply_btn" onclick="delete_comment('.$comment->id.')" id="delete_comment"><i class="fa fa-trash text-light"></i></a>
                            </div>
                        </div>
                        <p>'.$comment->comment.'</p>
                    </div>
                    <hr>';
            }else{					
                $output.='<div class="review_item">
                <div class="media">
                    <div class="media-body">
                        <h4>'.$comment->user->name.'</h4>
                        <h5>'.$comment->created_at->format('Y-m-d').'</h5>
                    </div>
                </div>
                <p>'.$comment->comment.'</p>
                </div>
                <hr>';
            }		
        }
        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Comment::where('id',$request->comment_id)->delete();
        $user = session()->get('user');
        $comments = Comment::where('prod_id',$request->prod_id)->orderBy('created_at','desc')->get();
        $output = "";
        foreach($comments as $comment){
            if($comment->user_id == $user['user_id']){
                $output.='<div class="review_item">
                        <div class="media">
                            <div class="media-body">
                                <h4>'.$comment->user->name.'</h4>
                                <h5>'.$comment->created_at->format('Y-m-d').'</h5>
                                <a class="btn-danger text-light reply_btn" onclick="delete_comment('.$comment->id.')" id="delete_comment"><i class="fa fa-trash text-light"></i></a>	
                            </div>
                        </div>
                        <p>'.$comment->comment.'</p>
                    </div>
                    <hr>';
            }else{					
                $output.='<div class="review_item">
                <div class="media">
                    <div class="media-body">
                        <h4>'.$comment->user->name.'</h4>
                        <h5>'.$comment->created_at->format('Y-m-d').'</h5>
                    </div>
                </div>
                <p>'.$comment->comment.'</p>
                </div>
                <hr>';
            }		
        }
        return $output;
    }
}
