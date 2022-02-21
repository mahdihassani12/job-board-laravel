@extends('backend.layouts.app')
@section('main_content')
		
	<div class="box box-info">
		<div class="box-header with-border">
		  <h3 class="box-title">افزودن محصل جدید</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form method='post' action="{{ route('postRegister') }}">
		  @csrf
		  <div class="box-body row">
		  
			<div class="col-md-12">
			    <label for="username" class="col-md-12">نام</label>
				<div class="form-group">
					<input type="text" class="form-control" id="username" name='username' 
						  placeholder="نام" autocomplete='off' value="{{ old('username') }}" />
				</div>
			</div>
			
			<div class="col-md-12">
			    <label for="lastname" class="col-md-12">تخلص</label>
				<div class="form-group">
					<input type="text" class="form-control" id="lastname" name='lastname' 
							placeholder="تخلص" autocomplete='off' value="{{ old('lastname') }}" />
				</div>
			</div>
			
			<div class="col-md-12">
			    <label for="email" class="col-md-12">ایمیل</label>
				<div class="form-group">
					<input type="email" class="form-control" id="email" name='email' 
							placeholder="ایمیل" autocomplete='off' value="{{ old('email') }}" />
				</div>
			</div>
			
			<div class="col-md-12">
				<label for="faculty" class="col-md-12">فاکولته</label>
				<div class="form-group">
					<select name='faculty' class="form-control" id="faculty">
							<option value=""> انتخاب فاکولته </option>
						@foreach($faculties as $faculty)
							<option value="{{ $faculty->id }}" >{{ $faculty->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="col-md-12">
				<label for="department" class="col-md-12">دیپارتمنت</label>
				<div class="form-group">
					<select class="form-control" name="department" id="department"> 
						<option value="">انتخاب دیپارتمنت</option>
						@foreach($departments as $department)
							<option value="{{ $department->id }}">{{ $department->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="col-md-12">
				<label for="uni_enrolled_year" class="col-md-12">سال ورود به دانشگاه</label>
				<div class="form-group">
					<input type="date" name="uni_enrolled_year" id="uni_enrolled_year" 
						  class="form-control" value="{{ old('uni_enrolled_year') }}" />
				</div>
			</div>
			
			<div class="col-md-12">
				<label for="uni_graduation_year" class="col-md-12">سال فراغت</label>
				<div class="form-group">
					<input type="date" name="uni_graduation_year" id="uni_graduation_year" 
						  class="form-control" value="{{ old('uni_graduation_year') }}" />
				</div>
			</div>
			
			<div class="col-md-12">
				<label for="sesson" class="col-md-12">فصل</label>
				<div class="form-group">
					<select name="season" id="sesson" class="form-control">
						<option value="">انتخاب فصل</option>
						<option value="spring">بهار</option>
						<option value="fall">خزان</option>
					</select>
				</div>
			</div>
			
			<input type="hidden" name="role" value="user">
			
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
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection