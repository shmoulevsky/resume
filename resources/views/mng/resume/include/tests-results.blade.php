<table class="table-fixed w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">{{__('resume-detail.TestResult_date')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.TestResult_title')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.TestResult_points')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.TestResult_total')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.TestResult_right')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.TestResult_time')}}</th>
            <th class="px-4 py-2">{{__('resume-detail.TestResult_more')}}</th>

        </tr>

    </thead>

    <tbody>

        @forelse($testResults as $test)

        <tr>

            <td class="border px-4 py-2">{{ $test->id }}</td>
            <td class="border px-4 py-2">{{ $test->created_at }}</td>
            <td class="border px-4 py-2">{{ $test->test->name }}</td>
            <td class="border px-4 py-2">{{ $test->points }}</td>
            <td class="border px-4 py-2">{{ $test->count }}</td>
            <td class="border px-4 py-2">{{ $test->count_right }}</td>
            <td class="border px-4 py-2">{{ $test->timer }}</td>
            <td class="border px-4 py-2">
                <a href="">{{__('resume-detail.TestResult_more')}}</a>
            </td>


        </tr>
        @empty
            <tr><td class="p-5" colspan="8">{{__('resume-detail.TestResult_no_records')}}</td></tr>
        @endforelse


    </tbody>

</table>
