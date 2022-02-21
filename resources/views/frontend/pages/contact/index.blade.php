@extends('frontend.layouts.app')
@section('main_content')

	<!-- CONTACT SECTION -->
	<section id="contact" class="parallax-section">
		 <div class="container">
			  <div class="row">

				   <div class="col-md-12 col-sm-12">
						<!-- SECTION TITLE -->
						<div class="wow fadeInUp section-title" data-wow-delay="0.2s">
							 <h2>تماس باما</h2>
							 <p>توسط فرم زیر میتوانید باما در ارتباط بوده و یا به شماره های ذکر شده به تماس شوید</p>
						</div>
				   </div>

				   <div class="col-md-7 col-sm-10">
						<!-- CONTACT FORM HERE -->
						<div class="wow fadeInUp" data-wow-delay="0.4s">
							<form action="{{ route('contact.store') }}" method="post">
									@csrf
								  <div class="col-md-12 col-sm-12">
									   <input type="text" class="form-control" name="name" 
											  placeholder="نام کامل" autocomplete="off">
								  </div>
								  <div class="col-md-12 col-sm-12">
									   <input type="text" class="form-control" name="phone" 
											  placeholder="شماره تماس" autocomplete="off">
								  </div>
								  <div class="col-md-12 col-sm-12">
									   <input type="email" class="form-control" name="email" 
									          placeholder="ایمیل آدرس" autocomplete="off">
								  </div>
								  <div class="col-md-12 col-sm-12">
									   <textarea class="form-control" rows="5" name="description" placeholder="پیام شما"></textarea>
								  </div>
								  <div class="submit_div">
									   <button id="submit" type="submit" class="btn">ارسال پیام</button>
								  </div>
							</form>
						</div>
				   </div>

				   <div class="col-md-5 col-sm-8">
						<!-- CONTACT INFO -->
						<div class="wow fadeInUp contact-info" data-wow-delay="0.4s">
							 <div class="section-title">
								  <h2>معلومات تماس</h2>
								  <p>{{ $info ? $info->description: '' }}</p>
							 </div>
							 
							 <p><i class="fa fa-map-marker">آدرس : </i>{{ $info ? $info->address : '' }}</p>
							 <p><i class="fa fa-comment">ایمیل آدرس : </i>
							 	<a href="{{ $info ? $info->email : '' }}">{{ $info ? $info->email : '' }}
							 	</a>
							</p>
							 <p><i class="fa fa-phone">شماره تماس : </i>{{ $info ? $info->phone : '' }}</p>
						</div>
				   </div>

			  </div>
		 </div>
	</section>

@endsection

@section('style')
  <style>
	.contact-info i{
		color: #000;
		font-weight: 600;
	}
	.submit_div{
		text-align:left;
		padding-left:15px;
	}
    .header-area{
      position: unset;
      background: rgba(0, 29, 56, 0.8);
    }
    .alert{
      position: fixed;
      bottom: 0;
    }
   body{
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;    
    }	
	#contact{
		text-align:right;
		direction:rtl;
		margin-top:30px;
	}
	.contact-info .fa {
	  padding-right: 5px;
	}

	#contact .form-control {
	  border: none;
	  border-bottom: 2px solid #f0f0f0;
	  border-radius: 0px;
	  box-shadow: none;
	  font-size: 18px;
	  margin-top: 10px;
	  margin-bottom: 10px;
	  -webkit-transition: all ease-in-out 0.4s;
	  transition: all ease-in-out 0.4s;
	  width:100%;
	  text-align:right;
	}

	#contact .form-control:focus {
	  border-bottom-color: #999999;
	}

	#contact input {
	  height: 55px;
	}

	#contact button#submit {
	  background: #00d363;
    border: none;
    border-radius: 12px;
    color: #ffffff;
    margin-top: 24px;
    padding: 10px 20px;
	}
	input[type=email]{
		padding:15px 15px;
		background:#fff;
		margin:unset;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function() {

    });
</script>
@endsection