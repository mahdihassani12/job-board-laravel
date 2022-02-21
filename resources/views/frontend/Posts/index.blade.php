@extends('frontend.layouts.app')
@section('main_content')

	<div class="container jobs_list">
	    <div class="row">
	        <div class="col-sm-9 col-md-10">

	        	<section>
	        		
	        		<h4>لیست شغل ها</h4>

              <table class="table table-striped">

                <thead>
                  <tr>
                    <th>تاریخ</th>
                    <th>عنوان</th>
                    <th>توضیحات</th>
                    <th>عملیات</th>
                  </tr>
                </thead>

                <tbody>
                  @if($posts->count() > 0 )
                    @foreach($posts as $post)
                    <tr>
                      <td width="20%">{{ time_elapsed_string($post->created_at) }}</td>
                      <td width="30%"><a href="{{ route('jobs.show',$post->id) }}" class="name">{{ $post->title }}</a> </td>
                      <td width="50%">{!! \Illuminate\Support\Str::limit($post->description, 100 , '...') !!}</td>
					           <td width="auto"><a href="{{ route('jobs.show',$post->id) }}" class="show">نمایش</a> </td>
                    </tr>
                    @endforeach
                  @else
                    <tr>
                      <td>
                        هیچ اطلاعاتی پیدا نشد.
                      </td>
                    </tr>
                  @endif
                </tbody>

                <tfoot>
                  <tr>
                    <th>تاریخ</th>
                    <th>عنوان</th>
                    <th>توضیحات</th>
					<th>عملیات</th>
                  </tr>
                </tfoot>

              </table>

              <div class="pagination_div">
                  {{ $posts->links() }}
              </div>

	        	</section>

	        </div> <!-- end of col -->
	    </div>
	</div>

@endsection

@section('style')
  <style>
    .pagination_div{
      margin-top: 10px;
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
    .name{
    	min-width: 120px;
      display: inline-block;
      font-weight: bold;
    }
    section{
    	background-color: #fff;
    	padding: 15px;
    }
    h4{
    	margin-bottom: 20px;
    }
    .container{
      margin-bottom: 30px;
    }
	.jobs_list{
		text-align:right;
		direction:rtl;
	}
	.show{
		color:blue
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection

