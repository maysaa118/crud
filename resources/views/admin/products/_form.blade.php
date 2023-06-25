@if($errors->any())
<div class="alert alert-danger">
    You have some errors:
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-md-8">
        <x-form.input label="Product Name" id="name" name="name" value="{{$product->name}}" />

        <x-form.input label="URL Slug" id="slug" name="slug" value="{{$product->slug}}" />

        <x-form.texterea id="description" name="Desription" label="Desription" value="{{ $product->desription }}" />
        <x-form.error name="{{$name}}"/>

        <x-form.texterea id="short_description" name="short_description" label="Short_Description" value="{{ $product->short_description }}" />
        <x-form.error name="{{$name}}"/>

        <div class=" mb-3">
            <label for="gallery">Product Gallery</label>
            <div>
                <input type="file" class="form-control" id="gallery" name="gallery[]" multiple placeholder="Product Gallery">
            </div>
            @if ($gallery ?? false)
            <div class="row">
                @foreach($gallery as $image)
                <div class="col-md-3">
                    <img src="{{ $image->url }}" class="img-fluid" alt="">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="col-md-4">

            <div class=" mb-3">
                <label for="status">Status</label>
                <div>
                    @foreach ($status_options as $value => $label)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status_{{ $value }} " value="{{ $value }}" @checked($value==old('status', $product->status))>
                        <label class="form-check-label" for="status_{{ $value }}">
                            {{ $label }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>



            <x-form.select name="category_id" id="category_id" label="Category" :value=" $product->category_id " :options=" $categories->pluck('name' , 'id') " />


            <x-form.input type="number" label="Product Price" id="price" name="price" value="{{$product->price}}" />

            <x-form.input type="number" label="Compare Price" id="compare_price" name="compare_price" value="{{$product->compare_price}}" />

            <div class="mb-3">
                @if($product->image)
                <a href="{{ asset('storage/'.$product->image) }}" with="100" alt="">
                    <img src="{{Storage::disk('public')->url($product->image) }}" width="100" alt="">
                </a>
                @else
                <img src="http://placehold.co/100x100/orange/white?text=No+Image" alt="">
                @endif
                <label for="image">Product Image</label>
                <div>
                    <input type="file" class="form-control" id="image" name="image" placeholder="Product Image">
                    @error('image')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">{{ $submit_label ?? 'Save' }}</button>