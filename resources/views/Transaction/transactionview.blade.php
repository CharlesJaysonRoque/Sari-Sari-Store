@extends('index')

@section('content')
    @if($errors->any())
    <script>
        alert("{{ $errors->first() }}");
    </script>
    @endif
    @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
    @endif
    <h1>Transaction</h1>
    <p>See all transaction records.</p>
    <div class="StockLinks">
        <a href="{{ route('transactions.create') }}"><span style="font-size: 30px">+</span> Add Transaction</a>
        {{-- <a href="#"><span style="font-size: 25px">$</span> Sales</a> --}}
    </div>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Customer</th>
                <th>Quantity</th>
                <th>Selling Price</th>
                <th>Payment Method</th>
                <th>Payment Term</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->product->name ?? 'N/A' }}</td>
                    <td>{{ $transaction->customer->first_name ?? 'N/A' }} {{ $transaction->customer->last_name ?? '' }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ number_format($transaction->selling_price, 2) }}</td>
                    <td>{{ $transaction->paymentMethod->method ?? 'N/A' }}</td>
                    <td>{{ $transaction->paymentTerm->term ?? 'N/A' }}</td>
                    <td>{{ number_format($transaction->total, 2) }}</td>
                    <td style="display:flex; gap:8px;">
                        {{-- EDIT --}}
                        <a href="{{ route('transactions.edit', $transaction->id) }}"
                        style="background:#f0ad4e; color:white; padding:5px 10px; border-radius:5px; text-decoration:none;">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    style="background:#d9534f; color:white; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="display:flex; gap:8px; align-items:center;">

        {{-- Previous --}}
        @if ($transactions->onFirstPage())
            <span style="opacity:0.5; font-weight:bold; font-size:40px;">←</span>
        @else
            <a href="{{ $transactions->previousPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">←</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
            @if ($page == $transactions->currentPage())
                <span style="font-weight:bold; padding:4px 8px; background:#ddd;">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $url }}" style="padding:4px 8px;">
                    {{ $page }}
                </a>
            @endif
        @endforeach

        {{-- Next --}}
        @if ($transactions->hasMorePages())
            <a href="{{ $transactions->nextPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">→</a>
        @else
            <span style="opacity:0.5; font-weight:bold; font-size:40px;">→</span>
        @endif

    </div>
<style>
    .StockLinks {
        margin-bottom: 20px;
    }
    .StockLinks a:hover {
        text-decoration: underline;
    }
    .StockLinks a{
        text-decoration: none;
        background-color: #03a103;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
@endsection
