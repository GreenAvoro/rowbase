<x-app-layout>
    <x-slot name="header">
        <a href="{{back()->getTargetUrl()}}" class="text-xl font-bold hover:underline"> <i class="fa-solid fa-angle-left ml-4"></i> Back</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 relative">
                <p class="font-bold text-lg">{{$data->user->name}} </p>
                <p class="text-xs">{{date('D dS M g:ia',strtotime($data->datetime))}}</p>
                <p class="mt-2 border-gray-500 border-b">{{$data->workout->name}}</p>
                <div style="display:grid; grid-template-columns: 100px 100px">
                    <p>Time</p>
                    <p>Distance</p>
                    @foreach ($data->times as $time)
                        <p class="font-bold">{{$time->time}}</p>
                        <p class="font-bold">{{$time->distance}}m</p>
                    @endforeach
                </div>
                @if ($data->image)
                    <div class="rounded-md overflow-hidden inline-block w-1/2 mt-8">
                        <img src="{{Storage::url($data->image)}}" alt="Workout Image" class="w-full">
                    </div>
                @else
                    <p class="text-lg font-bold text-gray-400 border-2 inline-block p-4 rounded-md mt-4">No Image</p>
                @endif


                @if ($data->user_id == $user->id)
                    <form action="{{ route('log.destroy', $data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    
                        <button type="submit" class="text-red-500 absolute right-2 top-2 border-red-500 border rounded px-4 hover:bg-red-500 hover:text-white">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
