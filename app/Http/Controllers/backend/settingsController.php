<?php

namespace App\Http\Controllers\backend;

use App\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class settingsController extends Controller
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
        
        try{

            $settings = new Setting();
            $data = $request -> all();

            if ($files = $request->file('logo')) {
               $destinationPath = 'uploads/logo/'; // upload path
               $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $logo);
               $settings -> logo = $logo;
            }
            if(!empty($data['description'])){
                $settings -> description = $data['description'];    
            }
            if(!empty($data['facebook'])){
                $settings -> facebook = $data['facebook'];
            }
            if(!empty($data['telegram'])){
                $settings -> telegram = $data['telegram'];    
            }
            if(!empty($data['website'])){
                $settings -> website = $data['website'];
            }                    
            $settings -> save();
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

            $settings = Setting::find($id);
            $data = $request -> all();

            if ($files = $request->file('logo')) {
               $destinationPath = 'uploads/logo/'; // upload path
               $logo = date('YmdHis') . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $logo);
               $settings -> logo = $logo;
               
               $photo = Setting::find($id)->logo;
                if(!is_null($photo) && file_exists(public_path('uploads/logo/'.$photo))){
                    unlink(public_path('uploads/logo/'.$photo));
                }

            }
            if(!empty($data['description'])){
                $settings -> description = $data['description'];    
            }
            if(!empty($data['facebook'])){
                $settings -> facebook = $data['facebook'];
            }
            if(!empty($data['telegram'])){
                $settings -> telegram = $data['telegram'];    
            }
            if(!empty($data['website'])){
                $settings -> website = $data['website'];
            }                    
            $settings -> save();
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
