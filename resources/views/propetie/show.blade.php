@extends('layouts.index')
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const propertyId = {{ $propertie->id }};
            // console.log(propertyId);
            const response = await axios.get(`/reservation/show/${propertyId}`);
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
                // slotMinTime: "09:00:00",
                // slotMaxTime: "19:00:00",

                selectAllow: (info) => {
                    let momento = new Date()
                    return info.start > momento
                },
                select: (info) => {
                    let start = info.start
                    let end = info.end
                    // if (end.getDate() - start.getDate() > 0 && !info.allDay) {
                    //     calendar.unselect()
                    //     return
                    // }
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
                    // document.getElementById('start-time').value = formatdate(start).time
                    document.getElementById('end-date').value = formatdate(end).day
                    // document.getElementById('end-time').value = formatdate(end).time
                },
            });
            calendar.render();
        });
    </script>

    {{-- <h1> Hello {{ $place->title }}</h1> --}}
    @include('propetie.reservation_modal')
    <div class="p-10 flex flex-col gap-2">
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                {{-- @foreach ($properties as $propertie) --}}
                {{-- @php
                    $images = json_decode($propertie->image);
                @endphp --}}
                @foreach ($propertie->images as $img)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('storage/img/' . $img->image) }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    </div>
                @endforeach
                {{-- @endforeach --}}
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        <div class="flex justify-between items-start bg-black">
            <div class="w-[50%] flex flex-col gap-2 bg-red-400">
                <div class="border rounded-lg w-full px-2 flex flex-col gap-3 py-3">
                    <div class="flex justify-between w-full items-center bg-green-400">
                        <h1 class="text-2xl font-bold">{{ $propertie->title }}</h1>
                        <div class="flex gap-2 w-[30%]">
                            <h1>{{ $rating }} <i class="fa-solid fa-star text-yellow-400"></i> ({{ $numReviews }} reviews)</h1>
                        </div>
                    </div>
                    <p class="text-xl"><span>Description : </span> {{ $propertie->description }}</p>
                    <p class="text-xl"><span>Adress : </span> {{ $propertie->location }}</p>
                    <p class="text-xl"><span>max guest : </span> {{ $propertie->max_guest }}</p>
                    <h1 class="text-xl"> Price per night : {{ $propertie->price_per_night }} </h1>
                </div>
                <div class="border rounded-lg w-full px-2 flex flex-col gap-3 py-3">
                    <h1>Review</h1>
                    {{-- <h1 class="text-4xl font-bold">9/10</h1> --}}
                    @foreach ($latestReviews as $review)
                    <div class="border p-1 rounded-lg">
                        <div class="flex gap-2 font-bold">
                            <svg class="w-8 h-8 text-[#3788D8] -left-1 bg-gray-300 rounded-full p-2" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>
                            <h5> {{ $review->user->name }}</h5>
                        </div>
                        <p class="pl-10">{{ $review->description }}</p>
                    </div>
                    @endforeach

                    
                    <div class="py-2">
                        <form action="{{ route('review.store') }}" method="POST">
                            @csrf
                            <div class="rating mb-2">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="propertie_id" value="{{ $propertie->id  }}">    
                                <input type="radio" id="star-1" name="rating" value="5">
                                <label for="star-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path pathLength="360"
                                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                        </path>
                                    </svg>
                                </label>
                                <input type="radio" id="star-2" name="rating" value="4">
                                <label for="star-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path pathLength="360"
                                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                        </path>
                                    </svg>
                                </label>
                                <input type="radio" id="star-3" name="rating" value="3">
                                <label for="star-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path pathLength="360"
                                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                        </path>
                                    </svg>
                                </label>
                                <input type="radio" id="star-4" name="rating" value="2">
                                <label for="star-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path pathLength="360"
                                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                        </path>
                                    </svg>
                                </label>
                                <input type="radio" id="star-5" name="rating" value="1">
                                <label for="star-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path pathLength="360"
                                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z">
                                        </path>
                                    </svg>
                                </label>
                            </div>
                            <textarea name="description" id="" class="w-full p-5 rounded-md bg-gray-100"
                                placeholder="Enter your Comment" rows="5"></textarea>
                            <button class="bg-blue-800 text-white px-3 py-2 rounded-lg">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w-[50%] p-5">
                <div id='calendar'></div>
            </div>
        </div>



    </div>
@endsection
