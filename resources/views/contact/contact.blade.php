@extends('layouts.index')
@section('content')
    <div class="w-full h-screen">
        <div class="flex items-center bg-gray-200 justify-center p-12">
            <div class="mx-auto w-full max-w-[550px] bg-white p-4 rounded-lg">
                <form action="{{ route('contact.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="mb-5">
                        <label for="subject" class="mb-3 block text-base font-medium text-[#07074D]">
                            Subject
                        </label>
                        <input type="text" name="subject" id="subject" placeholder="Enter your subject"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="message" class="mb-3 block text-base font-medium text-[#07074D]">
                            Message
                        </label>
                        <textarea rows="4" name="message" id="message" placeholder="Type your message"
                            class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                    </div>
                    <div>
                        <button
                            class="hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white outline-none">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
