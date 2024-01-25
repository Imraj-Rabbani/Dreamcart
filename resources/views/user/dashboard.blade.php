@extends('user.layouts.template')
@section('title')
    User Dashboard
@endsection
@section('content')
    <div class="container bg-white text-black ">

        @if ($address)
            <div class="fs-2 m-2 mt-4">Your Information</div>
            <div class="mx-4">Area: {{ $address->address }}</div>
            <div class="mx-4">Postal Code: {{ $address->postal_code }}</div>
            <div class="mx-4">Phone Number: {{ $address->phone_number }}</div>
            <hr>

            @if ($pending_orders->isNotEmpty())
                <div class="fs-2 m-2 my-4">Your Pending orders</div>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <td>Product Name</td>
                                <td>Image</td>
                                <td>Quantity</td>
                                <td>Price</td>
                            </tr>
                        </thead>
                        @foreach ($pending_orders as $order)
                            <tr>
                                <td>{{ $order->name }}</td>
                                <td><img src="{{ $order->img_url }}" alt="" style="height: 50px"></td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                            </tr>
                        @endforeach
                    </table>
            @endif
            @else
            <div class="fs-2 m-2 mt-4">Add Your Address</div>
            <a href="{{route('address')}}" class="btn btn-primary">Go to Address Form</a>

        @endif


        @if ($delivered_products->isNotEmpty())
            <div class="fs-2 m-2 my-4">Delivered Products</div>
            <div class="table-responsive mb-4">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <td>Product Name</td>
                            <td>Image</td>
                            <td>Quantity</td>
                            <td>Price</td>
                        </tr>
                    </thead>
                    @foreach ($delivered_products as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td><img src="{{ $order->img_url }}" alt="" style="height: 50px"></td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->price }}</td>
                        </tr>
                    @endforeach
                </table>
        @endif
    </div>
@endsection
