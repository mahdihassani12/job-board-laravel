@extends('frontend.layouts.app')
@section('main_content')
@auth
    <?php
        $id = auth()->user()->id;
		$user_role = auth()->user()->role;
        $student_id = DB::table('students')->where('user_id',$id)->select('id')->pluck('id')->first();
        $company_img = DB::table('companies')->where('id',$job->company_id)
                                               ->select('logo')->pluck('logo')->first();
    ?>
@endif
	    <div class="job_details_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="thumb">
                                    <img src="{{ asset('public/frontend/img/svg_icon/1.svg') }}" alt="">
                                </div>
                                <div class="jobs_conetent">
                                    <h4 class='jobs_title'>{{ $job->title }}</h4>

                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i>{{ $job->address }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i>{{ $job->type == 'full' ? 'تمام وقت' : 'نیمه وقت' }}</p>
                                        </div>
                                        <div class="location">
                                        	<p>تاریخ انقضا:  <?php echo time_elapsed_string($job->deadline); ?> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>توضیحات درباره شغل</h4>

                            <div class="categories">
                                دسته ها : 
                                @foreach($job->categories as $cat)
                                    <span class="label"> {{$cat->name}} </span>
                                @endforeach
                            </div>

                            <p>{!! $job->description !!}</p>
                        </div>
                    </div>
                    <div class="apply_job_form white-bg">
                        <h4>درخواست برای شغل</h4>
                        @auth
							<?php
								if($user_role == 'user'):
							?>
                            <form action="{{ route('enrolls.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input_field">
                                            <input type="text" name='title' placeholder="عنوان" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input_field">
                                            <textarea name="description" id="" cols="30" rows="10" 
                                            placeholder="توضیحات" autocomplete="off"></textarea>
                                        </div>
                                    </div>

                                    <input type="hidden" name="company_id" value="{{ $job->company_id }}">
                                    <input type="hidden" name="student_id" value="{{ $student_id }}">
                                    <input type="hidden" name="job_id" value="{{ $job->id }}">

                                    <div class="col-md-12">
                                        <div class="submit_btn">
                                            <button class="boxed-btn3 w-100" type="submit">درخواست</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
							<?php
								else:
							?>
								
								<div>
									تنها محصلین ثبت شده میتواند درخواست ارسال نمایند.
								</div>	
								
							<?php 
								endif;
							?>
                        @else
                            <div>
                                <a href="{{ route('login') }}" class="text text-danger">
                                   شما باید وارد سایت شوید تا بتوانید برای این شغل درخواست ارسال نمایید.
                                </a>
                            </div>
                        @endif
                        
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="job_sumary">
                        <div class="summery_header">
                            <h3>خلاصه این شغل</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <li>تاریخ انتشار : <span>{{ $job->created_at }}</span></li>
                                <li>ظرفیت : <span>{{ $job->vacancy }} بست</span></li>
                                <li>معاش : <span>{{ $job->salary }}</span></li>
								<li>معاش به حرف : <span>{{ $job->salaryText }}</span></li>
                                <li>موقعیت : <span>{{ $job->address }}</span></li>
                                <li>نوعیت شغل : <span>{{ $job->type == 'full' ? 'تمام وقت' : 'نیمه وقت' }}</span></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('style')
  <style>
    form input:first-child{
        padding-right: 20px;
    }
    .jobs_left .thumb{
        background: unset !important;
        border: unset !important;
        padding: 0 !important;
        width: 100px !important;
    }
    .jobs_left .thumb img{
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .label{
        background: #00d363;
        color: #fff;
        border-radius: 10px;
        padding: 3px;
        margin-left: 10px;
        margin-bottom: 15px;
        display: inline-block;
    }
	.jobs_title{
		margin-right:40px;
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
    .job_details_area .single_jobs .jobs_left .jobs_conetent .links_locat .location{
        margin-right: 30px;
    }
	.job_details_area{
		text-align:right;
		direction:rtl;
	}
	.job_details_area .job_sumary .job_content ul li::before{
		position: absolute;
		width: 8px;
		height: 8px;
		border: 1px solid #AAB1B7;
		-webkit-border-radius: 50%;
		-moz-border-radius: 50%;
		border-radius: 50%;
		right: 0;
		content: '';
		top: 16px;
	}
	.job_details_area .job_sumary .job_content ul li{
		padding-left:0px;
		padding-right: 18px;
	}
	.job_details_area .job_sumary .job_content ul li span{
		padding-right: 10px;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function() {

    });
</script>
@endsection