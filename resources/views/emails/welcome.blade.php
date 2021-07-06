@component('mail::message')
# Welcome to the family, {{ $firstname }}

To get started, fund your wallet and start buying tickets.

@component('mail::button', ['url' => 'https://capitalticketing.herokuapp.com/fund_wallet'])
Fund Wallet
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
