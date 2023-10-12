@component('mail::message')
# Introduction
<h3>{{ $details['title'] }}</h3>
<h3>{{ $details['body'] }}</h3>
@component('mail::button', ['url' => $details['url'], 'color' => 'error'])
Login
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
