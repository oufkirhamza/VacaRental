@extends('layouts.index')
@section('content')
    <div class="flex py-12 flex-wrap bg-gray-200 justify-center min-h-[50vh] gap-10 sm:gap-4">
        @if ($properties->count() == 0)
            <h1 class="text-xl">Create you Propertie card</h1>
        @endif
        @foreach ($properties as $propertie)
            <div class="relative flex w-80  flex-col rounded-xl h-fit bg-white bg-clip-border text-gray-700 shadow-md">
                <div
                    class="relative mx-4 -mt-6 h-40 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 bg-gradient-to-r from-blue-500 to-blue-600">
                    @foreach ($propertie->images as $image)
                        <img src="{{ asset('storage/img/' . $image->image) }}" alt="">
                    @endforeach
                </div>
                <div class="p-6 font-medium">
                    <div class="flex justify-between">
                        <h5
                            class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                            {{ $propertie->title }}
                        </h5>
                        <h5><i class="fa-solid fa-star text-yellow-300"></i> {{ $ratings[$propertie->id] }} (
                            {{ $numReviewsArray[$propertie->id] }}
                            reviews) </h5>
                    </div>
                    <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                        <i class="fa-solid fa-location-dot"></i>
                        {{ $propertie->location }}, {{ $propertie->city }}
                    </p>
                    <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                        <i class="fa-solid fa-people-group"></i>
                        {{ $propertie->max_guest }} travelers
                    </p>
                    <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                        <i class="fa-solid fa-money-bill"></i>
                        {{ $propertie->price_per_night }} $
                    </p>
                </div>
                <div class="p-6 pt-0 flex gap-2">
                    <form action="{{ route('propertie.destroy', $propertie) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            class="select-none rounded-lg bg-red-900 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-900/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            Delete
                        </button>
                    </form>
                    <button data-ripple-light="true" type="button"
                        class="select-none rounded-lg bg-[#002e45] py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-900/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        <a href="{{ route('propertie.show', $propertie) }}">Details</a>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@endsection
