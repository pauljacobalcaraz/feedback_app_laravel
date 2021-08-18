<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Label;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
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
        $feedback = new Feedback();
        $feedback->user_id = Auth::user()->id;
        $feedback->product_id = $request->product_id;
        $feedback->label_id = $request->label_id;
        $feedback->title = $request->title;
        $feedback->action_id = 1; //no action taken
        $feedback->feedback = $request->feedback;
        $feedback->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(feedback $feedback)
    {
        // $comments = Comment::all()->where('feedback_id', '=', $feedback->id);
        // $comments = Comment::all();

        // return view('comment.comment', ['comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, feedback $feedback)
    {
        if ($request->action_id) {

            $feedback->action_id = $request->action_id;
        } else {

            $feedback->title = $request->title;
            $feedback->feedback = $request->feedback;
        }
        $feedback->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(feedback $feedback)
    {
        // delete all comments
        DB::table('comments')->where('feedback_id', '=', $feedback->id)->delete();
        // delete all votes
        DB::table('votes')->where('feedback_id', '=', $feedback->id)->delete();
        $feedback->delete();
        return redirect()->back();
    }
    public function filterFeedback(Request $request)
    {
        session(['label_id' => $request->label_id]);
        // dd(session('label'));
        if ($request->all_label) {
            $request->session()->forget('label_id');
        }
        return redirect()->back();
    }
}
