<x-app-layout>
    <div class="py-12">
        <div class="bg-white max-w-7xl mx-auto rounded-md p-4">
            <h1 class="text-center text-3xl mt-4 font-bold">Before we let you in, please pick a squad</h1>
            <form action="{{route('set-squad.user')}}" method="POST" enctype="multipart/form-data" id="update-user" class="md:w-1/2 block mx-auto mb-4">
                @csrf
                <input type="hidden" name="user-id" id="user-id" value="{{$user->id}}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-8">
                    @foreach ($squads as $squad)
                    <?php if ($squad->id == 1) continue; ?>
                        <input name="squad-{{$squad->id}}" type="submit" value="{{$squad->name}}" data-id="{{$squad->id}}" class="flex justify-center items-center bg-{{$squad->color}} hover:opacity-60 rounded-md p-4 text-white font-bold text-lg cursor-pointer">
                    @endforeach
                </div>
            </form>
        </div>
    </div>
</x-app-layout>