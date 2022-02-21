<?php

namespace App\Http\Controllers;

use App\contactInfo;
use Illuminate\Http\Request;

class contactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.contact.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.contact.create');
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
                'phone' => 'required',
                'address'=> 'required',
                'email'=> 'required',
                'description'=> 'required',            
            ],
             [
                 'phone.required'  => 'فیلد شماره تماس الزامی میباشد.',
                 'address.required' => 'فیلد آدرس الزامی میباشد.',
                 'email.required' => 'فیلد ایمیل الزامی میباشد.',
                 'description.required' => 'فیلد توضیحات الزامی میباشد.'
             ]);

            $info = new contactInfo();
            $data = $request -> all();

            $info -> phone = $data['phone'];
            $info -> description = $data['description'];
            $info -> email = $data['email'];
            $info -> address = $data['address'];            
            $info -> save();
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
        try{

            $this->validate($request,[
                'phone' => 'required',
                'address'=> 'required',
                'email'=> 'required',
                'description'=> 'required',            
            ],
             [
                 'phone.required'  => 'فیلد شماره تماس الزامی میباشد.',
                 'address.required' => 'فیلد آدرس الزامی میباشد.',
                 'email.required' => 'فیلد ایمیل الزامی میباشد.',
                 'description.required' => 'فیلد توضیحات الزامی میباشد.'
             ]);

            $info = contactInfo::find($id);
            $data = $request -> all();

            $info -> phone = $data['phone'];
            $info -> description = $data['description'];
            $info -> email = $data['email'];
            $info -> address = $data['address'];            
            $info -> save();
            return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
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
