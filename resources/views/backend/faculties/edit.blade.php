@extends('backend.layouts.app')
@section('main_content')
		
	<div class="box box-info">
		<div class="box-header with-border">
		  <h3 class="box-title">ویرایش فاکولته</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
		<form method='post' action="{{ route('faculties.update',$faculty->id) }}">
		  @csrf
		  @method('put')
		  <div class="box-body">
		  
			<div class="form-group">
			  <label for="name" class="col-sm-3 control-label">نام فاکولته</label>

			  <div class="col-sm-9">
				<input type="text" class="form-control" id="name" name='name' value="{{ $faculty->name }}" autocomplete='off'>
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