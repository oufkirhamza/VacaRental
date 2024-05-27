@extends('layouts.index')
@section('content')
    <div>
        <div class="hero_home">
            <div class="bg-[#0a1f4696] relative w-full flex justify-center items-center h-[50vh]">
                <img class="w-[150px] absolute right-0 bottom-0 " src="{{ asset('images/logo.png') }}" alt="">
                <h1 class="sm:text-4xl font-bold text-2xl sm:w-[100%] w-[60%] text-center text-white ">Discover Your Ideal
                    Vacation Retreat: Find, Rent, and Enjoy! </h1>
            </div>
        </div>
    </div>
    <div class="py-16 flex flex-col gap-4 bg-gray-200">
        <div class="flex flex-wrap justify-center sm:gap-4 gap-10">

            @foreach ($firstProperties as $propertie)
                <div class="relative flex w-80 flex-col  rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                    <div
                        class="relative mx-4 -mt-6 h-40 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 bg-gradient-to-r from-blue-500 to-blue-600">
                        @foreach ($propertie->images as $image)
                            <img src="{{ asset('storage/img/' . $image->image) }}" alt="">
                        @endforeach
                    </div>
                    <div class="p-6 font-medium">
                        <div class="flex flex-col justify-between">
                            <h5
                                class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                                {{ $propertie->title }}
                            </h5>
                            <div class="flex justify-between">
                                <p><i class="fa-solid fa-star text-yellow-300"></i> {{ $ratings[$propertie->id] }}</p>
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
        </div>
        <div class="w-full flex justify-center">
            <a href="/search">
                <button type="button"
                    class="select-none rounded-lg bg-[#002e45] py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-900/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    All properties
                </button>
            </a>
        </div>
    </div>

    <div class="bg-[#002e45] w-full flex flex-col justify-center items-center py-16">
        <h1 class="text-2xl text-white font-bold">How It Works</h1>
        <p class="text-xl text-white">Follow these 3 steps to book your place</p>
        <div class="flex gap-5 sm:flex-row flex-col justify-center items-center">
            <div
                class="flex items-center my-4  gap-2 bg-white flex-col justify-center sm:w-[25%] w-[80%] text-center rounded-lg p-4 ">
                <div class="w-20 h-20 bg-[#6C60FE] rounded-full flex justify-center items-center text-white text-2xl">
                    <i class="fa-regular fa-map"></i>
                </div>
                <div class="ml-4">
                    <h1 class="font-bold">01. Search for Location</h1>
                    <p>Explore various locations and find the perfect place for your stay.</p>
                </div>
            </div>
            <div
                class="flex items-center my-4 gap-2 bg-white flex-col justify-center sm:w-[25%] w-[80%] text-center rounded-lg p-4 ">
                <div class="w-20 h-20 bg-[#6C60FE] rounded-full flex justify-center items-center text-white text-2xl">
                    <i class="fa-regular fa-calendar"></i>
                </div>
                <div class="ml-4">
                    <h1 class="font-bold">02. Select Dates</h1>
                    <p>Choose your desired check-in and check-out dates.</p>
                </div>
            </div>
            <div
                class="flex items-center my-4 gap-2 bg-white flex-col justify-center sm:w-[25%] w-[80%] text-center rounded-lg p-4 ">
                <div class="w-20 h-20 bg-[#6C60FE] rounded-full flex justify-center items-center text-white text-2xl">
                    <i class="fa-regular fa-handshake"></i>
                </div>
                <div class="ml-4">
                    <h1 class="font-bold">03. Confirm Booking</h1>
                    <p>Complete your booking and enjoy your stay!</p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white flex flex-col justify-center gap-6 items-center w-full py-16">
        <div class="sm:w-[30%] text-[#002e45] text-center px-3">
            <h1 class="text-3xl font-bold mb-2">Hundreds of Partners Around the World</h1>
            <p>Every day, we build trust through communication, transparency, and results.</p>
        </div>
        <div class="w-full flex sm:flex-row flex-col justify-center items-center mr-5 gap-5">
            <div class="bg-gray-200 rounded-lg p-2">
                <img src="{{ asset('images/partner-icon-2.svg') }}" alt="">
            </div>
            <div class="bg-gray-200 rounded-lg p-2">
                <img src="{{ asset('images/partner-icon-3.svg') }}" alt="">
            </div>
            <div class="bg-gray-200 rounded-lg p-2">
                <img src="{{ asset('images/partner-icon-4.svg') }}" alt="">
            </div>
            <div class="bg-gray-200 rounded-lg p-2">
                <img src="{{ asset('images/partner-icon-5.svg') }}" alt="">
            </div>
            <div class="bg-gray-200 rounded-lg p-2">
                <img src="{{ asset('images/partner-icon-6.svg') }}" alt="">
            </div>
        </div>

    </div>
    <div class="bg-[#002e45] flex sm:flex-row flex-col w-full py-16">
        <div class="sm:w-[40%] text-white px-3">
            <h1 class="text-3xl mb-2">Explore Property Type</h1>
            <p>Discover a diverse range of rental properties for your next stay. Browse through houses, apartments, and
                villas available for rent. Find your ideal accommodation among listings created by property owners.</p>
        </div>
        <div class="sm:w-[60%] flex sm:flex-row flex-col items-center justify-center mr-5 gap-5">
            <div
                class="bg-white sm:w-[20%] w-[80%] rounded-lg min-h-[27vh] flex flex-col justify-center items-center gap-5 ">
                <img src="{{ asset('images/property-icon-1.svg') }}" alt="">
                <h1 class="text-xl font-bold">Houses</h1>
                <p>30 properties</p>
            </div>
            <div
                class="bg-white sm:w-[20%] w-[80%] rounded-lg min-h-[27vh] flex flex-col justify-center items-center gap-5 ">
                <img src="{{ asset('images/property-icon-4.svg') }}" alt="">
                <h1 class="text-xl font-bold">Houses</h1>
                <p>30 properties</p>
            </div>
            <div
                class="bg-white sm:w-[20%] w-[80%] rounded-lg min-h-[27vh] flex flex-col justify-center items-center gap-5 ">
                <img src="{{ asset('images/property-icon-3.svg') }}" alt="">
                <h1 class="text-xl font-bold">Houses</h1>
                <p>30 properties</p>
            </div>
        </div>
    </div>


    </div>
@endsection
