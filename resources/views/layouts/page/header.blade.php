<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>e</b>MP</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">Main Menu</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            @if ($notification->getNotificationCount()['mailCount']>0) 
              <span class="label label-success">{{$notification->getNotificationCount()['mailCount']}}</span>
            @endif
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have {{$notification->getNotificationCount()['mailCount']}} messages</li>
            <li>
              <!-- inner menu: contains the messages -->
              <ul class="menu">
                @if ($notification->getNotificationCount()['mailCount']>0) 
                  @foreach ($notification->getLatestMessage() as $message)
                    <li><!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <!-- User Image -->
                          <img src="/p/{{$message->fromUser->profileimage}}" class="img-circle" alt="User Image">
                        </div>
                        <!-- Message title and timestamp -->
                        <h4>
                          {{$message->fromUser->username}}
                          <small><i class="fa fa-clock-o"></i> {{$message->receivedTime()}}</small>
                        </h4>
                        <!-- The message -->
                        <p>{{$message->subject}}</p>
                      </a>
                    </li><!-- end message -->
                  @endforeach
                @endif
              </ul><!-- /.menu -->
            </li>
            <li class="footer"><a href="#">See All Messages</a></li>
          </ul>
        </li><!-- /.messages-menu -->

        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu">
          <!-- Menu toggle button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            @if ($notification->getNotificationCount()['notificationCount']>0) 
              <span class="label label-warning">{{$notification->getNotificationCount()['notificationCount']}}</span>
            @endif
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have {{$notification->getNotificationCount()['notificationCount']}} notifications</li>
            <li>
              <!-- Inner Menu: contains the notifications -->
              <ul class="menu">
                @if ($notification->getNotificationCount()['interestCount']>0) 
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-thumbs-up text-aqua"></i> You have got {{$notification->getNotificationCount()['interestCount']}} interest(s)
                    </a>
                  </li><!-- end notification -->
                @endif
                @if ($notification->getNotificationCount()['visitorCount']>0) 
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> {{$notification->getNotificationCount()['visitorCount']}} new profile visits
                    </a>
                  </li><!-- end notification -->
                @endif
                @if ($notification->getNotificationCount()['flavouritesCount']>0) 
                  <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-heart text-aqua"></i> {{$notification->getNotificationCount()['flavouritesCount']}} have favourited you
                    </a>
                  </li><!-- end notification -->
                @endif
                <li><!-- start notification -->
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li><!-- end notification -->
              </ul>
            </li>
            <li class="footer"><a href="#">Done</a></li>
          </ul>
        </li>
        <!-- Tasks Menu -->
        <li class="dropdown tasks-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-flag-o"></i>
            <span class="label label-danger">9</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 9 tasks</li>
            <li>
              <!-- Inner menu: contains the tasks -->
              <ul class="menu">
                <li><!-- Task item -->
                  <a href="#">
                    <!-- Task title and progress text -->
                    <h3>
                      Design some buttons
                      <small class="pull-right">20%</small>
                    </h3>
                    <!-- The progress bar -->
                    <div class="progress xs">
                      <!-- Change the css width attribute to simulate progress -->
                      <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">20% Complete</span>
                      </div>
                    </div>
                  </a>
                </li><!-- end task item -->
              </ul>
            </li>
            <li class="footer">
              <a href="#">View all tasks</a>
            </li>
          </ul>
        </li>
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="/p/{{ Auth::user()->profileimage }}" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{ Auth::user()->username }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="/p/{{ Auth::user()->profileimage }}" class="img-circle" alt="User Image">
              <p>
                {{ Auth::user()->username }} , {{ Auth::user()->getAge() }}
                <small>Member since Nov. 2012</small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="col-xs-4 text-center">
                <a href="/inbox">Mail</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="/interest">Interest</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="/favourite">Favourited</a>
              </div>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="/myprofile" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>