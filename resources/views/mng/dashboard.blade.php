
@extends('mng.master')
@section('title', __('dashboard.Title'))
@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><h2 class="text-2xl text-gray-400 mb-4 leading-8 mt-6">{{__('dashboard.Resume')}}</h2></div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">

        <div class="flex-1 shadow-xl sm:rounded-lg px-6 py-6 ">
            <div class="flex">
                <div class="ml-auto">
                    <div class="bg-green-500 p-2 rounded-lg text-white cursor-pointer flex"> 5%
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4 w-4 h-4"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                </div>
            </div>
            <div class="text-3xl font-bold leading-8 mt-6">5 {{__('dashboard.Unit')}}</div>
            <div class="text-gray-400 text-base mt-1">{{__('dashboard.Today')}}</div>
        </div>

        <div class="flex-1 shadow-xl mx-8 sm:rounded-lg px-6 py-6 ">
            <div class="flex">
                <div class="ml-auto">
                    <div class="bg-red-500 p-2 rounded-lg text-white cursor-pointer flex"> 10%
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4 w-4 h-4"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                </div>
            </div>
            <div class="text-3xl font-bold leading-8 mt-6">10 {{__('dashboard.Unit')}}</div>
            <div class="text-gray-400 text-base mt-1">{{__('dashboard.Week')}}</div>
        </div>

        <div class="flex-1 shadow-xl sm:rounded-lg px-6 py-6 bg-gradient-to-r from-blue-400 to-indigo-500">
            <div class="flex">
                <div class="ml-auto">
                    <div class="bg-red-500 p-2 rounded-lg text-white cursor-pointer flex"> 33%
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4 w-4 h-4"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                </div>
            </div>
            <div class="text-white text-3xl font-bold leading-8 mt-6">10 {{__('dashboard.Unit')}}</div>
            <div class="text-white text-base mt-1">{{__('dashboard.All')}}</div>
        </div>

    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><h2 class="text-2xl text-gray-400 mb-4 leading-8 mt-6">{{__('dashboard.Interviews')}}</h2></div>
    <div class="max-w-7xl mx-auto my-8 sm:px-6 lg:px-8 flex">

        <div class="flex-1 shadow-xl sm:rounded-lg px-6 py-6 ">
            <div class="flex">
                <div class="ml-auto">
                    <div class="bg-red-500 p-2 rounded-lg text-white cursor-pointer flex"> 5%
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4 w-4 h-4"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                </div>
            </div>
            <div class="text-3xl font-bold leading-8 mt-6">2 {{__('dashboard.Unit')}}</div>
            <div class="text-gray-400 text-base mt-1">{{__('dashboard.Today')}}</div>
        </div>

        <div class="flex-1 shadow-xl mx-8 sm:rounded-lg px-6 py-6 ">
            <div class="flex">
                <div class="ml-auto">
                    <div class="bg-green-500 p-2 rounded-lg text-white cursor-pointer flex"> 12%
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4 w-4 h-4"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                </div>
            </div>
            <div class="text-3xl font-bold leading-8 mt-6">4 {{__('dashboard.Unit')}}</div>
            <div class="text-gray-400 text-base mt-1">{{__('dashboard.Week')}}</div>
        </div>

        <div class="flex-1 shadow-xl sm:rounded-lg px-6 py-6 bg-gradient-to-r from-green-200 to-green-600">
            <div class="flex">
                <div class="ml-auto">
                    <div class="bg-red-500 p-2 rounded-lg text-white cursor-pointer flex"> 33%
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4 w-4 h-4"><polyline points="18 15 12 9 6 15"></polyline></svg>
                    </div>
                </div>
            </div>
            <div class="text-white text-3xl font-bold leading-8 mt-6">15 {{__('dashboard.Unit')}}</div>
            <div class="text-white text-base mt-1">{{__('dashboard.All')}}</div>
        </div>

    </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
        <div class="shadow-xl flex-1 sm:rounded-lg px-6 py-6 ">
            <canvas id="myChart" width="400" height="150"></canvas>
        </div>
        <div class="shadow-xl flex-1 sm:rounded-lg px-6 py-6 ">
            <canvas id="myChart2" width="400" height="150"></canvas>
        </div>
    </div>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб','Вс'],
            datasets: [{
                label: '{{__('dashboard.Interview_count')}}',
                data: [12, 8, 3, 5, 2, 3,1],
                backgroundColor: [
                    '#636bf2',
                    '#636bf2',
                    '#636bf2',
                    '#636bf2',
                    '#636bf2',
                    '#636bf2',
                    '#636bf2'
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctx2 = document.getElementById('myChart2').getContext('2d');

    var resData = {
        labels: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб','Вс'],
        datasets: [{
            label: "{{__('dashboard.Resume_count')}}",
            data: [0, 4, 5, 2, 5, 7, 1,2],
            lineTension: 0,
            fill: false,
            borderColor: '#636bf2',
            backgroundColor: 'transparent',

            pointBorderColor: '#636bf2',
            pointBackgroundColor: '#636bf2',
            pointRadius: 5,
            pointHoverRadius: 10,
            pointHitRadius: 30,
            pointBorderWidth: 2,
            pointStyle: 'rectRounded'
        }]
        };

var chartOptions = {
  legend: {
    display: true,
    position: 'top',
    labels: {
      boxWidth: 80,
      fontColor: 'black'
    }
  }
};

var lineChart = new Chart(ctx2, {
  type: 'line',
  data: resData,
  options: chartOptions
});
    </script>
    @endsection
