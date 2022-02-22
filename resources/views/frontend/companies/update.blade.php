@extends('frontend.layouts.app')
@section('main_content')

  <div class="container">
    <div class="main-body">
        
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">

              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    @if($user->logo)
                      <img src='{{ url("public/uploads/company_meta/$user->logo") }}' 
                           alt="Admin" id="prof" />
                    @else
                      <img src='{{ url("public/uploads/images/author.png") }}' 
                            alt="Admin" 
                            class="rounded-circle" 
                            width="150" />
                    @endif
                    <div class="mt-3">
                      <form action="{{ $user ? route('company.update',$user->id) : route('company.store') }}" method="post" 
                            enctype="multipart/form-data">
                        @csrf
                        @if($user)
                          @method('put')
                        @endif
                        <input  type="file" name="logo" class="form-control" accept="image/*">
                        <button type="submit" class="btn btn-primary mt-3">بروز رسانی لوگو</button>
                    </form>
					           <a class="btn btn-danger" href="{{ route('logout') }}">خروج</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mt-3">
				<ul class="list-group">
				  <li class="list-group-item text-muted">فعالیت ها <i class="fa fa-dashboard fa-1x"></i></li>

				  <li class="list-group-item text-left">
								<a href="{{ route('jobs.index') }}" class="pull-right">
					  <strong>شغل های پست شده</strong>
					</a>{{ $posts->count() }}
				  </li>
				  <li class="list-group-item text-left">
					<a href="{{ route('enrolls.index',['company_id' => $company_id]) }}" class="pull-right">
					  <strong>درخواستی ها</strong>
					</a> {{ $enrolls->count() }}
				  </li>
				  <li class="list-group-item text-left">
					<a href="{{ route('message.index',['user_id' => $id]) }}"
					   class="pull-right">
					  <strong>پیام ها</strong>
					</a>{{ $messages->count() }}
				  </li>

				  <li class="list-group-item text-left">
					<a href="{{ route('message.index',['status' => 'unseen' ,'user_id' => $id]) }}" class="pull-right">
						<strong>پیام های خوانده نشده</strong>
					</a>{{ $unseen_messages->count() }}
				  </li>
				</ul>
              </div>
			  
			  <div class="card mt-3">
                <ul class="list-group list-group-flush">

                  <form action="{{ route('companySetting',$company_user->id) }}" method="post">
                    @csrf
					@method('put')

                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-1">پسورد قبلی</h6>
                        <input type="password" name="old_pass" class="form-control" autocomplete="off" >
                      </li>
					  
					             <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-1">پسورد جدید</h6>
                        <input type="password" name="new_pass" class="form-control" autocomplete="off">
                      </li>
                      <button type="submit" class="btn btn-primary pull-right mt-3 mr-3">ارسال</button>
                  </form>
                </ul>
              </div>

            </div> <!-- end of col -->

            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">

                  <div>
                      <h4 class="pb-3">معلومات کمپنی</h4>
                  </div>

                   <form action="{{ $user ? route('company.update',$user->id) : route('company.store') }}" method="post">
                     @csrf
                     @if($user)
                      @method('put')
                     @endif
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">نام</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="text" name="name" class="form-control" autocomplete="off" 
                              value="{{ $user ? $user->name : '' }}">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">ایمیل آدرس</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="email" name="email" class="form-control" autocomplete="off" 
                              value="{{ $user ? $user->email : '' }}">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">شماره تماس</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="text" name="phone" class="form-control" autocomplete="off" 
                               value="{{ $user ? $user->phone : '' }}">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">سال تاسیس</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="date" name="foundation_year" class="form-control" autocomplete="off" 
                               value="{{ $user ? $user->foundation_year : '' }}">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">آدرس</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="text" name="address" class="form-control" autocomplete="off" 
                              value="{{ $user ? $user->address : '' }}">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">نوع فعالیت</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="text" name="type" class="form-control" autocomplete="off" 
                               value="{{ $user ? $user->type : '' }}">
                      </div>
                    </div>
                    <hr>
					<div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">نوع سازمان</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <select name="base_type" class="form-control">
							<option value="">انتخاب نوعیت</option>
							<option value="دولتی" {{ ( $user && $user-> base_type == 'دولتی' ) ? 'selected' : '' }}  > دولتی </option>
							<option value="خصوصی" {{ ( $user && $user-> base_type == 'خصوصی' ) ? 'selected' : '' }} >خصوصی</option>
							<option value="موسسه" {{ ( $user && $user-> base_type == 'موسسه' ) ? 'selected' : '' }} >موسسه</option>
						</select>
                      </div>
                    </div>
                    <hr>
					
					<div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0"> وبسایت </h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="website" name="website" class="form-control" autocomplete="off" 
                              value="{{ $user ? $user->website : '' }}" >
                      </div>
                    </div>
                    <hr>
					
					<div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0"> انستاگرام </h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="text" name="instagram" class="form-control" autocomplete="off" 
                              value="{{ $user ? $user->instagram : '' }}">
                      </div>
                    </div>
                    <hr>
					
					<div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0"> فیسبوک </h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        <input type="text" name="facebook" class="form-control" autocomplete="off" 
                               value="{{ $user ? $user->website : '' }}">
                      </div>
                    </div>
                    <hr>
					
                    <div class="row">
                      <div class="col-sm-12">
                        <h6 class="mb-3">توضیحات</h6>
                      </div>
                      <div class="col-sm-12 text-secondary">
                        <textarea name="description" class="desc form-control" rows="4" cols="10" 
                                  >{{ $user ? $user->description : '' }}</textarea>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right mt-3">ارسال</button>
                   </form>

                </div> <!-- end of card body -->
              </div>

            </div>
          </div> <!-- end of row -->
        </div>
    </div>

@endsection

@section('style')
  <style>

    body{
        margin-top:20px;
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;    
    }
    .main-body {
        padding: 15px;
		direction:rtl;
		text-align:right;
    }
    .card {
        box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col, .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }
    .mb-3, .my-3 {
        margin-bottom: 1rem!important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }
    .h-100 {
        height: 100%!important;
    }
    .shadow-none {
        box-shadow: none!important;
    }
    .header-area{
      position: unset;
      background: rgba(0, 29, 56, 0.8);
    }
    .header-area .main-header-area .main-menu ul li a , .phone_num a{
      color: #fff !important;
    }
    input[type=email] , input[type=password]{
	  text-align: right;
      display: block;
      width: 100%;
      padding: .375rem .75rem;
      font-size: 1rem;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: .25rem;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
    .alert{
      position: fixed;
      bottom: 0;
	  z-index: 9999;
    }
	input[type=email]{
		text-align:right !important;
	}
  .modal-backdrop.show{
    opacity: 0;
      z-index: 0;
  }
  body{
    margin-top: 0;
  }
  ul li{ 
     list-style-type: disc; 
     list-style-position: inside; 
  }
  ol li{ 
     list-style-type: decimal; 
     list-style-position: inside; 
  }
  ul ul, ol ul { 
     list-style-type: circle; 
     list-style-position: inside; 
     margin-left: 15px; 
  }
  ol ol, ul ol { 
     list-style-type: lower-latin; 
     list-style-position: inside; 
     margin-left: 15px; 
  }
  #prof{
    width: 100%;
    height: auto;
    object-fit: cover;
    max-width: 200px;
  }
  </style>
@endsection

@section('script')
<script type="text/javascript">
  // HTML editor
  $('.desc').summernote({
    height:200
  });
</script>
@endsection