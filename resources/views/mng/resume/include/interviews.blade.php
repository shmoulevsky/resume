
<h3>Список собеседований:</h3>
<ul>
@forelse($interviews as $interview)
    <li>{!! $interview->formatDateTimeInterview !!}</li>
@empty
    <li>Нет записей</li> 
@endforelse
</ul>
