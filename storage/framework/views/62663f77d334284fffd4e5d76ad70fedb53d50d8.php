<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - 1997Store</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo e(asset('public/backend/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo e(asset('public/backend/css/sb-admin-2.min.css')); ?>" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href=<?php echo e(URL::to( '/dashboard')); ?>>
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><sup>1997</sup>Store</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href=<?php echo e(URL::to( '/dashboard')); ?>>
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Tổng quan</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Quản lý -->
      <div class="sidebar-heading">
        Quản lý
      </div>

      <!-- Quản lý doanh mục sản phẩm -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bill" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-file-invoice"></i>
          <span>Đơn hàng</span>
        </a>
        <div id="bill" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quản lý đơn hàng</h6>
            <a class="collapse-item" href="<?php echo e(URL::to('/manage-order')); ?>">Quản lý đơn hàng</a>
          </div>
        </div>
      </li>

      <!-- Quản lý sản phẩm -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="true"
          aria-controls="collapseUtilities">
          <i class="fab fa-product-hunt"></i>
          <span>Quản lý sản phẩm</span>
        </a>
        <div id="product" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quản lý sản phẩm</h6>
            <a class="collapse-item" href="<?php echo e(URL::to('/add-product')); ?>">Thêm sản phẩm</a>
            <a class="collapse-item" href="<?php echo e(URL::to('/all-product')); ?>">Danh sách sản phẩm</a>
          </div>
        </div>
      </li>

      <!-- Quản lý doanh mục -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category" aria-expanded="true"
          aria-controls="collapseUtilities">
          <i class="fas fa-th-large"></i>
          <span>Quản lý danh mục</span>
        </a>
        <div id="category" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quản lý danh mục</h6>
            <a class="collapse-item" href="<?php echo e(URL::to('/add-category-product')); ?>">Thêm danh mục</a>
            <a class="collapse-item" href="<?php echo e(URL::to('/all-category-product')); ?>">Danh sách danh mục</a>
          </div>
        </div>
      </li>

      <!-- Quản lý thương hiệu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brand" aria-expanded="true"
          aria-controls="collapseUtilities">
          <i class="fas fa-store-alt"></i>
          <span>Quản lý thương hiệu</span>
        </a>
        <div id="brand" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quản lý thương hiệu</h6>
            <a class="collapse-item" href="<?php echo e(URL::to('/add-brand-product')); ?>">Thêm thương hiệu</a>
            <a class="collapse-item" href="<?php echo e(URL::to('/all-brand-product')); ?>">Danh sách thương hiệu</a>
          </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customer" aria-expanded="true"
          aria-controls="collapseUtilities">
          <i class="fas fa-user"></i>
          <span>Quản lý khách hàng</span>
        </a>
        <div id="customer" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quản lý khách hàng</h6>
            <a class="collapse-item" href="<?php echo e(URL::to('/all-customer')); ?>">Danh sách khách hàng</a>
            <a class="collapse-item" href="<?php echo e(URL::to('/all-contact-info')); ?>">Thông tin cần liên hệ</a>
          </div>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#coupon" aria-expanded="true"
          aria-controls="collapseUtilities">
          <i class="fas fa-cart-arrow-down"></i>
          <span>Quản lý khuyến mãi</span>
        </a>
        <div id="coupon" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quản lý khuyến mãi</h6>
            <a class="collapse-item" href="<?php echo e(URL::to('/add-coupon')); ?>">Thêm mã khuyến mãi</a>
            <a class="collapse-item" href="<?php echo e(URL::to('/all-coupon')); ?>">Danh sách mã khuyến mãi</a>
          </div>
        </div>
      </li>

      <!-- Quản lý hình ảnh -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#images" aria-expanded="true"
          aria-controls="collapseUtilities">
          <i class="far fa-images"></i>
          <span>Quản lý hình ảnh</span>
        </a>
        <div id="images" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quản lý hình ảnh</h6>
            <a class="collapse-item" href="<?php echo e(URL::to('/add-image')); ?>">Thêm hình ảnh</a>
            <a class="collapse-item" href="<?php echo e(URL::to('/all-image')); ?>">Danh sách hình ảnh</a>
          </div>
        </div>
      </li>

      <!-- Quản lý tin tức -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#blog" aria-expanded="true"
          aria-controls="collapseUtilities">
          <i class="far fa-images"></i>
          <span>Quản lý tin tức</span>
        </a>
        <div id="blog" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Quản lý tin tức</h6>
            <a class="collapse-item" href="<?php echo e(URL::to('/add-blog')); ?>">Thêm tin tức</a>
            <a class="collapse-item" href="<?php echo e(URL::to('/all-blog')); ?>">Danh sách tin tức</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Thống kê  -->
      <div class="sidebar-heading">
        Thống kê
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href=<?php echo e(URL::to( '/apriori')); ?>>
          <i class="fas fa-calculator"></i>
          <span>Apriori</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                      aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  <?php
                    $name = Session::get('admin_name');
                    if($name){
                        echo $name;
                    }
                ?>
                </span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <section>

            <?php echo $__env->yieldContent('admin_content'); ?>

          </section>
        </div>
        <!-- End of Main Content -->


      </div>
      <!-- End of Content Wrapper -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
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
            <a class="btn btn-primary" href="<?php echo e(URL::to('/logout')); ?>">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo e(asset('public/backend/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/backend/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo e(asset('public/backend/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo e(asset('public/backend/js/sb-admin-2.min.js')); ?>"></script>
    <!-- Page level plugins -->

    <!-- Page level custom scripts -->
    <!-- JS quản lý đơn hàng -->
    <script src="<?php echo e(asset('public/backend/vendor/datatables/jquery.dataTables.js')); ?>"></script>
    <script src="<?php echo e(asset('public/backend/vendor/datatables/dataTables.bootstrap4.js')); ?>"></script>
    <script src="<?php echo e(asset('public/backend/js/demo/datatables-demo.js')); ?>"></script>

</body>

</html><?php /**PATH C:\xampp\htdocs\website-online\resources\views/admin_layout.blade.php ENDPATH**/ ?>