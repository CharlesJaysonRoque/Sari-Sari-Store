@extends('index')

@section('content')
    <h1>Stocks</h1>
    <p>See all stocks available and their details in the inventory.</p>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Retail Price</th>
                <th>Quantity</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
                <tr>
                    <td>{{ $stock->product->name }}</td>
                    <td>{{ $stock->selling_price }}</td>
                    <td>{{ $stock->stock_quantity }}</td>
                    <td>{{ $stock->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="display:flex; gap:8px; align-items:center;">

        {{-- Previous --}}
        @if ($stocks->onFirstPage())
            <span style="opacity:0.5; font-weight:bold; font-size:40px;">←</span>
        @else
            <a href="{{ $stocks->previousPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">←</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($stocks->getUrlRange(1, $stocks->lastPage()) as $page => $url)
            @if ($page == $stocks->currentPage())
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
        @if ($stocks->hasMorePages())
            <a href="{{ $stocks->nextPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">→</a>
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
</style>
@endsection
