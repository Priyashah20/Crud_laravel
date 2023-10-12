
<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>

<td align="center" height="143" ><img alt="" height="34" src="{{ $msg->embed(asset('/logos/shop.png') }}" style="border-width: 0px; width: 100px; height: 100px;" width="160"></td>
    <p>Hello {{ $order['name'] }}</p>
    <p>Quantity of order:- {{$order['qty']}}</p>
    <p>Price of order:- {{$order['price']}}</p>
    <p>Total price of order:- {{$order['total_price']}}</p>
    <p>{{$order['title']}}</p>
    Thanks,<br>
    {{ config('app.name') }}
    <p>Your Order has been successfully placed.</p>
    <p>Thank you</p>
</body>
</html>


