<x-app-layout>
    <section class="bg-gray-700 py-12 mb-12">
        <div class="container grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <figure>
                @if ($course->image)
                    <img class="h-60 w-full object-cover" src="{{Storage::url($course->image->url)}}" alt="">
                @else
                    <img class="h-60 w-full object-cover" src="https://cdn.pixabay.com/photo/2017/04/19/13/15/computer-2242263_960_720.jpg" alt="">
                @endif
            </figure>

            <div class="text-white">
                <h1 class="text-4xl">{{$course->title}}</h1>
                <h2 class="text-xl mb-3">{{$course->subtitle}}</h2>
                <p class="mb-2"><i class="fas fa-chart-line"></i> Nivel: {{$course->level->name}}</p>
                <p class="mb-2"><i class="fas fa-chart-line"></i> Categoria: {{$course->category->name}}</p>
                <p class="mb-2"><i class="fas fa-users"></i> Matriculados: {{$course->students_count}}</p>
                <p><i class="fas fa-star"></i> Calificacion: {{$course->rating}}</p>
            </div>

        </div>
    </section>

    <div class="container grid grid-cols-1 lg:grid-cols-3 gap-6">
        @if (session('info'))
            <div class="lg:col-span-3" x-data="{open: true}" x-show="open">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Ocurrio un error!</strong>
                    <span class="block sm:inline">{{session('info')}}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                      <svg x-on:click="open=false" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                  </div>
            </div>
        @endif

        <div class="order-2 lg:col-span-2 lg:order-1">

            {{--  METAS  --}}
            <section class="card mb-12">
                <div class="card-body">
                    <h1 class="font-bold text-2xl mb-2 text-gray-800">Lo que aprenderas</h1>

                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                        @forelse ($course->goals as $goal)
                            <li class="text-gray700 text-base"><i class="fas fa-check text-gray-600 mr-2"></i>{{$goal->name}}</li>
                        @empty
                            <li class="text-gray700 text-base">Este curso no tiene ninguna meta asignada</li>
                        @endforelse
                    </ul>
                </div>
            </section>

            {{--  TEMARIO  --}}
            <section class="mb-12">
                <h1 class="font-bold text-3xl mb-2 text-gray-800">Temario</h1>

                @forelse ($course->sections as $section)

                    <article class="mb-4 shadow" 
                        @if ($loop->first)
                            x-data="{ open: true }"
                        @else
                            x-data="{ open: false }"
                        @endif
                    >

                        <header class="border border-gray-200 px-4 py-2 cursor-pointer bg-gray-200" x-on:click="open = !open">
                            <h1 class="text-lg text-gray-600">{{$section->name}}</h1>
                        </header>

                        <div class="bg-white py-2 px-4" x-show="open">
                            <ul>
                                @foreach ($section->lessons as $lesson)
                                    <li class="text-gray-700 text-base mb-2"><li class="fas fa-play-circle mr-2 text-gray-600"></li>{{$lesson->name}}</li>
                                @endforeach
                            </ul>
                        </div>

                    </article>
                @empty
                    <article class="card">
                        <div class="card-body">
                            Este curso no tiene ninguna sección asignada
                        </div>
                    </article>
                @endforelse
            </section>

            {{--  REQUISITOS  --}}
            <section class="mb-8">
                <h1 class="font-bold text-3xl text-gray-800">Requisitos</h1>

                <ul class="list-disc list-inside">
                    @forelse ($course->requirements as $requirement)
                        <li class="text-gray-700 text-base">{{$requirement->name}}</li>
                    @empty
                        <li class="text-gray-700 text-base">Este curso no tiene ningun requerimiento asignado</li>
                    @endforelse
                </ul>
            </section>

            {{--  DESCRIPCION  --}}
            <section>
                <h1 class="font-bold text-3xl text-gray-800">Descripción</h1>

                <div class="text-gray-700 text-base">
                    {!!$course->description!!}
                </div>
            </section>

        </div>

        <div class="order-1 lg:order-2">
            <section class="card mb-4">
                <div class="card-body">

                    <x-teacher-card :course="$course" />

                    <form action="{{route('admin.courses.approved', $course)}}" class="mt-4" method="POST">
                        @csrf

                        <button class="btn btn-primary w-full" type="submit">Aprobar curso</button>
                    </form>

                    <a href="{{route('admin.courses.observation', $course)}}" class="btn btn-danger w-full block text-center mt-4">Observar curso</a>

                </div>
            </section>

        </div>
    </div>
</x-app-layout>