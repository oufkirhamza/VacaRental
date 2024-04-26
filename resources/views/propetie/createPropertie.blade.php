@extends('layouts.index')
@section('content')
    <div class="flex flex-col items-center">
        <div class="shadow-lg w-[35%] my-5 py-7 px-5">
            <form class="flex flex-col gap-2 " enctype="multipart/form-data" action="{{ route('propertie.store') }}"
                method="POST">
                @csrf
                <div class="flex flex-col">
                    <input class="rounded-lg" type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                    <label for="">Title</label>
                    <input class="rounded-lg" type="text" name="title">
                </div>
                <div class="flex flex-col">
                    <label for="">Description</label>
                    <textarea name="description" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="flex flex-col">
                    <label for="">Location</label>
                    <input class="rounded-lg" type="text" name="location">
                </div>
                <div class="flex flex-col">
                    <label for="">City</label>
                    <input class="rounded-lg" type="text" name="city">
                </div>
                <div class="flex flex-col">
                    <label for="">Price per night</label>
                    <input class="rounded-lg" type="number" name="price_per_night">
                </div>
                <div class="flex flex-col">
                    <label for="">Max guest</label>
                    <input class="rounded-lg" type="number" name="max_guest">
                </div>
                <div class="grid w-full max-w-xs items-center gap-1.5">
                    <label class="peer-disabled:cursor-not-allowed peer-disabled:opacity-70">Picture</label>
                    <input multiple name="image[]" type="file"
                        class="flex h-10  w-full rounded-md border border-input bg-white px-3 py-2 text-sm text-gray-400 file:border-0 file:bg-transparent file:text-gray-600 file:text-sm file:font-medium">
                </div>
                <button class="px-3 mt-4 w-fit rounded-lg py-2 bg-blue-400">create</button>
            </form>
        </div>

        {{-- @foreach ($properties as $propertie)
            @php
                $images = json_decode($propertie->image);
            @endphp
            @foreach ($images as $img)
                <img src="{{ asset('storage/img/' . $img) }}" alt="">
            @endforeach
        @endforeach --}}
    </div>
@endsection
