<?php

namespace App\Http\Controllers;

use DB;
use App\contactMessage;
use App\contactInfo;
use App\Blog;
use App\Post;
use App\Student;
use App\Company;
use App\category;
use App\faculty;
use App\department;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    //showing pages
    public function job_page(){
        $jobs = Post::orderby('id','DESC')->paginate(20);
        $categories = Category::all();
        return view('frontend.pages.jobs.index')->with('jobs',$jobs)->with('categories',$categories);
    }

    public function job_detail($id){
        $job = Post::find($id);
        return view('frontend.pages.jobs.show')->with('job',$job);
    }

    public function companies_page(){
        $companies = Company::orderby('id','DESC')->paginate(20);
        return view('frontend.pages.companies.index')->with('companies',$companies);
    }

    public function company_details($id){
        $user = Company::find($id);
        return view('frontend.pages.companies.show')->with('user',$user);
    }

    public function students_page(){
        $students = Student::orderby('id','DESC')->paginate(20);
        $faculties = faculty::all();
        $departments = department::all();
        return view('frontend.pages.students.index',compact(['students','faculties','departments']));
    }

    public function student_detail($id){
        $student = Student::find($id);
        $documents = DB::table('documents')->where('student_id', '=', $id)->orderby('id','DESC')->get();
        $references = DB::table('student_references')->where('student_id', '=',$id)
                     ->orderby('id','DESC')->get();
        $experiences = DB::table('experiences')->where('student_id', '=', $id)
                    ->orderby('id','DESC')->get();
        return view('frontend.pages.students.show',compact(['documents','references','experiences']))->with('student',$student);
    }

    public function blogPage(){
        $posts = Blog::orderby('id','DESC')->paginate(20);
        return view('frontend.pages.blog.index')->with('posts',$posts);
    }

    public function singleBlog($id){
        $blog = Blog::find($id);
        return view('frontend.pages.blog.show')->with('blog',$blog);
    }
    public function contact(){
        $info = DB::table('contact_info')->first();
        return view('frontend.pages.contact.index')->with('info',$info);
    }
}
