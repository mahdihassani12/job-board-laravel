<?php

namespace App\Http\Controllers\backend;

use App\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
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
                'name' => 'required|unique:categories',           
            ],
             [
                 'name.required'  => 'فیلد نام الزامی میباشد.',
                 'name.unique'    => 'نام دسته از قبل موجود است'
             ]);

            $category = new category();
            $data = $request -> all();

            $category -> name = $data['name'];        
            $category -> save();
            return redirect()->route('categories.index')->with('success','عملیات موفقانه انجام شد.');

        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
    }

    public function postCategory(Request $request){
        try{

            $this->validate($request,[
                'name' => 'required|unique:categories',           
            ],
             [
                 'name.required'  => 'فیلد نام الزامی میباشد.',
                 'name.unique'    => 'نام دسته از قبل موجود است'
             ]);

            $category = new category();
            $data = $request -> all();

            $category -> name = $data['name'];        
            $category -> save();
            $category -> id;
            return response()->json(
                 [
                   'success' => true,
                   'message' => ' دسته موفقانه اضافه شد. ',
                   'id'      => $category -> id
                 ]
            );

        }
        catch(Exception $e){
            return response()->json(
                 [
                   'success' => false,
                   'message' => 'عملیات انجام نشد.'
                 ]
            );
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
        $category = category::find($id);
        return view('backend.categories.edit')->with('category',$category);
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

            $category = category::find($id);
            $data = $request -> all();

            $category -> name = $data['name'];        
            $category -> save();
            return redirect()->route('categories.index')->with('success','عملیات موفقانه انجام شد.');

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
           $category = category::find($id);
           $category -> delete();
           return redirect()->route('categories.index')->with('success','عملیات موفقانه انجام شد.');
        } catch (Exception $e) {
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
    }
}
