<aside id="sidebar" style="overflow: auto; position: fixed; height: 100vh; width: 200px; padding-left: 20px; ">
<pre>
Scyla's
Sari-Sari
Store
</pre>
    </h1>
    <ul>
        <hr>
        <li class="LI1"><a href="{{ route('stocks.index') }}">Stocks</a></li>
        <li class="LI1"><a href="{{ route('products.index') }}">Products</a></li>
        <li class="LI1"><a href="{{ route('categories.index') }}">Categories</a></li>
        <li class="LI1"><a href="{{ route('stockin.index') }}">Stock In</a></li>
        <li class="LI1"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
        <li class="LI1"><a href="{{ route('stockout.index') }}">Stock Out</a></li>
        <li class="LI1"><a href="{{ route('reasons.index') }}">Reasons</a></li>
        <hr>
        <li class="LI1"><a href="{{ route('customers.index') }}">Customers</a></li>
        <li class="LI1"><a href="{{ route('blocklist.index') }}">Blocklist</a></li>
        <li class="LI1"><a href="{{ route('violations.index') }}">Violations</a></li>
        <hr>
        <li class="LI1"><a href="{{ route('transactions.index') }}">Transactions</a></li>
        <li class="LI1"><a href="{{ route('paymentmethods.index') }}">Payment Method</a></li>
        <li class="LI1"><a href="{{ route('paymentterms.index') }}">Payment Term</a></li>

    </ul>
</aside>

<style>
    .LI1 {
        padding: 10px;
        border-radius: 5px;
        list-style-type: none;
        margin: 5px 0;
        margin-left: -30px;
    }
    .LI1 a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        font-size: 18px
    }
    .LI1 a:hover {
        text-decoration: underline;
    }
    .LI1::marker {
        content: "⩥";
        color: white;
    }
    pre {
        font-family: 'Arial', sans-serif;
        color: white;
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    hr {
        height: 3px;
        background: white;
        border: none;
        margin-left: -40px;
    }
</style>

<script>
const sidebar = document.getElementById('sidebar');

/* Restore scroll position */
window.addEventListener('load', () => {
    const saved = localStorage.getItem('sidebarScroll');

    if(saved !== null){
        sidebar.scrollTop = saved;
    }
});

/* Save scroll position */
sidebar.addEventListener('scroll', () => {
    localStorage.setItem('sidebarScroll', sidebar.scrollTop);
});
</script>
