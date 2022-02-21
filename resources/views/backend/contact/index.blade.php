@extends('backend.layouts.app')
@section('main_content')
<?php 
  $messages = DB::table('contact_messages')->orderBy('id','DESC')->paginate(20);
?>		
		<a href="{{ route('info.create') }}" class='btn btn-primary'>ویرایش معلومات تماس</a>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title"> لیست پیام ها </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> مشخصه </th>
                  <th>نام فرستنده</th>
                  <th>خلاصه از پیام</th>
                  <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
					
					@foreach($messages as $index => $message)
						<tr>
							<td>{{ $index + 1 }}</td>
							<td>{{ $message->name }}</td>
							<td>{{ \Illuminate\Support\Str::limit($message->description, 120 , '...') }}</td>
							<td><a href="{{ route('contact.show',$message->id) }}">نمایش</a></td>
						</tr>
					@endforeach
				
                </tbody>

                <tfoot>
                <tr>
                  <th> مشخصه </th>
                  <th>نام فرستنده</th>
                  <th>خلاصه از پیام</th>
                  <th>عملیات</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              {{ $messages->links() }}
            </div>

        </div>
          <!-- /.box -->

@endsection

@section('style')
  <style>
	.box th{
		min-width:120px;
	}
   .box-footer{
    text-align: center;
   } 
   .box{
	   width:650px;
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