<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
    <h2 class="mb-4 s-3"><?= $title ?><?= $title ?></h2>
    <a href="/admin/products/create" class="btn btn-sm btn-primary">+ Create Product</a>
    <table class="table">
        <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Cateory</th>
              <th>Price</th>
              <th>Status</th>
            </tr>
         </thead>
      <tbody>
        <?php foreach ($products as $product) : ?>
          <tr>
            <td><?= $product->id ?></td>
            <td><?= $product->name ?></td>
            <td><?= $product->cateory_name ?></td>
            <td><?= $product->price ?></td>
            <td><?= $product->status ?></td>
          </tr>
          <?php endforeach ?>

  </tbody>
</table>
</div>
    

  
  </body>
</html>