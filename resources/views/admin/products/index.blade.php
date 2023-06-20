@extends('layouts.admin')

@section('content')
<h2 class="mb-4 s-3">{{$title}}</h2>
<a href="{{ route('products.create') }}" class="btn btn-sm btn-primary">+ Create Product</a>
@if(session()->has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Cateory</th>
            <th>Price</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>

                <a href="{{ $product->image_url) }}">
                    <img src="{{Storage::disk('public')->url($product->image) }}" width="60" alt="">
                </a>

                <img src="http://placehold.co/60x60/orange/white?text=No+Image" alt="">

            </td>
            <td>{{ $product->id }} </td>
            <td>{{ $product->name }} </td>
            <td>{{ $product->cateory_name }}</td>
            <td>{{ $product->price_formatted }}</td>
            <td>{{ $product->status }}</td>
            <td><a href="{{route('products.edit' ,$product->id)}}" class="btn btn-sm btn-outline-dark">
                    <i class="far fa-edit"></i>Edit</a></td>
            <td>
                <form action="{{route('products.destroy',$product->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>Delete</button>
                </form>
            </td>
        </tr>

        @endforeach

    </tbody>
</table>
@endsection