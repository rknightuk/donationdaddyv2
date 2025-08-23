@extends('layouts.app')

@section('content')

    <div class="featured-image">
        <img src="/icons/{{ $assetpath }}/{{ $image }}">
    </div>

    @if ($count > 0)<p class="center"><strong>{{ $count}} people have raised enough for a {{ $item }}!</strong></p>@endif

    @foreach ($need as $n)
        <a class="sj-container" href="{{ $n->url }}" target="_blank">
            <p class="sj-title" style="margin-top: 0px; margin-bottom: 5px; font-weight: bold;overflow: hidden;">
                {{ $n->name }}<br style="margin-bottom:5px;"></p>
            <p class="sj-subtitle" style="margin-top: 0px; margin-bottom: 10px;">${{ number_format($limit - $n->raised, 2) }} needed</p>
            <div style="position: relative; height: 25px; background: rgba(189, 195, 199, 0.6); border-radius: 15px;">
                <div class="sj-progress" style="width: {{ $n->percentage }}%;"></div>
                <div class="sj-progress-text">{{ '$' . $n->raised }} • {{ $n->percentage }}%</div>
            </div>
        </a>
    @endforeach
@endsection
