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
						<h4>افزودن شغل جدید</h4>

						<div class="row">
							<div class="col-md-6">
								
								<form action="{{ route('jobs.store') }}" method="post">
									@csrf

									<input type="hidden" name="company_id" value="{{ $company_id }}">

									<div class="form-group">
										<label for="title">عنوان شغل</label>
										<input type="text" name="title" id="title" class="form-control" autocomplete="off">
									</div>

									<div class="form-group">
										<label for="salary">مقدار معاش به عدد</label>
										<input type="number" name="salary" id="salary" class="form-control" autocomplete="off">
									</div>
									
									<div class="form-group">
										<label for="salaryText">مقدار معاش به حرف</label>
										<input type="text" name="salaryText" id="salaryText" class="form-control" autocomplete="off">
									</div>

									<div class="form-group">
										<label for="address">آدرس</label>
										<input type="text" name="address" id="address" class="form-control" autocomplete="off">
									</div>

									<div class="form-group">
										<label for="vacancy">ظرفیت شغل</label>
										<input type="number" name="vacancy" id="vacancy" class="form-control" autocomplete="off">
									</div>

									<div class="form-group">
										<label for="deadline">تاریخ ختم</label>
										<input type="date" name="deadline" id="deadline" class="form-control" autocomplete="off">
									</div>

									<div class="form-group">
										<label for="type">نوعیت شغل</label>
										<select class="form-control" name="type" id="type">
											<option>انتخاب نوعیت شغل</option>
											<option value="part">نیمه وقت</option>
											<option value="full">تمام وقت</option>
										</select>
									</div>
									
									<div class='form-group'>
										<label> 

											افزودن دسته
											<i class="btn btn-info add_cat" 
												id="new_cat" 
								  				title="در صورت نبود دسته میتوانید یکی اضافه کنید." 
								  				data-toggle="modal" data-target="#myModal"
											>+</i>

										</label>
										<select class="form-control category" name="categories[]" id="category" multiple>
											@foreach($categories as $category)
												<option value="{{ $category->id }}">{{ $category->name }}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group">
										<label for="description">توضیحات شغل</label>
										<textarea class="form-control" name="description" id="description" 
												   autocomplete="off" rows="5" cols="10"></textarea>
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

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

			<div class="modal-content">

			  <div class="modal-header">
				  <h4 class="modal-title"> افزودن دسته - <span class="success text-success"> تنها در صورت نبودن دسته در لیست, دسته جدید اضافه نمایید. </span> </h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>

			  <div class="modal-body">
				<div class="er_messages"></div>
				<form method="post">
					<input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
					<div class="form-group">
						<label class="label-control">نام دسته</label>
						<input type="text" name="name" class="form-control" id="ajax_cat" placeholder="نام دسته" autocomplete="off">
						<button type="button" class="btn btn-info ajax_btn" style="margin-top:5px;">افزودن</button>
					</div>
				</form>

			  </div>
			  
			</div>
	  </div>
	</div> <!-- Modal -->

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
	.modal-backdrop.show{
		opacity: 0;
    	z-index: 0;
	}
	.select2-results ul li{
		text-align: right;
	}
	.add_cat{
		padding: 0px 10px;
	}
	.alert{
		position: fixed;
	    bottom: 0;
	    z-index: 10;
	    text-align: right;
	    min-width: 300px;
	}
	.modal-title{
		text-align: right;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   jQuery(document).ready(function(){

   		$('.category').select2({
   			placeholder: " انتخاب دسته ",
		    dir: "rtl",
   		});

   		$('#description').summernote({
   			height:200
   		});

   		/// adding category using ajax
		
		$(".ajax_btn").click(function(e){
		e.preventDefault();

			var name = jQuery('#ajax_cat').val();

			$.ajax({
			   url:'{{route('postCategory')}}',
			   method:'POST',
			   dataType: 'json',
			   data:{
					_token: $("#csrf").val(),
					name:name, 
				},
				beforeSend:function(){
					jQuery('.er_messages').empty().append('<span class="success text-success"> در حال بررسی درخواست, لطفا صبر کنید.</span>');
				},
			   success:function(response){
				  if(response.success){
					  $('#category').append('<option value='+ response.id +' selected="selected">'+jQuery('#ajax_cat').val()+'</option>');
					  jQuery('.er_messages').empty().append('<span class="success text-success"><i class="fa fa-check"></i>  ' + response.message + '</span>');
					  setTimeout(function(){ $("#myModal").modal('hide'); }, 1500);
				  }
			   },
			   error:function(response){
				  $.each(response.responseJSON.errors,function(key,error){
						jQuery('.er_messages').empty().append('<span class="error text-danger"><i class="fa fa-close"></i> ' + error + '</span>');
					});
			   }
			});
		});

   });
</script>
@endsection