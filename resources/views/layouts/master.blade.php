<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="teewhy">

  <title>..::RUN::Student Portal</title>

  <!-- Custom fonts for this template
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
-->
  <!-- Custom styles for this template
  <link  href="{{ URL::asset('css/runcss1.css') }}" rel="stylesheet"> -->
  <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">
 
<style type="text/css">/* Chart.js 
@keyframes chartjs-render-animation
{from{opacity:.99}to{opacity:1}}
.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;
width:200%;height:200%;left:0;top:0} */

	</style>
 
 
</head>
<body id="page-top" >

  <!-- Page Wrapper -->
  <div class="wrapper" id="app" >

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Admin Dashboard</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3"> -->
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" v-model='search'
        @keyup.enter='searchit' type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    <!-- </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="./images/user.jpg" 
			  alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>

                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/images/user.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/images/user.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./images/logo3.png" width="300" height="200" alt="RUN Admin " class="brand-image img-circle elevation-3"
           style="">
           <span class="brand-text font-weight-light">Run PG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./images/user.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }} </a>
          <p class="d-block">{{Auth::user()->type}}</p>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2 ">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <!-- <li class="nav-item has-treeview menu-open"> -->
            <li class="nav-item {{ 'dashboard' == request()->path() ? 'active' : ''}}">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt blue"></i>
              <p>
                Dashboard
                
              </p>
            </router-link>
          </li>



          @canany(['isAdmin',  'isAuthor'])
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link  to="/adninTools" class="nav-link active">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Admin Tools</p>
                </router-link>
              </li>
              <li class="nav-item">
              <router-link  to="/course" class="nav-link active">
                <i class="nav-icon fas fa-cogs"></i>
                  <p>Course</p>
                  </router-link>
              </li>
              <li class="nav-item">
              <router-link  to="/programme" class="nav-link active">
                <i class="nav-icon fas fa-cogs"></i>
                  <p>Programme</p>
                  </router-link>
              </li>

              <li class="nav-item">
              <router-link  to="/setting" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i>
                  <p>Settings</p>
                  </router-link>
              </li>
            </ul>
          </li>
        
        
        @endcanany

          @canany(['isAdmin',  'isAuthor'])
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link  to="/users" class="nav-link active">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users</p>
                </router-link>
              </li>
              <li class="nav-item">
              <router-link  to="/course" class="nav-link active">
                <i class="nav-icon fas fa-cogs"></i>
                  <p>Course</p>
                  </router-link>
              </li>
              <li class="nav-item">
              <router-link  to="/programme" class="nav-link active">
                <i class="nav-icon fas fa-cogs"></i>
                  <p>Programme</p>
                  </router-link>
              </li>
              <li class="nav-item">
              <router-link  to="/department" class="nav-link active">
                <i class="nav-icon fas fa-cogs"></i>
                  <p>Department</p>
                  </router-link>
              </li>
              <li class="nav-item">
              <router-link  to="/faculty" class="nav-link active">
                <i class="nav-icon fas fa-cogs"></i>
                  <p>Faculty</p>
                  </router-link>
              </li>
              <li class="nav-item">
              <router-link  to="/curriculum" class="nav-link active">
                <i class="nav-icon fas fa-cogs"></i>
                  <p>Curriculum</p>
                  </router-link>
              </li>
              <li class="nav-item">
              <router-link  to="/setting" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i>
                  <p>Settings</p>
                  </router-link>
              </li>
            </ul>
          </li>
        
          <li class="nav-item">
            <router-link to="/developer" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
               Developer
                
              </p>
            </router-link>
          </li>
        @endcanany
        

        <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Profile
                
              </p>
            </router-link>
          </li>
          <li class="nav-item">
          
            <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-power-off red"></i>
                    <p>{{ __('Logout') }} </p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  >
  
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid"> 
        <router-view> </router-view>
        <vue-progress-bar></vue-progress-bar>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Running with a vision ......
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="https://adminlte.io">run.edu.ng</a>.</strong> All rights reserved.
  </footer>
  
</div>


  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript
  <script src="vendor/jquery/jquery.min.js"></script>
	 <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
	
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="{{ URL::asset('js/bootstrap.bundle.min.js') }}"></script>
-->
  <!-- Core plugin JavaScript
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="{{ URL::asset('js/jquery.easing.min.js') }}"></script>
-->
  <!-- Custom scripts for all pages
  <script src="js/sb-admin-2.min.js"></script>
	<script src="{{ URL::asset('js/runjs.js') }}"></script>
-->
  <!-- Page level plugins 
  <script src="vendor/chart.js/Chart.min.js"></script>
	<script src="{{ URL::asset('js/Chart.min.js') }}"></script>
-->
  <!-- Page level custom scripts 
  <script src="js/demo/chart-area-demo.js"></script>
	<script src="{{ URL::asset('js/chart-area-demo.js') }}"></script>
	
  <script src="js/demo/chart-pie-demo.js"></script>
-->



<!-- REQUIRED SCRIPTS -->
@auth
 <script>
    window.user = @json(auth()->user())
 </script>
@endauth

<script src="/js/app.js"></script>

<script>
    function openMenu(){
        document.querySelector(".admin-sidebar").classList.add("open")
    }
    function closeMenu(){
        document.querySelector(".admin-sidebar").classList.remove("open")
    }
</script>
</body>
</html>
