@extends('layouts.admin')

@section('content')
<h2 class="mb-4 fs-3">New Product</h2>

<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    @include('admin.products._form',[
        'submit_tabel' => 'Create',
        ])
</form>
@endsection