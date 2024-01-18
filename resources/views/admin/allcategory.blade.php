@extends('admin.layouts.template')
@section('title')
    All Category
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> All Category</h4>

        <div class="card">
            <h5 class="card-header">Available Category Information</h5>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Num</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @php
                            $num = 1;
                        @endphp

                        @foreach ($categories as $category)
                            <tr class="text-center">
                                <td>{{ $num }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('edit.category', $category->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('delete.category', $category->id) }}" class="btn btn-warning"
                                        onclick="event.preventDefault();
                                            document.getElementById('delete-category').submit();">
                                        Delete</a>
                                        
                                    <form action="{{ route('delete.category')}}" id="delete-category" method="POST"
                                    style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $category->id }}">
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
