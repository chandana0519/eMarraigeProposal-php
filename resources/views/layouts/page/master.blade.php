@extends('layouts.site.master')

@section('custommetatag')
    <meta id="csrf-token" name="csrf_token" value="{!! csrf_token() !!}">    
    <meta id="current-user" name="current-user" value="{!! Auth::user()->username !!}">
    <meta id="current-user" name="user-id" value="{!! Auth::user()->id !!}">
@endsection

@section('pagestyle')
    <link href="/css/ionicons.css" rel="stylesheet">
    <link href="/css/AdminLTE.css" rel="stylesheet">
    <link href="/css/skins/_all-skins.min.css" rel="stylesheet">
    <link href="/plugins/slider.css" rel="stylesheet">
@endsection

@section('content')
    @inject('notification', 'App\Services\Notification')
    <div class="hold-transition skin-red sidebar-mini">
      <div class="wrapper">

          <!-- Header -->
          @include('layouts.page.header')

          <!-- Sidebar -->
          <div id="asideslidebar">
          @include('layouts.page.sidebar')
          </div>
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content-header">
                  <h1>
                      {{ $page_title or "Page Title" }}
                      <small>{{ $page_description or null }}</small>
                  </h1>
                  <!-- You can dynamically generate breadcrumbs here -->
                  <ol class="breadcrumb">
                      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                      <li class="active">Here</li>
                  </ol>
              </section>

              <!-- Main content -->
              <section class="content">
                  <!-- Your Page Content Here -->
                    <div class="row">
                      <div class="col-md-9">                        
                        @include('flash::message')
                        @yield('pagecontent')
                      </div><!-- /.col -->
                      <div class="col-md-3">

                        <!-- right slide bar -->
                  <!-- USERS LIST -->
                  <div class="box box-danger">
                    <div class="box-header with-border">
                      <h3 class="box-title">Latest Members</h3>                      
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-3 col-sm-3">
                          <img class="img-circle" src="/img/user1-128x128.jpg" alt="User Avatar" style="max-width:100%;max-height:100%;">
                          <a class="users-list-name" href="#">Alexander Pierce</a>
                          <span class="users-list-date">Today</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-3 col-sm-3">
                          <img class="img-circle" src="/img/user8-128x128.jpg" alt="User Avatar" style="max-width:100%;max-height:100%;">
                          <a class="users-list-name" href="#">Alexander Pierce</a>
                          <span class="users-list-date">Today</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-3 col-sm-3">
                          <img class="img-circle" src="/img/user7-128x128.jpg" alt="User Avatar" style="max-width:100%;max-height:100%;">
                          <a class="users-list-name" href="#">Alexander Pierce</a>
                          <span class="users-list-date">Today</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-3 col-sm-3">
                          <img class="img-circle" src="/img/user6-128x128.jpg" alt="User Avatar" style="max-width:100%;max-height:100%;">
                          <a class="users-list-name" href="#">Alexander Pierce</a>
                          <span class="users-list-date">Today</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-3 col-sm-3">
                          <img class="img-circle" src="/img/user2-160x160.jpg" alt="User Avatar" style="max-width:100%;max-height:100%;">
                          <a class="users-list-name" href="#">Alexander Pierce</a>
                          <span class="users-list-date">Today</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-3 col-sm-3">
                          <img class="img-circle" src="/img/user5-128x128.jpg" alt="User Avatar" style="max-width:100%;max-height:100%;">
                          <a class="users-list-name" href="#">Alexander Pierce</a>
                          <span class="users-list-date">Today</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-3 col-sm-3">
                          <img class="img-circle" src="/img/user4-128x128.jpg" alt="User Avatar" style="max-width:100%;max-height:100%;">
                          <a class="users-list-name" href="#">Alexander Pierce</a>
                          <span class="users-list-date">Today</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-3 col-sm-3">
                          <img class="img-circle" src="/img/user3-128x128.jpg" alt="User Avatar" style="max-width:100%;max-height:100%;">
                          <a class="users-list-name" href="#">Alexander Pierce</a>
                          <span class="users-list-date">Today</span>
                        </div>
                      </div>
                      
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                      <a href="javascript::" class="uppercase">View All Users</a>
                    </div><!-- /.box-footer -->
                  </div><!--/.box -->



                      </div><!-- /.col -->
                    </div><!-- /.row -->
              </section><!-- /.content -->
          </div><!-- /.content-wrapper -->

          <!-- Footer -->
          @include('layouts.page.footer')

      </div><!-- ./wrapper -->
    </div>
@endsection

@section('pagescripts') 
<script src="/plugins/bootstrap-slider.js"></script>
<script src="/js/jquery.blockUI.js"></script>
<script src="/js/app.js"></script>
<script>
  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').slider();
  });
</script>
@endsection 