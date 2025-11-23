<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PorkHub Product Created</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <div class="container mt-5">
        <h1 class="text-success">PorkHub Product Created Successfully</h1>
        <p>Name: {{ $product->product_name }}</p>
        <p>Description: {{ $product->product_description }}</p>
        <p>Price: ${{ $product->product_price }}</p>
        <p>Stock: {{ $product->stock }}</p>
        <p>Category: {{ $product->category ?? 'N/A' }}</p>
        @if($product->image_path)
            <p>Image:</p>
            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->product_name }}" class="img-fluid" style="max-width: 200px;">
        @endif
    </div>

    <a href="/porkhub/create" class="btn btn-primary mt-3">Create Another Product</a>
    <a href="/porkhub/list" class="btn btn-secondary mt-3">Go to PorkHub Products List</a>
</body>
</html>
