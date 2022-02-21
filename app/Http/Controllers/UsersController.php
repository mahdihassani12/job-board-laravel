<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\User;
use App\Company;
use App\Post;
use App\Student;
use App\Document;
use App\Reference;
use App\Experience;
use App\Message;
use App\Skill;
use App\faculty;
use App\department;
use App\Enroll;
use App\contactMessages;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    // functions for returning to profiles

    public function user_profile(){

        $id = auth()->user()->id;
        $student_user = User::where('id', '=', $id)->first();
        $student_id = DB::table('students')->where('user_id',$id)->select('id')->pluck('id')->first();
        $user = Student::where('user_id',$id)->first();
        $skills = Skill::all();
        $documents = Document::where('student_id',$student_id)->orderby('id','DESC')->get();
        $references = Reference::where('student_id',$student_id)->orderby('id','DESC')->get();
        $experiences = Experience::where('student_id',$student_id)->orderby('id','DESC')->get();
        $departments = department::orderby('name','DESC')->get();
        $faculties = faculty::orderby('name','DESC')->get();

        //messages
        $messages = Message::where('user_id',$id)->get();
        $unseen_messages = Message::where('user_id', '=', $id)->where('status', '=', 'unseen')
                                                                      ->get();

        return view('frontend.users.update')->with('id',$id)
                                            ->with('student_user',$student_user)
                                            ->with('student_id',$student_id)
                                            ->with('user',$user)
                                            ->with('skills',$skills)
                                            ->with('documents',$documents)
                                            ->with('references',$references)
                                            ->with('experiences',$experiences)
                                            ->with('departments',$departments)
                                            ->with('faculties',$faculties)
                                            ->with('messages',$messages)
                                            ->with('unseen_messages',$unseen_messages);
    }

    public function admin_profile(){

        $posts = Post::count();
        $students = Student::count();
        $companies = Company::count();
        $acceptedStudents = Student::where('accepted','=','1')->count();
        $pending_users = User::orderby('id','DESC')->where('status','pending')->paginate(10);
        $messages = contactMessages::orderBy('id','DESC')->where('status','unseen')->paginate(10);

        return view('backend.welcome')->with('acceptedStudents',$acceptedStudents)
                                      ->with('posts',$posts)
                                      ->with('students',$students)
                                      ->with('companies',$companies)
                                      ->with('pending_users',$pending_users)
                                      ->with('messages',$messages);
    }

    public function company_profile(){

        $id = auth()->user()->id;
        $company_user = Company::where('user_id',$id)->first();
        $users = User::where('id',$id)->first();
        $company_id = Company::where('user_id','=',$id)->select('id')->pluck('id')->first();
         
        $posts = Post::all();
        if($posts->count() > 0){
            $posts = Post::where('company_id',$company_id)->get();
        }

        //messages
        $messages = Message::where('user_id',$id)->get();
        $unseen_messages = Message::where('user_id', '=', $id)->where('status', '=', 'unseen')
                                                              ->get();

        $enrolls = Enroll::where('company_id',$company_id)->get();
        $user = Company::where('user_id',$id)->first();

        return view('frontend.companies.update')->with('id',$id)
                                                ->with('company_user',$company_user)
                                                ->with('users',$users)
                                                ->with('company_id',$company_id)
                                                ->with('posts',$posts)
                                                ->with('messages',$messages)
                                                ->with('unseen_messages',$unseen_messages)
                                                ->with('enrolls',$enrolls)
                                                ->with('user',$user);
    }

    public function companySetting(Request $request, $id){

        try{

            $this->validate($request,[
                'old_pass' => 'required',
                'new_pass'=> 'required',            
            ],
            [
                'old_pass.required' => ' پسورد فعلی الزامی است. ',
                'new_pass.required' => ' پسورد جدید الزامی است. '
            ]);

            $user = User::find($id);
            $data = $request -> all();
				
			if( Hash::check($data['old_pass'], $user->password) ){
				$user -> password = bcrypt($data['new_pass']);
			}else{
				return redirect()->back()->with('error','پسورد تایید نشده است. ');
			}	
				
           $user -> save();
            return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }

    }

    public function updateCred(Request $request, $id)
    {
       try{

            $this->validate($request,[
                'userName' => 'required',
                'email'=> 'required',            
            ],
            [
                'userName.required' => 'فیلد نام کاربری الزامی میباشد.',
                'email.required' => 'فیلد ایمیل الزامی میباشد.'
            ]);

            $user = User::find($id);
            $data = $request -> all();

            $user -> name = $data['userName'];
            $user -> email = $data['email'];

            if(!empty($data['password']) && !empty($data['newPassword']) ){
                
                if (Hash::check($data['password'], $user->password)) {
                   $user -> password = bcrypt($data['newPassword']);
                }else{
                    return redirect()->back()->with('error','پسورد تایید نشده است. ');
                }
                                
            }
            $user -> save();
            return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
    }

}
