<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Excel;
use Session;
use \Exception;
use App\Company;
use App\User;
use App\Student;
use App\faculty;
use App\department;
use Illuminate\Support\Str;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    
    // login process
    public function login(){
        return view('frontend.auth.login');
    }

    // checking the authentication
    public function postLogin(Request $request)
    {

        try{

            $this->validate($request,[
                'email'=> 'required',
                'password'=> 'required', 
                           
            ],[
                'email.required' => 'فیلد ایمیل الزامی است.',
                'password.required' => 'فیلد پسورد الزامی است.'
            ]);


            $data = $request -> all();
            $email = $data['email'];
            $password = $data['password'];

            if (Auth::attempt(['email' => $email, 'password' => $password,'role'=>'admin','status' => 'publish' ])) {

                return redirect()->route('admin_profile');

            }else if (Auth::attempt(['email' => $email, 'password' => $password,'role'=>'user','status' => 'publish'])) {

                return redirect()->route('user_profile');

            }elseif (Auth::attempt(['email' => $email, 'password' => $password,'role'=>'company','status' => 'publish'])) {

                return redirect()->route('company_profile');

            }else{
                return redirect()->back()->withInput()->with('error',' ایمیل یا پسورد اشتباه میباشد. ');
            }

        }
        catch(Exception $e){
            return redirect()->back()->withInput()->with('error','عملیات انجام نشد!');
        }

    }


    // register process
    public function register(){
        return view('frontend.auth.register');
    }


    // register auth view to register with pending status
    public function postRegisterCo(Request $request){
        try{
            $this->validate($request,[
                'username' => 'required',
                'role' => 'required',
                'email'=> 'required|email|unique:users',        
                'password'=> 'required|min:6',        
            ],[
                'email.required' => 'فیلد ایمیل الزامی است.',
                'username.required' => 'فیلد نام کامل الزامی است.',
                'role.required' => 'انتخاب نقش کاربری الزامی است.',
                'password.required' => 'فیلد پسورد الزامی است.',
                'email.email' => 'فیلد ایمیل فرمت نادرست دارد',
                'email.unique' => 'ایمیل آدرس قبلا استفاده شده است.',
                'password.min' => 'پسورد حداقل باید شش حرف باشد.'
            ]);

            $user = new User();
            $data = $request -> all();
            $user -> name = $data['username'];
            $user -> email  = $data['email'];
            $user -> role = $data['role'];
            $user -> password = bcrypt($data['password']);
            $user -> status = $data['status'];
            $user -> save();
            
            return redirect('login')->with('success','عملیات موفقانه انجام شد, لطفا تا تایید ادمین سایت صبر کنید.');

        }
        catch(Exception $e){
            return redirect()->back()->withInput()->with('error','عملیات انجام نشد!');
        }
    }

    // registering the single user
    public function postRegister(Request $request)
    {  

        $this->validate($request,[
            'username' => 'required',
            'lastname' => 'required',
            'email'=> 'required|unique:users', 
            'faculty'=> 'required', 
            'department'=> 'required', 
            'uni_enrolled_year'=> 'required', 
            'uni_graduation_year'=> 'required', 
            'season'=> 'required', 
                       
        ],[
            'email.required' => 'فیلد ایمیل الزامی است.',
            'username.required' => 'فیلد نام الزامی است.',
            'lastname.required' => 'فیلد تخلص الزامی است.',
            'faculty.required' => 'انتخاب فاکولته الزامی است.',
            'department.required' => 'انتخاب دیپارتمنت الزامی است.',
            'uni_enrolled_year.required' => 'سال ورود به دانشگاه الزامی است.',
            'uni_graduation_year.required' => 'سال فراغت الزامی است.',
            'season.required' => 'انتخاب فصل الزامی است.',
            'email.unique'    => 'ایمیل از قبل استفاده شده است.'
        ]);

        $user = new User();
        $student = new Student();
        $data = $request -> all();
        
        $user -> name = $data['username'];
        $user -> email  = $data['email'];
        $user -> role = $data['role'];
        $pass = 'hu-'.Str::random(10);
        $user->primary_password = $pass;
        $user->password = bcrypt($pass);
        $user -> status = 'publish';
        
        try {
            DB::beginTransaction();    
            
            $user -> save();
            $id = $user ->id;
            $student -> user_id = $id;
            $student -> email = $data['email'];
            $student -> department_id = $data['department'];
            $student -> faculty_id = $data['faculty'];
            $student -> season = $data['season'];            
            $student -> lastName = $data['lastname'];            
            $student -> firstName = $data['username'];            
            $student -> uni_enrolled_year = $data['uni_enrolled_year'];            
            $student -> uni_graduation_year = $data['uni_graduation_year'];            
            $student -> save();

            $details  = [
                'email' => $data['email'],
                'password' => $pass
            ];
            \Mail::to($data['email'])->send(new \App\Mail\mailStudents($details ));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error','عملیات انجام نشد!');
            throw $e;
        }

        return redirect()->route('admin.students')->with('success','عملیات موفقانه انجام شد.');

    }

    // return the view
    public function addStudent(){
        $faculties = faculty::all();
        $departments = department::all();
        return view('backend.students.add')->with('faculties',$faculties)
        ->with('departments',$departments);
    }


    public function logout(Request $request) {
      Auth::logout();
      return redirect('/');
    }

    //updating the company or admins register by view
    // waiting for admin to approve them
    public function update(Request $request, $id){
		
        if(Company::where('user_id','=',$id)->exists()){

            if($request->pending == 'true'){
                try {
                    DB::beginTransaction();
                    $user = User::find($id);
                    $user -> status = 'pending';
                    $user -> save();
                    $company = Company::find($request->company_id);
                    $company -> status = 'pending';
                    $company->save();
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->back()->with('error','عملیات انجام نشد!');
                    throw $e;
                }
                return redirect()->back()->with('success','عملیات موفقانه انجام شد.');
            }elseif($request->pending == 'false'){
                try {
                    DB::beginTransaction();
                    $user = User::find($id);
                    $user -> status = 'publish';
                    $user -> save();
                    $company = Company::find($request->company_id);
                    $company -> status = 'publish';
                    $company->save();
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->back()->with('error','عملیات انجام نشد!');
                    throw $e;
                }
                return redirect()->back()->with('success','عملیات موفقانه انجام شد.');
            }

        }else{
            // the company user not exists, so we create a user for that.
            try {
                DB::beginTransaction();
                $user =User::find($id);
                $user -> status = 'publish';
                $user -> save();
                $company = new Company();
                $company -> user_id = $user -> id; 
                $company -> name = $user -> name; 
                $company -> email = $user -> email; 
                $company -> save(); 
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error','عملیات انجام نشد!');
                throw $e;
            }
            return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

        }

    }

    public function destroy($id){
        
        try {

            $user =User::find($id);
            $user -> delete();
            return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

        } catch (\Exception $e) {

            return redirect()->back()->with('error','عملیات انجام نشد!');

        }
    }


    // using excel file to import students

    // get the get
    public function getImport(){

        $faculties = faculty::all();
        $departments = department::all();
        return view('backend.students.excel',compact(['faculties','departments']));

    }

    // send the excel file to import into database
    public function importExcel(Request $request){

        try{
            $this->validate($request,[
                'faculty' => 'required',
                'department'=> 'required',            
                'season'=> 'required',            
                'file'=> 'required',            
            ],[
                'faculty.required' => 'انتخاب فاکولته الزامی است.',
                'department.required' => 'انتخاب دیپارتمنت الزامی است.',
                'season.required' => ' انتخاب فصل الزامی است. ',
                'file.required' => ' اپلود فایل الزامی است. ',
            ]);

            $data = $request -> all();
			$faculty_id = $data['faculty'];
			$department_id = $data['department'];
			$season = $data['season'];
			
			Excel::import(new UsersImport($faculty_id, $department_id, $season), request()->file('file'));
            return redirect()->back()->with('success','عملیات موفقانه انجام شد.');
      
        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }

    }
    
    public function updateSetting(Request $request,$id)
    {
      try{
            $this->validate($request,[
                'userName' => 'required',
                'email'=> 'required',            
            ],[
                'email.required' => 'فیلد ایمیل الزامی است.',
                'userName.required' => ' فیلد نام کاربری الزامی است. ',
            ]);

            $user = User::find($id);
            $data = $request -> all();

            $user -> name = $data['userName'];
            $user -> email = $data['email'];

            if(!empty($data['old_pass']) && !empty($data['new_pass'])){
                
                if( Hash::check($data['old_pass'], $user->password) ){
                    $user -> password = bcrypt($data['new_pass']);
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

    // updating student list using dashboard

    public function editStudentList($id){
        $user = User::find($id);
        $faculties = faculty::all();
        $departments = department::all();
        return view('backend.students.edit',compact(['user','faculties','departments']));
    }

    public function updateStudentList(Request $request,$id){
             
        try{
            $this->validate($request,[
                'username' => 'required',
                'lastname' => 'required',
                'email'=> 'required', 
                'faculty'=> 'required', 
                'department'=> 'required', 
                'uni_enrolled_year'=> 'required', 
                'uni_graduation_year'=> 'required', 
                'season'=> 'required', 
                           
            ],[
                'email.required' => 'فیلد ایمیل الزامی است.',
                'username.required' => 'فیلد نام الزامی است.',
                'lastname.required' => 'فیلد تخلص الزامی است.',
                'faculty.required' => 'انتخاب فاکولته الزامی است.',
                'department.required' => 'انتخاب دیپارتمنت الزامی است.',
                'uni_enrolled_year.required' => 'سال ورود به دانشگاه الزامی است.',
                'uni_graduation_year.required' => 'سال فراغت الزامی است.',
                'season.required' => 'انتخاب فصل الزامی است.',
            ]);

            $user = User::find($id);
            $student = Student::find($request->student_id);
            $data = $request -> all();
            
            $user -> name = $data['username'];
            $user -> email  = $data['email'];
            $user -> role = $data['role'];
            $user -> status = 'publish';
            $user -> save();
            $id = $user ->id;

            $student -> user_id = $id;
            $student -> email = $data['email'];
            $student -> department_id = $data['department'];
            $student -> faculty_id = $data['faculty'];
            $student -> season = $data['season'];            
            $student -> lastName = $data['lastname'];
            $student -> firstName = $data['username'];             
            $student -> uni_enrolled_year = $data['uni_enrolled_year'];            
            $student -> uni_graduation_year = $data['uni_graduation_year'];            
            $student -> save();
            
            return redirect()->route('admin.students')->with('success','عملیات موفقانه انجام شد.');
        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }

    }

    public function deleteStudentList(Request $request,$id){

        try {

            DB::beginTransaction();    
            $user = User::find($id);
            $user -> delete();
            $student = Student::find($request->student_id);
            $student -> delete();     
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error','عملیات انجام نشد!');
            throw $e;
        }

        return redirect()->route('admin.students')->with('success','عملیات موفقانه انجام شد.');

    }

    // forget password process

    public function forget(){
        return view('frontend.auth.forget');
    }

    public function checkEmail(Request $request){
        
    }

}
