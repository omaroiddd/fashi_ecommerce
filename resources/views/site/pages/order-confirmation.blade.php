<h1>
    Your order has been confirmed
</h1>
<ul>
    <li>
        Customer Name : {{ $order->name }}
    </li>
    <li>
        Order Number: {{ $order->id }}
    </li>
    <li>
        Order Date: {{ $order->created_at }}
    </li>
</ul>
<p>
    <a href="{{ route('site.home') }}" class="btn btn-primary">Back to Home</a>
</p>
