@extends('frontend.layouts.app')
@section('main_content')
    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="single_slider  d-flex align-items-center slider_bg_1">
            <div class="container">
                <form style="position:relative;" method='get' action="{{ route('homeSearch') }}">
					<div class="row">
						<div class="col-md-4">
							<label for='title'>عنوان شغل</label>
							<input type="text" name="title" class="form-control" placeholder="عنوان شغل" autocomplete="off" id='title'>
						</div>
						<div class="col-md-4">
							<label for='location'>موقعیت شغل</label>
							<input type="text" name="location" 
								   class="form-control" 
								   placeholder="موقعیت" 
								   autocomplete="off" id='location'>
						</div>
						<div class="col-md-4">
							<label for='category'>دسته بندی ها</label>
							<select class="form-control" name="category" id="category">
								<option>همه دسته ها</option>
								@foreach($categories as $cat)
									<option value="{{ $cat->id }}">{{ $cat->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group submit_btn">
							<input type="submit" name="submit" class="btn btn-success" value="جستجو">
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
    <!-- slider_area_end -->

    <!-- job_listing_area_start  -->
    <div class="job_listing_area">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section_title">
                        <h3>لیست شغل ها</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="brouse_job text-right">
                        <a href="{{ route('jobs.page') }}" class="boxed-btn4">مشاهده شغل های بیشتر</a>
                    </div>
                </div>
            </div>

            <!-- List of Jobs  -->

            <div class="job_lists wow fadeInUp">
                <div class="row">
                   @if(count($posts) > 0)
                   @foreach($posts as $post)
                        <?php
                            $company_img = DB::table('companies')->where('id',$post->company_id)
                                              ->select('logo')->pluck('logo')->first();
                        ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="thumb">
                                        @if($company_img)
                                        <img 
                                        src='{{url("public/uploads/company_meta/$company_img")}}' alt="company logo">
                                        @else
                                        <img src="{{ asset('public/frontend/img/svg_icon/1.svg') }}" alt="">
                                        @endif
                                    </div>
                                    <div class="jobs_conetent">
                                        <a href="{{ route('job.detail',$post->id) }}">
										<h4 class="jobs_title">{{ $post->title }}</h4></a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i>{{ $post->address }}</p>
                                            </div>
                                            <div class="location">
                                                <p>
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ $post->type == 'full' ? 'تمام وقت' : 'نیمه وقت' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a href="{{ route('job.detail',$post->id) }}" class="boxed-btn3">درخواست</a>
                                    </div>
                                    <div class="date">
                                        <p>تاریخ انقضا:  <?php echo time_elapsed_string($post->deadline); ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- job container -->

                    @endforeach
                    @else
                        <h3> هیچ شغلی برای فعلا در سیستم ذخیره نیست. </h3>
                    @endif
                </div>
            </div> <!-- end of job lists -->

        </div>
    </div>
    <!-- job_listing_area_end  -->

    <!-- featured_candidates_area_start  -->
    <div class="featured_candidates_area wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-40">
                        <h3> لیست محصلین سال اخیر </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                @if(count($students) > 0 )
                    <div class="candidate_active owl-carousel">
                        @foreach($students as $student)
                        <div class="single_candidates text-center">
                            <div class="thumb">
                                @if($student->profile_image)
                                    <img src='{{ url("public/uploads/student_meta/$student->profile_image") }}' 
                                        alt="Admin" class="rounded-circle" width="150">
                                @else
                                    <img src='{{ url("public/uploads/images/author.png") }}' alt="Admin" class="rounded-circle" width="150">
                                @endif
                            </div>
                            <a href="{{ route('student.detail',$student->id) }}">
                                <h4>{{$student->firstName}} {{ $student->lastName }}</h4>
                            </a>
                            <p>{{ $student->faculty->name }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                        <h3 style="text-align:right"> هیچ محصلی برای فعلا در سیستم ذخیره نیست. </h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- featured_candidates_area_end  -->

    <div class="top_companies_area">
        <div class="container">
            <div class="row align-items-center mb-40">
                <div class="col-md-6 col-sm-12">
                    <div class="section_title">
                        <h3>لیست شرکت های برتر</h3>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="brouse_job text-right">
                        <a href="{{ route('companies.page') }}" class="boxed-btn4">مشاهده شرکت های بیشتر</a>
                    </div>
                </div>
            </div>

            <div class="row">
                @if(count($companies) > 0)
                    @foreach($companies as $company)
                        <div class="col-lg-4 col-xl-3 col-md-6">
                            <div class="single_company">
                                <div class="thumb">
                                    @if($company->logo)
                                        <img src='{{ url("public/uploads/company_meta/$company->logo") }}' alt="">
                                    @else
                                        <img src='{{ url("public/uploads/images/author.png") }}' alt="Admin" class="rounded-circle" width="150">
                                    @endif
                                </div>
                                <a href="jobs.html"><h3>{{ $company->name ? $company->name : 'company' }}</h3></a>
                                <p>{{ $company->type }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3> هیچ شرکتی برای فعلا در سیستم ذخیره نیست. </h3>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('style')
  <style>
    .jobs_left .thumb{
        padding: 0 !important;
        width: 100px !important;
        background: unset !IMPORTANT;
        border: unset !important;
    }
    .jobs_left .thumb img{
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .footer .socail_links{
        margin-top: unset;
    }
    .blogs{
        text-align: right;
        margin-bottom: 50px;
        padding-top: 50px;
    }
    .blogs h4{
        font-size: 20px;
        margin-top: 15px;
        margin-bottom: 15px;
        text-align: right;
    }
    .featured_image img{
        width: 100%;
        height: auto;
        max-height: 300px;
        object-fit: cover;
    }
    .featured_candidates_area .single_candidates .thumb{
        width: 110px;
        height: 140px;
    }
    .single_company .thumb{
        padding: 0 !important;
        width: 150px !important;
        height: auto !important;
    }
    .single_company .thumb img{
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
    .popular_catagory_area{
     text-align: center;
    }
    .owl-carousel .owl-stage-outer{
        direction: ltr !important;
    }
    .top_companies_area .single_company{
        text-align: center;
    }
	.single_slider{
		text-align:right;
	}
	.single_slider label{
		color:#fff;
		font-size:18px;
	}
	.single_slider input , .single_slider select{
		height:50px !important;
		margin:unset;
	}
	input[type=submit]{
		background-color: #00d363;
		padding: 0px 80px;
		font-size:18px;
	}
	input[type=submit]:hover{
		background-color: #00d363;
	}
	.submit_btn{
		position: absolute;
		left: 0;
		top: 95px;
	}
    .job_listing_area{
        padding-top: 50px;
    }
    .featured_candidates_area .single_candidates{
        box-shadow: 0px 1px 5px #d0d0d0;
        margin-bottom: 2px;
    }
    .single_company{
         box-shadow: 0px 1px 5px #d0d0d0;
    }
    .footer .socail_links ul li a i{
        font-family: fontawesome !important;
        color: #fff;
    }
	.jobs_title{
		margin-right:60px;
		text-align:right;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection
 