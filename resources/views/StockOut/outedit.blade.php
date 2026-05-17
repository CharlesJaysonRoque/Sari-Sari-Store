@extends('index')

@section('content')
    <a href="{{ route('stockout.index') }}" class="btn btn-secondary">← Back</a>
    <h1>Edit Stock Out</h1>
    <p>Update the information below to modify the stock-out record.</p>

    <form action="{{ route('stockout.update', $stockout->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="label-row">
            <label for="product">Product:</label>
            <p class="required">Required</p>
        </div>
        <select id="product" name="product_id" required>
            <option value="{{ $stockout->product_id }}" selected>{{ $stockout->product->name }}</option>
            @foreach($products as $product)
                @if($product->id != $stockout->product_id)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endif
            @endforeach
        </select>

        <div class="label-row">
            <label for="reason">Reason:</label>
            <p class="required">Required</p>
        </div>
        <select id="reason" name="reason_id" required>
            <option value="{{ $stockout->reason_id }}" selected>{{ $stockout->reason->title }}</option>
            @foreach($reasons as $reason)
                @if($reason->id != $stockout->reason_id)
                    <option value="{{ $reason->id }}">{{ $reason->title }}</option>
                @endif
            @endforeach
        </select>

        <div class="label-row">
            <label for="quantity">Quantity:</label>
            <p class="required">Required</p>
        </div>
        <input type="number" id="quantity" name="quantity" min="1" value="{{ $stockout->quantity }}" required>

        <input type="submit" value="Update Stock Out">
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
