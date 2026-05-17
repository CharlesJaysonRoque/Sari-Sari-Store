@extends('index')

@section('content')
    <a href="{{ route('products.index') }}" class="btn btn-secondary">← Back</a>
    <h1>Edit Product</h1>
    <p>Update the information below to modify the product details.</p>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="label-row">
            <label for="name">Product Name:</label>
            <p class="required">Required</p>
        </div>
        <input type="text" id="name" name="name" value="{{ $product->name }}" required>

        <div class="label-row">
            <label for="category">Category:</label>
            <p class="required">Required</p>
        </div>
        <select id="category" name="category_id" required>
            <option value="{{ $product->category_id }}" selected>{{ $product->category->title }}</option>
            @foreach($categories as $category)
                @if($category->id != $product->category_id)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endif
            @endforeach
        </select>

        <input type="submit" value="Update Product">
    </form>

    <style>
        :root {
            --primary-color: #03a103;
            --primary-hover: #028002;

            --secondary-color: #555;
            --secondary-hover: #333;
        }
        .btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 5px 10px;
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: var(--secondary-hover);
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: var(--primary-hover);
        }
        .required {
            color: red;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .optional {
            color: gray;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
@endsection
