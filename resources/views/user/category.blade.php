@extends('user.layouts.template')
@section('title')
    {{ $category->name }}
@endsection()
@section('content')
    <div class="fashion_section">
        <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h1 class="fashion_taital" style="color: white">{{ $category->name }}</h1>
                        <div class="fashion_section_2">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-sm-4">
                                        <div class="box_main">
                                            <h4 class="fs-4 fw-bolder text-center" style="height: 100px">
                                                {{ $product->name }}</h4>
                                            <p class="price_text"> <span style="color: #262626;">$
                                                    {{ $product->price }}</span></p>
                                            <div class="text-center py-4"><img class="my-4"
                                                    src="{{ asset($product->img_url) }}" style="height: 200px"></div>
                                            <div class="btn_main">

                                                <div class="seemore_bt"><a href="{{route('product',$product->id)}}">See More</a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-center bg-alert">{{ $products->links() }}</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
