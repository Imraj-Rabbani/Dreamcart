@extends('admin.layouts.template')
@section('title')
    All Product
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> All Product</h4>

        <div class="card">
            <h5 class="card-header">Available Product Information</h5>
            @if (session()->has('message'))
                <div class="alert alert-success ">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @php
                        $num = 1;
                    @endphp
                    <tbody class="table-border-bottom-0 ">
                        @foreach ($products as $product)
                            <tr class="text-center">
                                <td>{{ $num }}</td>
                                <td>{{ $product->name }}</td>
                                {{-- <td><img style="height: 50px" src="{{ asset($product->img_url) }}"
                                        alt="Product Picture"></td> --}}
                                <td><img style="height: 50px" src="{{ $product->img_url }}" alt="Product Picture"></td>
                                <td>{{ $product->price }}</td>
                                <td>

                                    <a href="{{ route('edit.product', $product->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('delete.product') }}" class="btn btn-warning"
                                        onclick="event.preventDefault();
                                            document.getElementById('delete-product').submit();">
                                        Delete</a>

                                    <form action="{{ route('delete.product') }}" id="delete-product" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                    </form>

                                </td>
                            </tr>
                            @php
                                $num = $num + 1;
                            @endphp
                        @endforeach





                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
