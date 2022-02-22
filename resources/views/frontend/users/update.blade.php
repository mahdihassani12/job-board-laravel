@extends('frontend.layouts.app')
@section('main_content')
<div class="container">

	<section class="top_banner">
		<div class="media">
		  <div class="media-right">
		    @if($user->profile_image)
	            <img src='{{ url("public/uploads/student_meta/$user->profile_image") }}' 
	            	 alt="Image" />
	        @else
	            <img src='{{ url("public/uploads/images/author.png") }}' alt="Image">
	        @endif
		  </div>
		  <div class="media-body">
		    <h1 class="media-heading">{{ ($user->firstName && $user)? $user->firstName : '' }}</h1>
		    <strong class="media-heading">{{ ($user->email && $user)? $user->email : '' }}</strong>
			<p> {{ ($user && $user->bio) ? $user->bio : '' }} </p>
		  </div>
		</div>
  	</section> <!-- /section -->

  <section class="main-body">
  	<div class="row">

  		<div class="col-lg-3 col-md-3">
  			<div class="side_nav">
  				<ul class="nav nav-tabs">
		          	<li class="active">
		          		<a data-toggle="tab" href="#home">
		          			<i class="fa fa-user"></i>
		          			معلومات شخصی
			          	</a>
			          </li>
		          	<li>
		          		<a data-toggle="tab" href="#education">
		          			<i class="fa fa-address-book-o"></i>
			          		معلومات تحصیلی
			          	</a>
			         </li>
		          	<li>
		          		<a data-toggle="tab" href="#achievement">
		          			<i class="fa fa-hand-rock-o "></i>
		          			دستاورد ها
			          	</a>
			          </li>
		          	<li>
		          		<a data-toggle="tab" href="#documents">
		          			<i class="fa fa-file-text-o"></i>
		          		مدارک
		          		</a>
		          	</li>
		          	<li>
		          		<a data-toggle="tab" href="#experience">
		          		  <i class="fa fa-address-card-o "></i>
		          		تجربیات
			          	</a>
			        </li>
		          	<li>
		          		<a data-toggle="tab" href="#reference">
		          			<i class="fa fa-users"></i>
		          		مراجع
			          	</a>
			        </li>
					<li>
						<a href="{{ route('message.index',['user_id' => $id ]) }}">
		          			<i class="fa fa-comments "></i>
		          			پیام ها
			          	</a>
						<span> {{ $messages->count() }} </span>
					</li>
					<li>
						<a href="{{ route('message.index',['status' => 'unseen' ,'user_id' => $user->id ]) }}">
		          			<i class="fa fa-comments "></i>
		          			پیام های خوانده نشده
			          	</a>
						<span> {{ $unseen_messages->count() }} </span>
					</li>
			        <li>
		          		<a data-toggle="tab" href="#settings">
		          			<i class="fa fa-cogs "></i>
		          			تنظیمات
			          	</a>
			        </li>
			        <li>
		          		<a href="{{ route('logout') }}">
		          			<i class="fa fa-sign-out "></i>
		          			خروج
			          	</a>
			        </li>
		        </ul>
  			</div>
  		</div> <!-- /col -->

  		<div class="col-lg-9 col-md-9">
  			<div class="tab-content">
  				
  				<div class="tab-pane active" id="home">
  					<h3>معلومات شخصی</h3><br />

		            <form action="{{  $user ? route('student.update',$user->id) : route('student.store')  }}" method="post">
		            	@csrf
		            	@if($user)
		                  @method('put')
		                @endif

		            	<div class="row">
		                  <div class="col-md-6">
		                    <label for="firstName">نام</label>
		                    <input type="text" name="firstName" class="form-control" autocomplete="off" 
		                    	   value="{{ $user ? $user->firstName : '' }}" id="firstName" >
		                  </div>
			               
		                  <div class="col-sm-6">
		                  	<label for="lastName">تخلص</label>
		                  	<input type="text" name="lastName" class="form-control" id="lastName" autocomplete="off"
		                  		   value="{{ $user ? $user->lastName : '' }}">
		                  </div>
		                </div>
		                <hr>

		                <div class="row">
		                  <div class="col-sm-6">
		                  	<label for="fatherName">نام پدر</label>
		                  	<input type="text" name="fatherName" class="form-control" id="fatherName" autocomplete="off"
		                  		   value="{{ $user ? $user->fatherName : '' }}">
		                  </div>
		                  <div class="col-sm-6">
		                    <label for="email">ایمیل آدرس</label>
		                    <input type="email" name="email" class="form-control" id="email" autocomplete="off"
		                    	   value="{{ $user ? $user->email : '' }}">
		                  </div>
		                </div>
		                <hr>

		                <div class="row">
		                  <div class="col-sm-6">
		                    <label for="phone">شماره تماس</label>
		                    <input type="text" name="phone" class="form-control" id="phone" autocomplete="off"
		                           value="{{ $user ? $user->phone : '' }}">
		                  </div>

		                  <div class="col-sm-6">
		                    <label for="address">آدرس</label>
		                    <input type="text" name="address" id="address" class="form-control" autocomplete="off"
		                    	   value="{{ $user ? $user->address : '' }}">
		                  </div>
		                </div>
		                <hr>

		                <div class="row">
		                  <div class="col-sm-6">
		                    <label for="mother_tonque"> زبان مادری </label>
		                    <input type="text" name="mother_tonque" id="mother_tonque" class="form-control" autocomplete="off"
		                    	   value="{{ $user ? $user->mother_tonque : '' }}">
		                  </div>

		                  <div class="col-sm-6" id="radio_btns">
		                    <label>جنسیت : </label>
		                    مرد <input type="radio" name="gender" value="مرد" 
		                    	  {{ ( $user && $user->gender == 'مرد' ) ? 'checked' : '' }}>
		                    زن <input type="radio" name="gender" value="زن" 
		                          {{ ( $user && $user->gender == 'زن' ) ? 'checked' : '' }}>
		                  </div>
		                </div>
		                <hr>

		                <div class="row">
		                	<div class="col-sm-6">
		                		<button class="btn btn-primary pull-right" type="submit">ارسال</button>
		                	</div>
		                </div>
		            </form>
  				</div> <!-- /home -->

  				<div class="tab-pane" id="education">
		           <h3>معلومات تحصیلی</h3><br />

		            <form action="{{  $user ? route('student.update',$user->id) : route('student.store')  }}" method="post">
		            	@csrf
		            	@if($user)
		                  @method('put')
		                @endif

		                <div class="row">
		                  <div class="col-sm-6">
		                    <label for="faculty"> درجه تحصیل </label>
		                    <select name="education_level" id="education_level" class="form-control">
		                    	<option value=""> انتخاب درجه تحصیل </option>								
								<option value="لیسانس"  {{ ( $user && $user-> education_level == 'لیسانس' ) ? 'selected' : '' }} 
										>لیسانس </option>
								<option value="ماستری"  {{ ( $user && $user-> education_level == 'ماستری' ) ? 'selected' : '' }}
										> ماستری </option>
		                    </select>
		                  </div>

		                  <div class="col-sm-6">
		                    <label for="school_name">نام مکتب</label>
		                    <input type="text" name="school_name" id="school_name" class="form-control" autocomplete="off" 
		                    	   value="{{ $user ? $user->school_name : '' }}">
		                  </div>
		                </div>
		                <hr>

		                <div class="row">
		                  <div class="col-sm-6">
		                    <label for="school_address">آدرس مکتب</label>
		                    <input type="text" name="school_address" id="school_address" class="form-control" autocomplete="off" 
		                    	   value="{{ $user ? $user->school_address : '' }}">
		                  </div>

		                  <div class="col-sm-6">
		                    <label for="school_graduation_year">سال فراغت از مکتب</label>
		                    <input type="date" name="school_graduation_year" id="school_graduation_year" class="form-control" 
		                    		autocomplete="off" value="{{ $user ? $user->school_graduation_year : '' }}">
		                  </div>
		                </div>
		                <hr>
						
						<div class="row">
		                  <div class="col-sm-6">
		                    <label for="school_percentage"> فیصدی نمرات سه ساله مکتب </label>
		                    <input type="number" name="school_percentage" id="school_percentage" class="form-control" 
		                    		autocomplete="off" value="{{ $user ? $user->school_percentage : '' }}">
		                  </div>

		                  <div class="col-sm-6">
		                    <label for="uni_enrolled_year">سال ورودی به دانشگاه</label>
		                    <input type="date" name="uni_enrolled_year" id="uni_enrolled_year" class="form-control" autocomplete="off" 
		                    	   value="{{ $user ? $user->uni_enrolled_year : '' }}">
		                  </div>
		                </div>
		                <hr>

		                <div class="row">
		                  <div class="col-sm-6">
		                    <label for="faculty">نام فاکولته</label>
		                    <select name="faculty" id="faculty" class="form-control">
		                    	<option>انتخاب فاکولته</option>
								@foreach($faculties as $faculty)
									
									@if($user)
				                     	<option value="{{ $faculty->id }}" {{ "$faculty->id == $user->faculty_id" ? 'selected' : " " }}>{{ $faculty->name }}</option>
									@else
										<option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
				                    @endif

								@endforeach
		                    </select>
		                  </div>

		                  <div class="col-sm-6">
		                    <label for="department">نام دیپارتمنت</label>
		                    <select name="department" id="department" class="form-control">
		                  		<option>انتخاب دیپارتمنت</option>
								@foreach($departments as $department)

									@if($user)
										<option value="{{ $department->id }}" {{ "$department->id == $user->department_id" ? 'selected' : " " }}>{{ $department->name }}</option>
									@else
										<option value="{{ $department->id }}">{{ $department->name }}</option>
									@endif

								@endforeach
		                    </select>
		                  </div>
		                </div>
		                <hr>

		                <div class="row">
		                  <div class="col-sm-6">
		                    <label for="uni_graduation_year">سال فراغت از دانشگاه</label>
		                    <input type="date" name="uni_graduation_year" id="uni_graduation_year" class="form-control" autocomplete="off" 
		                    	   value="{{ $user ? $user->uni_graduation_year : '' }}">
		                  </div>

		                  <div class="col-sm-6">
		                    <label for="uni_percentage"> فیصدی نمرات لیسانس </label>
		                    <input type="number" name="uni_percentage" id="uni_percentage" class="form-control" autocomplete="off" 
		                    	   value="{{ $user ? $user->uni_percentage : '' }}">
		                  </div>
		                </div>
		                <hr>
						
						<div class="row master">
		                  <div class="col-sm-6">
		                    <label for="master_entry_date">  سال آغاز دوره ماستری </label>
		                    <input type="date" name="master_entry_date" id="master_entry_date" class="form-control" 
		                    	   autocomplete="off" 
		                    	   value="{{ $user ? $user->master_entry_date : '' }}">
		                  </div>

		                  <div class="col-sm-6">
		                    <label for="master_field"> رشته تحصیلی ماستری </label>
		                    <input type="text" name="master_field" id="master_field" class="form-control" autocomplete="off" 
		                    	   value="{{ $user ? $user->master_field : '' }}">
		                  </div>
		                </div>
		                <hr class="master">
						
						<div class="row master">
		                  <div class="col-sm-6">
		                    <label for="master_percentage">  فیصدی نمرات ماستری </label>
		                    <input type="number" name="master_percentage" id="master_percentage" class="form-control" 
		                    	   autocomplete="off" 
		                    	   value="{{ $user ? $user->master_percentage : '' }}">
		                  </div>

		                  <div class="col-sm-6">
		                    <label for="master_end_date"> تاریخ اتمام دوران ماستری </label>
		                    <input type="date" name="master_end_date" id="master_end_date" class="form-control"
		                    	   autocomplete="off" 
		                    	   value="{{ $user ? $user->master_end_date : '' }}">
		                  </div>
		                </div>
		                <hr class="master">

		                <div class="row">
		                	<div class="col-sm-6">
		                		<button class="btn btn-primary pull-right" type="submit">ارسال</button>
		                	</div>
		                </div>

		            </form>

		         </div><!--/tab-pane-->

		         <div class="tab-pane" id="achievement">
					<h3> دستاورد ها </h3><br />
					
					 <form action="{{  $user ? route('student.update',$user->id) : route('student.store')  }}" method="post">
		            	@csrf
		            	@if($user)
		                  @method('put')
		                @endif

		                <div class="row">
						  <div class="col-sm-10">
							<label for="skills"> مهارت ها </label>
							<textarea name="skills" id="skills" 
									  class="form-control" rows="8">{{ $user ? $user->user_skills : '' }}</textarea>
						  </div>
						</div>
						<hr>
						
						<div class="row">
						  <div class="col-sm-10">
							<label for="research"> تحقیقات </label>
							<textarea name="research" id="research" 
									  class="form-control" rows="8">{{ $user ? $user->research : '' }}</textarea>
						  </div>
						</div>
						<hr>
						
						<div class="row">
						  <div class="col-sm-10">
							<label for="achievement"> دستاورد ها </label>
							<textarea name="achievement" id="achievements" 
									  class="form-control" rows="8">{{ $user ? $user->achievement : '' }}</textarea>
						  </div>
						</div>
						<hr>
		                
		                <div class="row">
		                	<div class="col-sm-6">
		                		<button class="btn btn-primary pull-right" type="submit">ارسال</button>
		                	</div>
		                </div>

		            </form>

				 </div><!--/tab-pane-->

				 <div class="tab-pane" id="documents">
		            <h۳>مدارک</h۳><br /><br />

		            <form action="{{   route('document.store')  }}" method="post" 
		            	  enctype="multipart/form-data">
		            	@csrf

		                <div class="row">
			              <div class="col-sm-6">
			                <label for="document_type">نوعیت مدرک</label>
			                <select name="document_type">
			                	<option value="uni_diploma">دیپلوم دانشگاه</option>
			                	<option value="school_diploma">دیپلوم مکتب</option>
			                	<option value="lang_document">مدرک زبان</option>
			                	<option value="comp_document">مدرک کمپیوتر</option>
			                	<option value="another">دیگر</option>
			                </select>
			              </div>
			         
			              <div class="col-sm-6">
			                <label for="document_type">مدارک</label>
			                <input type="file" name="document_name[]" id="document_name" class="form-control" 
			                	   accept="image/*" multiple>
			              </div>
			            </div>
			            <hr>        

			            <input type="hidden" name="student_id" value="{{ $student_id }}">

		             	<div class="row">
		                	<div class="col-sm-6">
		                		<button class="btn btn-primary pull-right" type="submit">ارسال</button>
		                	</div>
		                </div>

		            </form>

		            <div class="row">
		              @foreach($documents as $document)

		                <div class="col-sm-4">

		                  <div class="document_image" id="document_image">
		                  	<form action="{{ route('document.destroy',$document->id) }}" method="post">
								@csrf
								@method('Delete')
								<button type='submit' class='delete_btn'>
									<i class="fa fa-close" id="close_icon"></i>
								</button>
							 </form>
		                    <img src='{{ url("public/uploads/documents/$document->document_name") }}' class="myImg">

		                    @switch($document->document_type)
		                        @case('uni_diploma')
		                            <p>دیپلوم دانشگاه</p>
		                            @break

		                        @case('school_diploma')
		                            <p>دیپلوم مکتب</p>
		                            @break

		                        @case('lang_document')
		                            <p>مدرک زبان</p>
		                            @break

		                        @case('comp_document')
		                            <p>مدرک کمپیوتر</p>
		                            @break

		                        @default
		                            <p>دیگر</p>
		                    @endswitch

		                  </div>

		                </div>

		               @endforeach
		            </div>

		            <!-- The Modal -->
					<div id="myModal" class="modal">
					  <span class="close">&times;</span>
					  <img class="modal-content" id="img01" >
					</div>

		         </div><!--/tab-pane-->

		         <div class="tab-pane" id="experience">
		            <h3>تجربیات</h3><br />

		            <form action="{{   route('experience.store')  }}" method="post" 
		            	  enctype="multipart/form-data">
		            	@csrf
							
		            	@if($experiences->count() > 0)
		            		@foreach($experiences as $experience)
								<div class="row row_group">
									<div class="col-sm-12">
										<label for="description">تشریحات</label>
										<textarea class="form-control exp_desc" rows="5" id="description" 
												  cols="10" name="description[]" placeholder="شرح تجربه ...">{{ $experience->description }}</textarea>
									</div>
									<input type="hidden" name="student_id" value="{{ $student_id }}">
									<input type="hidden" name="update_exp" value="update">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-md-6" style="margin-bottom: 25px;">
												<label for="start_date">تاریخ شروع</label>
												<input type="date" name="start_date[]" id="start_date" class="form-control" value="{{ $experience->start_date }}">
											</div>

											<div class="col-md-6">
												<label for="end_date">تاریخ ختم</label>
												<input type="date" name="end_date[]" id="end_date" class="form-control" value="{{ $experience->end_date }}">
											</div>
										</div>
									</div>
								</div><hr > <!-- end of row -->
							@endforeach
		            	@else
		            		<div class="row row_group">
									<div class="col-sm-12">
										<label for="description">تشریحات</label>
										<textarea class="form-control exp_desc" rows="5" id="description" 
												  cols="10" name="description[]" placeholder="شرح تجربه ..."></textarea>
									</div>
									<input type="hidden" name="student_id" value="{{ $student_id }}">
									<div class="col-sm-12">
										<div class="row">
											<div class="col-md-6" style="margin-bottom: 25px;">
												<label for="start_date">تاریخ شروع</label>
												<input type="date" name="start_date[]" id="start_date" class="form-control"
												placeholder="تاریخ شروع">
											</div>

											<div class="col-md-6">
												<label for="end_date">تاریخ ختم</label>
												<input type="date" name="end_date[]" id="end_date" class="form-control" 
												placeholder="تاریخ ختم">
											</div>
										</div>
									</div>
								</div><hr > <!-- end of row -->
		            	@endif

		             	<div class="row">
		                	<div class="col-sm-12">
		                		<button class="btn btn-primary pull-right submit_btn" type="submit">ارسال</button>
		                		<a class="btn btn-primary pull-right new_row">افزودن سطر جدید</a>
		                		<a class="btn btn-primary pull-right remove_row">حدف سطر</a>
		                	</div>
		                </div>

		            </form>

		         </div><!--/tab-pane-->

		         <div class="tab-pane" id="reference">
		            <h3>مراجع</h3><br />

		            <form action="{{ route('reference.store')  }}" method="post" 
		            	  enctype="multipart/form-data">
		            	@csrf

						@if($references->count() > 0 )
							@foreach($references as $reference)
								<div class="row new_ref_group">
									<div class="col-md-6">
										<label for="reference_name">نام مرجع</label>
										<input type="text" name="reference_name[]" id="reference_name" 
											   class="form-control" autocomplete="off" value="{{ !empty($reference->reference_name) ? $reference->reference_name : '' }}">
									</div>
									<div class="col-md-6" style="margin-bottom: 15px">
										<label for="reference_organization"> نام سازمان </label>
										<input type="text" name="reference_organization[]" id="reference_organization" 
											   class="form-control" autocomplete="off" value="{{ !empty($reference->reference_organization) ? $reference->reference_organization : '' }}">
									</div>
									<div class="col-md-6">
										<label for="reference_email">ایمیل آدرس مرجع</label>
										<input type="email" name="reference_email[]" id="reference_email" 
											   class="form-control" autocomplete="off" value="{{ !empty($reference->reference_email) ? $reference->reference_email : '' }}">
									</div>
									<input type="hidden" name="student_id" value="{{ $student_id }}">
									<input type="hidden" name="update_ref" value="update">
									<div class="col-md-6">
										<label for="reference_phone">شماره تماس مرجع</label>
										<input type="text" name="reference_phone[]" id="reference_phone" 
											   class="form-control" autocomplete="off" value="{{ !empty($reference->reference_phone) ? $reference->reference_phone : '' }}">
									</div>
								</div><hr> <!-- end of row -->
							@endforeach
						@else
							<div class="row new_ref_group">
								<div class="col-md-6">
									<label for="reference_name">نام مرجع</label>
									<input type="text" name="reference_name[]" id="reference_name" 
										   class="form-control" autocomplete="off" placeholder="نام مرجع">
								</div>
								<div class="col-md-6" style="margin-bottom: 15px">
									<label for="reference_organization"> نام سازمان </label>
									<input type="text" name="reference_organization[]" id="reference_organization" 
										   class="form-control" autocomplete="off" placeholder="نام سازمان">
								</div>
								<div class="col-md-6">
									<label for="reference_email">ایمیل آدرس مرجع</label>
									<input type="email" name="reference_email[]" id="reference_email" 
										   class="form-control" autocomplete="off" placeholder="ایمیل مرجع">
								</div>
								<input type="hidden" name="student_id" value="{{ $student_id }}">
								<div class="col-md-6">
									<label for="reference_phone">شماره تماس مرجع</label>
									<input type="text" name="reference_phone[]" id="reference_phone" 
										   class="form-control" autocomplete="off" placeholder="شماره تماس مرجع">
								</div>
							</div><hr> <!-- end of row -->
						@endif
						
		             	<div class="row">
		                	<div class="col-sm-12">
		                		<button class="btn btn-primary pull-right submit_btn" type="submit">ارسال</button>
		                		<a class="btn btn-primary pull-right ref_new_row">افزودن سطر جدید</a>
		                		<a class="btn btn-primary pull-right ref_remove">حدف سطر</a>
		                	</div>
		                </div>

		            </form>

		         </div><!--/tab-pane-->
				 
		         <div class="tab-pane" id="settings">
		         	<h3> تنظیمات </h3> <br />
					
					<section>
						<form action="{{ $user ? route('student.update',$user->id) : route('student.store') }}" method="post" 
							  enctype="multipart/form-data">
							@csrf
							@if($user)
							  @method('put')
							@endif
							<div class="row">
								<div class="col-md-6">
									<input  type="file" name="profile_image" class="form-control" accept="image/*">
								</div>
							</div>
							<button type="submit" class="btn btn-primary mt-3">بروز رسانی عکس</button>
						</form> <hr />
					</section>
					
					<section>
						<form action="{{ route('studentSetting',$student_user->id) }}" method="post">
							@csrf
							@method('put')

							<div class="row">
								<div class="col-md-6">
									<h6 class="mb-1">پسورد قبلی</h6>
									<input type="password" name="old_pass" class="form-control" autocomplete="off" >
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h6 class="mb-1">پسورد جدید</h6>
									<input type="password" name="new_pass" class="form-control" autocomplete="off">
								</div>
							</div>

							 <button type="submit" class="btn btn-primary mt-3 mr-3">ارسال</button>
						</form> <hr />
					</section>
					
					<section>
						<form action="{{  $user ? route('student.update',$user->id) : route('student.store')  }}" method="post">
							@csrf
							@if($user)
							  @method('put')
							@endif
							
							<div class="form-group">
								<label> چکیده درباره شما </label>
								<textarea class="form-control" name="bio" 
										  id="bio" rows="5" cols="10">{{ ( $user && $user->bio ) ? $user->bio : ''  }}</textarea>
							</div>	
							<button type="submit" class="btn btn-primary mt-3 mr-3">ارسال</button>
						</form>
					</section>
					
		         </div> <!-- /tab-pane -->

  			</div> <!-- /tab - content -->
  		</div> <!-- /col -->
  	</div> <!-- /row -->
  </section> <!-- /section -->

