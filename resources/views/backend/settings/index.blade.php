@extends('backend.layouts.app')
@section('main_content')
<?php 
	$id = auth()->user()->id ;
?>
	<div class="row">
		<div class="col-md-6">		
				
			<div class="box">
				<div class="box-header">
					<h4>بروز رسانی رمز ورود</h4>
				</div>
				<div class="box-content">
					<form method="post" action="{{ route('updateCred',$id) }}">
						@csrf
						@method('PUT')
						<div class='form-group'>
							<input type="text" class="form-control" name="userName"
							value="{{ $user ? $user->name : '' }}"  placeholder="نام کاربری">
						</div>

						<div class='form-group'>
							<input type="email" class="form-control" name="email"
							value="{{ $user ? $user->email : '' }}"  placeholder=" ایمیل آدرس ">
						</div>
							
						<div class='form-group'>
							<input type="password" class="form-control" name="password" placeholder="رمز فعلی">
						</div>
						
						<div class="form-group">
							<input type="password" class="form-control" name="newPassword" placeholder="رمز جدید">
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="تایید">
						</div>
					</form>
				</div>	
			</div> <!-- /box -->
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			
			<div class="box">
				<div class="box-header">
					<h4>تنظیمات سایت</h4>
				</div>
				<div class="box-content">
					<form method="post" action="{{ $settings ? route('setting.update',$settings->id) : 
												   route('setting.store') }}"
						  enctype="multipart/form-data">
						@csrf
						@if($settings)
							@method('PUT')
						@endif
						<div class='form-group logo'>
							<label for="logo">لوگوی سایت</label>
							@if($settings && $settings->logo)
								<img src='{{ url("/uploads/logo/$settings->logo") }}'>
							@endif
							<input type="file" class="form-control" name="logo" id="logo" accept="image/*">
						</div>
						
						<div class='form-group'>
							<label>فیسبوک</label>
							<input type="text" class="form-control" name="facebook" placeholder="فیسبوک" 
								   value="{{ $settings ? $settings->facebook : '' }}" autocomplete="off">
						</div>
							
						<div class='form-group'>
							<label>تلگرام</label>
							<input type="text" class="form-control" name="telegram" placeholder="تلگرام" 
								   value="{{ $settings ? $settings->telegram : '' }}" autocomplete="off">
						</div>
						
						<div class="form-group">
							<label>وبسایت</label>
							<input type="text" class="form-control" name="website" placeholder="وبسایت" 
							       value="{{ $settings ? $settings->website : '' }}" autocomplete="off">
						</div>
							
						<div class='form-group'>
							<label>توضیحات متن فوتر</label>
							<textarea name="description" class="form-control" 
									  rows="10" cols="10" placeholder="توضیحات متن فوتر">{{ $settings ? $settings->description : ''}}</textarea>
						</div>
						
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="تایید">
						</div>
					</form>
				</div>	
			</div> <!-- /box -->
			
		</div> <!-- /col -->
	</div> <!-- /row -->


@endsection

@section('style')
  <style>
	.logo img{
		width: 200px;
		height: auto;
		display: inherit;
		margin-bottom: 10px;
	}
	.box-content{
		padding: 5px 10px;
	}
	.alert{
		position: fixed;
	    bottom: 0;
	    z-index: 10;
	    text-align: right;
	    min-width: 300px;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection