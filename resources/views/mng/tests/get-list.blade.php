<table class="table-fixed w-full">
    <thead>
        <tr class="bg-gray-100 border border-gray-100">
            <th style="width:5%;"> </th>
            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">{{__('test-list.Table_title')}}</th>
            <th class="px-4 py-2">{{__('test-list.Table_date')}}</th>
            <th class="px-4 py-2">{{__('test-list.Table_count')}}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tests as $test)
        <tr>
            <td><input data-id="<?=$test->id?>" class="test-field" type="checkbox"  ></td>
            <td class="border px-4 py-2">{{ $test->id }}</td>
            <td class="border px-4 py-2">{{ $test->name }}</td>
            <td class="border px-4 py-2">{!! $test->formatDateTime !!}</td>
            <td class="border px-4 py-2">{{ $test->questions_count }}</td>
        </tr>
        @empty
            <tr><td class="p-5" colspan="9">{{__('test-list.Table_No_records')}}</td></tr>
        @endforelse

    </tbody>
</table>
