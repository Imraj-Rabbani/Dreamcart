@extends('user.layouts.template')
@section('content')
    <h2 class="text-white my-4 fs-1 text-center">Order confirmation</h2>
    <div class="row">
        <div class="col-12">
            <div class="box_main shadow-none">
                <div class="container">
                    <h3>Product will be delivered at</h3>
                    {{-- @dd($shipping_info) --}}
                    <p>Area: {{ $shipping_info->address }}</p>
                    <p>Postal Code: {{ $shipping_info->postal_code }}</p>
                    <p>Phone Number: {{ $shipping_info->phone_number }}</p>

                </div>
                <hr>
                <h3>Your Final Products are</h3>
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
                            <td>
                                <form action="{{ route('place.order') }}" method="POST">
                                    @csrf
                                    <input type="submit" value="Place Order" name="order" class="btn btn-primary">
                                </form>
                            </td>

                        </tr>
                    </table>
                    



                </div>
            </div>
        </div>
    @endsection
