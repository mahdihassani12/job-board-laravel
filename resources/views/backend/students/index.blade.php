@extends('backend.layouts.app')
@section('main_content')
		
		<a href="{{ route('add_student') }}" class='btn btn-primary'>افزودن</a>
		<a href="{{ route('getImport') }}" class='btn btn-primary'>افزودن با فایل اکسل</a>
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
                  <th> پسورد </th>
                  <th> عملیات </th>
                </tr>
                </thead>
                <tbody>
				
				@foreach($users as $index => $user )
					<tr>
					  <td>{{ $index + 1 }}</td>
					  <td>{{ $user->name }}</td>
					  <td>{{ $user->student->lastName }}</td>
					  <td>{{ $user->email }}</td>
					  <td>{{ $user->student->faculty->name }}</td>
					  <td>{{ $user->student->department->name }}</td>
					  <td>{{ $user->primary_password }}</td>
            <td class="operation">
              
                  <a href="{{ route('editStudentList',$user->id) }}">
                    <i class="fa fa-edit"></i>
                  </a>&nbsp 
                  /
                  <form method="post" action="{{ route('deleteStudentList',$user->id) }}">
                    @csrf
                    @method('DELETE')
					<input type="hidden" name="student_id" value="{{ $user->student->id }}">
                    <button type="submit">
          				<i class="fa fa-trash"></i>
          			</button>
                  </form>
            </td>
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
                  <th> پسورد </th>
                  <th> عملیات </th>
                </tr>
                </tfoot>
              </table>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css"
                       href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
@endsection

@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript">
  $(function() {
      $('#example1').dataTable({
        dom: 'Bfrtip',
        buttons: [ {
            extend: 'excelHtml5',
        }]
    });
  });
</script>
@endsection