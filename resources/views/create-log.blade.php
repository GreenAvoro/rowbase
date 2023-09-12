<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Log a new Workout') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <form action="{{route('submit.log')}}" method="POST" enctype="multipart/form-data" id="log-workout-form" class="md:p-0 py-4 px-12 md:block flex flex-col items-stretch">
                    @csrf
                    <label for="workout">Workout Type</label><br>
                    <select name="workout" id="workout" class="rounded lg:inline block lg:w-auto w-full">
                        @foreach ($workouts as $workout)
                            <option value="{{$workout->id}}" class="workout-option">{{$workout->name}}</option>
                        @endforeach
                    </select>
                    <br>
                    <br>
                    @foreach ($workouts as $workout)
                        <div id="workout-{{$workout->id}}" style="display: {{$workout->id == 1 ? 'block' : 'none'}}">
                            @foreach ($workout->presets as $preset)
                                @if ($preset->distance != 0)
                                    <input type="hidden" name="distance_{{$preset->interval_no}}" value="{{$preset->distance}}"{{$workout->id == 1 ?'' : 'disabled'}}>
                                    <label for="time_{{$preset->interval_no}}">Time (hours:minutes:seconds)</label><br>
                                    <input class="rounded" type="text" id="time_{{$preset->interval_no}}" name="time_{{$preset->interval_no}}"{{$workout->id == 1 ?'' : 'disabled'}} placeholder="00:00:00">
                                @else
                                    <input type="hidden" name="time_{{$preset->interval_no}}" value="{{$preset->time}}"{{$workout->id == 1 ?'' : 'disabled'}}>
                                    <label for="distance_{{$preset->interval_no}}">Distance (meters)</label><br>
                                    <input class="rounded" type="number" id="distance_{{$preset->interval_no}}" name="distance_{{$preset->interval_no}}"{{$workout->id == 1 ?'' : 'disabled'}}>
                                @endif
                                <br>
                            @endforeach
                        </div>
                    @endforeach
                    <br>
                    <p>Upload an image:</p>
                    <input type="file" name="image" class="rounded"><br>
                    <input type="submit" value="Submit" class="bg-red-500 text-white px-10 py-2 mt-4 rounded cursor-pointer hover:bg-red-600">
                </form>
            </div>
        </div>
    </div>

    <script>
        var mySelect = document.getElementById('workout');
        var options = document.getElementsByClassName('workout-option');
        mySelect.onchange = (event) => {
            
            for(option of options)
            {
                var workout = document.getElementById('workout-'+option.value)

                workout.style.display = "none"
                
                let inputs = workout.querySelectorAll('input')
                for (input of inputs)
                {
                    input.disabled = true
                }
            }

            var value = event.target.value;
            var workoutInputs = document.getElementById('workout-'+value)
            workoutInputs.style.display = "block"

            let inputs = workoutInputs.querySelectorAll('input')
            for (input of inputs)
            {
                input.disabled = false
            }


        }
    </script>
</x-app-layout>
