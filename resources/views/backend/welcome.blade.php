@extends('backend.layouts.app')
@section('main_content')

	<div>
	 <div class="row">
		<div class="col-lg-3 col-xs-6">
			<a href="{{ route('getStudents') }}">
				<!-- small box -->
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <h3>{{ $acceptedStudents }}</h3>
					<p>
							محصلین شاغل شده
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
			  </div>
			</a>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-aqua">
			<div class="inner">
			  <h3>{{ $students }}</h3>

			  <p>محصلین</p>
			</div>
			<div class="icon">
			  <i class="ion ion-person-add"></i>
			</div>
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-red">
			<div class="inner">
			  <h3>{{ $companies }}</h3>

			  <p>کمپنی ها</p>
			</div>
			<div class="icon">
			 <i class="ion ion-person-add"></i>
			</div>
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-green">
			<div class="inner">
			  <h3>{{ $posts }}</h3>

			  <p> شغل ها </p>
			</div>
			<div class="icon">
			  <i class="ion ion-stats-bars"></i>
			</div>
		  </div>
		</div>
		<!-- ./col -->
	  </div>
	  <!-- /.row -->
	  
	  <div class="row">
			<div class="col-md-7">
				
				<div class="box">
					<div class="box-header">
					  <h3 class="box-title"> کاربران در حال انتظار </h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>مشخصه</th>
						  <th>نام کاربری</th>
						  <th>ایمیل</th>
						  <th>نقش</th>
						  <th>عملیات</th>
						</tr>
						</thead>
						
						<tbody>
								
							@if(count($pending_users) != 0 )
								
								@foreach($pending_users as $index => $user)
								
								<tr>
								  <td>{{ $index + 1 }}</td>
								  <td>{{ $user->name }}</td>
								  <td>{{ $user->email }}</td>
								  <td>{{ $user->role  == 'company'? 'کمپنی' : 'ادمین' }}</td>
								  <td class='operation'>
									<form method="post" action="{{ route('register.update',$user->id) }}">
										@csrf
										@method('PUT')
										<button type='submit'>تایید</button>
									</form>
									/
									<form method="post" action="{{ route('register.destroy',$user->id) }}">
										@csrf
										@method('DELETE')
										<button type="submit">حذف</button>
									</form>
								  </td>
								</tr>	
								
							@endforeach
								
							@else
								<tr>
									<td>هیچ موردی پیدا نشد.</td>
								</tr>
							@endif
							
						</tbody>

						<tfoot>
						<tr>
						  <th>مشخصه</th>
						  <th>نام کاربری</th>
						  <th>ایمیل</th>
						  <th>نقش</th>
						  <th>عملیات</th>
						</tr>
						</tfoot>
					  </table>
					</div>
					<!-- /.box-body -->

					 <div class='box-footer'>
						 {{ $pending_users->links() }}
					 </div>

				  </div>
				  <!-- /.box -->	
				
			</div>
			<!-- ./col -->
	  </div> 
	  <!-- /.row -->
	  
	  <div class="row">
			<div class="col-md-7">
				
				<div class="box">
					<div class="box-header">
					  <h3 class="box-title"> پیام های جدید </h3>
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
							
							@if(count($messages) != 0)
								
								@foreach($messages as $index => $message)
									<tr>
										<td>{{ $index + 1 }}</td>
										<td>{{ $message->name }}</td>
										<td>{{ \Illuminate\Support\Str::limit($message->description, 120 , '...') }}</td>
										<td><a href="{{ route('contact.show',$message->id) }}">نمایش</a></td>
									</tr>
								@endforeach
							
							@else
								<tr>
									<td>هیچ پیامی جدیدی دریافت نشده است.</td>
								</tr>
							@endif
						
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
				
			</div>
	  </div>
		  
	</div>

@endsection

@section('style')
  <style>
	.operation button{
		background: unset;
		border: unset;
	}
	.operation button:focus{
		outline:unset;
	}
	.operation form{
		display:inline-block;
	}
	tbody tr td{
		min-width:100px;
	}
	.alert {
	    position: fixed;
	    bottom: 0;
	    z-index: 10;
	    text-align: right;
	    min-width: 300px;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection