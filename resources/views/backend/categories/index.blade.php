@extends('backend.layouts.app')
@section('main_content')
<?php 
  $categories = DB::table('categories')->orderby('id','DESC')->paginate(10);
?>		
		<a href="{{ route('categories.create') }}" class='btn btn-primary'>افزودن</a>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">لیست دسته ها</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> مشخصه </th>
                  <th>نام دسته</th>
                  <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
				
				@foreach($categories as $index => $category )
					<tr>
					  <td>{{ $index + 1 }}</td>
					  <td>{{ $category->name }}</td>
					  <td>
						 <form action="{{ route('categories.destroy',$category->id) }}" method="post">
							@csrf
							@method('Delete')
							<button type='submit' class='delete_btn'>حذف</button>
						 </form>
							/
						  <a href="{{ route('categories.edit',$category->id) }}">ویرایش</a>
					  </td>
					</tr>
				@endforeach
				
                </tbody>

                <tfoot>
                <tr>
                  <th> مشخصه </th>
                  <th>نام دسته</th>
                  <th>عملیات</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              {{ $categories->links() }}
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