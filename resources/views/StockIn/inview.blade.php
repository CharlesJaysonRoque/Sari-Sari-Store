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
    <h1>Stock In</h1>
    <p>See all stock-in records.</p>
    <div class="StockLinks">
        <a href="{{ route('stockin.create') }}"><span style="font-size: 30px">+</span> Add Stock In</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Supplier</th>
                <th>Cost Price</th>
                <th>Selling Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stockins as $stock)
                <tr>
                    <td>{{ $stock->product->name ?? 'N/A' }}</td>
                    <td>{{ $stock->supplier->name ?? 'N/A' }}</td>
                    <td>{{ number_format($stock->cost_price, 2) }}</td>
                    <td>{{ number_format($stock->selling_price, 2) }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td style="display:flex; gap:8px;">
                        {{-- EDIT --}}
                        <a href="{{ route('stockin.edit', $stock->id) }}"
                        style="background:#f0ad4e; color:white; padding:5px 10px; border-radius:5px; text-decoration:none;">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('stockin.destroy', $stock->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this stock-in record?');">
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
        @if ($stockins->onFirstPage())
            <span style="opacity:0.5; font-weight:bold; font-size:40px;">←</span>
        @else
            <a href="{{ $stockins->previousPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">←</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($stockins->getUrlRange(1, $stockins->lastPage()) as $page => $url)
            @if ($page == $stockins->currentPage())
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
        @if ($stockins->hasMorePages())
            <a href="{{ $stockins->nextPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">→</a>
        @else
            <span style="opacity:0.5; font-weight:bold; font-size:40px;">→</span>
        @endif

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
