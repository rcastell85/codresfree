@props(['course'])

<div class="flex items-center">
    <img class="h-12 w-12 object-cover rounded-full shadow-lg" src="{{$course->teacher->profile_photo_url}}" alt="{{$course->teacher->name}}">

    <div class="ml-4">
        <h1 class="font-bold text-gray-500 text-lg">Prof: {{$course->teacher->name}}</h1>
        <a class="text-blue-400 text-sm font-bold" href="">{{'@' . Str::slug($course->teacher->name, '')}}</a>
    </div>
</div>