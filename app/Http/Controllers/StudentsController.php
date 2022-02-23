<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\Student;
use App\User;
use App\Document;
use App\Reference;
use App\Experience;
use App\faculty;
use App\department;
use App\Skill;
use App\Message;
use Illuminate\Http\Request;

class StudentsController extends Controller
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
        $student_user = User::where('id', '=', $id)->first();
        $student_id = Student::where('user_id',$id)->select('id')->pluck('id')->first();
        $user = Student::where('user_id',$id)->first();
        $skills = Skill::all();
        $documents = Document::where('student_id',$student_id)->orderby('id','DESC')->get();
        $references = Reference::where('student_id',$student_id)->orderby('id','DESC')->get();
        $experiences = Experience::where('student_id',$student_id)->orderby('id','DESC')->get();
        $departments = department::orderby('name','DESC')->get();
        $faculties = faculty::orderby('name','DESC')->get();

        //messages
        $messages = Message::where('student_id',$student_id)->where('user_type','company')->get();
        $sent_messages = Message::where('student_id', '=', $student_id)->where('user_type','user')->get();
        $unseen_messages = Message::where('student_id', '=', $student_id)->where('status', '=', 'unseen')
                                                              ->where('user_type','company')->get();

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
                                            ->with('sent_messages',$sent_messages)
                                            ->with('unseen_messages',$unseen_messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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

    public function studentAccepted(Request $request, $id){
        try{

            $student = Student::find($id);
            $data = $request -> all();

            $student-> accepted = $request->has('accepted') ? '1' : '0';
            $student ->save();
            return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
    }

    public function getStudents(){

        $users = Student::latest('students.created_at');
        
        if(request('userName')){
            $users = $users->where('firstName','like','%'.request('userName').'%');
        }

        if(request('userFaculites')){
            $users = $users
                    ->join('faculties','students.faculty_id','=','faculties.id')
                    ->where('students.faculty_id','=',request('userFaculites'))
                    ->select('students.id','students.*');
        }

        if(request('userDepartment')){
            $users = $users
                    ->join('departments','students.department_id','=','departments.id')
                    ->where('students.department_id','=',request('userDepartment'))
                    ->select('students.id','students.*');
        }

        $users = $users->where('accepted','=','1')
                       ->paginate(15);

        $faculties = faculty::all();
        $departments = department::all();
        return view('backend.students.accepted',compact(['users','faculties','departments']));
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
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3072',
            ],
             [
                'profile_image.image'  => ' شما فقط مجاز به اپلود عکس هستید. ',
                'profile_image.mimes'  => ' نوعیت فایل شما اشتباه است. ',
                'profile_image.max'  => 'حجم عکس شما زیاد است.',
             ]);
            $student = Student::find($id);
			$user = User::find(auth()->user()->id);
            $data = $request -> all();


            if ($files = $request->file('profile_image')) {
               $destinationPath = 'uploads/student_meta/'; // upload path
               $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
               $files->move($destinationPath, $profileImage);
               $student -> profile_image = $profileImage;

               $photo = Student::find($id)->profile_image;
                if(!is_null($photo) && file_exists(public_path('uploads/student_meta/'.$photo))){
                    unlink(public_path('uploads/student_meta/'.$photo));
                }
               
            }

            if(!empty($data['firstName'])){
                $student -> firstName = $data['firstName'];
                $user -> name = $data['firstName'];
            }

            if(!empty($data['bio'])){
                $student -> bio = $data['bio'];
            }

            if(!empty($data['lastName'])){
                $student -> lastName = $data['lastName'];
            }

            if(!empty($data['fatherName'])){
                $student -> fatherName = $data['fatherName'];
            }

            if(!empty($data['education_level'])){
                $student -> education_level = $data['education_level'];
            }

            if(!empty($data['phone'])){
                $student -> phone = $data['phone'];
            }

            if(!empty($data['email'])){
                $student -> email = $data['email'];
                $user -> email = $data['email'];
            }

            if(!empty($data['gender'])){
                $student -> gender = $data['gender'];
            }

            if(!empty($data['mother_tonque'])){
                $student -> mother_tonque = $data['mother_tonque'];
            }

            if(!empty($data['address'])){
                $student -> address = $data['address'];
            }

            if(!empty($data['school_name'])){
                $student -> school_name = $data['school_name'];
            }

            if(!empty($data['school_address'])){
                $student -> school_address = $data['school_address'];
            }

            if(!empty($data['school_graduation_year'])){
                $student -> school_graduation_year = $data['school_graduation_year'];
            }

            if(!empty($data['uni_percentage'])){
                $student -> uni_percentage = $data['uni_percentage'];
            }

            if(!empty($data['school_percentage'])){
                $student -> school_percentage = $data['school_percentage'];
            }

            if(!empty($data['uni_enrolled_year'])){
                $student -> uni_enrolled_year = $data['uni_enrolled_year'];
            }

           if(!empty($data['faculty'])){
                $student -> faculty_id = $data['faculty'];
            }

            if(!empty($data['department'])){
                $student -> department_id = $data['department'];
            }

            if(!empty($data['skills'])){
                $student -> user_skills = $data['skills'];
            }

            if(!empty($data['uni_graduation_year'])){
                $student -> uni_graduation_year = $data['uni_graduation_year'];
            }

            if(!empty($data['master_entry_date'])){
                $student -> master_entry_date = $data['master_entry_date'];
            }

            if(!empty($data['master_field'])){
                $student -> master_field = $data['master_field'];
            }

            if(!empty($data['master_percentage'])){
                $student -> master_percentage = $data['master_percentage'];
            }

            if(!empty($data['master_end_date'])){
                $student -> master_end_date = $data['master_end_date'];
            }

            if(!empty($data['research'])){
                $student -> research = $data['research'];
            }

            if(!empty($data['achievement'])){
                $student -> achievement = $data['achievement'];
            }
            
            $student -> user_id = auth()->user()->id;            
            $student -> save();
            $user -> save();
            $student->skills()->sync($request->skill_cat);
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

    public function studentSetting(Request $request, $id)
    {
        try{

            $this->validate($request,[
                'old_pass' => 'required',
                'new_pass'=> 'required|min:6',            
            ],[
                'new_pass.required' => ' پسورد جدید الزامی است. ',
                'old_pass.required' => ' پسورد فعلی الزامی است. ',
                'new_pass.min'      => 'پسورد باید حداقل شش حرف باشد.'
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

    public function studentsSearch(Request $request){
        try{
            $data = $request -> all();
            $faculties = faculty::all();
            $departments = department::all();
            $students = Student::where('gender','like','%'.$request->gender.'%')
                                ->where('faculty_id','like','%'.$request->faculty.'%')
                                ->where('department_id','like','%'.$request->department.'%')
                                ->where('uni_graduation_year','like',
                                        '%'.$request->uni_graduation_year.'%')
                                ->paginate(20);
            return view('frontend.pages.students.search',
                   compact(['students','faculties','departments']));
        }
        catch(Exception $e){

            $faculties = faculty::all();
            $departments = department::all();
            $students = Student::orderby('id','desc')->paginate(20);
            return view('frontend.pages.students.search',compact(['students','faculties','departments']));
            
        }

    }

}
