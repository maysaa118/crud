<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Deleted At</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>
                <a href="{{ $product->image_url }}">
                    <img src="{{ $product->image_url }}" width="60" alt="">
                </a>
            </td>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->deleted_at }}</td>
            <td>
                <form action="{{ route('products.restore', $product->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-trash-restore"></i> Restore</button>
                </form>
            </td>
            <td>
                <form action="{{ route('products.force-delete', $product->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Force Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>