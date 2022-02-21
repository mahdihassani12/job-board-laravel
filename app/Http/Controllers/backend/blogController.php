<?php

namespace App\Http\Controllers\backend;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.create');
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
                'description' => 'required',         
                'featured_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:3072',         
            ],
             [
                 'title.required'  => 'فیلد عنوان الزامی میباشد.',
                 'description.required' => 'فیلد توضیحات الزامی میباشد.',
                 'featured_image.required' => 'انتخاب عکس مشخصه الزامی میباشد.',
                 'featured_image.mimes' =>'فایل انتخاب شده عکس نمیباشد.',
                 'featured_image.max'   => 'حجم عکس نباید از سه ام بی بیشتر باشد.'
             ]);

            $blog = new Blog();
            $data = $request -> all();

            $blog -> title = $data['title'];
            $blog -> description = $data['description'];

            if ($files = $request->file('featured_image')) {
               $destinationPath = 'uploads/posts/'; // upload path
               $featured_image = date('YmdHis') . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $featured_image);
               $blog -> featured_image = $featured_image;
            }

            $blog -> user_id = auth()->user()->id ;            
            $blog -> save();
            $blog->categories()->attach($request->categories);
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.blog.edit')->with('blog',Blog::find($id));
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
                'title' => 'required',         
                'description' => 'required',         
                'featured_image' => 'mimes:jpeg,png,jpg,gif,svg|max:3072',         
            ],
             [
                 'title.required'  => 'فیلد عنوان الزامی میباشد.',
                 'description.required' => 'فیلد توضیحات الزامی میباشد.',
                 'featured_image.mimes' =>'فایل انتخاب شده عکس نمیباشد.',
                 'featured_image.max'   => 'حجم عکس نباید از سه ام بی بیشتر باشد.'
             ]);

            $blog = Blog::find($id);
            $data = $request -> all();

            $blog -> title = $data['title'];
            $blog -> description = $data['description'];

            if ($files = $request->file('featured_image')) {
               $destinationPath = 'uploads/posts/'; // upload path
               $featured_image = date('YmdHis') . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $featured_image);
               $blog -> featured_image = $featured_image;

               $photo = Blog::find($id)->featured_image;
                if(!is_null($photo) && file_exists(public_path('uploads/posts/'.$photo))){
                    unlink(public_path('uploads/posts/'.$photo));
                }
            }

            $blog -> user_id = auth()->user()->id ;            
            $blog -> save();
            $blog ->categories()->sync($request->categories);
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
        try {
           $blog = Blog::find($id);
           $blog -> delete();
           return redirect()->route('blog.index')->with('success','عملیات موفقانه انجام شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
    }
}
