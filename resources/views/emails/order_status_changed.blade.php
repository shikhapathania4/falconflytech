<!DOCTYPE html>
<html>
<head>
    <title>Order Status Changed</title>
</head>
<body>
    <h1>Order Status Update</h1>
    <p>Dear {{ $order->user->name }},</p>

    <p>Your order with ID <strong>{{ $order->id }}</strong> has changed status.</p>

    <p><strong>Previous Status:</strong> {{ ucfirst($oldStatus) }}</p>
    <p><strong>New Status:</strong> {{ ucfirst($newStatus) }}</p>

    <p>Thank you for shopping with us!</p>

    <p>Best regards,<br>Falcon Fly</p>
</body>
</html>
