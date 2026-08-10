<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>General Dashboard &mdash; ABED</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">

<!-- DATA TABLES -->
    <link rel="stylesheet" href="assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, Abed</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">ABED Learning</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">AE</a>
          </div>
          <ul class="sidebar-menu">
            </li><li><a class="nav-link" href="index.html"><i class="fas fa-pencil-ruler"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Master Data</li>
            <li class="dropdown active">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Master Data</span></a>
              <ul class="dropdown-menu">
                <li class=active><a class="nav-link" href="data-tables.html">Category</a></li>
              </ul>
            </li>
            <li class="menu-header">Transaction</li>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-sync"></i><span>Transaction</span></a>
                <ul class="dropdown-menu">
                  <li class=active><a class="nav-link" href="index.html">Materi</a></li>
                  <li class=active><a class="nav-link" href="index.html">Tugas</a></li>
                </ul>
              </li>
            <li class="menu-header">Utilities</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Utilities</span></a>
              <ul class="dropdown-menu">
                <li><a href="#">User Management</a></li>
              </ul>
            
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-outline-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-book"></i> Abed Learning
            </a>
          </div>        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Categories</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Modules</a></div>
              <div class="breadcrumb-item">DataTables</div>
            </div>
          </div>

          <div class="section-body">
        <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-plus"></i> Add
        </button>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Categories</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th class="">
                              No
                            </th>
                            <th>Name Category</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>                                 
                          <tr>
                            <td>
                              1
                            </td>
                            <td>Website</td>
                            <td>
                                <a href="#" class="btn btn-outline-secondary"><i class="fas fa-info-circle"></i></a>
                                <a href="#" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              2
                            </td>
                            <td>AI Tools</td>
                            <td>
                                <a href="#" class="btn btn-outline-secondary"><i class="fas fa-info-circle"></i></a>
                                <a href="#" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              3
                            </td>
                            <td>Design</td>
                            <td>
                                <a href="#" class="btn btn-outline-secondary"><i class="fas fa-info-circle"></i></a>
                                <a href="#" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        
          </div>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2025 <div class="bullet"></div> Design By <a href="#">Lil Tepu Dev</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>
<!-- MODAL -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col">
                <label for="">Name category</label>
                <input type="text" class="form-control">
            </div>
            <div class="col">
                <label for="">About category</label>
                <input type="text" class="form-control">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
  <script src="assets/modules/chart.min.js"></script>
  <script src="assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="assets/modules/summernote/summernote-bs4.js"></script>
  <script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- DATA TABLES -->
  <script src="assets/modules/datatables/datatables.min.js"></script>
  <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index-0.js"></script>
  
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
<script>
$(document).ready(function () {
  $('#table-1').DataTable();
});
</script>
</body>
</html>