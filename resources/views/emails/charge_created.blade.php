@component('mail::message')
# Initiated Deposit

You just initiated a deposit of ${{ $price }} in your {{ config('app.name') }} account

You can view your updated deposit status by clicking the button below.

@component('mail::button', ['url' => 'https://capitalticketing.herokuapp.com/deposits'])
View Deposits
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
