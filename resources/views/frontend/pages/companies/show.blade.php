@extends('frontend.layouts.app')
@section('main_content')
@auth
    <?php
        $id = auth()->user()->id;
        $user_type = auth()->user()->role;
        $student_id = DB::table('students')->where('user_id',$id)->select('id')->pluck('id')->first();
    ?>
@endif

  <section class="container">
      <div class="row">
           <div class="col-md-4">
             
              <div class="card">
                <div class="card-header">
                  <h3> راه ارتباطی </h3>
                </div>  
                <div class="card-body">
                  
                  <div class="company_thumb">
                    @if($user->logo)
                      <img src='{{ url("public/uploads/company_meta/$user->logo") }}' alt="Admin" class="rounded-circle">
                    @else
                      <img src='{{ url("public/uploads/images/author.png") }}' alt="Admin" class="rounded-circle" width="150">
                    @endif  
                  </div>
                    
                  <div class="company_details">
                    <ul>
                      <li>
                        <div class="media">
                          <div class="media-header">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <strong>   فیسبوک : </strong>
                            <h4> {{ $user ? $user->facebook : '' }}</h4>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <div class="media-header">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <strong>   انستاگرام : </strong>
                            <h4>{{ $user ? $user->instagram : '' }}</h4>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <div class="media-header">
                           <i class="fa fa-internet-explorer" aria-hidden="true"></i>
                          </div>
                          <div class="media-body">
                            <strong> وبسایت :  </strong>
                            <h4> {{ $user ? $user->website : '' }} </h4>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  
                </div>
              </div>
			  
			  <div class="card mt-3 mb-5">
				 <div class="card-header">
					ارتباط باما
				 </div>	
				 <div class="card-body">
					<form action="{{ route('message.store') }}" method="post">
						@csrf
						<div class="row">
						  
							<div class="col-md-12 form-group">
								<div class="input_field">
									<input type="text" name='name' placeholder="نام" class="form-control" autocomplete="off">
								</div>
							</div>
							
							<div class="col-md-12 form-group">
								<div class="input_field">
									<input type="text" name='phone' placeholder="شماره تماس" class="form-control" autocomplete="off">
								</div>
							</div>
							
							<div class="col-md-12 form-group">
								<div class="input_field">
									<input type="text" name='title' placeholder="عنوان پیام" class="form-control" autocomplete="off">
								</div>
							</div>

							<div class="col-md-12 form-group">
								<div class="input_field">
									<textarea name="description" id="" cols="20" rows="7" class="form-control" 
									placeholder="توضیحات" autocomplete="off"></textarea>
								</div>
							</div>

							<input type="hidden" name="user_id" value="{{ $user->user_id }}">

							<div class="col-md-12">
								<div class="submit_btn">
									<button class="boxed-btn3 w-100" type="submit">درخواست</button>
								</div>
							</div>
						</div>
					</form>
				 </div>	
			  </div>

           </div> <!-- /col --> 
		   
           <div class="col-md-8">
				
				<div class="card mb-5">
					<div class="card-header">
						 <h3> درباره سازمان </h3>
					</div>
					
					<div class="card-body">
						
						<section>
							<div class="row">
								<div class="col-sm-2">
								  <p><strong> نام سازمان </strong></p>
								</div>
								<div class="col-sm-10 text-secondary">
								   {{ $user ? $user->name : '' }}
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2">
								  <p><strong> ایمیل آدرس </strong></p>
								</div>
								<div class="col-sm-10 text-secondary">
								   {{ $user ? $user->email : '' }}
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2">
								  <p><strong>شماره تماس </strong></p>
								</div>
								<div class="col-sm-10 text-secondary">
								   {{ $user ? $user->phone : '' }}
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2">
								  <p><strong>آدرس </strong></p>
								</div>
								<div class="col-sm-10 text-secondary">
								   {{ $user ? $user->address : '' }}
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2">
								  <p><strong>سال تاسیس </strong></p>
								</div>
								<div class="col-sm-10 text-secondary">
								   {{ $user ? $user->foundation_year : '' }}
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2">
								  <p><strong> نوعیت </strong></p>
								</div>
								<div class="col-sm-10 text-secondary">
								   {{ $user ? $user->base_type : '' }}
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2">
								  <p><strong> فعالیت </strong></p>
								</div>
								<div class="col-sm-10 text-secondary">
								   {{ $user ? $user->type : '' }}
								</div>
							</div>
						</section> <hr />
						
						<section>
							<p><strong> توضیحات </strong></p>
							{!! $user ? $user->description : '' !!}
						</section>	
						
					</div>
					
				</div>
           </div> <!-- /col --> 
		   
      </div> <!-- /row -->
  </section> <!-- /container -->
	
@endsection
@section('style')
  <style>
	.modal-backdrop.show{
		z-index:10;
	}
	.modal-header .close{
		margin: -1rem -1rem;
	}
    body{
        color: #1a202c;
        text-align: right;
        background-color: #e2e8f0;    
    }
    .main-body {
        padding: 15px;
		direction:rtl;
		text-align:right;
    }
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col, .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }
    .h-100 {
        height: 100%!important;
    }
    .shadow-none {
        box-shadow: none!important;
    }
    .header-area{
      position: unset;
      background: rgba(0, 29, 56, 0.8);
      margin-bottom: 50px;
    }
    .alert{
      position: fixed;
      bottom: 0;
      z-index: 10;
    }
    .jobs_card{
      min-height: 218px;
    }
    .call{
      color: #fff;
    }
    .call a{
      color: #fff;
    }

    /*******************/
    .company_thumb{
      text-align: center;
      border-bottom: 1px solid #eee;
      padding-bottom: 15px;
      margin-bottom: 15px;
    }
    .company_thumb img{
      width: 150px;
      height: auto;
      object-fit: cover;
    }
    .company_details i{
      font-family: 'FontAwesome' !important;
      font-size: 25px;
      color: #305068;
    }
    .company_details li{
      list-style: none;
    }
    ul li{ 
       list-style-type: disc; 
       list-style-position: inside; 
    }
    ol li{ 
       list-style-type: decimal; 
       list-style-position: inside; 
    }
    ul ul, ol ul { 
       list-style-type: circle; 
       list-style-position: inside; 
       margin-left: 15px; 
    }
    ol ol, ul ol { 
       list-style-type: lower-latin; 
       list-style-position: inside; 
       margin-left: 15px; 
    }
    .company_details .media-body{
      display: flex;
      margin-right: 10px;
      margin-bottom: 15px;
    }
    .company_details .media-body h4{
      margin-right: 8px;
    }
    .company_details .media-body strong{
      min-width: 46px;
    }
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection