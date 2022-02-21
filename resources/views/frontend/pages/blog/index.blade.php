@extends('frontend.layouts.app')
@section('main_content')

    <div class="container mt-5 mb-5 blog_con">
        <div class="span8">
		
			@if($posts->count() > 0)
				@foreach($posts as $post)
					<h1>
						<a href="{{ route('blog.single',$post->id) }}">{{ $post->title }}</a>
					</h1>
					<p>{!! \Illuminate\Support\Str::limit($post->description, 350 , '...') !!}</p>
					<div>
						<span class="badge badge-success">منتشر شده در : {{ time_elapsed_string($post->created_at) }}</span>
					</div> 
					<div class="categories">
						دسته ها : 
						@foreach($post->categories as $cat)
							<span class="label"> {{$cat->name}} </span>
						@endforeach
					</div>
					<hr>
				@endforeach
			@else
				<h3> هیچ اطلاعاتی پیدا نشد. </h3>
			@endif
			
			<div class='pagination'>
				{{ $posts->links() }}
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
		margin-top: 15px;
	}
	.pagination{
		text-align:center;
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