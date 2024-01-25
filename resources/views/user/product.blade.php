@extends('user.layouts.template')
@section('content')
    <div class="container pt-4">
        <div class="row">
            <div class="col-lg-4 ">
                <div class="box_main">
                    <div class="tshirt_img"><img src="{{$product->img_url}}" alt=""></div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="box_main">
                    <div class="text-start">
                        <h4 class="shirt-text fs-3">{{ $product->name }}</h4>
                        <p class="fs-4 text-black mb-2">Price: ${{ $product->price }}</p>
                    </div>
                    <div class="my-3 product-details">
                        <p class="lead my-4">{{ $product->desc }}!</p>
                        <ul class="p-2 my-4 bg-light rounded">
                            <li>Available Quantity {{ $product->quantity }}</li>
                        </ul>
                    </div>
                    <div class="btn_main">
                        <form action="{{route('addtocart')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id">

                            <div class="form-group">
                                <label for="product_quantity">Quantity</label>
                                <input class="form-control" class="my-4" type="number" name="quantity" id="product_quanity" min="1" max ={{$product->quantity}} value="1">

                            </div>
                            <input type="submit" class="btn btn-warning my-4" value='Add to Cart'>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="fashion_section">
        <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <h1 class="fashion_taital text-start my-4">Frequently bought with</h1>
                        <div class="fashion_section_2">
                            <div class="row">

                                @foreach ($related_products as $product)
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
