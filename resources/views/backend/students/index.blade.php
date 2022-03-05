@extends('backend.layouts.app')
@section('main_content')
		
		<a href="{{ route('add_student') }}" class='btn btn-primary'>افزودن</a>
		<a href="{{ route('getImport') }}" class='btn btn-primary'>افزودن با فایل اکسل</a>
		<button class="btn btn-primary" onclick="$('table').tblToExcel();"> خروجی با اکسل </button>

    <div class="box">
      <div class="box-header">
        <h3 class="box-title"> لیست محصلین </h3>
      </div>
      <!-- /.box-header -->
		
	  <div class="box-header">
      <form>
    			<div class="row">
    				<div class="col-md-3">
    					<div class="form-group">
    						<input type="text" 
    							   name="userName" 
    							   class="form-control"
    							   placeholder="نام محصل"
    							/>
    					</div>
    				</div>
    				<div class="col-md-3">
    					<div class="form-group">
    						<select name="userFaculites" class="form-control">
    							<option value="">انتخاب فاکولته</option>
                  @foreach($faculties as $faculty)
                     <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                  @endforeach
    						</select>
    					</div>
    				</div>
    				<div class="col-md-3">
    					<div class="form-group">
    						<select name="userDepartment" class="form-control">
    							<option value="">انتخاب دیپارتمنت</option>
                  @foreach($departments as $department)
                     <option value="{{ $department->id }}">{{ $department->name }}</option>
                  @endforeach
    						</select>
    					</div>
    				</div>
    				<div class="col-md-3">
    					<div class="form-group">
    						<button class="btn btn-success" type="submit">
    							فیلتر
    						</button>
    					</div>
    				</div>
    			</div> <!--/row-->

    		</form>         
      </div>
      <!-- /.box-header -->
	  
      <div class="box-body">
        @include('backend.students.table',$users)
      </div>
      <!-- /.box-body -->

    <div class="box-footer">
      {{ $users->links() }}
    </div>

  </div>
  <!-- /.box -->

@endsection

@section('style')
  <style>
  .box-footer{
    text-align: center;
   } 
  .btn{
	  margin-bottom:15px;
  }
  .operation button{
	  background:unset;
	  border:unset;
  }
  .operation form{
    display: inline;
  }
  .operation .fa-edit{
    color:blue;
  }
  .operation .fa-trash{
    color:red;
  }
  </style>
@endsection

@section('script')
<script type="text/javascript">
    
</script>
@endsection