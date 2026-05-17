@extends('index')

@section('content')
    <a href="{{ route('stockout.index') }}" class="btn btn-secondary">← Back</a>
    <h1>Add Stock Out</h1>
    <p>Fill in the form below to add a new stock-out record to the system.</p>
    <div>
        <form action="{{ route('stockout.store') }}" method="POST">
            @csrf
            <div class="label-row">
                <label for="product">Product:</label>
                <p class="required">Required</p>
            </div>
            <select id="product" name="product_id" required>
                <option value="" disabled selected>Select a product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>

            <div class="label-row">
                <label for="reason">Reason:</label>
                <p class="required">Required</p>
            </div>
            <select id="reason" name="reason_id" required>
                <option value="" disabled selected>Select a reason</option>
                @foreach($reasons as $reason)
                    <option value="{{ $reason->id }}">{{ $reason->title }}</option>
                @endforeach
            </select>

            <div class="label-row">
                <label for="quantity">Quantity:</label>
                <p class="required">Required</p>
            </div>
            <input type="number" id="quantity" name="quantity" min="1" required>

            <input type="submit" value="Add Stock Out">
        </form>
    </div>

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
