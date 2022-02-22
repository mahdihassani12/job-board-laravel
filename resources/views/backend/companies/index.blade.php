@extends('backend.layouts.app')
@section('main_content')
  
  <div class="box">

    <div class="box-header">
      <h3 class="box-title"> لیست شرکت ها </h3>
    </div>
	
	<div class="box-header">
      <form>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<input type="text" 
						   class="form-control" 
						   name="companyName" 
						   placeholder="نام شرکت"
						/>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="form-group">
					<input type="text" 
						   class="form-control" 
						   name="companyAddress" 
						   placeholder="آدرس شرکت"
						/>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" name="companyType">
						<option value="">انتخاب نوعیت شرکت</option>
						<option>دولتی</option>
						<option>شخصی</option>
						<option>موسسه</option>
					</select>
				</div>
			</div>
			
			<div class="col-md-3">
				<button class="btn btn-success" type="success">
					فیلتر	
				</button>
			</div>	
			
		</div>
	  </form>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>مشخصه</th>
          <th>نام</th>
          <th>ایمیل</th>
          <th>شماره تماس</th>
          <th>آدرس</th>
          <th>نوعیت</th>
          <th>عملیات</th>
        </tr>
        </thead>
				
        <tbody>
						
					@foreach($companies as $index => $company)
						
						<tr>
						  <td>{{ $index + 1 }}</td>
						  <td>{{ $company->name }}</td>
						  <td>{{ $company->email }}</td>
						  <td>{{ $company->phone }}</td>
						  <td>{{ $company->address }}</td>
						  <td>{{ $company->type }}</td>

						  <td class="operation">
              @if($company->status == 'publish')
								<form method="post" 
                      action="{{ route('register.update',$company->user_id) }}">
									@csrf
									@method('PUT')
                  <input type="hidden" name="company_id" value="{{ $company->id }}">
                  <input type="hidden" name="pending" value="true">
									<button type='submit'> مسدود </button>
								</form>
                @else
                <form method="post" 
                      action="{{ route('register.update',$company->user_id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <input type="hidden" name="pending" value="false">
                    <button type='submit'> انتشار </button>
                </form>
                @endif
						  </td>
              
						</tr>	
						
					@endforeach
					
      </tbody>

      <tfoot>
        <tr>
          <th>مشخصه</th>
          <th>نام</th>
          <th>ایمیل</th>
          <th>شماره تماس</th>
          <th>آدرس</th>
				  <th>نوعیت</th>
				  <th>عملیات</th>
          </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->

  <div class='box-footer'>
     {{ $companies->links() }}
  </div>

  </div>
  <!-- /.box -->

@endsection

@section('style')
  <style>
    .box-footer{
      text-align: center;
     }
  	.operation button{
  		background: none;
  		border: none;
  		color:blue;
  	}
  </style>
@endsection

@section('script')

@endsection