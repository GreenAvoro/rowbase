<?php
$totalWorkouts = 0;
$totalKilometers = 0;
$totalTime = 0.0;

$averageSplit = 0;
$totalTimes = 0;
?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-2">
                <h3 class="p-4 text-xl font-bold">Recent Logs<span class="text-sm text-gray-500"> - showing the 20 most recent workout logs</span></h3>

                @foreach ($logs as $log)
                    <?php
                    if($log->user_id == $user->id)
                    {
                        $totalWorkouts++;
                        foreach ($log->times  as $time)
                        {
                            $totalTimes++;
                            $totalKilometers += $time->distance;
                            $fiveHundreds = $time->distance / 500;
                            $timeParts = explode(':', $time->time);
                            // $hours = (int)$timeParts[0];
                            // $minutes = (int)$timeParts[1];
                            $seconds = ((float)$timeParts[0]*60*60) + ((float)$timeParts[1]*60) + (float)$timeParts[2];
                            $hours = $seconds /60 / 60;
                            $totalTime += $hours;

                            $averageSplit += ($seconds / $fiveHundreds);
                        }
                    }
                    ?>
                    <a href="{{route('log.view', $log->id)}}" class="">
                        <div class="mx-4 mb-4 bg-gray-100 p-4 sm:rounded overflow-hidden relative z-0 hover:bg-blue-100 transition-all">
                            <div class="relative z-20">
                                <div class="flex justify-between">
                                    <div class="flex justify-center items-center">
                                        <p class="font-bold text-2xl text-{{$log->user->squad->color}}">{{$log->user->name}}</p>
                                        @if ($log->image)
                                            <i class="fa-solid fa-image ml-4 text-blue-800"></i>
                                        @else
                                            <i class="fa-solid fa-image-slash ml-4 text-blue-200"></i>
                                        @endif
                                    </div>
                                    <p class="font-bold text-2xl text-white italic">{{$log->workout->name}}</p>
                                </div>
                                <p class="text-sm mb-2 px-3 py-0.5 text-white inline-block rounded-2xl bg-{{$log->user->squad->color}}">{{$log->user->squad->name}}</p>
                                <p class="text-xs border-gray-500 border-b mb-2">{{date('D dS M g:ia',strtotime($log->datetime))}}</p>
                                <div style="display:grid; grid-template-columns: 100px 100px">
                                    <p>Time</p>
                                    <p>Distance</p>
                                    @foreach ($log->times as $time)
                                        <p class="font-bold">{{$time->time}}</p>
                                        <p class="font-bold">{{$time->distance}}m</p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="absolute z-0 w-2/5 h-96 rotate-[20deg] bg-{{$log->user->squad->color}} opacity-20" style="top: -3rem; right: -2rem"></div>
                            <div class="absolute z-10 w-2/5 h-96 rotate-[20deg] bg-{{$log->user->squad->color}}" style="top: -3rem; right: -6rem"></div>
                        </div>
                    </a>
                @endforeach
                <?php 
                    if($totalTimes > 0)
                    {
                        $averageSplit = $averageSplit / $totalTimes;
                    }
                ?>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-auto">
                <h3 class="p-4 pb-0 text-xl font-bold">My Weekly Stats</h3>

                <div class="grid grid-cols-2 gap-2">
                    <div class=" p-4">
                        <p class="flex items-center"><i class="text-2xl fa-regular fa-ruler-horizontal text-red-500"></i>&nbsp;&nbsp;Total Kilometers</p>
                        <p class="text-3xl">{{number_format($totalKilometers/1000, 1)}}km</p>
                    </div>

                    <div class=" p-4">
                        <p class="flex items-center"><i class="text-2xl fa-regular fa-clock text-blue-500"></i>&nbsp;&nbsp;Total Time</p>
                        <p class="text-3xl">{{number_format($totalTime, 1)}} hours</p>
                    </div>

                    <div class=" p-4">
                        <p class="flex items-center"><i class="text-2xl fa-regular fa-arrow-trend-up text-green-500"></i>&nbsp;&nbsp;# of Workouts</p>
                        <p class="text-3xl">{{$totalWorkouts}}</p>
                    </div>

                    <div class=" p-4">
                        <p class="flex items-center"><i class="text-2xl fa-regular fa-gauge-circle-bolt text-yellow-500"></i>&nbsp;&nbsp;Average Split</p>

                        <p class="text-3xl">{{intdiv($averageSplit, 60)}}:{{sprintf('%02d',$averageSplit%60);}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
