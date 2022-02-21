<?php 
$setting = DB::table('settings')->first();
?>
 <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid container">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    @if($setting)
                                        @if($setting->logo)
                                            <a href="{{ route('index') }}">
                                                <img src='{{ url("/uploads/logo/$setting->logo") }}' alt="Logo" style="width: 75px; height: auto; border-radius: 50%; margin-top: 10px;">
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('index') }}">صفحه اصلی</a></li>
                                            <li><a href="{{ route('jobs.page') }}">وظیفه ها</a></li>
                                            <li><a href="{{ route('students.page') }}">محصلین</a></li>
                                            <li><a href="{{ route('companies.page') }}">شرکت ها</a></li>
                                            <li><a href="{{ route('contact') }}">تماس باما</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">

                                     @if (Route::has('login'))

                                        <div class="phone_num d-none d-xl-block">

                                            @auth
                                                
                                                @if(Auth()->user()->role=='admin')
                                                    <a href="{{ route('admin_profile') }}">داشبورد</a>
                                                @elseif(Auth()->user()->role=='user')
                                                   <a href="{{ route('user_profile') }}">داشبورد</a>
                                                @elseif(Auth()->user()->role=='company')
                                                     <a href="{{ route('company_profile') }}">داشبورد</a>
                                                @endif

                                            @else
                                                <a href="{{ route('login') }}">ورود</a>
                                            @endif

                                        </div>

                                    @endif

                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn3" href="{{ route('jobs.create') }}">ایجاد شغل</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->