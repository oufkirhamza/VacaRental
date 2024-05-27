@extends('layouts.index')
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const propertyId = {{ $propertie->id }};
            // console.log(propertyId);
            const response = await axios.get(`/reservation/show/${propertyId}`);
            // console.log(response);
            const events = response.data.events;
            // console.log(events);

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // object below should be in this arrangement
                headerToolbar: {
                    left: 'dayGridMonth',
                    center: 'title',
                    // right: 'listMonth,listWeek,listDay'
                },
                views: {
                    listDay: { // Customize the name for listDay
                        buttonText: 'Day Events',
                    },
                    listWeek: { // Customize the name for listWeek
                        buttonText: 'Week Events',
                    },
                    listMonth: { // Customize the name for listMonth
                        buttonText: 'Month Events',
                    },
                    timeGridWeek: {
                        buttonText: 'Week', // Customize the button text
                    },
                    timeGridDay: {
                        buttonText: "Day",
                    },
                    dayGridMonth: {
                        buttonText: "Month",
                    },
                },
                initialView: "dayGridMonth",
                selectable: true,
                selectMirror: true,
                nowIndicator: true,
                selectOverlap: true,
                weekends: true,
                events: events,
                selectOverlap: function(events) {
                    return events.display === 'background';
                },

                selectAllow: (info) => {
                    let momento = new Date()
                    return info.start > momento
                },
                select: (info) => {
                    let start = info.start
                    let end = info.end

                    document.getElementById("modalConfirm").click()
                    const formatdate = (date) => {
                        let year = String(date.getFullYear())
                        let month = String(date.getMonth() + 1).padStart(2, 0)
                        let day = String(date.getDate()).padStart(2, 0)
                        let hour = String(date.getHours()).padStart(2, 0)
                        let min = String(date.getMinutes()).padStart(2, 0)
                        let sec = String(date.getSeconds()).padStart(2, 0)
                        return {
                            day: `${year}-${month}-${day}`,
                            time: `${hour}:${min}:${sec}`
                        }
                    }
                    document.getElementById('start-date').value = formatdate(start).day
                    document.getElementById('end-date').value = formatdate(end).day
                },
            });
            calendar.render();
        });
    </script>

    <div class="sm:p-10 flex sm:w-[100%] py-5 items-center justify-center flex-col gap-2 bg-gray-200">
        {{--  --}}
        <div class="container mx-auto sm:px-5 py-2 lg:px-32 lg:pt-24">
            {{-- phone --}}
            <div class="sm:hidden grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach ($propertie->images as $image)
                    <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                        src="{{ asset('storage/img/' . $image->image) }}" />
                @endforeach
            </div>
            {{-- desktop --}}
            <div class="hidden -m-1 sm:flex flex-wrap md:-m-2">
                <div class="flex w-1/2 flex-wrap">
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="{{ asset('storage/img/' . $propertie->images[0]->image) }}" />
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        @if (count($propertie->images) > 1)
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/img/' . $propertie->images[1]->image) }}" />
                        @else
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/img/' . $propertie->images[0]->image) }}" />
                        @endif
                    </div>
                    <div class="w-full p-1 md:p-2">
                        @if (count($propertie->images) > 2)
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/img/' . $propertie->images[2]->image) }}" />
                        @else
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/img/' . $propertie->images[0]->image) }}" />
                        @endif
                    </div>
                </div>
                <div class="flex w-1/2 flex-wrap">
                    <div class="w-full p-1 md:p-2">
                        @if (count($propertie->images) > 3)
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/img/' . $propertie->images[3]->image) }}" />
                        @else
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/img/' . $propertie->images[0]->image) }}" />
                        @endif
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        @if (count($propertie->images) > 4)
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/img/' . $propertie->images[4]->image) }}" />
                        @else
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/img/' . $propertie->images[0]->image) }}" />
                        @endif
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        @if (count($propertie->images) > 5)
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/img/' . $propertie->images[5]->image) }}" />
                        @else
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/img/' . $propertie->images[0]->image) }}" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="flex sm:flex-row flex-col w-full justify-between sm:items-start mt-5   gap-2 px-2">
            <div class="sm:w-[50%] flex flex-col gap-2 border-r-2 bg-white px-4 rounded-sm">
                <div
                    class=" {{ $propertie->user->name == Auth::user()->name ? 'hidden' : '' }}   w-full px-2 flex flex-col gap-3 py-3 border-b-2 border-gray-200 pb-10">
                    <h1 class="text-2xl font-bold">Owner</h1>
                    <div class="flex justify-between items-center">
                        <p class="text-xl"><i class="fa-solid fa-user mr-2"></i>{{ $propertie->user->name }}</p>
                        <a href="/chatify/{{ $propertie->user->id }}">
                            <button
                                class="select-none  bg-[#002e45] py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-900/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                Contact
                            </button>
                        </a>
                    </div>
                </div>
                <div class="  w-full px-2 flex flex-col gap-3 py-3 border-b-2 border-gray-200 pb-10">
                    <div class="flex justify-between  w-full items-center ">
                        <h1 class="text-2xl font-bold">{{ $propertie->title }}</h1>
                        <div class="flex gap-2 w-fit mr-2">
                            <h1>{{ $rating }} <i class="fa-solid fa-star text-yellow-400"></i> ({{ $numReviews }}
                                reviews)</h1>
                        </div>
                    </div>
                    <p class="text-xl"><i class="fa-solid fa-location-dot mr-2"></i><span>Adress : </span>
                        {{ $propertie->location }}</p>
                    <p class="text-xl"> <i class="fa-solid fa-users mr-2"></i><span>Max guest : </span>
                        {{ $propertie->max_guest }}</p>
                    <h1 class="text-xl"> <i class="fa-solid fa-money-bill mr-2"></i>Price per night :
                        {{ $propertie->price_per_night }} </h1>
                </div>
                <div class="  w-full px-2 flex flex-col gap-3 py-3 border-b-2 border-gray-200 pb-10">
                    <h1 class="text-2xl font-bold">Description : </h1>
                    <p class="text-xl">{{ $propertie->description }}</p>
                </div>
                <div class="  w-full px-2 flex flex-col gap-3 py-3">
                    <h1 class="text-2xl font-bold">Reviews</h1>
                    {{-- <h1 class="text-4xl font-bold">9/10</h1> --}}
                    @foreach ($latestReviews as $review)
                        <div class="border p-1 bg-white rounded-lg">
                            <div class="flex gap-2 font-bold p-3">
                                <svg xml:space="preserve" style="enable-background: new 0 0 16 16" viewBox="0 0 16 16"
                                    y="0px" x="0px" id="Layer_1_1_" version="1.1" class="avatar">
                                    <path d="M12,9H8H4c-2.209,0-4,1.791-4,4v3h16v-3C16,10.791,14.209,9,12,9z"></path>
                                    <path d="M12,5V4c0-2.209-1.791-4-4-4S4,1.791,4,4v1c0,2.209,1.791,4,4,4S12,7.209,12,5z">
                                    </path>
                                </svg>
                                <h5> {{ $review->user->name }}</h5>
                            </div>
                            <p class="pl-12">{{ $review->description }}</p>
                        </div>
                    @endforeach
                    <div class="py-2 {{ $propertie->user->name == Auth::user()->name ? 'hidden' : '' }}">
                        <form action="{{ route('review.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="propertie_id" value="{{ $propertie->id }}">
                            <div class="rating mb-2 ">
                                <input value="5" name="rating" id="star5" type="radio">
                                <label title="text" for="star5"></label>
                                <input value="4" name="rating" id="star4" type="radio">
                                <label title="text" for="star4"></label>
                                <input value="3" name="rating" id="star3" type="radio" checked="">
                                <label title="text" for="star3"></label>
                                <input value="2" name="rating" id="star2" type="radio">
                                <label title="text" for="star2"></label>
                                <input value="1" name="rating" id="star1" type="radio">
                                <label title="text" for="star1"></label>
                            </div>
                            <textarea name="description" id="" class="w-full p-5 rounded-md bg-gray-50"
                                placeholder="Enter your Comment" rows="5"></textarea>
                            <button
                                class="select-none rounded-lg bg-[#002e45] py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-900/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Submit
                                Review</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="sm:w-[50%] flex flex-col gap-6 bg-white rounded-sm p-5">
                <div id='calendar' class="h-[75vh]"></div>
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14260.278375030784!2d-1.8726392922554729!3d38.102153159164104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd65ad0d625cc5bb%3A0x1ebcd51e92bfaacf!2sTurismo%20Caravaca!5e0!3m2!1sfr!2sma!4v1716681176611!5m2!1sfr!2sma" class="w-full" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            @include('propetie.reservation_modal')
        </div>



    </div>
@endsection
