<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new Squad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                <form action="{{route('submit.squad')}}" method="POST" enctype="multipart/form-data" id="squad-create-form">
                    @csrf
                    <label for="squad-name">Squad Name:</label><br>
                    <input type="text" name="squad-name" id="squad-name">
                    <br><br>
                    <label for="squad-color">Color</label><br>
                    <input type="radio" name="squad-color" id="squad-color-blue" class="bg-blue-500" value="blue-500" checked>
                    <input type="radio" name="squad-color" id="squad-color-red" class="bg-red-500" value="red-500" >
                    <input type="radio" name="squad-color" id="squad-color-pink" class="bg-pink-300" value="pink-300" >
                    <input type="radio" name="squad-color" id="squad-color-green" class="bg-green-500" value="green-500">
                    <input type="radio" name="squad-color" id="squad-color-orange" class="bg-orange-500" value="orange-500">
                    <input type="radio" name="squad-color" id="squad-color-purple" class="bg-purple-500" value="purple-500">
                    <input type="radio" name="squad-color" id="squad-color-cyan" class="bg-cyan-500" value="cyan-500">
                    <input type="radio" name="squad-color" id="squad-color-magenta" class="bg-fuchsia-500" value="fuschia-500">
                    <br>
                    <input type="submit" value="Submit" class="bg-red-500 text-white px-10 py-2 mt-4 rounded cursor-pointer hover:bg-red-600">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>