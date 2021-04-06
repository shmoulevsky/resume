<div><span class="text-xl my-2 block font-bold text-gray-400">Образование:</span></div>
<table class="table-fixed education-table w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2">Учебное заведение</th>
            <th class="px-4 py-2">Специальность</th>
            <th class="px-4 py-2 period">Период</th>
           
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
            <tr><td class="p-5" colspan="8">Нет записей</td></tr>
        @endforelse
        

    </tbody>

</table>