<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список резюме</h2>
    </x-slot>

    <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            @if (session()->has('message'))

                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">

                  <div class="flex">

                    <div>

                      <p class="text-sm">{{ session('message') }}</p>

                    </div>

                  </div>

                </div>

            @endif

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New Post</button>

            

            <table class="table-fixed w-full">

                <thead>

                    <tr class="bg-gray-100">

                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2 w-20">Дата</th>
                        <th class="px-4 py-2">Фамилия</th>
                        <th class="px-4 py-2">Имя</th>
                        <th class="px-4 py-2">Отчество</th>
                        <th class="px-4 py-2">Телефон</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Подробнее</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($resume as $resume)

                    <tr>

                        <td class="border px-4 py-2">{{ $resume->id }}</td>
                        <td class="border px-4 py-2">{{ $resume->created_at }}</td>
                        <td class="border px-4 py-2">{{ $resume->name }}</td>
                        <td class="border px-4 py-2">{{ $resume->last_name }}</td>
                        <td class="border px-4 py-2">{{ $resume->second_name }}</td>
                        <td class="border px-4 py-2">{{ $resume->phone }}</td>
                        <td class="border px-4 py-2">{{ $resume->email }}</td>
                        <td class="border px-4 py-2"><button>Подробнее</button></td>

                       

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
    
</x-app-layout>

