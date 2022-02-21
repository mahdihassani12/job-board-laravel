<?php

namespace App\Http\Controllers;

use App\Post;
use App\category;
use DB;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $company_id = DB::table('companies')->where('user_id','=',$user_id)->select('id')->pluck('id')->first();
        $posts = DB::table('posts')->where('company_id', '=', $company_id)->orderby('id','DESC')->paginate(10);
        return view('frontend.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.posts.create');
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
                'title' 	=> 'required',
                'vacancy'	=> 'required',
                'salary'	=> 'required',
				'salaryText' => 'required',
                'address'	=> 'required',
                'deadline'	=> 'required', 
                'description' => 'required',             
                'type' => 'required',                          
            ],
             [
                 'title.required'  => 'عنوان شغل الزامی است.',
                 'vacancy.required'  => 'ظرفیت برای این شغل الزامی است.',
                 'salary.required'  => 'مقدار معاش به عدد الزامی است.',
                 'address.required'  => 'آدرس شغل الزامی است.',
                 'deadline.required'  => 'تاریخ ختم الزامی است.',
                 'description.required'  => 'توضیحات الزامی است.',
                 'type.required'  => 'نوعیت شغل الزامی است.',
				 'salaryText.required' => 'مقدار معاش به حرف الزامی است.'
             ]);

            $post = new Post();
            $data = $request -> all();

            $post -> title = $data['title'];
            $post -> description = $data['description'];
            $post -> salary = $data['salary'];
			$post -> salaryText = $data['salaryText'];
            $post -> address = $data['address'];
            $post -> type = $data['type'];
            $post -> vacancy = $data['vacancy'];
            $post -> deadline = $data['deadline'];
            $post -> company_id = $data['company_id'];            
            $post -> status = 'publish';            
            $post -> save();
            $post->categories()->attach($request->categories);
            return redirect()->route('company_profile')->with('success','عملیات موفقانه انجام شد.');

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
        return view('frontend.posts.edit')->with('post',Post::find($id));
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
                'title' => 'required',
                'vacancy'=> 'required',
                'salary'=> 'required',
				'salaryText'=> 'required',
                'address'=> 'required',
                'deadline'=> 'required', 
                'description' => 'required',             
                'type' => 'required',             
                'category.*' => 'required',             
            ],
             [
                 'title.required'  => 'عنوان شغل الزامی است.',
                 'vacancy.required'  => 'ظرفیت برای این شغل الزامی است.',
                 'salary.required'  => 'معاش شغل الزامی است.',
                 'address.required'  => 'آدرس شغل الزامی است.',
                 'deadline.required'  => 'تاریخ ختم الزامی است.',
                 'description.required'  => 'توضیحات الزامی است.',
                 'type.required'  => 'نوعیت شغل الزامی است.',
                 'category.*.required'  => 'انتخاب دسته الزامی است.',
				 'salaryText.required' => 'مقدار معاش به حرف الزامی است.'
             ]);

            $post = Post::find($id);
            $data = $request -> all();

            $post -> title = $data['title'];
            $post -> description = $data['description'];
            $post -> salary = $data['salary'];
			$post -> salaryText = $data['salaryText'];
            $post -> address = $data['address'];
            $post -> type = $data['type'];
            $post -> vacancy = $data['vacancy'];
            $post -> deadline = $data['deadline'];
            $post -> company_id = $data['company_id'];  
            $post -> status = 'publish';             
            $post -> save();
            $post ->categories()->sync($request->categories);
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
	
	/**
	 * Search job lists
     */
	public function homeSearch(Request $request)
	{	
		
		try{
			$data = $request -> all();
			$categories = Category::all();
			$jobs = DB::table('posts')->join('category_post','category_post.post_id','posts.id')
                                      ->where('category_post.category_id',$data['category'])
                                      ->where('title', 'like', '%' . $request->title . '%')
                                      ->where('address', 'like', '%' . $request->location . '%')
                                      ->select('posts.*')->paginate(20);
            return view('frontend.pages.jobs.search')->with('jobs',$jobs)
                                                    ->with('categories',$categories);
			
		}
		catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }

		
	} //end of homesearch

    public function archiveSearch(Request $request){

        $data = $request -> all();
        $categories = Category::all();

        if($data['type']){

            $jobs = Post::where('type', '=', $request->type )->paginate(20);
            return view('frontend.pages.jobs.search')->with('jobs',$jobs)->with('categories',$categories);

        }elseif($data['address']){

            $jobs = Post::where('address', 'like', '%' . $request->keyword . '%')->paginate(20);
            return view('frontend.pages.jobs.search')->with('jobs',$jobs)->with('categories',$categories);

        }elseif($data['keyword']){

            $jobs = Post::where('title', 'like', '%' . $request->keyword . '%')
                    ->orWhere('description', 'like', '%' . $request->keyword . '%')->paginate(20);
            return view('frontend.pages.jobs.search')->with('jobs',$jobs)->with('categories',$categories);

        }elseif($data['category']){

            $jobs = DB::table('posts')->join('category_post','category_post.post_id','posts.id')
                                      ->where('category_post.category_id',$data['category'])->select('posts.*')->paginate(20);
            return view('frontend.pages.jobs.search')->with('jobs',$jobs)->with('categories',$categories);

        }else{

            $jobs = Post::orderby('id','DESC')->paginate(20);
            return view('frontend.pages.jobs.search')->with('jobs',$jobs)->with('categories',$categories);

        }


    }//end of archiveSearch
}
