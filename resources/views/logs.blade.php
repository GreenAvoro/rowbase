<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Workout Logs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <form action="{{route('logs')}}" method="GET" class="grid grid-cols-4 p-4 items-end">
                    <div class="px-2">
                        <label for="">Squad Group</label><br>
                        <select name="squad" id="squad" class="w-full">
                            <option value="all">All</option>
                        </select>
                    </div>
                    <div class="px-2">
                        <label for="">Workout Type</label><br>
                        <select name="workout" id="workout" class="w-full">
                            <option value="all">All</option>
                            @foreach ($workouts as $workout)
                                <option value="{{$workout->id}}">{{$workout->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="px-2">
                        <label for="">User</label><br>
                        <select name="user" id="user" class="w-full">
                            <option value="all">All</option>
                            @foreach ($users as $u)
                                <option value="{{$u->id}}">{{$u->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input type="submit" value="Filter" class="ml-2 border-[1px] border-red-500 bg-red-500 text-white px-10 py-2 hover:bg-red-600 transition-all cursor-pointer">
                    </div>
                </form>

                @foreach ($logs as $log)
                <a href="{{route('log.view', $log->id)}}" class="">
                    <div class="mx-4 my-2 bg-teal-50 p-4 sm:rounded overflow-hidden relative z-0 hover:bg-teal-100 transition-all">
                        <div class="relative z-20">
                            <div class="flex justify-between">
                                <div class="flex justify-center items-center">
                                    <p class="font-bold text-2xl text-teal-900">{{$log->user->name}} </p>
                                    @if ($log->image)
                                        <i class="fa-solid fa-image ml-4"></i>
                                    @else
                                        <i class="fa-solid fa-image-slash ml-4 text-blue-200"></i>
                                    @endif
                                </div>
                                <p class="font-bold text-2xl text-teal-900 italic">{{$log->workout->name}}</p>
                            </div>
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
                        <div class="absolute z-0 w-2/5 h-96 rotate-[20deg] bg-teal-100" style="top: -3rem; right: -2rem"></div>
                        <div class="absolute z-10 w-2/5 h-96 rotate-[20deg] bg-teal-200" style="top: -3rem; right: -6rem"></div>
                    </div>
                </a>
                @endforeach
                <div class="p-4">
                    {{$logs->links()}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
