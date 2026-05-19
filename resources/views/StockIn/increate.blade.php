@extends('index')

@section('content')

<a href="{{ route('stockin.index') }}" class="btn btn-secondary">← Back</a>

<div style="display:flex; gap:2vw;">

    <div style="width:50%;">

        <h2>Add Stock In</h2>

        <form action="{{ route('stockin.store') }}" method="POST">
            @csrf

            <label>Supplier</label>
            <select name="supplier_id" required>
                <option value="">Select Supplier</option>

                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>

            <div id="hiddenInputs"></div>

            <button type="submit">Submit Stock In</button>
        </form>
    </div>

    <div style="width:50%;">

        <h2>Products</h2>

        <input
            type="text"
            id="searchInput"
            onkeyup="searchProducts()"
            placeholder="Search products..."
            style="width:100%; margin-bottom:10px;"
        >

        <div style="overflow-y:auto; max-height:52vh;">

            <table id="productsTable" border="1" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Selling Price</th>
                        <th>Stock</th>
                        <th>Add</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($sorted_stocks as $category => $stocks)

                        @foreach($stocks as $stock)

                            <tr>
                                <td style="font-weight:500;" >
                                    {{ $stock->product->name }}
                                </td>

                                <td>
                                    {{ $category }}
                                </td>

                                <td>
                                    {{ $stock->selling_price }}
                                </td>

                                <td>
                                    {{ $stock->stock_quantity }}
                                </td>

                                <td>
                                    <button
                                        type="button"

                                        onclick="addProduct(
                                            '{{ $stock->product->id }}',
                                            '{{ $stock->product->name }}',
                                            '{{ $stock->selling_price }}'
                                        )"
                                    >
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

<table border="1" width="100%">
    <thead>
        <tr>
            <th style="width: 30%;">Name</th>
            <th style="width: 15%;">Selling Price</th>
            <th style="width: 15%;">Cost Price</th>
            <th style="width: 15%;">Qty</th>
            <th style="width: 25%;">Action</th>
        </tr>
    </thead>

    <tbody id="selectedBody"></tbody>
</table>

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

    input[type="number"],
    input[type="text"],
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
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

    table {
        border-collapse: collapse;
        background: white;
    }

    table th,
    table td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ccc;
    }

    table thead {
        background: #f5f5f5;
    }

    button {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.9;
    }

    .remove-btn {
        background: #e74c3c;
        color: white;
    }

    .remove-btn:hover {
        background: #c0392b;
    }

</style>

<script>

let cart = [];

function addProduct(id, name, selling_price)
{
    let existing = cart.find(p => Number(p.id) === Number(id));

    if (existing)
    {
        existing.quantity++;
    }
    else
    {
        cart.push({
            id,
            name,
            selling_price: 0,
            cost_price: 0,
            quantity: 1
        });
    }

    renderCart();
}

function removeProduct(id)
{
    cart = cart.filter(p => Number(p.id) !== Number(id));

    renderCart();
}

function updateQtyInput(id, value)
{
    let item = cart.find(p => Number(p.id) === Number(id));

    if (!item) return;

    item.quantity = Number(value);

    if (item.quantity < 1)
    {
        removeProduct(id);
        return;
    }

    renderCart();
}

function updateCost(index, value)
{
    cart[index].cost_price = value;
}

function updateSelling(index, value)
{
    cart[index].selling_price = value;
}

function searchProducts()
{
    let query = document
        .getElementById("searchInput")
        .value
        .toLowerCase();

    let rows = document.querySelectorAll("#productsTable tbody tr");

    rows.forEach(row => {

        let firstCell = row.cells[0];

        if (!firstCell) return;

        let name = firstCell.innerText.toLowerCase();

        row.style.display =
            name.includes(query)
            ? ""
            : "none";
    });
}

function renderCart()
{
    let tbody = document.getElementById("selectedBody");

    let hidden = document.getElementById("hiddenInputs");

    tbody.innerHTML = "";

    hidden.innerHTML = "";

    cart.forEach((p, index) => {

        tbody.innerHTML += `
            <tr>

                <td style="width: 30%;">${p.name}</td>

                <td style="width: 15%;">
                    <input
                        type="number"
                        step="0.01"
                        value="${p.selling_price}"
                        onchange="updateSelling(${index}, this.value)"
                        style="width:60px; padding:2px;"
                    >
                </td>

                <td style="width: 15%;">
                    <input
                        type="number"
                        step="0.01"
                        value="${p.cost_price}"
                        onchange="updateCost(${index}, this.value)"
                        style="width:60px; padding:2px;"
                    >
                </td>

                <td style="width:15%;">

                    <input
                        type="number"
                        min="1"
                        value="${p.quantity}"
                        onchange="updateQtyInput(${p.id}, this.value)"
                        style="width:70px;"
                    >

                </td>

                <td style="width: 25%;">
                    <button
                        type="button"
                        onclick="removeProduct(${p.id})"
                    >
                        Remove
                    </button>
                </td>

            </tr>
        `;

        hidden.innerHTML += `
            <input
                type="hidden"
                name="product_ids[]"
                value="${p.id}"
            >

            <input
                type="hidden"
                name="selling_prices[]"
                value="${p.selling_price}"
            >

            <input
                type="hidden"
                name="cost_prices[]"
                value="${p.cost_price}"
            >

            <input
                type="hidden"
                name="quantities[]"
                value="${p.quantity}"
            >
        `;
    });
}

</script>

@endsection
