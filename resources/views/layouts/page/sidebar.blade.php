<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="/p/{{Auth::user()->profileimage}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Auth::user()->username}}</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">HEADER</li>
      <li{{ $page=='online' ? ' class=active' : '' }}><a href="/online"><i class="fa fa-users"></i> <span>Online</span></a></li>
      @if ($page!='inbox' && $page!='sent' && $page!='trash')
        <li>
          <a href="/inbox">
            <i class="fa fa-envelope"></i> 
            <span>Mail
              @if ($notification->getNotificationCount()['mailCount']>0)
                <span class="badge alert-danger badge-notify">{{$notification->getNotificationCount()['mailCount']}}</span>
              @endif
            </span>
          </a>
        </li>
      @else
        <li class="treeview active">
          <a href="/inbox">
            <i class="fa fa-envelope"></i> 
            <span>Mail
              @if ($notification->getNotificationCount()['mailCount']>0)
                <span class="badge alert-danger badge-notify">{{$notification->getNotificationCount()['mailCount']}}</span>
              @endif
            </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li{{ $page=='inbox' ? ' class=active' : '' }}><a href="/inbox">Inbox</a></li>
            <li{{ $page=='sent' ? ' class=active' : '' }}><a href="/message/sent">Sent</a></li>
            <li{{ $page=='trash' ? ' class=active' : '' }}><a href="/message/trash">Trash</a></li>
          </ul>
        </li>
      @endif
      @if ($page!='interest' && $page!='sentinterest')
        <li>
          <a href="/interest">
            <i class="fa fa-thumbs-up"></i> 
            <span>Liked You
              @if ($notification->getNotificationCount()['interestCount']>0)
                <span class="badge alert-danger badge-notify">{{$notification->getNotificationCount()['interestCount']}}</span>
              @endif
            </span>
          </a>
        </li>
      @else
        <li class="treeview active">
          <a href="/interest">
            <i class="fa fa-thumbs-up"></i> 
            <span>Liked You
              @if ($notification->getNotificationCount()['interestCount']>0)
                <span class="badge alert-danger badge-notify">{{$notification->getNotificationCount()['interestCount']}}</span>
              @endif
            </span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li{{ $page=='interest' ? ' class=active' : '' }}><a href="/interest">Received Interests</a></li>
            <li{{ $page=='sentinterest' ? ' class=active' : '' }}><a href="/interest">Sent Interests</a></li>          
          </ul>
        </li>
      @endif
      @if ($page!='flavourites' && $page!='sentflavourites')
        <li>
          <a href="/favourite">
            <i class="fa fa-heart"></i> 
            <span>Favourited you
              @if ($notification->getNotificationCount()['flavouritesCount']>0)
                <span class="badge alert-danger badge-notify">{{$notification->getNotificationCount()['flavouritesCount']}}</span>
              @endif
            </span>
          </a>
        </li>
      @else
        <li class="treeview active">
          <a href="/favourite">
            <i class="fa fa-heart"></i> 
            <span>Favourited you</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/favourite">Received Favourites</a></li>
            <li><a href="/favourite">Sent Favourites</a></li>          
          </ul>
        </li>
      @endif
      @if ($page!='visitors' && $page!='recentvisitors')
        <li>
          <a href="/visiror">
            <i class="fa fa-street-view"></i> 
            <span>Visitors
              @if ($notification->getNotificationCount()['visitorCount']>0)
                <span class="badge alert-danger badge-notify">{{$notification->getNotificationCount()['visitorCount']}}</span>
              @endif
            </span>
          </a>
        </li>
      @else
        <li class="treeview active">
          <a href="/visiror">
            <i class="fa fa-street-view"></i> 
            <span>Visitors</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li{{ $page=='visitors' ? ' class=active' : '' }}><a href="/visiror">Recent</a></li>
            <li{{ $page=='recentvisitors' ? ' class=active' : '' }}><a href="/visiror">All</a></li>          
          </ul>
        </li>
      @endif      
      <li><a href="#"><i class="fa fa-link"></i> <span>My Maches</span></a></li>      
      <li{{ $page=='myprofile' ? ' class=active' : '' }}><a href="/myprofile"><i class="fa fa-user"></i> <span>My Profile</span></a></li>
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>