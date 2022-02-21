<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Company;
use App\Setting;
use App\User;

class adminController extends Controller
{
    

    // Pages route for admin panel

    public function companies_lists(){
        $companies = Company::orderby('id','DESC')->paginate(15);
        return view('backend.companies.index')->with('companies',$companies);
    }

    public function students_lists(){
        $users = User::where('role','user')->orderby('id','DESC')->paginate(15);
        return view('backend.students.index')->with('users',$users);
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
