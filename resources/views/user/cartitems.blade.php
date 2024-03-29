@extends('user.layouts.template')
@section('title')
    Cart Items
@endsection
@section('content')
    <h2 class="text-white my-4 fs-1 text-center">My Cart</h2>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="box_main rounded shadow-none">
                <div class="table-responsive">
                    <table class="table table-striped border rounded text-center">
                        <tr>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($cart_items as $item)
                            <tr>
                                @php
                                    $total_price = $item->quantity * $item->price;
                                @endphp
                                <td>{{ $item->name }}</td>
                                <td><img src="{{ $item->img_url }}" alt="" style="height: 50px"></td>

                                <td>{{ $item->quantity }}</td>
                                <td>{{ $total_price }}</td>

                                <td><a href="" class="btn btn-warning"
                                        onclick="event.preventDefault();
                                document.getElementById('remove-product').submit();">Remove</a>

                                    <form action="{{ route('delete.product') }}" id="remove-product" method="POST"
                                        style="display: none">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                    </form>
                                </td>
                            </tr>
                            @php
                                $total = $total + $total_price;
                            @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td>{{ $total }}</td>
                            @if ($total > 0)
                                <td><a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a></td>
                            @else
                                <td><a href="" class="btn btn-primary disabled">Checkout</a></td>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
