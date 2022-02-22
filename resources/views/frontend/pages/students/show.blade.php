@extends('frontend.layouts.app')
@section('main_content')
  
  <section class="container">
      <div class="row">
          <div class="col-lg-4 col-md-4">
            
			<div class="card">
				<div class="card-header">
					<h3> مشخصات محصل </h3>
				</div>	
				<div class="card-body">
					
					<div class="candidate_thumb">
						@if($student->profile_image)
						  <img src='{{ url("public/uploads/student_meta/$student->profile_image") }}'
							 alt="Admin" class="rounded-circle" width="150">
						@else
						  <img src='{{ url("public/uploads/images/author.png") }}' alt="Admin" class="rounded-circle" width="150">
						@endif	
					</div>
						
					<div class="candidate_details">
						<ul>
							<li>
								<div class="media">
									<div class="media-header">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
									</div>
									<div class="media-body">
										<strong>  نام و تخلص : </strong>
										<h4>{{ $student->firstName }} {{ $student->lastName }}</h4>
									</div>
								</div>
							</li>
							<li>
								<div class="media">
									<div class="media-header">
										<i class="fa fa-mobile" aria-hidden="true"></i>
									</div>
									<div class="media-body">
										<strong>  شماره تماس : </strong>
										<h4>{{ $student->phone }}</h4>
									</div>
								</div>
							</li>
							<li>
								<div class="media">
									<div class="media-header">
										<i class="fa fa-map-marker" aria-hidden="true"></i>
									</div>
									<div class="media-body">
										<strong> آدرس :  </strong>
										<h4> {{ $student->address }} </h4>
									</div>
								</div>
							</li>
							<li>
								<div class="media">
									<div class="media-header">
										<i class="fa fa-language" aria-hidden="true"></i>
									</div>
									<div class="media-body">
										<strong> زبان :  </strong>
										<h4> {{ $student->mother_tonque }} </h4>
									</div>
								</div>
							</li>
							<li>
								<div class="media">
									<div class="media-header">
										<i class="fa fa-user" aria-hidden="true"></i>
									</div>
									<div class="media-body">
										<strong> جنسیت :  </strong>
										<h4> {{ $student->gender }} </h4>
									</div>
								</div>
							</li>
						</ul>
					</div>
					
				</div>
			</div>
			
			<div class="card">
				<div class="card-header">
					<h3> مراجع </h3>
				</div>	
				<div class="card-body">
					@if($references->count() > 0)
						@foreach($references as $ref)
						<div class="row reference_row">
						   <div class="col-md-12 ref_col">
                              <i> نام مرجع : </i> {{ $ref->reference_name }}
                          </div>
						   <div class="col-md-12 ref_col">
                              <i> نام سازمان : </i> {{ $ref->reference_organization }}
                          </div>
                          <div class="col-md-12 ref_col">
                              <i> ایمیل آدرس: </i> {{ $ref->reference_email }} 
                          </div>
                          <div class="col-md-12 ref_col">
                              <i>شماره تماس : </i> {{ $ref->reference_phone }}
                          </div>
                      </div> <!-- end of row -->
                    @endforeach
					@else
					  <h4> هیج معلوماتی یافت نشد. </h4>
					@endif
				</div>	
			</div>

			<div class="card">
				<div class="card-header">
					پل ارتباطی
				</div>
				<div class="card-body">
					<form action="{{ route('message.store') }}" method="post">
						@csrf
						<div class="row">
							
							<div class="col-md-12 form-group">
								<div class="input_field">
									<input type="text" name='name' placeholder="نام" class="form-control" autocomplete="off">
								</div>
							</div>
							
							<div class="col-md-12 form-group">
								<div class="input_field">
									<input type="text" name='phone' placeholder="شماره تماس" class="form-control" autocomplete="off">
								</div>
							</div>
							
							<div class="col-md-12 form-group">
								<div class="input_field">
									<input type="text" name='title' placeholder="عنوان پیام" class="form-control" autocomplete="off">
								</div>
							</div>

							<div class="col-md-12 form-group">
								<div class="input_field">
									<textarea name="description" id="" cols="20" rows="7" class="form-control" 
									placeholder="توضیحات" autocomplete="off"></textarea>
								</div>
							</div>

							<input type="hidden" name="user_id" value="{{ $student->user_id }}">
							<div class="col-md-12">
								<div class="submit_btn">
									<button class="boxed-btn3 w-100" type="submit">درخواست</button>
								</div>
							</div>
						</div>
					</form>						
				</div>
			</div>
			
          </div> <!-- /col -->
          <div class="col-lg-8 col-md-8">
            
			<div class="card">
				<div class="card-header">
					<h3> درباره من </h3>
				</div>
				<div class="card-body">
					{{ $student->bio }}
				</div>
			</div>
			
			<div class="card">
				<div class="card-header">
					<h3> تحصیلات </h3>
				</div>
				<div class="card-body" id="education_section">
				
					<div class="row">
						<div class="col-md-5">
							<div class="input-group">
								<strong> درجه تحصیل :</strong>{{ $student->education_level }}
							</div>
						</div>
						<div class="col-md-5">
							<div class="input-group">
								<strong> نام مکتب : </strong>{{ $student->school_name }}
							</div>
						</div>
					</div> <!-- /row -->
					
					<div class="row">
						<div class="col-md-5">
							<div class="input-group">
								<strong> سال فراغت از مکتب : </strong>{{ $student->school_graduation_year }}
							</div>
						</div>
						<div class="col-md-5">
							<div class="input-group">
								<strong> فیصدی نمرات مکتب : </strong>{{ $student->school_percentage."%" }}
							</div>
						</div>
					</div> <!-- /row -->
					
					<div class="row">
						<div class="col-md-5">
							<div class="input-group">
								<strong> آدرس مکتب : </strong>{{ $student->school_address }}
							</div>
						</div>
						<div class="col-md-5">
							<div class="input-group">
								<strong> سال ورود به دانشگاه : </strong>{{ $student->uni_enrolled_year }}
							</div>
						</div>
					</div> <!-- /row -->
					
					<div class="row">
						<div class="col-md-5">
							<div class="input-group">
								<strong> نام فاکولته : </strong>{{ $student->faculty->name }}
							</div>
						</div>
						<div class="col-md-5">
							<div class="input-group">
								<strong> نام دیپارتمنت : </strong>{{ $student->department->name }}
							</div>
						</div>
					</div> <!-- /row -->
					
					<div class="row">
						<div class="col-md-5">
							<div class="input-group">
								<strong> سال فراغت از دانشگاه : </strong>{{ $student->uni_graduation_year }}
							</div>
						</div>
						<div class="col-md-5">
							<div class="input-group">
								<strong> فیصدی نمرات دانشگاه : </strong>{{ $student->uni_percentage."%" }}
							</div>
						</div>
					</div> <!-- /row -->
					
					@if($student->education_level == 'ماستری' && $student)
						<div class="row">
							<div class="col-md-5">
								<div class="input-group">
									<strong> سال آغاز ماستری : </strong>{{ $student->master_entry_date }}
								</div>
							</div>
							<div class="col-md-5">
								<div class="input-group">
									<strong> رشته دوره ماستری : </strong>{{ $student->master_field }}
								</div>
							</div>
						</div> <!-- /row -->
						
						<div class="row">
							<div class="col-md-5">
								<div class="input-group">
									<strong> سال فراغت ماستری : </strong>{{ $student->master_end_date }}
								</div>
							</div>
							<div class="col-md-5">
								<div class="input-group">
									<strong> فیصدی نمرات ماستری : </strong>{{ $student->master_percentage."%"}}
								</div>
							</div>
						</div> <!-- /row -->
					@endif
					
				</div>
			</div> <!-- /card -->
			
			<div class="card">
				<div class="card-header">
					<h3>
						دستاورد ها
					</h3>
				</div>
				<div class="card-body">
					
					<section>
						<p><strong> مهارت ها : </strong></p>
						{!! $student->user_skills !!}
					</section><br /><hr />
					
					<section>
						<p><strong>  تحقیقات : </strong></p>
						{!! $student->research !!}
					</section> <br /><hr />
					
					<section>
						<p><strong>  دستاورد ها : </strong></p>
						{!! $student->achievement !!}
					</section> <br /><hr />
					
					<section>
            <p><strong>   تجربیات : </strong></p>
						@if($experiences->count() > 0 )
						  @foreach($experiences as $exp)
							{!! $student->achievement !!}
							<div class="exp_date">
                <span><i>شروع از</i>: {{ $exp->start_date }}</span>
                 <strong> - </strong>
                <span><i>تا به</i>: {{ $exp->end_date }}</span>
              </div>
						@endforeach
					  @endif
						
					</section> <br /><hr />
					
				</div>
			</div> <!-- /card -->
			
			<div class="card">
				<div class="card-header">
					<h3>
						مدارک
					</h3>
				</div>
				<div class="card-body">
					@if($documents->count() > 0)
						
					  <div class="row">
						 @foreach($documents as $document)
						  <div class="col-sm-6">

							<div class="document_image" id="document_image">
							  <img src='{{ url("/uploads/documents/$document->document_name") }}' class="myImg">

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
					  
					@endif
				</div>
					<hr>

					<!-- The Modal -->
					<div id="imageModal" class="imageModal">
					  <span class="close">&times;</span>
					  <img class="modal-content" id="img01" >
					</div>
				</div>
			</div> <!-- /card -->
			
          </div> <!-- /col -->
      </div> <!-- /row -->
  </section> <!-- /container -->

