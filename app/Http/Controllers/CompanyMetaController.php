<?php

namespace App\Http\Controllers;

use DB;
use App\Company;
use App\User;
use App\Post;
use App\Message;
use Illuminate\Http\Request;

class CompanyMetaController extends Controller
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
        $id = auth()->user()->id;
        $company_user = Company::where('user_id',$id)->first();
        $users = User::where('id',$id)->first();
        $company_id = DB::table('companies')->where('user_id','=',$id)->select('id')->pluck('id')->first(); 
        $posts = Post::all();
        if($posts->count() > 0){
            $posts = Post::where('company_id',$company_id)->get();
        }

        //messages
        $messages = Message::where('company_id',$company_id)->where('user_type','user')->get();
        $sent_messages = Message::where('company_id', '=', $company_id)->where('user_type','company')->get();
        $unseen_messages = Message::where('company_id', '=', $company_id)->where('status', '=', 'unseen')
                                                              ->where('user_type','user')->get();

        $user = Company::where('user_id',$id)->first();

        return view('frontend.companies.update',compact(['id','user','company_user','posts', 'users', 'messages', 'sent_messages', 'unseen_messages']));
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
                'name' => 'required',
                'email'=> 'required',
                'phone'=> 'required', 
                'foundation_year' => 'required',
                'address' => 'required',
                'description' => 'required',
                'type' => 'required',              
                'base_type' => 'required',              
            ],
             [
                 'name.required'  => 'فیلد نام شرکت الزامی است.',
                 'email.required'  => 'فیلد ایمیل شرکت الزامی است.',
                 'phone.required'  => 'فیلد شماره تماس الزامی است.',
                 'foundation_year.required'  => 'فیلد سال تاسیس الزامی است.',
                 'address.required'  => 'فیلد آدرس الزامی است.',
                 'type.required'  => 'فیلد نوع فعالیت الزامی است.',
                 'base_type.required'  => 'فیلد نوع سازمان الزامی است.',
                 'description.required'  => ' فیلد توضیحات الزامی است. ',
             ]);

            $company = new Company();
            $data = $request -> all();

            $company -> name = $data['name'];
            $company -> phone = $data['phone'];
            $company -> email = $data['email'];
            $company -> foundation_year = $data['foundation_year'];
            $company -> address = $data['address'];
            $company -> description = $data['description'];
            $company -> type = $data['type'];
            $company -> base_type = $data['base_type'];

            if ($files = $request->file('logo')) {
               $destinationPath = 'uploads/company_meta/'; // upload path
               $profile_image = date('YmdHis') . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $profile_image);
               $company -> logo = $profile_image;
            }

            if(!empty($data['website'])){
                $company -> website = $data['website'];
            }
            if(!empty($data['facebook'])){
                $company -> facebook = $data['facebook'];
            }
            if(!empty($data['instagram'])){
                $company -> instagram = $data['instagram'];
            }
            
            $company -> user_id = auth()->user()->id ;            
            $company -> save();
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
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
             [
                'logo.image'  => ' شما فقط مجاز به اپلود عکس هستید. ',
                'logo.mimes'  => ' نوعیت فایل شما اشتباه است. ',
                'logo.max'  => 'حجم عکس شما زیاد است.',
             ]);

            $company = Company::find($id);
            $user = User::find(auth()->user()->id);
            $data = $request -> all();

            if(!empty($data['name'])){
                $company -> name = $data['name'];
                $user -> name = $data['name'];
            }
            if(!empty($data['phone'])){
                $company -> phone = $data['phone'];
            }
            if(!empty($data['email'])){
                $company -> email = $data['email'];
                $user -> email = $data['email'];
            }
            if(!empty($data['foundation_year'])){
                $company -> foundation_year = $data['foundation_year'];
            }
            if(!empty($data['address'])){
               $company -> address = $data['address'];
            }
            if(!empty($data['description'])){
                $company -> description = $data['description'];
            }
            if(!empty($data['type'])){
                $company -> type = $data['type'];
            }
            if(!empty($data['base_type'])){
                $company -> base_type = $data['base_type'];
            }
            if(!empty($data['website'])){
                $company -> website = $data['website'];
            }
            if(!empty($data['facebook'])){
                $company -> facebook = $data['facebook'];
            }
            if(!empty($data['instagram'])){
                $company -> instagram = $data['instagram'];
            }

            if ($files = $request->file('logo')) {
               $destinationPath = 'uploads/company_meta/'; // upload path
               $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $profileImage);
               $featured_image = "$profileImage";
               $company -> logo = $featured_image;

               $photo = Company::find($id)->logo;
                if(!is_null($photo) && file_exists(public_path('uploads/company_meta/'.$photo))){
                    unlink(public_path('uploads/company_meta/'.$photo));
                }
               
            }
            
            $company -> user_id = auth()->user()->id ;            
            $company -> save();
            $user -> save();
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

    public function companiesSearch(Request $request){
        
        try{
            $data = $request -> all();                                                                        
            $companies = Company::where('address', 'like', '%' . $request->address . '%')
                        ->where('name','like','%'.$request->name.'%')
                        ->where('base_type','like','%'.$request->base_type.'%')
                        ->orderby('id','desc')
                        ->paginate(20);
            return view('frontend.pages.companies.search')->with('companies',$companies);
        }
        catch(Exception $e){
            $companies = Company::orderby('id','desc')->paginate(20);
            return view('frontend.pages.companies.search')->with('companies',$companies);
        }
    }

}
