@extends('layouts.index')
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', async function() {

            // const {
            //     data
            // } = await axios.get("/calendar/show")

            // const events = data.events;

            // console.log(data);

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // object below should be in this arrangement
                headerToolbar: {
                    left: 'dayGridMonth,timeGridWeek,timeGridDay',
                    center: 'title',
                    right: 'listMonth,listWeek,listDay'
                },
                views: {
                    listDay: { // Customize the name for listDay
                        buttonText: 'Day Events',
                    },
                    listWeek: { // Customize the name for listWeek
                        buttonText: 'Week Events'
                    },
                    listMonth: { // Customize the name for listMonth
                        buttonText: 'Month Events'
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
                initialView: "timeGridWeek",
                selectable: true,
                selectMirror: true,
                nowIndicator: true,
                selectOverlap: true,
                weekends: true,
                events: events,
                // slotMinTime: "09:00:00", 
                // slotMaxTime: "19:00:00",

                selectAllow: (info) => {
                    let momento = new Date()
                    return info.start > momento
                },
                select: (info) => {
                    let start = info.start
                    let end = info.end
                    if (end.getDate() - start.getDate() > 0 && !info.allDay) {
                        calendar.unselect()
                        return
                    }
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
                    document.getElementById('start-time').value = formatdate(start).time
                    document.getElementById('end-date').value = formatdate(end).day
                    document.getElementById('end-time').value = formatdate(end).time
                },
            });
            calendar.render();

        });
    </script>

    {{-- <h1> Hello {{ $place->title }}</h1> --}}
    <div class="p-10 flex flex-col gap-2">
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                {{-- @foreach ($properties as $propertie) --}}
                @php
                    $images = json_decode($place->image);
                @endphp
                @foreach ($images as $img)
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('storage/img/' . $img) }}"
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
        <div>
            <div class="border rounded-lg w-[30%] px-1 py-3">
                <div class="flex justify-between w-full items-center">
                    <h1 class="text-2xl font-bold">{{ $place->title }}</h1>
                    <h1><i class="fa-solid fa-star text-yellow-400"></i> 3,5</h1>
                    <p>{{ $place->member }}</p>
                </div>
                <p class="text-xl"><span>Description : </span> {{ $place->description }}</p>
                <p class="text-xl"><span>Adress : </span> {{ $place->location }}</p>
                <p class="text-xl"><span>max guest : </span> {{ $place->max_guest }}</p>
                <h1 class="text-xl"> Price per night : {{ $place->price_per_night }} </h1>
            </div>
            <div>
                <div id='calendar'></div>
            </div>
        </div>
    </div>
@endsection
