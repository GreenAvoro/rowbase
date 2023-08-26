<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-2">
                @foreach ($users as $user)
                    <div class="bg-{{$user->squad->color}} rounded-lg p-4 text-white my-2">
                        <p class="font-bold text-2xl inline-block">{{$user->name}}</p>

                        <form action="{{route('update.user')}}" method="POST" enctype="multipart/form-data" id="update-user" class="inline-block">
                            @csrf
                            <select class="bg-transparent font-bold border-none" name="squad-select" id="squad-select">
                                @foreach ($squads as $squad)
                                    <option value="{{$squad->id}}" {{($squad->id == $user->squad_id ? 'selected' : '')}}>{{$squad->name}}</option>
                                @endforeach
                            </select>

                            <input type="hidden" name="user-id" value="{{$user->id}}">

                            <input type="submit" class="border border-white px-4 py-1 rounded-md cursor-pointer hover:bg-white hover:text-{{$user->squad->color}}" value="UPDATE">
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>