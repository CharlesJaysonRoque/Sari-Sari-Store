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
    <h1>Product</h1>
    <p>See all products available and their details.</p>
    <div class="StockLinks">
        <a href="{{ route('products.create') }}"><span style="font-size: 30px">+</span> Add Product</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->title ?? 'N/A' }}</td>
                    <td style="display:flex; gap:8px;">
                        {{-- EDIT --}}
                        <a href="{{ route('products.edit', $product->id) }}"
                        style="background:#f0ad4e; color:white; padding:5px 10px; border-radius:5px; text-decoration:none;">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this product?');">
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
        @if ($products->onFirstPage())
            <span style="opacity:0.5; font-weight:bold; font-size:40px;">←</span>
        @else
            <a href="{{ $products->previousPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">←</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
            @if ($page == $products->currentPage())
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
        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">→</a>
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
