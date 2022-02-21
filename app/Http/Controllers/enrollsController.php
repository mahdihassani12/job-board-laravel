<?php

namespace App\Http\Controllers;

use App\Enroll;
use Illuminate\Http\Request;

class enrollsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request -> all();
        $company_id = $data['company_id'];
        $enrolls = Enroll::where('company_id',$company_id)->orderby('id','DESC')->paginate(20);
        return view('frontend.enrolls.index',compact('enrolls'));
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
                 'title.required'  => ' فیلد نام الزامی است. ',
                 'description.required'  => ' فیلد توضیحات الزامی است. ',
             ]);

            $enroll = new Enroll();
            $data = $request -> all();

            $enroll -> title = $data['title'];
            $enroll -> description = $data['description'];            
            $enroll -> student_id = $data['student_id'];            
            $enroll -> company_id = $data['company_id'];            
            $enroll -> job_id = $data['job_id'];            
            $enroll -> save();
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
        $enroll = Enroll::find($id);
        return view('frontend.enrolls.show',compact('enroll'));
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
