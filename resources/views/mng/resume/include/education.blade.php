<div><span class="text-xl my-2 block font-bold text-gray-400">{{__('resume-detail.Education')}}:</span></div>
<table class="table-fixed education-table w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2">{{__('resume-detail.Education_place')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.Specialization')}}</th>
            <th class="px-4 py-2 period">{{__('resume-detail.Education_period')}}</th>

        </tr>

    </thead>

    <tbody>

        @forelse($education as $edu)

        <tr>
            <td class="border px-4 py-2">{{ $edu->place }}</td>
            <td class="border px-4 py-2">{{ $edu->specialisation }}</td>
            <td class="border px-4 py-2 period">{{ $edu->period}}</td>
        </tr>
        @empty
            <tr><td class="p-5" colspan="8">{{__('resume-detail.Education_no_records')}}</td></tr>
        @endforelse


    </tbody>

</table>
