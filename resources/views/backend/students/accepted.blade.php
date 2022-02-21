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