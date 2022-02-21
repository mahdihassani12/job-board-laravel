@extends('backend.layouts.app')
@section('main_content')
<?php 
  $jobs = DB::table('posts')->orderby('id','DESC')->paginate(10);
?>
  
            <div class="box">
            <div class="box-header">
              <h3 class="box-title">لیست وظیفه ها </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>مشخصه</th>
                  <th>عنوان</th>
                  <th>آدرس</th>
                  <th>معاش</th>
                  <th>ظرفیت</th>
                  <th>تاریخ انقضا</th>
                </tr>
                </thead>
                <tbody>
				
    					@foreach($jobs as $index => $job)
    						
    						<tr>
    						  <td>{{ $index + 1 }}</td>
    						  <td>{{ $job->title }}</td>
    						  <td>{{ $job->address }}</td>
    						  <td>{{ $job->salary }}</td>
    						  <td>{{ $job->vacancy }}</td>
    						  <td>{{ $job->deadline }}</td>
    						</tr>	
    						
    					@endforeach

                </tbody>

                <tfoot>
                <tr>
                  <th>مشخصه</th>
                  <th>عنوان</th>
                  <th>آدرس</th>
                  <th>معاش</th>
                  <th>ظرفیت</th>
                  <th>تاریخ انقضا</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              {{ $jobs->links() }}
            </div>
          </div>
          <!-- /.box -->

@endsection

@section('style')
  <style>
    .box-footer{
      text-align: center;
    }
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection