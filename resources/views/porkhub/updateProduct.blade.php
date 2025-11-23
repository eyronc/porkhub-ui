<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-dark text-light">
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Update Product</h1>
        <form method="POST" action="{{ url('/porkhub/edit/' . $product->id) }}" enctype="multipart/form-data" class="bg-secondary p-4 rounded">
            @csrf
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}">
                @error('product_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="product_price" name="product_price" value="{{ $product->product_price }}">
                @error('product_price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}">
                @error('stock')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-control" name="category" id="category">
                <option value="">Select Category</option>
                <option value="Food" {{ $product->category == 'Food' ? 'selected' : '' }}>Food</option>
                <option value="Drinks" {{ $product->category == 'Drinks' ? 'selected' : '' }}>Drinks</option>
                <option value="Dessert" {{ $product->category == 'Dessert' ? 'selected' : '' }}>Dessert</option>
            </select>
            @error('category')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

            <div class="mb-3">
                <label for="product_description" class="form-label">Description</label>
                <textarea class="form-control" id="product_description" name="product_description">{{ $product->product_description }}</textarea>
                @error('product_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image_path" class="form-label">Product Image</label>
                <input type="file" class="form-control" id="image_path" name="image_path">
                @if($product->image_path)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" width="120" class="rounded">
                    </div>
                @endif
                @error('image_path')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger w-100">Update Product</button>
        </form>

        <div class="text-center mt-3">
            <a href="/porkhub/list" class="text-decoration-none text-warning">← Go to Products List</a>
        </div>
    </div>
</body>
</html>
