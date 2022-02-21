@extends('frontend.layouts.app')
@section('main_content')
<?php 
	$user_id = auth()->user()->id;
    $company_id = DB::table('companies')->where('user_id','=',$user_id)->select('id')->pluck('id')->first();
	$categories = DB::table('categories')->orderby('id','DESC')->get();
?>
	<main class="create_job">
		<div class="container">
			
			<div class="row">
				<div class="col-md-12">
					<section>
						<h4>ویرایش شغل</h4>
						<div class="row">
							<div class="col-md-6">
								
								<form action="{{ route('jobs.update',$post->id) }}" method="post">
									@csrf
									@method('put')

									<input type="hidden" name="company_id" value="{{ $company_id }}">

									<div class="form-group">
										<label for="title">عنوان شغل</label>
										<input type="text" name="title" id="title" class="form-control" 
												autocomplete="off" value="{{ $post->title }}">
									</div>

									<div class="form-group">
										<label for="salary">معاش</label>
										<input type="text" name="salary" id="salary" class="form-control"
										       autocomplete="off" value="{{ $post->salary }}">
									</div>
									
									<div class="form-group">
										<label for="salaryText">مقدار معاش به حرف</label>
										<input type="text" name="salaryText" id="salaryText" class="form-control" 
											   autocomplete="off" value="{{ $post->salary }}">
									</div>

									<div class="form-group">
										<label for="address">آدرس</label>
										<input type="text" name="address" id="address" class="form-control" 
										       autocomplete="off" value="{{ $post->address }}">
									</div>

									<div class="form-group">
										<label for="vacancy">ظرفیت شغل</label>
										<input type="number" name="vacancy" id="vacancy" class="form-control" 
												autocomplete="off" value="{{ $post->vacancy }}">
									</div>

									<div class="form-group">
										<label for="deadline">تاریخ ختم</label>
										<input type="date" name="deadline" id="deadline" class="form-control" 
												autocomplete="off" value="{{ $post->deadline }}">
									</div>

									<div class="form-group">
										<label for="type">نوعیت شغل</label>
										<select class="form-control" name="type" id="type">
											<option>انتخاب نوعیت شغل</option>
											<option value="part" {{ $post->type == 'part' ? 'selected' : '' }} >نیمه وقت</option>
											<option value="full" {{ $post->type == 'full' ? 'selected' : '' }}>تمام وقت</option>
										</select>
									</div>
									
									<div class='form-group'>
										<label for="category">دسته بندی شغل</label>
										<select class="form-control category" name="categories[]" id="category" multiple>
											@foreach($categories as $category)
											  
												<option value="{{ $category->id }}" 
														@foreach($post->categories as $cat)
														 {{ ( $category->id == $cat->id) ? 'selected' : '' }}
														 @endforeach
														 >
													{{ $category->name }}
												</option>

										    @endforeach
										</select>
									</div>

									<div class="form-group">
										<label for="description">توضیحات شغل</label>
										<textarea class="form-control" name="description" id="description" 
												   autocomplete="off" rows="5" cols="10">{{ $post->description }}</textarea>
									</div>
									<button type="Submit" class="btn btn-primary pull-right">تایید</button>
								</form>

							</div> <!-- end of col -->
						</div> <!-- end of inner row -->

					</section>
				</div>
			</div> <!-- end of row -->

		</div> <!-- end of container -->
	</main>

@endsection

@section('style')
  <style>
  	.header-area{
  		position: unset;
  		background: rgba(0, 29, 56, 0.8);
  		margin-bottom: 50px;
  	}
  	body{
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;    
    }
    .create_job section{
    	background-color: #fff;
    	padding: 15px;
    	margin-bottom: 20px;
    }
    h4{
    	margin-bottom: 20px;
    }
	.create_job{
		text-align:right;
		direction:rtl;
	}
	.select2-results ul li{
		text-align: right;
	}
	.alert{
		position: fixed;
	    bottom: 0;
	    z-index: 10;
	    text-align: right;
	    min-width: 300px;
	}
  </style>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
   jQuery(document).ready(function(){

   		jQuery('.category').select2({
   			placeholder: " انتخاب دسته ",
		    dir: "rtl",
   		});

   		$('#description').summernote({
   			height:200
   		});

   });
</script>
@endsection