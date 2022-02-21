<?php

namespace App\Http\Controllers;

use DB;
use App\Reference;
use Illuminate\Http\Request;

class ReferencesController extends Controller
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
                'reference_phone.*' => 'required',
                'reference_email.*'=> 'required',
                'reference_name.*'=> 'required',
                'reference_organization.*'=> 'required',
            ],
             [
                 'reference_email.*.required'  => 'فیلد ایمیل الزامی میباشد.',
                 'reference_phone.*.required' => 'فیلد شماره تماس الزامی میباشد.',
                 'reference_name.*.required' => ' نام مرجع الزامی است. ',
                 'reference_organization.*.required' => ' نام سازمان الزامی است. ',
             ]);

            if($request->update_ref){
                
                $ref = Reference::where('student_id',$request->student_id)->truncate();
                $data = $request -> all();
                $condition = $data['reference_email'];
                foreach ($condition as $key => $condition) {

                    $ref = new Reference();
                    $ref -> reference_name = $data['reference_name'][$key];
                    $ref -> reference_organization = $data['reference_organization'][$key];
                    $ref -> reference_email = $data['reference_email'][$key];
                    $ref -> reference_phone = $data['reference_phone'][$key]; 
                    $ref -> student_id = $data['student_id'];           
                    $ref -> save();
                }
                return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

            }else{

            $data = $request -> all();
            $condition = $data['reference_email'];
            foreach ($condition as $key => $condition) {

                $ref = new Reference();
                $ref -> reference_name = $data['reference_name'][$key];
                $ref -> reference_organization = $data['reference_organization'][$key];
                $ref -> reference_email = $data['reference_email'][$key];
                $ref -> reference_phone = $data['reference_phone'][$key]; 
                $ref -> student_id = $data['student_id'];           
                $ref -> save();
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
