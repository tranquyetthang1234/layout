
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="HTML5 Template" />
<meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
<meta name="author" content="potenzaglobalsolutions.com" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template</title>

<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.ico" />

<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<!-- css -->
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
 <style rel="stylesheet" type="text/css" href="/admin/csspage/upload.css" ></style>
 <style>
     .form-control{
         border: 1px solid  #e9e9e9!important;
     }
     .edit-blog{
        display: inline-block;
        font-size: 25px;
        cursor: pointer;
     }
     .delete-blog{
         float: right;
        display: inline-block;
        font-size: 25px;
        margin-top: -2px;
        cursor: pointer;
     }
     .is-invalid{
         border :1px solid #d74d4d;
    }
    .swal2-confirm.btn.btn-success{
        margin-left:13px !important;
    }
    .checkbox.checbox-switch label > input:checked + span:before, .checkbox-inline.checbox-switch > input:checked + span:before{
       left: 14px !important;
    }
    .checkbox.checbox-switch label span:before, .checkbox-inline.checbox-switch span:before{
        left: -12px!important;
    }
 </style>
</head>
<body>
<div class="wrapper">

<!--=================================
 preloader -->

{{-- <div id="pre-loader">
    <img src="images/pre-loader/loader-01.svg" alt="">
</div> --}}

<!--=================================
 preloader -->

<!--=================================
 header start-->

<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <!-- logo -->
  <div class="text-left navbar-brand-wrapper">
    <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo-dark.png" alt="" ></a>
    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-icon-dark.png" alt=""></a>
  </div>
  <!-- Top bar left -->
  <ul class="nav navbar-nav mr-auto">
    <li class="nav-item">
      <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
    </li>
    <li class="nav-item">
      <div class="search">
        <a class="search-btn not_click" href="javascript:void(0);"></a>
        <div class="search-box not-click">
          <input type="text" class="not-click form-control" placeholder="Search" value="" name="search">
          <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
        </div>
      </div>
    </li>
  </ul>
  <!-- top bar right -->
  <ul class="nav navbar-nav ml-auto">
    <li class="nav-item fullscreen">
      <a id="btnFullscreen" href="#" class="nav-link" ><i class="ti-fullscreen"></i></a>
    </li>
    <li class="nav-item dropdown ">
      <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="ti-bell"></i>
        <span class="badge badge-danger notification-status"> </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
        <div class="dropdown-header notifications">
          <strong>Notifications</strong>
          <span class="badge badge-pill badge-warning">05</span>
        </div>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">New registered user <small class="float-right text-muted time">Just now</small> </a>
        <a href="#" class="dropdown-item">New invoice received <small class="float-right text-muted time">22 mins</small> </a>
        <a href="#" class="dropdown-item">Server error report<small class="float-right text-muted time">7 hrs</small> </a>
        <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1 days</small> </a>
        <a href="#" class="dropdown-item">Order confirmation<small class="float-right text-muted time">2 days</small> </a>
      </div>
    </li>
    <li class="nav-item dropdown ">
      <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-big">
        <div class="dropdown-header">
          <strong>Quick Links</strong>
        </div>
        <div class="dropdown-divider"></div>
        <div class="nav-grid">
          <a href="#" class="nav-grid-item"><i class="ti-files text-primary"></i><h5>New Task</h5></a>
          <a href="#" class="nav-grid-item"><i class="ti-check-box text-success"></i><h5>Assign Task</h5></a>
        </div>
        <div class="nav-grid">
          <a href="#" class="nav-grid-item"><i class="ti-pencil-alt text-warning"></i><h5>Add Orders</h5></a>
          <a href="#" class="nav-grid-item"><i class="ti-truck text-danger "></i><h5>New Orders</h5></a>
        </div>
      </div>
    </li>
    <li class="nav-item dropdown mr-30">
      <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <img src="images/profile-avatar.jpg" alt="avatar">
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header">
          <div class="media">
            <div class="media-body">
              <h5 class="mt-0 mb-0">Michael Bean</h5>
              <span>michael-bean@mail.com</span>
            </div>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#"><i class="text-secondary ti-reload"></i>Activity</a>
        <a class="dropdown-item" href="#"><i class="text-success ti-email"></i>Messages</a>
        <a class="dropdown-item" href="#"><i class="text-warning ti-user"></i>Profile</a>
        <a class="dropdown-item" href="#"><i class="text-dark ti-layers-alt"></i>Projects <span class="badge badge-info">6</span> </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>Settings</a>
        <a class="dropdown-item" href="#"><i class="text-danger ti-unlock"></i>Logout</a>
      </div>
    </li>
  </ul>
