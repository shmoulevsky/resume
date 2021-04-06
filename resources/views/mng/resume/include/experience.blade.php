<div><span class="text-xl my-2 block font-bold text-gray-400">Опыт работы:</span></div>
<table class="table-fixed experience-table w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2">Компания</th>
            <th class="px-4 py-2">Должность</th>
            <th class="px-4 period py-2">Период</th>
            <th class="px-4 py-2">Должностные обязонности</th>

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
            <tr><td class="p-5" colspan="8">Нет записей</td></tr>
        @endforelse
        

    </tbody>

</table>