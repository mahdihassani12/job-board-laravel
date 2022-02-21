<?php

namespace App\Http\Controllers;

use DB;
use App\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
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

            $this->validate($request,[
                'description.*' => 'required',
                'start_date.*'=> 'required',
                'end_date.*'=> 'required',
            ],
             [
                 'description.*.required'  => 'فیلد توضیحات الزامی میباشد.',
                 'start_date.*.required' => 'فیلد تاریخ شروع الزامی میباشد.',
                 'end_date.*.required'  => 'فیلد تاریخ ختم الزامی میباشد.'
             ]);

            if($request->update_exp){

                DB::table('experiences')->where('student_id',$request->student_id)->truncate();
                $data = $request -> all();
                $condition = $data['description'];
                foreach ($condition as $key => $condition) {

                    $exp = new Experience();
                    $exp -> description = $data['description'][$key];
                    $exp -> start_date  = $data['start_date'][$key];
                    $exp -> end_date    = $data['end_date'][$key];
                    $exp -> student_id  = $data['student_id'];            
                    $exp -> save();
                }

                return redirect()->back()->with('success','عملیات موفقانه انجام شد.');
                
            }else{

                $data = $request -> all();
                $condition = $data['description'];
                foreach ($condition as $key => $condition) {

                    $exp = new Experience();
                    $exp -> description = $data['description'][$key];
                    $exp -> start_date  = $data['start_date'][$key];
                    $exp -> end_date    = $data['end_date'][$key];
                    $exp -> student_id  = $data['student_id'];            
                    $exp -> save();
                }

                return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

            }

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
