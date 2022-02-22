@extends('frontend.layouts.app')
@section('main_content')

    <div class="container mt-5 mb-5 blog_con">
        <div class="span8">
			
			<h1>{{ $blog->title }}</h1>
			<div class="featured_image">
				<img src='{{ url("public/uploads/posts/$blog->featured_image") }}'>
			</div>
			
			<div class="categories">
				دسته ها : 
				@foreach($blog->categories as $cat)
					<span class="label"> {{$cat->name}} </span>
				@endforeach
			</div>
			
			<div>
				{!! $blog->description !!}
			</div>
			
		</div>
    </div>

@endsection

@section('style')
  <style>
	.label{
		background: #00d363;
		color: #fff;
		border-radius: 10px;
		padding: 3px;
		margin-left: 10px;
		margin-bottom: 15px;
		display: inline-block;
	}
	.featured_image img{
		width: 80%;
		height: auto;
		max-height: 400px;
		object-fit: cover;
		margin-top: 30px;
		border-radius: 5px;
		margin-bottom:15px;
	}
	.blog_con{
		text-align:right;
		direction:rtl;
	}
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
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection