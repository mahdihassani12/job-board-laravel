@extends('frontend.layouts.app')
@section('main_content')
	<section class="message">
		<div class="container">
			
			<table class="table table-striped">
				<thead>
					<tr>
						<th> عنوان پیام </th>
						<th> متن پیام </th>
						<th> فرستنده </th>
						<th> شماره تماس فرستنده </th>
						<th> تاریخ </th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td> {{ $message->title }} </td>
						<td> {{ $message->description }} </td>
						<td>{{ $message->name }}</td>
						<td>{{ $message->phone }}</td>
						<td>{{ date('Y/F/d', strtotime($message->created_at)) }}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th> عنوان پیام </th>
						<th> متن پیام </th>
						<th> فرستنده </th>
						<th> شماره تماس فرستنده </th>
						<th> تاریخ </th>
					</tr>
				</tfoot>
			</table>

		</div> <!-- /container -->
	</section> <!-- /section -->

@endsection

@section('style')
  <style>
  	.header-area{
  		position: unset;
  		background: rgba(0, 29, 56, 0.8);
  		margin-bottom: 50px;
  	}
  	body{
        color: #1a202c;
        text-align: right;
        background-color: #e2e8f0;    
    }
   .alert{
      position: absolute;
      bottom: 0;
      z-index: 99999;
    }
    .table{
    	background: #fff;
		margin-bottom:30px;
    }
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection