<?php

namespace App\Http\Controllers;

use App\Student;
use App\Setting;
use App\category;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{

    public function index(){
		$posts = DB::table('posts')->orderby('id','DESC')->paginate(10);
		$companies = DB::table('companies')->orderby('id','DESC')->paginate(4);
		$categories = DB::table('categories')->orderby('id','DESC')->paginate(10);
    	$students = Student::orderby('id','DESC')->whereYear('created_at', '=', date('Y'))->get();
    	return view('frontend.welcome',compact(['posts','companies','categories','students']));
    }
    
}
