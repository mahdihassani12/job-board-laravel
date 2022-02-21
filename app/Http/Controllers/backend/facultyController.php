<?php

namespace App\Http\Controllers\backend;

use App\faculty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class facultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.faculties.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.faculties.create');
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
                'name' => 'required|unique:faculties',           
            ],
             [
                 'name.required'  => 'فیلد نام الزامی میباشد.',
                 'name.unique'     => 'نام فاکولته از قبل موجود است.'
             ]);

            $faculty = new faculty();
            $data = $request -> all();

            $faculty -> name = $data['name'];        
            $faculty -> save();
            return redirect()->route('faculties.index')->with('success','عملیات موفقانه انجام شد.');

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
       $faculty = faculty::find($id);
       return view('backend.faculties.edit')->with('faculty',$faculty);
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
                'name' => 'required',           
            ],
             [
                 'name.required'  => 'فیلد نام الزامی میباشد.',
             ]);

            $faculty = faculty::find($id);
            $data = $request -> all();

            $faculty -> name = $data['name'];        
            $faculty -> save();
            return redirect()->route('faculties.index')->with('success','عملیات موفقانه انجام شد.');

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
           $faculty = faculty::find($id);
           $faculty -> delete();
           return redirect()->route('faculties.index')->with('success','عملیات موفقانه انجام شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }

    }
}
