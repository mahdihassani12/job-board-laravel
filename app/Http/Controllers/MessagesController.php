<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = $request -> all();

        if($request->status && $request->user_id){

            $user_id = $data['user_id'];
            $status = $data['status'];

            $messages = Message::orderby('id','DESC')->where('status', '=' , $status)
                      ->where('user_id','=',$user_id)->paginate(20);
            return view('frontend.companies.messages')->with('messages',$messages);

        }elseif($request->user_id){

            $user_id = $data['user_id'];

            $messages = Message::orderby('id','DESC')->where('user_id','=',$user_id)->paginate(20);
            return view('frontend.companies.messages')->with('messages',$messages);

        }

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
        try{

            $this->validate($request,[
                'title' => 'required',
                'description'=> 'required',           
            ],
             [
                 'required'  => 'The :attribute field is required.'
             ]);

            $message = new Message();
            $data = $request -> all();

            $message -> title = $data['title'];
            $message -> name = $data['name'];
            $message -> phone = $data['phone'];
            $message -> description = $data['description'];            
            $message -> user_id = $data['user_id'];                                 
            $message -> status = 'unseen';            
            $message -> save();
            return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        $message -> status = 'seen';
        $message -> save();
        return view('frontend.companies.message')->with('message',$message);
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
    public function destroy($id)
    {
        //
    }
}
