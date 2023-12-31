
  @extends('layouts.admin')
@section('content')
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Category</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

  <div class="container">
    <form action="{{route('categories.store')}}" method="post">
      @csrf
      <h2 class="mb-4 fs-3">New Category</h2>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="categoryName">
        <label for="name">Category Name</label>
      </div>

      <button type="submit" class="btn btn-success">Create New Category</button>
    </form>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>

@endsection