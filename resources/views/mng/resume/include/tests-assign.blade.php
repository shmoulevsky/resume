<table class="table-fixed w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">{{__('resume-detail.Test_date')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.Test_title')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.Test_more')}}</th>
            <th class="px-4 py-2"></th>

        </tr>

    </thead>

    <tbody>

        @forelse($testAssign as $test)

        <tr>

            <td class="border px-4 py-2">{{ $test->id }}</td>
            <td class="border px-4 py-2">{{ $test->created_at }}</td>
            <td class="border px-4 py-2">{{ $test->test->name}}</td>
            <td class="border px-4 py-2">
                <a target="_blank" href="{{route('test.public.info', [$companyId, $test->code])}}">{{__('resume-detail.Test_link')}}</a>
            </td>
            <td class="border px-4 py-2">
                <a class="delete-icon delete-item" data-url="{{route('test.assign.delete', [$test->id])}}" href="#"></a>
            </td>


        </tr>
        @empty
            <tr><td class="p-5" colspan="8">{{__('resume-detail.Test_no_records')}}</td></tr>
        @endforelse


    </tbody>

</table>