@endsection
@section('style')
  <style>
	.modal-backdrop.show{
		z-index:10;
	}
	.modal-header .close{
		margin: -1rem -1rem;
	}
    .header-area{
      position: unset;
      background: rgba(0, 29, 56, 0.8);
      margin-bottom: 50px;
    }
    .alert{
		position: fixed;
        bottom: 0;
        z-index: 10;
    }
   body{
        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;    
    }
    .snippet{
      background-color: #fff;
      padding: 15px;
      margin-bottom: 20px;
    }
    .card{
      margin-bottom: 20px;
    }
    .nav li{
      margin-right: 15px;
    }
    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 15px;
        margin-bottom: 15px;
    }
    .nav a.active{
      color: #007bff;
    }
    .document_image img{
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
    }
    .document_image p{
      padding-top: 10px;
      text-align: center;
    }
    .exp_col{
      margin-bottom: 25px;
      border-bottom: 1px solid #eee;
      padding-bottom: 15px;
    }
    .exp_date{
      padding-top: 10px;
    }
    .exp_date i{
      color: red;
    }
    .reference_row{
      margin-bottom: 15px;
      border-bottom: 1px solid #eee;
      padding-bottom: 15px;
    }
    .reference_row i{
      color: #007bff;
    }
	.single_student{
		direction:rtl;
		text-align:right;
	}
  .exp_date i{
      color: #007bff;
      font-style: inherit;
    }
	.send_message{
		margin-top: 30px;
		padding: 10px 35px;
	}
  .imageModal {
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
  .close {
    position: absolute;
    top: 105px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
  }

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
  .call{
    color: #fff;
  }
  .call a{
    color: #fff;
  }

  /*****************************/

	.card{
		text-align:right;
	}
  .candidate_thumb{
    text-align: center;
    padding-bottom: 25px;
    border-bottom: 1px solid #eee;
  }
  .candidate_details .media i{
    font-family: 'FontAwesome' !important;
    font-size: 25px;
    color: #305068;
  }
  .candidate_details .media{
    display: flex;
    flex-direction: row;
    align-items: center;
    padding-top: 20px;
    }
  .candidate_details .media .media-body{
    display: flex;
    padding-right: 15px;
  }
  .candidate_details .media .media-body h4{
    padding-right: 10px;
    margin-bottom: 0;
  }
  .candidate_details .media .media-body strong{
    min-width: 46px;
  }
  .candidate_details li{
      border-bottom: 1px solid #eee;
      padding-bottom: 15px;
      list-style: none;
  }
  #education_section .input-group{
    padding: 8px 0;
  }
  #education_section .input-group strong{
    padding-left: 8px;
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
    .ref_col{
      padding-bottom: 10px;
    }
  </style>
@endsection

@section('script')
<script type="text/javascript">
   $(document).ready(function() {

        // popup gallery

        var modal = jQuery('#imageModal');
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

        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        

        $(".file-upload").on('change', function(){
            readURL(this);
        });
    });
</script>
@endsection