{{__('email-new-resume.Title', ['fullname' => $resume->fullname])}}
<br>
{{__('email-new-resume.Phone')}}: {{$resume->phone}}
<br>
{{__('email-new-resume.Email')}}: {{$resume->email}}
<br><br>
@component('mail::button', ['url' => $url, 'color' => 'success'])
    {{__('email-new-resume.Detail')}}
@endcomponent
