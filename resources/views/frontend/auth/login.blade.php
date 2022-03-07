@extends('frontend.layouts.app')
@section('main_content')

<section class="login_register">
	<div class="wrapper fadeInDown">
	  <div id="formContent">
	    <!-- Tabs Titles -->
	    <h2 class="active"> ورود </h2>

	    <!-- Login Form -->
	    <form method="post" action="{{ route('postLogin') }}">
	    	@csrf
	      <input type="text" id="email" 
	      		class="fadeIn second" name="email" 
	      		placeholder="ایمیل آدرس" autocomplete="off" value="{{ old('email') }}">
	      <input type="password" id="password" 
	      		 class="fadeIn third" name="password" 
	      		 placeholder="پسورد" autocomplete="off" >
	      <input type="submit" class="fadeIn fourth submit" value="ورود">
	    </form>

	    <!-- Remind Passowrd -->
	    <div id="formFooter">
	      <a class="underlineHover" href="{{ route('forget') }}" style="display: block;">رمز خودرا فراموش کرده اید؟</a>
	      <a class="underlineHover" href="{{ route('register') }}">ثبت نام</a>
	    </div>

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
  	.close{
		font-size: 30px;
    margin-right: 5px;
	}
	input{
		text-align:right !important;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection