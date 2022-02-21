@extends('frontend.layouts.app')
@section('main_content')
<?php
	$student = DB::table('students')->where('id',$enroll->student_id)->first();
?>
	<section class="message">
		<div class="container">
			
			<table class="table table-striped">
				<thead>
					<tr>
						<th> عنوان پیام </th>
						<th> متن پیام </th>
						<th> فرستنده </th>
						<th> تاریخ </th>
						<th> نمایش فرستنده </th>
						<th title=" این فیلد برای گرفتن آمار برای سیستم میباشد. "> پذیرفتن </th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td> {{ $enroll->title }} </td>
						<td> {{ $enroll->description }} </td>
						<td>{{ $student->firstName }}</td>
						<td>{{ date('Y/F/d', strtotime($enroll->created_at)) }}</td>
						<td><a href="{{ route('student.detail',$student->id) }}" class="student"> نمایش فرستنده </a></td>
						<td>
							<form method="post" action="{{ route('studentAccepted',$student->id) }}">
								@csrf
								@method('put')
								
								<input type='checkbox' name="accepted" value="1" 
									  onChange="this.form.submit()" 
									  title=" این فیلد برای گرفتن آمار برای سیستم میباشد. "
									  {{ ($student->accepted == '1')? 'checked' : '' }}>	
							</form>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th> عنوان پیام </th>
						<th> متن پیام </th>
						<th> فرستنده </th>
						<th> تاریخ </th>
						<th> نمایش فرستنده </th>
						<th title=" این فیلد برای گرفتن آمار برای سیستم میباشد. "> پذیرفتن </th>
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
	.student{
		color:blue
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">

</script>
@endsection