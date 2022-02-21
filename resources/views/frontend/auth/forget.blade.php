@extends('frontend.layouts.app')
@section('main_content')

<section class="login_register">
	<div class="wrapper fadeInDown">
	  <div id="formContent">
	    <!-- Tabs Titles -->
	    <h2 class="active mb-4"> رمز خودرا فراموش کرده اید؟ </h2>

	    <!-- reset Form -->
	    <form id="resetForm">
            <div class="form-group">
                <input  type="email" 
                        name="email"
                        placeholder="لطفا ایمیل خودرا وارد کنید." 
                        id="email" class="form-control"
                        autocomplete="off" />
            </div>
            <div class="form-group">
                <button id="submit" class="btn btn-success"> تایید </button>
            </div>
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
	input{
		text-align:right !important;
	}
  </style>
@endsection

@section('script')


<script>
  (function($){


  })(jQuery);
</script>


@endsection