</div> <!-- /container -->
@endsection
@section('style')
  <style>
  	.new_row, .remove_row , .ref_new_row , .ref_remove{
  		margin-right: 10px;
  		margin-top: 20px;
  		color: #fff !important;
  	}
    .header-area{
      position: unset;
      background: rgba(0, 29, 56, 0.8);
      margin-bottom: 50px;
    }
    .alert{
      position: fixed;
      bottom: 0;
      z-index: 9999;
    }
   body{
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;    
    }
    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    input[type=email] , input[type=password]{
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
    .new_row_added , .remove_ref_row{
    	margin-top: 30px;
    }
	.document_image img{
        width: 250px;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
    }
    .document_image p{
      padding-top: 10px;
      text-align: center;
    }
    .delete_btn{
    	background: unset;
    	border: unset;
    	position: absolute;
    	cursor: pointer;
    }
    #close_icon{
    	font-family: fontawesome !important;
	    color: red;
	    background: #fff;
	    padding: 3px;
	    border-radius: 20px;
    }
	.nav a.active{
		color: #007bff;
	}
	.modal {
	  display: none; /* Hidden by default */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Sit on top */
	  padding-top: 100px; /* Location of the box */
	  left: 0;
	  top: 0;
	  width: 100%; /* Full width */
	  height: 100%; /* Full height */
	  overflow: auto; /* Enable scroll if needed */
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
	}

	/* Modal Content (image) */
	.modal-content {
	  margin: auto;
	  display: block;
	  width: 80%;
	  max-width: 700px;
	  margin-bottom: 30px;
	}
	@-webkit-keyframes zoom {
	  from {-webkit-transform:scale(0)} 
	  to {-webkit-transform:scale(1)}
	}

	@keyframes zoom {
	  from {transform:scale(0)} 
	  to {transform:scale(1)}
	}

	/* The Close Button */
	.close:hover,
	.close:focus {
	  color: #bbb;
	  text-decoration: none;
	  cursor: pointer;
	}

	/* 100% Image Width on Smaller Screens */
	@media only screen and (max-width: 700px){
	  .modal-content {
	    width: 100%;
	  }
	}
	.myImg {
	  cursor: pointer;
	  transition: 0.3s;
	}
	.ck.ck-toolbar.ck-toolbar_grouping>.ck-toolbar__items{
		flex-wrap: wrap !important;
		direction: ltr;
	    padding: 0px 10px;
	}
	.modal-backdrop.show{
		opacity: 0;
    	z-index: 0;
	}
	.master{
		display: none;
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
	  .nav-tabs > li{
	  	list-style: none;
	  }

	  /*******************/
	  .top_banner{
	  	width: 100%;
	  	height: auto;
	  	background: #fff;
	  	margin-bottom: 30px;
	  }
	  .top_banner .media .media-right img {
	  	width: 150px;
	    height: auto;
	    object-fit: cover;
	    border: 1px solid #eee;
	    margin: 20px;
	    min-height: 200px;
	  }
	  .top_banner .media .media-body h1{
	  	text-align: right;
	  	font-size: 30px;
	  	padding-bottom: 5px;
	  }
	  .top_banner .media .media-body{
	  	text-align: right;
	  	margin-top: 50px;
	  	margin-right: 10px;
	  }
	  .top_banner .media .media-body p{
	  	padding-top: 10px;
	  }
	  .side_nav{
	  	background: #fff;
	  	min-height: 520px;
    	margin-bottom: 30px;
    	padding-top: 30px;
	  }
	  .side_nav ul li{
	  	display: block;
	    width: 100%;
	    text-align: right;
	    padding: 10px 0;
	    padding-right: 15px;
	    border: 1px solid #eee;
	  }
	  .side_nav ul li:hover{
	  	border-right: 2px solid #007bff;
    	border-left: 2px solid #007bff;
	  }
	  .side_nav ul li:hover > a{
	  	color: #007bff;
	  }
	  .side_nav ul li:hover > a > i{
	  	color: #007bff;
	  }
	  .side_nav ul li.has-dropdown{
	  	border-right: unset;
    	border-left: unset;
	  }
	  .side_nav ul li.active{
	  	border-right: 2px solid #007bff;
    	border-left: 2px solid #007bff;
	  }
	  .side_nav ul li.active a , .side_nav ul li.active i{
	  	color: #007bff;
	  }
	  .side_nav ul li a{
	  	color: #000;
	  }
	  .side_nav ul li a i{
	  	color: #000;
    	font-family: 'FontAwesome' !important;
    	padding-left: 5px;	
	  }
	  .side_nav ul li a i.fa-angle-down{
	  	margin-right: 15px;
    	font-weight: bold;
	  }
	  .nav-tabs{
	  	border-bottom: unset;
	  }
	  .tab-content .tab-pane{
	  	text-align: right;
	  }
	  #radio_btns{
	  	padding-top: 30px;
	  }
	  #documents select{
	  	padding: 5px 32px;
	  	width: 100%;
	  }
	  .ref_new_row , .ref_remove , .new_row, .remove_row{
	  	margin-top: unset;
	  }
	  ul.dropdown{
	  	margin-right: 25px;
	  	display: none;
	  }
	  ul.dropdown li{
	  	border: unset;
	  	border-bottom: 1px solid #eee;
	  }
	  ul.dropdown li:last-child{
	  	border-bottom:unset;
	  }
	  .side_nav > ul > li:last-child{
	  	margin-bottom: 50px;
	  }
	  ul.dropdown span{
	  	display: inline-block;
	    width: 22px;
	    height: 22px;
	    text-align: center;
	    border-radius: 13px;
	    color: #007bff;
	  }
  </style>
