@extends('mng.master')
@section('title', 'Текущий тариф')
@section('content')

<div class="p-4 xl:w-1/3 md:w-1/2 w-full">
        <div class="h-full p-6 rounded-lg border-2 @if($tariff->id == 2) border-indigo-500 @else border-gray-300 @endif flex flex-col relative overflow-hidden">
          <h2 class="text-sm tracking-widest title-font mb-1 font-medium">{{$tariff->name}}</h2>
          <h1 class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
            <span>{{$tariff->amount}} руб.</span>
            <span class="text-lg ml-1 font-normal text-gray-500">/мес.</span>
          </h1>
          <p class="flex items-center text-gray-600 mb-2">
            <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                <path d="M20 6L9 17l-5-5"></path>
              </svg>
            </span>Создание онлайн-форм
          </p>
          <p class="flex items-center text-gray-600 mb-2">
            <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                <path d="M20 6L9 17l-5-5"></path>
              </svg>
            </span>Управление статусами резюме
          </p>
          <p class="flex items-center text-gray-600 mb-2">
            <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                <path d="M20 6L9 17l-5-5"></path>
              </svg>
            </span>Онлайн оповещения
          </p>
          
          <p class="flex items-center text-gray-600 mb-6">
            <span class="w-4 h-4 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" class="w-3 h-3" viewBox="0 0 24 24">
                <path d="M20 6L9 17l-5-5"></path>
              </svg>
            </span>@if($tariff->id == 1) пробный доступ 14 дней @else доступ по подписке @endif
          </p>
          <button class="flex items-center mt-auto text-white @if($tariff->id == 2) bg-indigo-500 @else bg-gray-300 @endif border-0 py-2 px-4 w-full focus:outline-none hover:bg-gray-500 rounded">Подробнее
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </button>
          <p class="text-xs text-gray-500 mt-3">Цены указаны с НДС.</p>
        </div>
      </div>

@endsection
