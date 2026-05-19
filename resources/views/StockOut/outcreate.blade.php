@extends('index')

@section('content')

<a href="{{ route('stockout.index') }}" class="btn btn-secondary">
    ← Back
</a>

<div style="display:flex; gap:2vw;">

    <div style="width:50%;">

        <h2>Add Stock Out</h2>

        <form action="{{ route('stockout.store') }}" method="POST">
            @csrf

            <label>Reason</label>

            <select name="reason_id" required>
                <option value="" disabled selected>Select Reason</option>

                @foreach($reasons as $reason)
                    <option value="{{ $reason->id }}">
                        {{ $reason->title }}
                    </option>
                @endforeach
            </select>

            <div id="hiddenInputs"></div>

            <button type="submit">
                Submit Stock Out
            </button>
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
                        <th style="font-weight:bold;">Category</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Add</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($sorted_stocks as $category => $stocks)

                        @foreach($stocks as $stock)
                            <tr>
                                <td style="font-weight:500;">
                                    {{ $stock->product->name }}
                                </td>

                                <td>
                                    {{ $category }}
                                </td>

                                <td>
                                    {{ $stock->stock_quantity }}
                                </td>

                                <td>
                                    {{ $stock->selling_price }}
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
            <th style="width:55%;">Name</th>
            <th style="width:25%;">Qty</th>
            <th style="width:20%;">Action</th>
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

    table {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
        background: white;
    }

    table th,
    table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    form {
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    input,
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background: var(--primary-color);
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 5px 10px;
        background: var(--secondary-color);
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

</style>

<script>

let cart = [];

function addProduct(id, name, price)
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
            price,
            quantity: 1
        });
    }

    renderCart();
}

function removeProduct(id)
{
    cart = cart.filter(
        p => Number(p.id) !== Number(id)
    );

    renderCart();
}

function updateQtyInput(id, value)
{
    let item = cart.find(
        p => Number(p.id) === Number(id)
    );

    if (!item) return;

    item.quantity = Number(value);

    if (item.quantity < 1)
    {
        removeProduct(id);
        return;
    }

    renderCart();
}

function searchProducts()
{
    let query = document
        .getElementById("searchInput")
        .value
        .toLowerCase();

    let rows = document.querySelectorAll(
        "#productsTable tbody tr"
    );

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
    let tbody =
        document.getElementById("selectedBody");

    let hidden =
        document.getElementById("hiddenInputs");

    tbody.innerHTML = "";
    hidden.innerHTML = "";

    cart.forEach((p, index) => {

        tbody.innerHTML += `
            <tr>

                <td>${p.name}</td>

                <td>

                    <input
                        type="number"
                        min="1"
                        value="${p.quantity}"
                        onchange="
                            updateQtyInput(
                                ${p.id},
                                this.value
                            )
                        "
                        style="width:70px;"
                    >

                </td>

                <td>

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
                name="quantities[]"
                value="${p.quantity}"
            >

        `;
    });
}

</script>

@endsection
