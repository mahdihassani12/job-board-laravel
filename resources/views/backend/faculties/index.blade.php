@extends('backend.layouts.app')
@section('main_content')
<?php 
  $faculties = DB::table('faculties')->orderby('id','DESC')->paginate(10);
?>		
		<a href="{{ route('faculties.create') }}" class='btn btn-primary'>افزودن</a>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title"> لیست فاکولته ها </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> مشخصه </th>
                  <th>نام فاکولته</th>
                  <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
				
				@foreach($faculties as $index => $faculty )
					<tr>
					  <td>{{ $index + 1 }}</td>
					  <td>{{ $faculty->name }}</td>
					  <td>
						 <form action="{{ route('faculties.destroy',$faculty->id) }}" method="post">
							@csrf
							@method('Delete')
							<button type='submit' class='delete_btn'>حذف</button>
						 </form>
							/
						  <a href="{{ route('faculties.edit',$faculty->id) }}">ویرایش</a>
					  </td>
					</tr>
				@endforeach
				
                </tbody>

                <tfoot>
                <tr>
                  <th> مشخصه </th>
                  <th>نام فاکولته</th>
                  <th>عملیات</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              {{ $faculties->links() }}
            </div>

        </div>
          <!-- /.box -->

@endsection

@section('style')
  <style>
   .box-footer{
    text-align: center;
   } 
   .box{
	   width:500px;
   }
   .btn{
	   margin-bottom:10px;
   }
   .alert{
      position: absolute;
      bottom: 0;
      z-index: 99999;
    }
    form{
      display: inline-block;
    }
    form button{
      border: none;
      background: none;
      color: #3c8dbc;
    }
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection