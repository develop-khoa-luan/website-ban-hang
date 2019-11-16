<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('public/backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('public/backend/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <div class="text-cemter">
                    <h4 class="mt-3 mb-4 font-weight-bold text-center">HÌNH ẢNH</h4>

                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <h4 class="font-weight-bold text-primary mr-3">Thêm mới</h4>
                            <a href="{{URL::to("/add-gallery")}}" class="btn btn-primary btn-circle btn-sm" id=""><i
                                    class="fas fa-plus-circle fa-3x"></i></a>
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <input class="col-6 d-flex flex-row-reverse form-control" type="text" id="myInput"
                                onkeyup="myFunction()" placeholder="Tìm kiếm hình ảnh" title="search..." />
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Grid row -->
                        <ul id="myUL" class="list-group">
                            <div class="row">
                                @foreach($photos as $photo)
                                <!-- Grid column -->
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">

                                    <li class="list-group-item" style="width: 300px; height: 300px">
                                        <!--Modal: Name-->
                                        <img class="img-thumbnail" style="width: 200px; height: 200px"
                                            src="public/uploads/product/{{ $photo->filename }}"
                                            alt="{{ $photo->filename }}" data-toggle="modal"
                                            data-target="#my_model{{$photo->id}}">
                                        <p id="fileNameImage">{{ $photo->filename }}</p>
                                        <!-- Grid column -->
                                    </li>
                                </div>
                                @endforeach
                            </div>
                        </ul>
                        <!-- Grid row -->
                    </div>
                </div>
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

        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('public/backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{asset('public/backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('public/backend/js/sb-admin-2.min.js')}}"></script>
        <!-- Page level plugins -->
        <script src="{{asset('public/backend/vendor/chart.js/Chart.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('public/backend/js/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('public/backend/js/demo/chart-pie-demo.js')}}"></script>

        <!-- JS quản lý đơn hàng -->
        <script src="{{asset('public/backend/vendor/datatables/jquery.dataTables.js')}}"></script>
        <script src="{{asset('public/backend/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
        <script src="{{asset('public/backend/js/demo/datatables-demo.js')}}"></script>

        {{-- custom for this page --}}
        <script src="{{asset('public/backend/js/custom-js/gallery.js')}}"></script>
</body>
<script>
    $(document).ready(function() {
    function ProcessParentMessage(message) {
        $("#message-from-container").append('<div>' + message + '</div>');
    }

    // Helper function to get parameters from the query string.
    function getUrlParam(paramName) {
        var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
        var match = window.location.search.match(reParam);

        return (match && match.length > 1) ? match[1] : null;
    }
    // Simulate user action of selecting a file to be returned to CKEditor.
    $("img").on('click', function() {
        var current_url = window.location.href;
        debugger;
        if (current_url.includes("CKEditor")) {
            var funcNum = getUrlParam('CKEditorFuncNum');
            var fileUrl = $(this)[0].src;
            window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
            window.close();
        } else {
            var fileNameImage = $(this).parent().children()[1].textContent;
            if ($.trim(fileNameImage) != '') {
                window.opener.ProcessChildMessage(fileNameImage);
                $("#fileNameImage").text('');
            }
            window.close();
        }
    });
});
</script>

</html>