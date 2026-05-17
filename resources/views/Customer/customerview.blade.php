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
    <h1>Customer</h1>
    <p>See all registered customers and their details.</p>
    <div class="StockLinks">
        <a href="{{ route('customers.create') }}"><span style="font-size: 30px">+</span> Add Customer</a>
        {{-- <a href=""><span style="font-size: 20px">ↁ</span> Debts</a> --}}
    </div>
    <table>
        <thead>
            <tr>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Middlename</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->last_name }}</td>
                    <td>{{ $customer->first_name }}</td>
                    <td>{{ $customer->middle_name }}</td>
                    <td>{{ $customer->phone_number }}</td>
                    <td style="display:flex; gap:8px;">
                        {{-- EDIT --}}
                        <a href="{{ route('customers.edit', $customer->id) }}"
                        style="background:#f0ad4e; color:white; padding:5px 10px; border-radius:5px; text-decoration:none;">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this customer?');">
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
        @if ($customers->onFirstPage())
            <span style="opacity:0.5; font-weight:bold; font-size:40px;">←</span>
        @else
            <a href="{{ $customers->previousPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">←</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($customers->getUrlRange(1, $customers->lastPage()) as $page => $url)
            @if ($page == $customers->currentPage())
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
        @if ($customers->hasMorePages())
            <a href="{{ $customers->nextPageUrl() }}" style="opacity:0.5; font-weight:bold; font-size:40px;">→</a>
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
