<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Company;
use App\Setting;
use App\User;
use App\faculty;
use App\department;

class adminController extends Controller
{
    

    // Pages route for admin panel

    public function companies_lists(){
        $companies = Company::orderby('id','DESC');

        if(request('companyName')){
            $companies = $companies->where('name','like','%'.request('companyName').'%');
        }

        if(request('companyAddress')){
            $companies = $companies->where('address','like','%'.request('companyAddress').'%');
        }

        if(request('companyType')){
            $companies = $companies->where('base_type','like','%'.request('companyType').'%');
        }

        $companies = $companies->paginate(15);
        return view('backend.companies.index')->with('companies',$companies);
    }

    public function students_lists(){


        $users = User::orderby('id','ASC');
        
        if(request('userName')){
            $users = $users->where('name','like','%'.request('userName').'%');
        }

        if(request('userFaculites')){
            $users = $users
                    ->join('students','users.id','=','students.user_id')
                    ->join('faculties','students.faculty_id','=','faculties.id')
                    ->where('students.faculty_id','=',request('userFaculites'))
                    ->select('users.id','users.*');
        }

        if(request('userDepartment')){
            $users = $users
                    ->join('students','users.id','=','students.user_id')
                    ->join('departments','students.department_id','=','departments.id')
                    ->where('students.department_id','=',request('userDepartment'))
                    ->select('users.id','users.*');
        }

        $users = $users->where('role','user')
                       ->paginate(15);

        $faculties = faculty::all();
        $departments = department::all();
        return view('backend.students.index')->with('users',$users)
                                             ->with('faculties',$faculties)
                                             ->with('departments',$departments);
    }

    public function jobs_lists(){
        return view('backend.posts.index');
    }

    public function settings(){
        $id = auth()->user()->id ;
        $user = User::where('role','admin')->where('id',$id)->first();
        $settings = Setting::first();
        return view('backend.settings.index',compact(['settings','user','id']));
    }

}
