@extends('frontend.layouts.app')
@section('main_content')


	<!-- featured_candidates_area_start  -->
    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            <div class="row">
				
				<div class="col-md-12">
					<form method="post" action="{{ route('studentsSearch') }}">
					@csrf
						<div class="row">
								
							<div class="col form-group">
								<select class='faculty form-control' name="faculty">
									<option value="">انتخاب فاکولته</option>
									@foreach($faculties as $row)
										<option value="{{ $row->id }}">{{ $row->name }}</option>
									@endforeach
								</select>
							</div> <!-- /div  -->
							
							<div class="col form-group">
								<select class='department form-control' name="department">
									<option value="">انتخاب دیپارتمنت</option>
									@foreach($departments as $row)
										<option value="{{ $row->id }}">{{ $row->name }}</option>
									@endforeach
								</select>
							</div> <!-- /div  -->
							
							<div class="col form-group">
								<select class='gender form-control' name="gender">
									<option value="">انتخاب جنسیت</option>
									<option value='مرد'>مرد</option>
									<option value='زن'>زن</option>
								</select>
							</div> <!-- /div  -->
							<div class="col form-group">
								<select class='uni_graduation_year form-control' name='uni_graduation_year'>
									<option value="">سال فراغت</option>
									<?php for ($year=2000; $year <= date("Y"); $year++): ?>
									  <option value="<?=$year;?>"><?=$year;?></option>
									<?php endfor; ?>
								</select>
							</div><!-- /div  -->
							<div class="col form-group">
								<input type="submit" value="فیلتر" class="btn btn-success form-control">
							</div><!-- /div  -->
							
						</div> <!-- /row  -->
					</form>
				</div> <!-- /div  -->
			
            	@if(count($students) > 0)
					@foreach($students as $student)

					<div class="col-md-6 col-lg-3">
						<div class="single_candidates text-center">
							<div class="thumb">
								@if($student->profile_image)
									<img src='{{ url("public/uploads/student_meta/$student->profile_image") }}' 
										 alt="Admin" class="rounded-circle" width="150">
								@else
									<img src='{{ url("public/uploads/images/author.png") }}' alt="Admin" class="rounded-circle" width="150">
								@endif
							</div>
							@if($student->firstName)
								<a href="{{ route('student.detail',$student->id) }}"><h4>{{ $student->firstName }}</h4></a>
							@else
								<a href="{{ route('student.detail',$student->id) }}"><h4>Student</h4></a>
							@endif
							
							<p>{{ $student->faculty->name }}</p>
						</div>
					</div>

					@endforeach
				@else
					<h2> هیچ محصلی با این مشخصات پیدا نشد. </h2>
				@endif
                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination_wrap">
                        {{ $students->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured_candidates_area_end  -->		

@endsection

@section('style')
  <style>
	input[type=submit]{
		background-color: #56baed;
		border: none;
		color: white;
		padding: 10px 80px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		text-transform: uppercase;
		font-size: 13px;
		box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
		border-radius: 5px 5px 5px 5px;
		margin: unset;
		transition: all 0.3s ease-in-out;
	}
	select{
		margin:unset;
	}
    .header-area{
      position: unset;
      background: rgba(0, 29, 56, 0.8);
    }
    .alert{
      position: absolute;
      bottom: 0;
    }
   body{
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;    
    }
    .featured_candidates_area .single_candidates .thumb{
    	width: 110px;
    	height: auto;
    }
    .featured_candidates_area .single_candidates{
        box-shadow: 0px 1px 5px #d0d0d0;
    }
	.featured_candidates_area{
		direction:rtl;
		text-align:right;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function() {

    });
</script>
@endsection