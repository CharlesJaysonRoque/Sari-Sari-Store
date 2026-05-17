@extends('index')

@section('content')
    <a href="{{ route('stockin.index') }}" class="btn btn-secondary">← Back</a>
    <h1>Edit Stock In</h1>
    <p>Update the information below to modify the stock-in record.</p>

    <form action="{{ route('stockin.update', $stockin->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="label-row">
            <label for="product">Product:</label>
            <p class="required">Required</p>
        </div>
        <select id="product" name="product_id" required>
            <option value="{{ $stockin->product_id }}" selected>{{ $stockin->product->name }}</option>
            @foreach($products as $product)
                @if($product->id != $stockin->product_id)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endif
            @endforeach
        </select>

        <div class="label-row">
            <label for="supplier">Supplier:</label>
            <p class="required">Required</p>
        </div>
        <select id="supplier" name="supplier_id" required>
            <option value="{{ $stockin->supplier_id }}" selected>{{ $stockin->supplier->name }}</option>
            @foreach($suppliers as $supplier)
                @if($supplier->id != $stockin->supplier_id)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endif
            @endforeach
        </select>

        <div class="label-row">
            <label for="costprice">Cost Price:</label>
            <p class="required">Required</p>
        </div>
        <input type="number" id="costprice" name="cost_price" step="0.01" min="0" value="{{ $stockin->cost_price }}" required>

        <div class="label-row">
            <label for="retailprice">Retail Price (Selling Price):</label>
            <p class="required">Required</p>
        </div>
        <input type="number" id="retailprice" name="selling_price" step="0.01" min="0" value="{{ $stockin->selling_price }}" required>

        <div class="label-row">
            <label for="quantity">Quantity:</label>
            <p class="required">Required</p>
        </div>
        <input type="number" id="quantity" name="quantity" min="1" value="{{ $stockin->quantity }}" required>

        <input type="submit" value="Update Stock In">
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
        input[type="number"], select {
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
