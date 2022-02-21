<?php

namespace App\Http\Controllers\backend;

use App\department;
use App\faculty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class departmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.departments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = faculty::all();
        return view('backend.departments.create',compact('faculties'));
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
                'name'    => 'required|unique:departments', 
                'faculty' => 'required'          
            ],
             [
                 'name.required'  => 'نام دیپارتمنت الزامی میباشد.',
                 'faculty.required' => 'انتخاب فاکولته الزامی میباشد.',
                 'name.unique'      => 'نام دیپارتمنت از قبل موجود است.'
             ]);

            $department = new department();
            $data = $request -> all();

            $department -> name       = $data['name'];
            $department -> faculty_id = $data['faculty'];        
            $department -> save();
            return redirect()->route('departments.index')->with('success','عملیات موفقانه انجام شد.');

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
        $department = department::find($id);
        $faculties = faculty::all();
       return view('backend.departments.edit')->with('department',$department)->with('faculties',$faculties);
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
                'name'    => 'required', 
                'faculty' => 'required'          
            ],
             [
                 'name.required'  => 'نام دیپارتمنت الزامی میباشد.',
                 'faculty.required' => 'انتخاب فاکولته الزامی میباشد.',
             ]);

            $department = department::find($id);
            $data = $request -> all();

            $department -> name = $data['name']; 
            $department -> faculty_id = $data['faculty'];         
            $department -> save();
            return redirect()->route('departments.index')->with('success','عملیات موفقانه انجام شد.');

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
        try {
           $department = department::find($id);
           $department -> delete();
           return redirect()->route('departments.index')->with('success','عملیات موفقانه انجام شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
    }
}
