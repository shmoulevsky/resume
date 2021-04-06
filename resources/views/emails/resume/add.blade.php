Заполнено новое резюме от {{$resume->fullname}}. Для просмотра нажмите на кнопку ниже.
<br>
Телефон: {{$resume->phone}}
<br>
Email: {{$resume->email}}
<br><br>
@component('mail::button', ['url' => $url, 'color' => 'success'])
смотреть резюме
@endcomponent