@extends('backend.layouts.app')
@section('main_content')
<?php
	$contact = DB::table('contact_info')->first();
?>
	<div class="box box-info">
		<div class="box-header with-border">
		  <h3 class="box-title">ویرایش معلومات تماس</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form method='post' action="{{  $contact ? route('info.update',$contact->id) : route('info.store')  }}">
		  @csrf
		  @if($contact)
			@method('put')	
		  @endif
		  <div class="box-body">
		  
			<div class="row">
			  <label for="phone" class="col-sm-12 control-label">شماره تماس</label>

			  <div class="col-sm-12">
				<input type="text" class="form-control" id="phone" name='phone' 
				       value="{{ $contact ? $contact->phone : 'شماره تماس' }}" autocomplete='off'>
			  </div>
			</div>
			
			<div class="row">
			  <label for="email" class="col-sm-12 control-label">ایمیل آدرس</label>

			  <div class="col-sm-12">
				<input type="text" class="form-control" id="email" name='email' 
				       value="{{ $contact ? $contact->email : 'ایمیل آدرس' }}" autocomplete='off'>
			  </div>
			</div>
			
			<div class="row">
			  <label for="address" class="col-sm-12 control-label">آدرس</label>

			  <div class="col-sm-12">
				<textarea class="form-control" name="address" id="address" rows='5' cols='10' 
						  >{{ $contact ? $contact->address : 'آدرس' }}</textarea>
			  </div>
			</div>
			
			<div class="row">
			  <label for="description" class="col-sm-12 control-label">توضیحات</label>

			  <div class="col-sm-12">
				<textarea class="form-control" name="description" id="description" rows='5' cols='10' 
						  >{{ $contact ? $contact->description : 'توضیحات' }}</textarea>
			  </div>
			</div>
			
		  </div>
		  <!-- /.box-body -->
		  <div class="box-footer">
			<button type="submit" class="btn btn-info pull-left submit">تایید</button>
		  </div>
		  <!-- /.box-footer -->
		</form>
	</div>
	<!-- /.box -->

@endsection

@section('style')
  <style>
	 .box{
		 width:500px;
	 }
	 .submit{
		 margin-left:14px;
	 }
	 .alert{
      position: absolute;
      bottom: 0;
      z-index: 99999;
    }
	.box-body .row{
		margin-bottom:15px;
	}
	#phone{
		direction: initial;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection