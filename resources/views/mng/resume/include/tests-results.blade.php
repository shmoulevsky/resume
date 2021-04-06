<table class="table-fixed w-full">

    <thead>

        <tr class="bg-gray-100 border border-gray-100">

            <th class="px-4 py-2 w-20">No.</th>
            <th class="px-4 py-2">Дата прохождения</th>
            <th class="px-4 py-2">Название</th>
            <th class="px-4 py-2">Баллы</th>
            <th class="px-4 py-2">Всего вопросов</th>
            <th class="px-4 py-2">Правильных</th>
            <th class="px-4 py-2">Время</th>
            <th class="px-4 py-2">Подробнее</th>

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
                <a href="">Подробнее</a>
            </td>
    

        </tr>
        @empty
            <tr><td class="p-5" colspan="8">Нет записей</td></tr>
        @endforelse
        

    </tbody>

</table>