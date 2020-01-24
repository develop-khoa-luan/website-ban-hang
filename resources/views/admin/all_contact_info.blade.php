@extends('admin_layout')
@section('admin_content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Danh sách thông tin cần liên hệ</h1>
<?php
                $message = Session::get('message');
                if($message){
                    echo '<span style="color:red">' .$message. '</span>';
                    Session::put('message',null);
                }
            ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>Stt</th>
                        <th>Họ tên</th>
                        <th style="width:100px">Email</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        {{-- <th>Chi tiết</th> --}}
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($all_contact_info as $key => $contact)
                    <tr>
                        <td>{{ $contact -> contact_id }}</td>
                        <td>{{ $contact -> contact_name }}</td>
                        <td>{{ $contact -> contact_email}}</td>
                        <td>{{ $contact -> contact_subject}}</td>
                        <td>{{ $contact -> contact_message}}</td>
                        {{-- <td style="text-align=center">
                            <a  class="show-modal-contact-detail"  data-toggle="modal" data-target="#{{$contact-> contact_id}}"
                            >
                                <i class="fa fa-edit text-success text-active"></i>
                            </a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                    <input  id="modal-contact-id" type="text" readonly hidden/>
              <h5 id="modal-contact-message">ssss</h5>
            
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('public/frontend/js/jquery.js')}}"></script>
<script>
	$(document).ready(function(){
		

		$('.show-modal-contact-detail').click(function(e){
			$("#modal-contact").modal('show');
			
			$.ajax({
					url: "{{ url('/get-contact-info') }}",
					method: 'get',
					data: {
						contact_id: $(this).parents()[1].children[0].value
					},  
					success: function(data) {
						$("#modal-contact-message").text(data.contact[0].contact_message);
						$("#modal-contact-id").val(data.contact[0].contact_id);
					}
				});
		});

		

	});
</script> --}}
@endsection