@extends('index')

@section('content')

<h1>Debts</h1>

<p>
    List of customers with unpaid debts.
</p>

<div style="overflow-x:auto;">

    <table border="1" width="100%">

        <thead>

            <tr>
                <th style="width:40%;">
                    Customer
                </th>

                <th style="width:30%;">
                    Total Debt
                </th>

                <th style="width:30%;">
                    Actions
                </th>
            </tr>

        </thead>

        <tbody>

            @forelse($debts as $customerId => $transactions)

                @php
                    $customer = $transactions->first()->customer;
                    $totalDebt = $transactions->sum('total');
                @endphp

                <tr>

                    <td>
                        {{ $customer->first_name }}
                        {{ $customer->last_name }}
                    </td>

                    <td>
                        ₱{{ number_format($totalDebt, 2) }}
                    </td>

                    <td>

                        <div style="display:flex; gap:10px;">

                            <a
                                href="{{ route('debts.show', $customerId) }}"
                                class="btn btn-view"
                            >
                                View
                            </a>

                            <form
                                action="{{ route('debts.pay', $customerId) }}"
                                method="POST"
                                onsubmit="return confirm('Mark all debts as paid?')"
                            >
                                @csrf
                                @method('PUT')

                                <button
                                    type="submit"
                                    class="btn btn-pay"
                                >
                                    Pay
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" style="text-align:center; padding:20px;">
                        No unpaid debts found.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

<style>

    :root {
        --primary-color: #03a103;
        --primary-hover: #028002;

        --secondary-color: #555;
        --secondary-hover: #333;

        --danger-color: #e74c3c;
        --danger-hover: #c0392b;
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
        padding: 8px 14px;
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

    .btn-view {
        background-color: #3498db;
    }

    .btn-view:hover {
        background-color: #2980b9;
    }

    .btn-pay {
        background-color: var(--primary-color);
    }

    .btn-pay:hover {
        background-color: var(--primary-hover);
    }

</style>

@endsection
