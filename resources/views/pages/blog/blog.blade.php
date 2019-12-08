@extends('layout')
@section('content')
<div class="col-sm-9">
    <div class="blog-post-area">
        <h2 class="title text-center">Bản tin mới nhất</h2>
        @foreach ($all_blog as $blog)
        <div class="single-blog-post">
            <h3>{{$blog->title}}</h3>
            <div class="post-meta">
                <ul>
                    <li><i class="fa fa-user"></i> {{$blog->admin_name}}</li>
                    <li><i class="fa fa-clock-o"></i>{{ date('H:i', strtotime($blog->updated_at)) }}</li>
                    <li><i class="fa fa-calendar"></i>{{ date('d-M-y', strtotime($blog->updated_at)) }}</li>
                </ul>
                <span>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                </span>
            </div>
            <a href="">
            <img src="{{URL::to('/public/uploads/product/'.$blog->featured_image)}}" style="height: 390px; width: 846px" alt="">
            </a>
            <p>{{$blog->alias}}</p>
            <a class="btn btn-primary" href="{{URL::to('/blog/'.$blog->id)}}">Đọc thêm</a>
        </div>
        @endforeach

        <div class="pagination-area">
            <ul class="pagination">
                <li><a href="" class="active">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
        </div>
    </div>
</div>
@endsection