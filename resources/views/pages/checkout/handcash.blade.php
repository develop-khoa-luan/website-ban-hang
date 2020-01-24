@extends('layout_update')
@section('content_update')
<section id="cart_items">
    <div class="container">
    </div>
    <div class="review-payment">
        <?php
                    $customer_id = Session::get('customer_id');
                    if($customer_id ){
                        // echo $customer_id;
                    }
                    $name1 = Session::get('name1');
                    if($name1 ){
                        echo '<h2> Xin chào ' .$name1. '.</h2>';    
                    }
                 
        ?>
        <h3>Cảm ơn bạn đã mua hàng! Chúng tôi sẽ liên lạc với bạn sớm nhất.</h3>
        <h3>Hot line: (+84) 97 854 2629 - (+84) 90 376 8379</h3>
    </div>
    
    <input type="text" class="customer_id" value="{{$customer_id}}" readonly hidden/>
  
    <div style="display:flex; margin: 20px 0 0 0">
        <a href="{{URL::to('/trang-chu ')}}"><button  style="display:block" class="btn btn-warning">
            Tiếp tục mua sắm
        </button></a>
        <button  style="margin: 0 0 0 20px" class="btn btn-success show-modal-order">
            Xem thông tin đơn hàng    
        </button>
    </div>

    <!-- Central Modal Medium Info -->
	<div class="modal fade" id="modal-order-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-notify modal-info" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            {{-- <input class="modal-product-id" id="modal-product-id" type="text" > --}}
            <div style="font-size:20px; margin: 5px 0 5px" class="card-header  text-primary border-botton border-primary text-center">
                <b>THÔNG TIN ĐƠN HÀNG</b>
            </div>
            <!--Body-->
            <div class="col-12 col-sm-6 col-md-6">
                <div style="font-size:16px; margin: 5px 0 5px" class="card-header text-primary border-botton border-primary text-center">
                    THÔNG TIN KHÁCH HÀNG
                </div>

                <div class="col-12 col-sm-4 col-md-6 text-danger" style="margin: 0 0 0 -20px">
                Tên khách hàng:
                </div>
                <div class="col-12 col-sm-8 col-md-6 text-dark"  id="modal-cus-name">
                </div>

                <div class="col-12 col-sm-4 col-md-6 text-danger" style="margin: 0 0 0 -20px">
                Email:
                </div>
                <div class="col-12 col-sm-8 col-md-6 text-dark"  id="modal-cus-email">
                </div>

                <div class="col-12 col-sm-4 col-md-6 text-danger" style="margin: 0 0 0 -20px">
                Số điện thoại:
                </div>
                <div class="col-12 col-sm-8 col-md-6 text-dark"  id="modal-cus-phone"> 
                </div>
                
                <div class="col-12 col-sm-4 col-md-6 text-danger" style="margin: 0 0 0 -20px">
                Ngày đặt đơn:
                </div>
                <div class="col-12 col-sm-8 col-md-6 text-dark"  id="modal-order-created"> 
                </div>

                <div class="col-12 col-sm-4 col-md-6 text-danger" style="margin: 0 0 0 -20px">
                Tình trạng đơn:
                </div>
                <div class="col-12 col-sm-8 col-md-6 text-dark"  id="modal-order-status"> 
                </div>

            </div>
            <div class="col-12 col-sm-6 col-md-6">
                <div style="font-size:16px; margin: 5px 0 5px" class="card-header text-primary border-botton border-primary text-center">
                    THÔNG TIN GIAO HÀNG
                </div>

                <div class="col-12 col-sm-4 col-md-6 text-danger" style="margin: 0 0 0 -20px">
                Tên người nhận:
                </div>
                <div class="col-12 col-sm-8 col-md-6 text-dark"  id="modal-ship-name">
                </div>

                <div class="col-12 col-sm-4 col-md-6 text-danger" style="margin: 0 0 0 -20px">
                Số điện thoại:
                </div>
                <div class="col-12 col-sm-8 col-md-6 text-dark"  id="modal-ship-phone">
                </div>

                <div class="col-12 col-sm-4 col-md-6 text-danger" style="margin: 0 0 0 -20px">
                Địa chỉ giao:
                </div>
                <div class="col-12 col-sm-8 col-md-6 text-dark"  id="modal-ship-address">
                </div>

                <div class="col-12 col-sm-4 col-md-6 text-danger" style="margin: 0 0 0 -20px">
                Ghi chú:
                </div>
                <div class="col-12 col-sm-8 col-md-6 text-dark"  id="modal-ship-notes">
                </div>

                <div class="col-12 col-sm-4 col-md-6 text-danger" style="margin: 0 0 0 -20px">
                Tổng tiền:
                </div>
                <div class="col-12 col-sm-8 col-md-3 text-dark"  id="modal-order-total">
                    
                </div>
                <p class="col-12 col-sm-8 col-md-2 text-dark">VND</p>

            </div>

            <!--Footer-->
            <div class="modal-footer" style="margin-top: 0; border-bottom-right-radius: 1px">
                <a type="button" class="btn btn-danger" data-dismiss="modal" style="margin-top: 15px">Đóng</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
<script>
    var data1;
$('.show-modal-order').click(function(e){
			$("#modal-order-detail").modal('show');
			
			$.ajax({
					url: "{{ url('/get-order-detail') }}",
					method: 'get',
					data: {
						customer_id : $('.customer_id').val()
					},  
					success: function(data) {
                        console.log(data.get_order_detail);
                        data1 = data.get_order_detail;
						 $("#modal-cus-name").text(data1.customer_name);
                         $("#modal-cus-email").text(data1.customer_email);
                         $("#modal-cus-phone").text(data1.customer_phone);
                         $("#modal-order-created").text(data1.created_at);
                         $("#modal-order-status").text(data1.order_status);
                         $("#modal-ship-name").text(data1.shipping_name);
                         $("#modal-ship-phone").text(data1.shipping_phone);
                         $("#modal-ship-address").text(data1.shipping_address);
                         $("#modal-ship-notes").text(data1.shipping_notes);
                         $("#modal-order-total").text(data1.order_total);
						// $("#modal-product-image").attr('src', 'public/uploads/product/'+data.product[0].product_image);
						//  $("#modal-product-brand").text(data1.order_total);
                        //  $("#modal-product-brand").number(2000.616,3,',','.');
						// $("#modal-product-category").text(data.product[0].category_name);
						// $("#modal-product-id").val(data.product[0].product_id);
					}
				});
		});
</script>
<!-- Central Modal Medium Info -->
    @endsection