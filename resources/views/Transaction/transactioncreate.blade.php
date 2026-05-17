@extends('index')

@section('content')

<a href="{{ route('transactions.index') }}" class="btn btn-secondary">← Back</a>

<div style="display:flex; gap:2vw;">

    <!-- LEFT: FORM -->
    <div style="width:50%;">

        <h2>Add Transaction</h2>

        <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
            @csrf

            <label>Customer</label>
            <select name="customer_id" required>
                <option value="">Select Customer</option>
                @foreach($customers as $c)
                    <option value="{{ $c->id }}">{{ $c->first_name }} {{ $c->last_name }}</option>
                @endforeach
            </select>

            <label>Payment Method</label>
            <select name="payment_method_id" required>
                <option value="">Select Payment Method</option>
                @foreach($payment_methods as $m)
                    <option value="{{ $m->id }}">{{ $m->method }}</option>
                @endforeach
            </select>

            <label>Payment Term</label>
            <select name="payment_term_id" required>
                <option value="">Select Payment Term</option>
                @foreach($payment_terms as $t)
                    <option value="{{ $t->id }}">{{ $t->term }}</option>
                @endforeach
            </select>

            <!-- CART DATA GOES HERE -->
            <div id="hiddenInputs"></div>

            <hr>

            <h3>Total: ₱<span id="grandTotal">0.00</span></h3>

            <button type="submit" >Submit Transaction</button>
        </form>
    </div>

    <!-- RIGHT: PRODUCTS -->
    <div style="width:50%;">
        <h2>Products</h2>
        <div style="overflow-y: auto; max-height: 52vh;">
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Add</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sorted_stocks as $category => $stocks)

                        <tr>
                            <td colspan="4" style="font-weight:bold; background:#eee;">
                                {{ $category }}
                            </td>
                        </tr>

                        @foreach($stocks as $stock)
                            <tr>
                                <td>{{ $stock->product->name }}</td>
                                <td>{{ $stock->selling_price }}</td>
                                <td>{{ $stock->stock_quantity }}</td>
                                <td>
                                    <button type="button"
                                        onclick="addProduct(
                                            '{{ $stock->product->id }}',
                                            '{{ $stock->product->name }}',
                                            '{{ $stock->selling_price }}'
                                        )">
                                        +
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<hr>

<h2>Selected Products</h2>
<div style="overflow-y: auto; max-height: 60vh;">
    <table border="1" width="100%" style="overflow-y: auto; max-height: 60vh;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="selectedBody"></tbody>
    </table>
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
        button[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: var(--primary-hover);
        }
        .required {
            color: red;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .remove-btn {
            background-color: #e74c3c;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .remove-btn:hover {
            background-color: #c0392b;
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

    <script>
        let cart = [];

        function addProduct(id, name, price) {

            let existing = cart.find(p => p.id === id);

            if (existing) {
                existing.quantity++;
            } else {
                cart.push({
                    id,
                    name,
                    price,
                    quantity: 1
                });
            }

            renderCart();
        }

        function removeProduct(id) {
            cart = cart.filter(p => Number(p.id) !== Number(id));
            renderCart();
        }

        function updateQty(id, change) {
            let item = cart.find(p => Number(p.id) === Number(id));
            if (!item) return;

            item.quantity += Number(change);

            if (item.quantity < 1) {
                removeProduct(id);
                return;
            }

            renderCart();
        }

        function renderCart() {
            let tbody = document.getElementById("selectedBody");
            let hidden = document.getElementById("hiddenInputs");

            tbody.innerHTML = "";
            hidden.innerHTML = "";

            let total = 0;

            cart.forEach((p, index) => {

                let subtotal = p.price * p.quantity;
                total += subtotal;

                tbody.innerHTML += `
                    <tr>
                        <td>${p.name}</td>
                        <td>${p.price}</td>
                        <td>
                            <button type="button" onclick="updateQty(${p.id}, -1)">-</button>
                            ${p.quantity}
                            <button type="button" onclick="updateQty(${p.id}, 1)">+</button>
                        </td>
                        <td>${subtotal.toFixed(2)}</td>
                        <td>
                            <button type="button" onclick="removeProduct(${p.id})">Remove</button>
                        </td>
                    </tr>
                `;

                hidden.innerHTML += `
                    <input type="hidden" name="product_ids[]" value="${p.id}">
                    <input type="hidden" name="quantities[]" value="${p.quantity}">
                `;
            });

            document.getElementById("grandTotal").innerText = total.toFixed(2);
        }

        window.addProduct = addProduct;
        window.removeProduct = removeProduct;
        window.updateQty = updateQty;
        </script>
@endsection
