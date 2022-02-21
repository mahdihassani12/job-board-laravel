@extends('backend.layouts.app')
@section('main_content')
		
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"> لیست محصلین </h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th> مشخصه </th>
            <th>نام</th>
            <th>تخلص</th>
            <th>ایمیل</th>
            <th>فاکولته</th>
            <th> دیپارتمنت </th>
          </tr>
          </thead>
          <tbody>
				
				@foreach($students as $index => $user )
					<tr>
					  <td>{{ $index + 1 }}</td>
					  <td>{{ $user->firstName }}</td>
					  <td>{{ $user->lastName }}</td>
					  <td>{{ $user->email }}</td>
					  <td>{{ $user->faculty->name }}</td>
					  <td>{{ $user->department->name }}</td>
					</tr>
				@endforeach
				
        </tbody>

        <tfoot>
        <tr>
          <th> مشخصه </th>
          <th>نام</th>
          <th>تخلص</th>
          <th>ایمیل</th>
          <th>فاکولته</th>
          <th> دیپارتمنت </th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      {{ $students->links() }}
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