<div><span class="text-xl my-2 block font-bold text-gray-400">{{__('resume-detail.Experience')}}:</span></div>
<table class="table-fixed experience-table w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2">{{__('resume-detail.Company')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.Position')}}</th>
            <th class="px-4 period py-2">{{__('resume-detail.Period')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.Duty')}}</th>

        </tr>

    </thead>

    <tbody>

        @forelse($experience as $exp)

        <tr>
            <td class="border px-4 py-2">{{ $exp->company_name }}</td>
            <td class="border px-4 py-2">{{ $exp->position }}</td>
            <td class="border px-4 py-2 period">{{ $exp->period}}</td>
            <td class="border px-4 py-2">{!! $exp->description !!}</td>
        </tr>
        @empty
            <tr><td class="p-5" colspan="8">{{__('resume-detail.Experience_no_records')}}</td></tr>
        @endforelse


    </tbody>

</table>