@endsection

@section('script')

<script type="text/javascript">
   $(document).ready(function() {

    	// popup gallery

		var modal = jQuery('#myModal');
		var img = jQuery('.myImg');
		var modalImg = jQuery('#img01');

		jQuery('.myImg').on('click',function(){
			modal.css('display','block');
			var newAtrr = jQuery(this).attr('src');
			modalImg.attr('src', newAtrr);
		});

		jQuery('.close').css('z-index','100000');

		jQuery('.close').on('click',function(){
			modal.css('display','none')
		});


        // adding new row to experience

        jQuery('.new_row').on('click',function(){

        	var tr = '<div class="row new_row_added">'+

                    	'<div class="col-sm-12">'+
                    		'<label for="description">توضیحات</label>'+
                    		'<textarea class="form-control exp_desc" rows="5" id="description" '+
                    				  'cols="10" name="description[]" placeholder="توضیحات تجربه"></textarea>'+
                    	'</div>'+
                    	'<div class="col-sm-12">'+
                    		'<div class="row">'+
                    			'<div class="col-md-6" style="margin-bottom: 25px;">'+
                    				'<label for="start_date">تاریخ شروع</label>'+
                    				'<input type="date" name="start_date[]" id="start_date" class="form-control">'+
                    			'</div>'+

                    			'<div class="col-md-6">'+
                    				'<label for="end_date">تاریخ ختم</label>'+
                    				'<input type="date" name="end_date[]" id="end_date" class="form-control">'+
                    			'</div>'+
                    		'</div>'+
                    	'</div>'+

                    '</div>';
            jQuery('.row_group').last().after(tr);   	

        });

        jQuery('.remove_row').on('click',function(){
        	jQuery('.new_row_added').last().remove();
        });

        // add new row to reference
        jQuery('.ref_new_row').on('click',function(){

        	var ref = '<div class="row remove_ref_row">'+
						'<div class="col-md-6">'+
							'<label for="reference_name">نام مرجع</label>'+
							'<input type="text" name="reference_name[]" id="reference_name" '+
								   'class="form-control" autocomplete="off" placeholder="نام مرجع">'+
						'</div>'+
						'<div class="col-md-6" style="margin-bottom: 15px">'+
							'<label for="reference_organization"> نام سازمان </label>'+
							'<input type="text" name="reference_organization[]" id="reference_organization"'+ 
								   'class="form-control" autocomplete="off" placeholder="نام سازمان">'+
						'</div>'+
                    	'<div class="col-md-6">'+
                    		'<label for="reference_email">ایمیل مرجع</label>'+
                    		'<input type="email" name="reference_email[]" id="reference_email"'+
                    			   'class="form-control" autocomplete="off" placeholder="ایمیل مرجع">'+
                    	'</div>'+
                    	'<div class="col-md-6">'+
                    		'<label for="reference_phone">شماره تماس مرجع</label>'+
                    		'<input type="text" name="reference_phone[]" id="reference_phone" '+
                    			   'class="form-control" autocomplete="off" placeholder="شماره تماس مرجع">'+
                    	'</div>'+
                    '</div>';

             jQuery('.new_ref_group').last().after(ref);

        });

        jQuery('.ref_remove').on('click',function(){
        	jQuery('.remove_ref_row').last().remove();
        });

		// checking education degree
		jQuery('#education_level').change(function(){
			$val = jQuery(this).val();
			if( $val == 'ماستری' ){
				jQuery('.master').css('display','flex');
			}else{
				jQuery('.master').css('display','none');
			}
		});
		
		jQuery('.has-dropdown > a').click(function(){
			jQuery('.dropdown').toggle(500);
		});

    });
</script>
@endsection

