@extends('index')

@section('content')
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">← Back</a>
    <h1>Edit Transaction</h1>
    <p>Update the information below to modify the transaction details.</p>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="label-row">
            <label for="product">Product:</label>
            <p class="required">Required</p>
        </div>
        <select id="product" name="ProductID" required>
            <option value="{{ $transaction->ProductID }}" selected>{{ $transaction->product->Name }}</option>
            @foreach($products as $product)
                @if($product->id != $transaction->ProductID)
                    <option value="{{ $product->id }}">{{ $product->Name }}</option>
                @endif
            @endforeach
        </select>

        <div class="label-row">
            <label for="customer">Customer:</label>
            <p class="required">Required</p>
        </div>
        <select id="customer" name="CustomerID" required>
            <option value="{{ $transaction->CustomerID }}" selected>{{ $transaction->customer->first_name }} {{ $transaction->customer->last_name }}</option>
            @foreach($customers as $customer)
                @if($customer->id != $transaction->CustomerID)
                    <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                @endif
            @endforeach
        </select>

        <div class="label-row">
            <label for="paymentmethod">Payment Method:</label>
            <p class="required">Required</p>
        </div>
        <select id="paymentmethod" name="PaymentMethodID" required>
            <option value="{{ $transaction->PaymentMethodID }}" selected>{{ $transaction->paymentMethod->Method }}</option>
            @foreach($payment_methods as $method)
                @if($method->id != $transaction->PaymentMethodID)
                    <option value="{{ $method->id }}">{{ $method->Method }}</option>
                @endif
            @endforeach
        </select>

        <div class="label-row">
            <label for="paymentterm">Payment Term:</label>
            <p class="required">Required</p>
        </div>
        <select id="paymentterm" name="PaymentTermID" required>
            <option value="{{ $transaction->PaymentTermsID }}" selected>{{ $transaction->paymentTerms->Term }}</option>
            @foreach($payment_terms as $term)
                @if($term->id != $transaction->PaymentTermsID)
                    <option value="{{ $term->id }}">{{ $term->Term }}</option>
                @endif
            @endforeach
        </select>

        <div class="label-row">
            <label for="quantity">Quantity:</label>
            <p class="required">Required</p>
        </div>
        <input type="number" id="quantity" name="Quantity" min="1" value="{{ $transaction->Quantity }}" required>

        <div class="label-row">
            <label for="sellingprice">Selling Price:</label>
            <p class="required">Required</p>
        </div>
        <input type="number" id="sellingprice" name="SellingPrice" step="0.01" min="0" value="{{ $transaction->SellingPrice }}" required>

        <div class="label-row">
            <label for="totalprice">Total Price:</label>
            <p class="required">Required</p>
        </div>
        <input type="number" id="totalprice" name="TotalPrice" step="0.01" min="0" value="{{ $transaction->Total }}" required>

        <input type="submit" value="Update Transaction">
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
