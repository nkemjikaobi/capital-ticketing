@component('mail::message')
# Deposit Confirmed

Your deposit of   ${{ $price }} has been confirmed.

You can start buying tickets  by clicking the button below.

@component('mail::button', ['url' => 'https://capitalticketing.herokuapp.com/buy_tickets'])
Buy Tickets
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
