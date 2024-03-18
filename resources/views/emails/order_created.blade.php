@component('mail::message')

# Order Created!

Thank you for your order. Your order number is {{ $order->id }}.

@component('mail::button', ['url' => $url])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@endcomponent
