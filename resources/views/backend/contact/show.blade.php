@extends('backend.layouts.app')
@section('main_content')
	
	<div class="box box-info">
		<div class="box-header with-border">
			نمایش پیام
		</div>
		<div class="box-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th> نام فرستنده </th>
						<th> شماره تماس </th>
						<th> ایمیل آدرس </th>
						<th> متن پیام </th>
						<th> تاریخ پیام </th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td> {{ $message->name }} </td>
						<td> {{ $message->phone }} </td>
						<td>
							{{ $message->email }}
						</td>
						<td> {{ $message->description }} </td>
						<td>{{ date('d-m-Y', strtotime($message->created_at)) }}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th> نام فرستنده </th>
						<th> شماره تماس </th>
						<th> ایمیل آدرس </th>
						<th> متن پیام </th>
						<th> تاریخ پیام </th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

@endsection

@section('style')
  <style>
   .alert{
      position: absolute;
      bottom: 0;
      z-index: 99999;
    }
    .table{
    	background: #fff;
    }
    .container{
    	width: 90%;
    	margin-top: 50px;
    }
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection