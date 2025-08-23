@extends('layouts.app')

@section('title', 'Be a Donation Daddy Today!')

@section('content')

    <style>
        #contain-single {
            display: none;
        }

        #single:checked ~ #contain-single {
            display: block;
        }

        #contain-set {
            display: none;
        }

        #set:checked ~ #contain-set {
            display: block;
        }

        #coin-wrap {
            text-align: center;
        }

        #contain-single,
        #contain-set {
            margin-top: 10px;
        }

        .sj-container {
            text-align: left;
        }
    </style>
    @if ($countSingle > 0)<p class="center"><strong>{{ $countSingle }} people have raised enough for a coin!</strong></p>@endif

    @if ($countSet > 0)<p class="center"><strong>{{ $countSet }} people have raised enough for the host coin set!</strong></p>@endif

    <div id="coin-wrap">

        <input type="radio" id="single" name="cointype" value="single" checked />
        <label for="single">Needs a coin</label>

        <input type="radio" id="set" name="cointype" value="set" />
        <label for="set">Needs a host set</label>

        <div id="contain-single">

            @foreach ($singles as $single)
                <a class="sj-container" href="{{ $single->url }}" target="_blank">
                    <p class="sj-title" style="margin-top: 0px; margin-bottom: 5px; font-weight: bold;overflow: hidden;">{{ $single->name }}<br style="margin-bottom:5px;"></p>
                </a>
            @endforeach
        </div>

        <div id="contain-set">
            @foreach ($sets as $set)
                <a class="sj-container" href="{{ $set->url }}" target="_blank">
                    <p class="sj-title" style="margin-top: 0px; margin-bottom: 5px; font-weight: bold;overflow: hidden;">
                        {{ $set->name }}<br style="margin-bottom:5px;"></p>
                    <p class="sj-subtitle" style="margin-top: 0px; margin-bottom: 10px;">${{ number_format(100 - $set->raised, 2) }} needed</p>
                    <div style="position: relative; height: 25px; background: rgba(189, 195, 199, 0.6); border-radius: 15px;">
                        <div class="sj-progress" style="width: {{ $set->percentage }}%;"></div>
                        <div class="sj-progress-text">{{ '$' . $set->raised }} • {{ $set->percentage }}%</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
