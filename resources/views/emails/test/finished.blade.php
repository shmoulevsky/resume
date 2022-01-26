{{__('email-test-finished.Title')}}
<br>
<br>
{{__('email-test-finished.Fullname')}}: {{$resume->fullname}}
<br>
{{__('email-test-finished.Phone')}}: {{$resume->phone}}
<br>
{{__('email-test-finished.Email')}}: {{$resume->email}}
<br><br>
@component('mail::button', ['url' => $url, 'color' => 'success'])
{{__('email-test-finished.Detail')}}
@endcomponent
