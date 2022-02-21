  <!-- right side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-right image">
          <img src='{{ url("public/uploads/images/author.png") }}' class="img-circle" alt="User Image">
        </div>
        <div class="pull-right info">
          <p> <?php echo auth()->user()->name; ?> </p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{ route('admin.companies') }}"><i class="fa fa-link"></i> <span>شرکت ها</span></a></li>
        <li><a href="{{ route('admin.students') }}"><i class="fa fa-link"></i> <span>محصلین</span></a></li>
        <li><a href="{{ route('admin.jobs') }}"><i class="fa fa-link"></i> <span>وظیفه ها</span></a></li>
        <li><a href="{{ route('faculties.index') }}"><i class="fa fa-link"></i> <span>افزودن به لیست فاکولته ها</span></a></li>
        <li><a href="{{ route('departments.index') }}"><i class="fa fa-link"></i> <span>افزودن به لیست دیپارتمنت ها</span></a></li>
        <li><a href="{{ route('categories.index') }}"><i class="fa fa-link"></i> <span>افزودن به لیست دسته ها</span></a></li>
        <li><a href="{{ route('info.index') }}"><i class="fa fa-link"></i> <span>صفحه تماس باما</span></a></li>
        <li><a href="{{ route('settings.index') }}"><i class="fa fa-link"></i> <span>تنظیمات</span></a></li>
        <li><a href="{{ route('index') }}"><i class="fa fa-link"></i> <span>باز گشت به صفحه اصلی</span></a></li>
        <li><a href="{{ route('logout') }}"><i class="fa fa-link"></i> <span>خروج</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
    
  </aside>