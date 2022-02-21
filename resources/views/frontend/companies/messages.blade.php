@extends('frontend.layouts.app')
@section('main_content')
	
	<div class="container">
	    <div class="row">
	        <div class="col-md-9">
	            <div class="panel panel-primary">

	                <div class="panel-heading">
	                    <h4>لیست پیام ها</h4>
	                </div>

	                <div class="panel-body">
	                    
	                    <table class="table table-striped">
	                    	<thead>
	                    		<tr>
	                    			<th>تاریخ</th>
	                    			<th>عنوان</th>
	                    			<th>توضیحات</th>
	                    		</tr>
	                    	</thead>

	                    	<tbody>
	                    		@if($messages->count() > 0)

	                    			@foreach($messages as $message)
	                    			<tr>
	                    				<td width="20%">{{ date('Y/F/d', strtotime($message->created_at)) }}</td>
                      					<td width="30%"><a href="{{ route('message.show',$message->id) }}" class="name">{{ $message->title }}</a></td>
                     	 				<td width="50%">
                     	 					{{ \Illuminate\Support\Str::limit($message->description, 50, '...') }}
                     	 				</td>
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
	                    		</tr>
	                    	</tfoot>
	                    </table>

	                </div>

	                <div class="panel-footer">
						{{ $messages->links() }}
	                </div> <!-- panel footer -->

	            </div>
	        </div>
	    </div>
	</div>


@endsection

@section('style')
  <style>
  	.panel-body{
  		background: #fff;
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
    .trash { color:rgb(209, 91, 71); }
	.flag { color:rgb(248, 148, 6); }
	.panel-body { 
		padding:0px;
		margin-bottom: 15px; 
	}
	.list-group-item:hover, a.list-group-item:focus {text-decoration: none;background-color: rgb(245, 245, 245);}
	.list-group { margin-bottom:0px; }
	.panel-heading{
		margin-bottom:15px;
		padding-right:20px;
	}
	.panel-footer{
		margin-bottom: 30px;
	}
  </style>
@endsection

@section('script')
<script type="text/javascript">
   
</script>
@endsection