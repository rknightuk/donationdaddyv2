@extends('layouts.app')

@section('content')

    <p>Add this to your page replacing the URL with your campaign url:</p>

    <pre>&lt;script src='https://septembed.rknight.me/sj.js?u=<strong>https://tiltify.com/@rknightuk/stjude2025</strong>'&gt;&lt;/script&gt;</pre>

    <p>Example:</p>

    <br>

    <script src='/sj.js?u=https://tiltify.com/@rknightuk/stjude2025'></script>

    <p style='margin-top: 20px;'><em><small>If you get the URL wrong, the embed will fall back to using the main Relay campaign. If you always want to show the Relay campaign, don't pass anything to <code>u=</code>.</small></em></p>

@endsection
