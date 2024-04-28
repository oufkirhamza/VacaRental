@extends('layouts.index')
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const propertyId = {{ $propertie->id }};
            // console.log(propertyId);
            const response = await axios.get(`/reservation/show/${propertyId}`);
            console.log(response);
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

    @include('propetie.reservation_modal')
    <div class="p-10 flex flex-col gap-2 bg-gray-200">
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                @foreach ($propertie->images as $img)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('storage/img/' . $img->image) }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                    </div>
                @endforeach

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
        <div class="flex justify-between items-start gap-2 ">
            <div class="w-[50%] flex flex-col gap-2 ">
                <div class="border rounded-lg w-full px-2 flex flex-col gap-3 py-3 bg-white">
                    <div class="flex justify-between  w-full items-center ">
                        <h1 class="text-2xl font-bold">{{ $propertie->title }}</h1>
                        <div class="flex gap-2 w-fit mr-2">
                            <h1>{{ $rating }} <i class="fa-solid fa-star text-yellow-400"></i> ({{ $numReviews }}
                                reviews)</h1>
                        </div>
                    </div>
                    <p class="text-xl"><span>Adress : </span> {{ $propertie->location }}</p>
                    <p class="text-xl"><span>max guest : </span> {{ $propertie->max_guest }}</p>
                    <h1 class="text-xl"> Price per night : {{ $propertie->price_per_night }} </h1>
                </div>
                <div class="border rounded-lg w-full px-2 flex flex-col gap-3 py-3 bg-white">
                    <h1 class="text-2xl font-bold">Description : </h1>
                    <p class="text-xl">{{ $propertie->description }}</p>
                </div>
                <div class="border rounded-lg w-full px-2 flex flex-col gap-3 py-3 bg-white">
                    <h1 class="text-2xl font-bold">Reviews</h1>
                    {{-- <h1 class="text-4xl font-bold">9/10</h1> --}}
                    @foreach ($latestReviews as $review)
                        <div class="border p-1 rounded-lg">
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


                    <div class="py-2">
                        <form action="{{ route('review.store') }}" method="POST">
                            @csrf
                            <div class="rating mb-2">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="propertie_id" value="{{ $propertie->id }}">
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
                            <textarea name="description" id="" class="w-full p-5 rounded-md bg-gray-50" placeholder="Enter your Comment"
                                rows="5"></textarea>
                            <button class="bg-blue-800 text-white px-3 py-2 rounded-lg">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w-[50%] bg-white rounded-lg p-5">
                <div id='calendar'></div>
            </div>
        </div>



    </div>
@endsection
