@extends('index')

@section('content')
<div>
    <h2>Sales Report per Customer</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>Customer Name</th>
            <th>Total Sales</th>
        </tr>

        @foreach($sales as $sale)
        <tr>
            <td>
                {{ $sale->first_name }}
                {{ $sale->last_name }}
            </td>

            <td>
                ₱{{ number_format($sale->grand_total, 2) }}
            </td>
        </tr>
        @endforeach

    </table>

    <br>

    {{ $sales->links() }}
</div>

<div>
    <h2>Overall Total Sales: ₱{{ number_format($overallTotal, 2) }}</h2>
    <h2>Total Profit: ₱{{ number_format($totalProfit, 2) }}</h2>
    <h2>Total Capital: ₱{{ number_format($totalCapital, 2) }}</h2>
</div>

@endsection
