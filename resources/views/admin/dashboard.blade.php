@extends('admin.layouts.template')
@section('title')
Admin Dashboard
@endsection
@section('content')
<div class="container" style="height: 100%">
    <div class="container d-flex flex-row justify-content-evenly align-items-center" style="height:50%">
        <div class="bg-white rounded shadow p-4 text-center" style="height: 60%">
            <div class="fs-1 mb-4 text-decoration-underline fw-bold">Total Users</div>
            <div class="fs-3">{{$users}}</div>
        </div>
        <div class="bg-white rounded shadow p-4 text-center" style="height: 60%">
            <div class="fs-1 mb-4 text-decoration-underline fw-bold">Total Orders</div>
            <div class="fs-3">{{$orders}}</div>
        </div>
    </div>
    <div class="container d-flex flex-row justify-content-evenly align-items-center" style="height:50%">
        <div class="bg-white rounded shadow p-4 text-center" style="height: 60%">
            <div class="fs-1 mb-4 text-decoration-underline fw-bold">Total Category</div>
            <div class="fs-3">{{$categories}}</div>
        </div>
        <div class="bg-white rounded shadow p-4 text-center " style="height: 60%">
            <div class="fs-1 mb-4 text-decoration-underline fw-bold">Total Products</div>
            <div class="fs-3">{{$products}}</div>
        </div>
    </div>
</div>
@endsection