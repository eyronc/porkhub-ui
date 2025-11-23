<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create PorkHub Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container">
    <h1 class="mt-4">Create PorkHub Product</h1>

    <form method="POST" action="/porkhub" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="product_name" id="productName">
            @error('product_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="productPrice" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" name="product_price" id="productPrice">
            @error('product_price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" name="stock" id="stock">
            @error('stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="product_description" id="description"></textarea>
            @error('product_description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-control" name="category" id="category">
                <option value="">Select Category</option>
                <option value="Food">Food</option>
                <option value="Drinks">Drinks</option>
                <option value="Dessert">Dessert</option>
            </select>
            @error('category')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" class="form-control" name="image_path" id="image">
            @error('image_path')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <a href="/porkhub/list" class="btn btn-link mt-3">Go to PorkHub products list</a>
</body>
</html>
