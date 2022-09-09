@component('mail::message')
# Introduction


   Sofra Account Reset Password
@component('mail::button', ['url' => ''])
Button Text
@endcomponent


<p> your code is : {{$code}} </p>




Thanks,<br>
{{ config('app.name') }}
@endcomponent
