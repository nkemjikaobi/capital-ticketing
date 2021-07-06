@component('mail::message')
# Failed Deposit

Your deposit of ${{ $price }} was not successful. 

You can try again by clicking the button below.

@component('mail::button', ['url' => 'https://capitalticketing.herokuapp.com/fund_wallet'])
Fund Wallet
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
