<?php

namespace App\Http\Controllers;

use App\contactMessages;
use Illuminate\Http\Request;

class contactMessagesController extends Controller
{
    public function store(Request $request){
        try{

            $this->validate($request,[
                'phone' => 'required',
                'name'=> 'required',
                'email'=> 'required',
                'description'=> 'required',            
            ],
             [
                 'phone.required'  => 'فیلد شماره تماس الزامی است.',
                 'name.required'  => 'فیلد نام الزامی است.',
                 'email.required'  => 'فیلد ایمیل الزامی است.',
                 'description.required'  => 'فیلد توضیحات الزامی است.',
             ]);

            $message = new contactMessages();
            $data = $request -> all();

            $message -> phone = $data['phone'];
            $message -> description = $data['description'];
            $message -> email = $data['email'];
            $message -> name = $data['name'];            
            $message -> status = "unseen";            
            $message -> save();
            return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
    }


    public function show($id)
    {
        $message = contactMessages::find($id);
		$message -> status = "seen";            
        $message -> save();
        return view('backend.contact.show')->with('message',$message);
    }

}
