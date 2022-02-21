<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skill;

class skillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::orderby('id','desc')->paginate(10);
        return view('backend.skills.index',compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.skills.create');
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
                'name' => 'required|unique:skills',           
            ],
             [
                 'name.required'  => 'فیلد نام الزامی میباشد.',
                 'name.unique'    => 'مهارت از قبل موجود است.'
             ]);

            $skill = new Skill();
            $data = $request -> all();

            $skill -> name = $data['name'];        
            $skill -> save();
            return redirect()->route('skills.index')->with('success','عملیات موفقانه انجام شد.');

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
        $skill = Skill::find($id);
        return view('backend.skills.edit')->with('skill',$skill);
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
                 'name.required'  => 'فیلد نام الزامی میباشد.'
             ]);

            $skill = Skill::find($id);
            $data = $request -> all();

            $skill -> name = $data['name'];        
            $skill -> save();
            return redirect()->route('skills.index')->with('success','عملیات موفقانه انجام شد.');

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
           $skill = Skill::find($id);
           $skill -> delete();
           return redirect()->route('skills.index')->with('success','عملیات موفقانه انجام شد.');
        } catch (Exception $e) {
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
    }
}
