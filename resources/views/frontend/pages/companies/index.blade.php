@extends('frontend.layouts.app')
@section('main_content')


	<!-- featured_candidates_area_start  -->
    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            <div class="row">
			
				<div class="col-md-12">
					<form method="post" action="{{ route('companiesSearch') }}">
						@csrf
						<div class="row">
							<div class="col form-group">
								<input type="text" name="name" class="form-control" placeholder="نام شرکت" autocomplete="off">
							</div><!-- /div  -->
							<div class="col form-group">
								<input type="text" name="address" class="form-control" placeholder="آدرس شرکت" autocomplete="off">
							</div><!-- /div  -->
							<div class="col form-group">
								<select name="base_type" class="form-control base_type">
									<option value="">انتخاب نوعیت</option>
									<option value="دولتی"> دولتی </option>
									<option value="خصوصی">خصوصی</option>
									<option value="موسسه">موسسه</option>
								</select>
							</div>
							<div class="col form-group">
								<input type="submit" value="جستجو" class="btn btn-success form-control">
							</div><!-- /div  -->
						</div><!-- /row  -->
					</form>
				</div><!-- /div  -->

            	@foreach($companies as $company)

                <div class="col-md-6 col-lg-3">
                    <div class="single_candidates text-center">
                        <div class="thumb">
                            @if($company->logo)
                                <img src='{{ url("public/uploads/company_meta/$company->logo") }}' alt="">
                            @else
                                <img src='{{ url("public/uploads/images/author.png") }}' 
                                     alt="Admin" 
                                     class="rounded-circle" 
                                     width="150">
                            @endif
                        </div>
                        <a href="{{ route('company.detail',$company->id) }}"><h4>{{ $company->name }}</h4></a>
                        <p>{{ $company->address }}</p>
                    </div>
                </div>

                @endforeach
                
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination_wrap">
                        {{ $companies->links() }}
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
	.base_type{
		margin-top:0px;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function() {

    });
</script>
@endsection