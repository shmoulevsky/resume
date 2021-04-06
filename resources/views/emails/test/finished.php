Закончен тест. Для просмотра нажмите на кнопку ниже.
<br>
<br>
ФИО: {{$resume->fullname}}
<br>
Телефон: {{$resume->phone}}
<br>
Email: {{$resume->email}}
<br><br>
@component('mail::button', ['url' => $url, 'color' => 'success'])
смотреть результат
@endcomponent