@extends('backend.layouts.app')
@section('main_content')
		
		<div class="box">
        <div class="box-header">
          <h3 class="box-title">  افزودن محصل از طریق فایل اکسل </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        	<form action="{{ route('importExcel') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
			
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
					<label for="season" class="col-md-12">انتخاب فصل</label>
					<div class="form-group">
						<select class="form-control" name="season" id="season"> 
							<option value=""> انتخاب فصل</option>
							<option value="summer">بهار</option>
							<option value="fall">خزان</option>
						</select>
					</div>
				</div>
				
				<div class="col-md-12">
					<label for="file" class="col-md-12"> فایل اکسل </label>
					<div class="form-group">
						<input type="file" name="file" id="file" class="form-control" accept=".xlsx">
					</div>
				</div>
				<div class="col-md-12">
          <input type="submit" name="submit" class="btn btn-success" value="ارسال">
        </div>
				
			</form>
			
        </div>
    </div>

@endsection

@section('style')
  <style>
      .box{
        width: 60%;
      }
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection