<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Squads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-2">
                @foreach ($squads as $squad)
                    <div class="p-4 my-2 rounded-lg text-white bg-{{$squad->color}}">
                        <h2 class="text-xl font-bold">{{$squad->name}}</h2>
                    </div>
                @endforeach

                <div class="border-2 rounded-lg mt-4" style="border-color: #333333">
                    <a class="block text-gray-800 text-center p-4 font-bold" href="{{route('squad-create')}}">Add New Squad</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>