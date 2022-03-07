@extends('frontend.layouts.app')
@section('main_content')

<section class="login_register">
	<div class="wrapper fadeInDown">
	  <div id="formContent">
	    <!-- Tabs Titles -->
	    <h2 class="active">ثبت نام</h2>

	    <!-- Login Form -->
	    <form method="post" action="{{ route('postRegisterCo',['status' => 'pending']) }}">
	    	@csrf
	      <input type="text" id="username" 
	      		class="fadeIn second" name="username" 
	      		placeholder="نام کامل" autocomplete="off" value="{{ old('username') }}">

	      <input type="email" name="email"
	      		 class="fadeIn second" name="email" 
	      		placeholder="ایمیل آدرس" autocomplete="off" value="{{ old('email') }}">	

	      <input type="password" id="password" 
	      		 class="fadeIn third" name="password" 
	      		 placeholder="پسورد" autocomplete="off" >

	       <select class="fadeIn second" name="role" id="role" dir="rtl">
	       		<option value="admin">ادمین</option>
	       		<option value="company">کمپنی</option>
	       </select>
	      		 
	      <input type="submit" class="fadeIn fourth submit" value="ثبت نام">
	    </form>

	  </div>
	</div>
</section>

@endsection

@section('style')
  <style>
  	.footer{
  		display: none;
  	}
  	.alert{
  		position: absolute;
  		bottom: 0;
  	}
	input , select{
		text-align:right !important;
	}
	.close{
		font-size: 30px;
    margin-right: 5px;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection