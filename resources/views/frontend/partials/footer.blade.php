<?php 
$setting = DB::table('settings')->first();
$categories = DB::table('categories')->orderby('id','DESC')->paginate(5);
?>
<!-- footer start -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
							<h3 class="footer_title">
                                آدرس
                            </h3>
                            <p>
								{{ $setting ? $setting->description : '' }}
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="{{ $setting ? $setting->facebook : '' }}">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting ? $setting->telegram : '' }}">
                                            <i class="fa fa-telegram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $setting ? $setting->website : '' }}">
                                            <i class="fa fa-google"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".4s">
                            <h3 class="footer_title">
                                صفحات
                            </h3>
                            <ul>
                                <li><a href="{{ route('jobs.page') }}">وظیفه ها</a></li>
								<li><a href="{{ route('students.page') }}">محصلین</a></li>
								<li><a href="{{ route('companies.page') }}">شرکت ها</a></li>
								<li><a href="{{ route('contact') }}">تماس باما</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".5s">
                            <h3 class="footer_title">
                                دسته ها
                            </h3>
                            <ul>
                                @foreach($categories as $cat)
									<li><a href="#">{{ $cat->name }}</a></li>
								@endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".6s">
                            <h3 class="footer_title">
                                تماس باما
                            </h3>
                            <p class="newsletter_text">باما از طریق صفحه زیر در تماس بوده و نظریات خودرا شریک سازید</p>
							<a href="{{ route('contact') }}" class='contact_btn'>تماس باما</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".3s">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            تمام امتیاز های معنوی این سایت مربوط به دانشگاه هرات میباشد
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>