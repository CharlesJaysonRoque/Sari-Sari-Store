@extends('index')

@section('content')

<a href="{{ route('debts.index') }}" class="btn btn-secondary">
    ← Back
</a>

@php
    $customer = $transactions->first()->customer;
    $totalDebt = $transactions->sum('total');
@endphp

<h1>
    Debt Details
</h1>

<p>
    Customer:
    <strong>
        {{ $customer->first_name }}
        {{ $customer->last_name }}
    </strong>
</p>

<p>
    Total Debt:
    <strong>
        ₱{{ number_format($totalDebt, 2) }}
    </strong>
</p>

<div style="overflow-x:auto;">

    <table border="1" width="100%">

        <thead>

            <tr>

                <th style="width:25%;">
                    Product
                </th>

                <th style="width:15%;">
                    Quantity
                </th>

                <th style="width:20%;">
                    Price
                </th>

                <th style="width:20%;">
                    Total
                </th>

                <th style="width:20%;">
                    Date
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($transactions as $transaction)

                <tr>

                    <td>
                        {{ $transaction->product->name }}
                    </td>

                    <td>
                        {{ $transaction->quantity }}
                    </td>

                    <td>
                        ₱{{ number_format($transaction->selling_price, 2) }}
                    </td>

                    <td>
                        ₱{{ number_format($transaction->total, 2) }}
                    </td>

                    <td>
                        {{ $transaction->created_at->format('M d, Y') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" style="text-align:center; padding:20px;">
                        No debt records found.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

<br>

<form
    action="{{ route('debts.pay', $customer->id) }}"
    method="POST"
    onsubmit="return confirm('Mark all debts as paid?')"
>
    @csrf
    @method('PUT')

    <button
        type="submit"
        class="btn btn-pay"
    >
        Pay All Debts
    </button>

</form>

<style>

    :root {
        --primary-color: #03a103;
        --primary-hover: #028002;

        --secondary-color: #555;
        --secondary-hover: #333;
    }

    table {
        border-collapse: collapse;
        background: white;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
    }

    tr:nth-child(even) {
        background: #fafafa;
    }

    .btn {
        display: inline-block;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-secondary {
        background-color: var(--secondary-color);
        margin-bottom: 20px;
    }

    .btn-secondary:hover {
        background-color: var(--secondary-hover);
    }

    .btn-pay {
        background-color: var(--primary-color);
    }

    .btn-pay:hover {
        background-color: var(--primary-hover);
    }

</style>

@endsection
