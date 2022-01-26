
<h3>{{__('resume-detail.Interview_list')}}:</h3>
<ul>
@forelse($interviews as $interview)
    <li>{!! $interview->formatDateTimeInterview !!}</li>
@empty
    <li>{{__('resume-detail.Interview_no_records')}}</li>
@endforelse
</ul>
