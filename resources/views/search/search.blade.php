@extends('layouts.index')
@section('content')
    <h1>Search Results</h1>

    @if (count($results) > 0)
        <ul>
            @foreach ($results as $property)
                <li>
                    <a href="{{ route('property.show', $property->id) }}"> {{ $property->title }} - {{ $property->location }}
                        ({{ $property->city }}) </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No results found for your search.</p>
    @endif
@endsection