</nav>

<!--=================================
 header End-->

<!--=================================
 Main content -->

<div class="container-fluid">
  <div class="row">
    <!-- Left Sidebar -->
    <div class="side-menu-fixed">
     <div class="scrollbar side-menu-bg">
      <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
            <li> <a href="index.html">Dashboard 01</a> </li>
          </ul>
        </li>
        <!-- menu title -->
         <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Quản lý </li>
        <!-- menu item Elements-->
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
            <div class="pull-left"><i class="ti-palette"></i><span class="right-nav-text">Danh mục</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="elements" class="collapse" data-parent="#sidebarnav">
            <li><a href="{{route('admin.category.index')}}">Danh mục</a></li>
          </ul>
        </li>

         <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#blog">
            <div class="pull-left"><i class="ti-palette"></i><span class="right-nav-text">Blog</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="blog" class="collapse" data-parent="#sidebarnav">
             <li><a href="{{route('admin.blog.index')}}">Danh mục</a></li>
             <li><a href="{{route('admin.category.index')}}">Bài viết</a></li>
          </ul>
        </li>
        <!-- menu item calendar-->
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
            <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">calendar</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
            <li> <a href="calendar.html">Events Calendar </a> </li>
          </ul>
        </li>
        <!-- menu item todo-->
        <li>
          <a href="todo-list.html"><i class="ti-menu-alt"></i><span class="right-nav-text">Todo list</span> </a>
        </li>

         <!-- menu item calendar-->
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#setting-menu">
            <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">Cài đặt </span></div>
            <div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div>
          </a>
          <ul id="setting-menu" class="collapse" data-parent="#sidebarnav">
            <li> <a href="calendar.html">Cấu Hình </a> </li>
             <li> <a href="calendar.html">Phần Quyền</a> </li>
          </ul>
        </li>
        <!-- menu item todo-->


         <!-- menu item chat-->

        <!-- menu item Charts-->

        <!-- menu font icon-->

        <!-- menu title -->

        <!-- menu item Widgets-->

        <!-- menu item Form-->

        <!-- menu item table -->


        <!-- menu item Custom pages-->

        <!-- menu item Authentication-->

        <!-- menu item maps-->
        <li>
          <a href="maps.html"><i class="ti-location-pin"></i><span class="right-nav-text">maps</span> <span class="badge badge-pill badge-success float-right mt-1">06</span></a>
        </li>
        <!-- menu item timeline-->
        <li>
          <a href="timeline.html"><i class="ti-panel"></i><span class="right-nav-text">timeline</span> </a>
        </li>
        <!-- menu item Multi level-->
        <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#multi-level"><div class="pull-left"><i class="ti-layers"></i><span class="right-nav-text">Multi level Menu</span></div><div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
          <ul id="multi-level" class="collapse" data-parent="#sidebarnav">
          <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#auth">Level item 1<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
            <ul id="auth" class="collapse">
              <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#login">Level item 1.1<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                  <ul id="login" class="collapse">
                    <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#invoice">level item 1.1.1<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="invoice" class="collapse">
                      <li> <a href="#">level item 1.1.1.1</a> </li>
                      <li> <a href="#">level item 1.1.1.2</a> </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li> <a href="#">level item 1.2</a> </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#error">level item 2<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
            <ul id="error" class="collapse" >
              <li> <a href="#">level item 2.1</a> </li>
              <li> <a href="#">level item 2.2</a> </li>
            </ul>
          </li>
        </ul>
        </li>
      </ul>
  </div>
</div>
<!-- Left Sidebar End-->

<!--=================================
 Main content -->

 <!--=================================
wrapper -->

 @yield('content')

 <!--=================================
 wrapper -->

<!--=================================
 footer -->

    <footer class="bg-white p-4">
      <div class="row">
        <div class="col-md-6">
          <div class="text-center text-md-left">
              <p class="mb-0"> &copy; Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>. <a href="#"> Webmin </a> All Rights Reserved. </p>
          </div>
        </div>
        <div class="col-md-6">
          <ul class="text-center text-md-right">
            <li class="list-inline-item"><a href="#">Terms & Conditions </a> </li>
            <li class="list-inline-item"><a href="#">API Use Policy </a> </li>
            <li class="list-inline-item"><a href="#">Privacy Policy </a> </li>
          </ul>
        </div>
      </div>
    </footer>
    </div>
  </div>
 </div>
</div>

<!--=================================
 footer -->
@include('admin.template-parts.partials.script')
 @yield('script')
</body>
</html>
