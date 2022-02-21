@extends('frontend.layouts.app')
@section('main_content')
		
	<!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>شغل های قابل دسترس</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!-- job_listing_area_start  -->
    <div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
                        <div class="form_inner white-bg">
                            <h3>فیلتر</h3>
                            <form action="{{ route('archiveSearch') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <input type="text" placeholder="جستجوی کلمه کلیدی" name="keyword" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <input type="text" placeholder="جستجوی موقعیت" name="address" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide w-100" name="category">
                                                <option value="">دسته بندی</option>
												@foreach($categories as $cat)
													<option value="{{ $cat->id }}">{{ $cat->name }}</option>
												@endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide w-100" name="type">
                                                <option value="">نوعیت شغل</option>
                                                <option value="part">نیمه وقت</option>
                                                <option value="full">تمام وقت</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-lg-12">
										<div class="single_field">
											<button  class="boxed-btn3 w-100 mt-10" type="submit">فیلتر</button>
										</div>
									</div>
                                </div><!-- /row -->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4>لیست شغل ها</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="job_lists m-0">
                        <div class="row">

                        	@if($jobs->count() > 0)
                                @foreach($jobs as $post)
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
                                                src='{{url("/uploads/company_meta/$company_img")}}' alt="company logo">
                                                @else
                                                <img src="{{ asset('/frontend/img/svg_icon/1.svg') }}" alt="">
                                                @endif
                                            </div>
                                            <div class="jobs_conetent">
                                                <a href="{{ route('job.detail',$post->id) }}">
                                                <h4 class='jobs_title'>{{ $post->title }}</h4></a>
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
                                <h3> هیچ شغلی به اعلان گذاشته نشده است. </h3>
                            @endif

                        </div> <!-- end of jobs row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="pagination_wrap">
									{{ $jobs->links() }}
                                </div>
                            </div>
                        </div> <!-- end of pagination -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job_listing_area_end  -->

@endsection

@section('style')
  <style>
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
	.jobs_title{
		margin-right:60px;
		text-align:right;
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
	.job_listing_area{
		direction:rtl;
		text-align:right;
	}
	.bradcam_area h3{
		text-align:right;
		margin-right:90px;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function() {

    });
</script>
@endsection