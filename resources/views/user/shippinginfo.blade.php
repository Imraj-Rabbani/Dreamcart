@extends('user.layouts.template')
@section('content')
<div class="container fs-1 text-white text-center my-4">Add Your Delivery Address</div>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8 ">
        <div class="box_main shadow-none rounded">
            <form action="{{route('address')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" name="phone" id="phone">
                </div>

                <div class="form-group">
                    <label for="city">Area</label>
                    <input type="text" class="form-control" name="area" id="area">
                </div>

                <div class="form-group">
                    <label for="postal">Postal Code</label>
                    <input type="text" class="form-control" name="postal" id="postal">
                </div>

                <input type="submit" value="Submit" class="btn btn-primary mt-4">
            </form>
        </div>
    </div>
</div>

@endsection