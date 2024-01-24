@extends('admin.layouts.template')
@section('title')
Delivered Orders
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> Delivered Orders</h4>

        <div class="card">
            @if (session()->has('message'))
                <div class="alert alert-success ">
                    {{ session()->get('message') }}
                </div>
            @endif
            @foreach ($users as $user)
                <div class="container">
                    <div class="fs-3 fw-bold mx-4 mt-4">User Information</div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Phone</td>
                                    <td>Area</td>
                                    <td>Postal Code</td>
                                </tr>
                            </thead>
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->postal_code }}</td>
                            </tr>
                        </table>

                        <div class="fs-3 fw-bold mx-4 mt-4">Order details</div>
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
                                @foreach ($products as $product)
                                    @if ($product->user_id === $user->id)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td><img src="{{ $product->img_url }}" alt="" style="height: 50px"></td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->price }}</td>
                                        </tr>
                                    @endif
                                @endforeach

                            </table>
                            <div class="text-end my-4 mx-4">
                                <a href="" class="btn btn-primary"
                                    onclick="event.preventDefault();
                                    document.getElementById('order-delivered').submit();">Delete
                                    Order From Database</a>

                                <form action="{{ route('delete.order') }}" id="order-delivered" method="POST"
                                    style="display: none">
                                    @csrf
                                    <input type="text" name="id" value={{ $user->id }}>
                                </form>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
    </div>
@endsection
