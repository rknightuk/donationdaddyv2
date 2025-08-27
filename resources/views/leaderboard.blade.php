@extends('layouts.app')

@section('title', 'Be a Donation Daddy Today!')

@section('content')

    @foreach ($campaigns as $index => $n)
        <a class="sj-container" href="{{ $n->url }}" target="_blank">
            <p class="sj-title" style="margin-top: 0px; margin-bottom: 5px; font-weight: bold;overflow: hidden;">
                {{ $index + 1 }}. {{ $n->name }} @if ($n->username) / {{ '@' . $n->username }}@endif<br style="margin-bottom:5px;"></p>
            <div style="position: relative; height: 25px; background: rgba(189, 195, 199, 0.6); border-radius: 15px;">
                <div class="sj-progress" style="width: {{ $n->percentage }}%;"></div>
                <div class="sj-progress-text">{{ '$' . $n->raised }} • {{ $n->percentage }}%</div>
            </div>
        </a>
    @endforeach

@endsection
