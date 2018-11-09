@extends('layouts.app')

@section('content')
    @include('cabinet.adverts._nav')
    @if ($region)
        <p>
            <a href="{{ route('cabinet.adverts.create.advert', [$region]) }}" class="btn btn-success">Add Advert for {{ $region->name }}</a>
        </p>
    @endif
    <p>Or choose nested region:</p>
    <ul>
        @foreach ($regions as $current)
            <li>
                <a href="{{ route('cabinet.adverts.create.region', [$current]) }}">{{ $current->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection