@extends('layouts.app')

@section('content')

    <style>
        .reward-wrap {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
        }

        .reward-box {
            background: #FDE18C;
            padding: 10px;
            border: 2px solid #FFC52C;
            text-align: center;
        }

        .reward-image {
            margin-bottom: 10px;
        }

        .reward-image img {
            max-height: 100px;
        }
    </style>

    <div class="reward-wrap">
    @foreach($rewards as $reward)
        <div class='reward-box'>
            <div class='reward-image flex'><img src="{{ $reward->image }}"></div>
            <p><a href="{{ $reward->url }}" target="_blank" class='reward-header'>{{ $reward->name }} - {{ $reward->amount }} ({{ '@' . $reward->campaign_username }})</a></p>
            <p>{{ $reward->description }}</p>
        </div>
    @endforeach
    </div>
@endsection
