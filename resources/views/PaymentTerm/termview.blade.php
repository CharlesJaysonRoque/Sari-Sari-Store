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
    <h1>Payment Term</h1>
    <p>See all registered payment terms.</p>
    <div class="StockLinks">
        <a href="{{ route('paymentterms.create') }}"><span style="font-size: 30px">+</span>Add Payment Term</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Term</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paymentterms as $term)
                <tr>
                    <td>{{ $term->term }}</td>
                    <td style="display:flex; gap:8px;">
                        {{-- EDIT --}}
                        <a href="{{ route('paymentterms.edit', $term->id) }}"
                        style="background:#f0ad4e; color:white; padding:5px 10px; border-radius:5px; text-decoration:none;">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('paymentterms.destroy', $term->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this payment term?');">
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
        @if ($paymentterms->onFirstPage())
            <span style="opacity:0.5; font-weight:bold; font-size:40px;">←</span>
        @else
            <a href="{{ $paymentterms->previousPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">←</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($paymentterms->getUrlRange(1, $paymentterms->lastPage()) as $page => $url)
            @if ($page == $paymentterms->currentPage())
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
        @if ($paymentterms->hasMorePages())
            <a href="{{ $paymentterms->nextPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">→</a>
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
