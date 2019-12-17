@extends('layout_update')
@section('content_update')


<?php
$message = Session::get('message');
if($message){
    echo '<span style="color:red; font-size:18px">' .$message. '</span>';
    Session::put('message',null);
}
?>
<div id="contact-page" class="container" style="width:100%">
    <div class="bg">
            <div class="row">  	
                    <div class="col-sm-8">
                        <div class="contact-form">
                            <h2 class="title text-center">Liên hệ với chúng tôi</h2>
                            <div class="status alert alert-success" style="display: none"></div>
                            <form role="form" action="{{URL::to('/save-contact-info')}}" method="POST" id="main-contact-form" class="contact-form row" name="contact-form">
                                {{csrf_field()}}
                               
                                <div class="form-group col-md-6">
                                    <input type="text" name="contact_name" class="form-control" required="required" placeholder="Họ tên">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" name="contact_email" class="form-control" required="required" placeholder="Email">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" name="contact_subject" class="form-control" required="required" placeholder="Tiêu đề">
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea style="height:100px" name="contact_message" id="" required="required" class="form-control" rows="8" placeholder="Nội dung liên hệ"></textarea>
                                </div>                        
                                <div class="form-group col-md-12">
                                    <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="contact-info">
                            <h2 class="title text-center">Thông tin liên hệ</h2>
                            <address>
                                <p>1997 Store.</p>
                                <p>KTX Khu B - ĐHQG TPHCM, Đông Hòa, Dĩ An, Bình Dương</p>
                                {{-- <p>Newyork USA</p> --}}
                                <p>Mobile: (+84) 978542629</p>
                                <p>Email: 1997store@gmail.com</p>
                            </address>
                            <div class="social-networks">
                                <h2 class="title text-center">Mạng xã hội</h2>
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/truongthinh.nguyen97"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-youtube"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>    			
                </div>  
        <div class="row">    		
            <div class="col-sm-12" >    			   			
                <h2 class="title text-center"> Bản đồ</h2>    			    				    				
                <div id="gmap" class="contact-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.067502534812!2d106.77973971446636!3d10.882470492249647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3174d88556fa38e7%3A0x9746dea7851b826a!2zS8OtIHTDumMgeMOhIGtodSBiIMSR4bqhaSBo4buNYyBxdeG7kWMgZ2lhIEhDTQ!5e0!3m2!1svi!2s!4v1574355966020!5m2!1svi!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
            </div>			 		
        </div>    	
        
    </div>	
</div
@endsection