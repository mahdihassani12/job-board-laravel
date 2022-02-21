@extends('backend.layouts.app')
@section('main_content')
		
	<div class="box box-info">
		<div class="box-header with-border">
		  <h3 class="box-title">افزودن دیپارتمنت جدید</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form method='post' action="{{ route('departments.store') }}">
		  @csrf
		  <div class="box-body">
		  
			<div class="form-group">
			  <label for="name" class="col-sm-3 control-label">نام دیپارتمنت</label>

			  <div class="col-sm-9">
				<input type="text"
						class="form-control"
						id="name" name='name'
						placeholder="نام دیپارتمنت"
						value="{{ old('name') }}"
						autocomplete='off' />
			  </div>
			</div><br><br>

			<div class="form-group">
			  <label for="faculty" class="col-sm-3 control-label"> نام فاکولته </label>

			  <div class="col-sm-9">
				<select name="faculty" id="faculty" class="form-control">
					<option value="">انتخاب فاکولته</option>
					@foreach($faculties as $faculty)
						<option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
					@endforeach
				</select>
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
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection