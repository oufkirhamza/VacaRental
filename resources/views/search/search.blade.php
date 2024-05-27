@extends('layouts.index')
@section('content')
    <div class="bg-gray-200">
        <div class="hero_search">
            <div class="bg-[#0a1f4696] w-full flex justify-center items-center h-[50vh]">
                <h1 class="text-4xl font-bold text-white">Unlock Your Next Adventure: Explore Unique Vacation Rentals!</h1>
            </div>
        </div>

        <div class="flex flex-col py-3 items-center ">
            <div class="sticky top-0 bg-gray-200 z-30 flex items-center justify-start w-full pl-[10vw] py-3">
                <h1 class="text-2xl font-bold mb-2">Search</h1>
                {{-- title --}}
                <form class="flex  ">
                    {{-- <label for="search">Search by title :</label> --}}
                    <div class="flex w-fit mx-10 rounded bg-white">
                        <input class=" w-full border-none bg-transparent px-4 py-1  outline-none focus:outline-none "
                            type="search" name="search" placeholder="Title" />
                        <button type="submit" class="m-2 rounded bg-blue-600 px-4 py-2 text-white">
                            <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                                xml:space="preserve" width="512px" height="512px">
                                <path
                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                        </button>
                    </div>
                </form>
                {{-- city --}}
                <form class="flex">
                    {{-- <label for="search">Search by title :</label> --}}
                    <div class="flex w-fit mx-10 rounded bg-white">
                        <input class=" w-full border-none bg-transparent px-4 py-1  outline-none focus:outline-none "
                            type="search" name="city" placeholder="City" />
                        <button type="submit" class="m-2 rounded bg-blue-600 px-4 py-2 text-white">
                            <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                                xml:space="preserve" width="512px" height="512px">
                                <path
                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                        </button>
                    </div>
                </form>
                {{-- reset --}}
                <form >
                    <input type="hidden" name="city"/>
                    <button class="m-2 rounded bg-blue-600 px-4 py-3 text-white">Reset</button>
                </form>
            </div>
            <div class="flex w-[90%] justify-start h-fit flex-wrap py-16 ml-10 gap-4">
                @if (count($properties) > 0)
                    @foreach ($properties as $propertie)
                        <div
                            class="relative flex w-[23%] mb-10 flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                            <div
                                class="relative mx-4 -mt-6 h-40 overflow-hidden rounded-xl  bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 bg-gradient-to-r from-blue-500 to-blue-600">
                                <img src="{{ asset('storage/img/' . $propertie->images[0]->image) }}" alt="">
                            </div>
                            <div class="p-6 font-medium">
                                <div class="flex flex-col justify-between">
                                    <h5
                                        class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                        {{ $propertie->title }}
                                    </h5>
                                    <div class="flex justify-between">
                                        <p><i class="fa-solid fa-star text-yellow-300"></i> {{ $ratings[$propertie->id] }}
                                        </p>
                                        <p>({{ $numReviewsArray[$propertie->id] }} reviews)</p>
                                    </div>
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
                            <div class="p-6 pt-0">
                                <a href="{{ route('propertie.show', $propertie) }}">
                                    <button data-ripple-light="true" type="button"
                                        class="select-none rounded-lg bg-[#002e45] py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-900/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                        Book now
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No results found for your search.</p>
                @endif
            </div>
        </div>

    </div>
@endsection
