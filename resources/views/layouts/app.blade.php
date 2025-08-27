<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            -moz-text-size-adjust: none;
            -webkit-text-size-adjust: none;
            text-size-adjust: none;
        }

        body, h1, h2, h3, h4, p,
        figure, blockquote, dl, dd {
            margin: 0;
        }

        ul[role='list'],
        ol[role='list'] {
            list-style: none;
        }

        body {
            line-height: 1.5;
        }

        h1, h2, h3, h4,
        button, input, label {
            line-height: 1.1;
        }

        h1, h2,
        h3, h4 {
            text-wrap: balance;
        }

        a:not([class]) {
            text-decoration-skip-ink: auto;
            color: currentColor;
        }

        img,
        picture {
            max-width: 100%;
            display: block;
        }

        input, button,
        textarea, select {
            font: inherit;
        }

        textarea:not([rows]) {
            min-height: 10em;
        }

        :target {
            scroll-margin-block: 5ex;
        }

        body {
            font-family: Atkinson Hyperlegible, sans-serif;
            font-size: 1.2em;
            background-color: #ecf0f1;
            color: #343a40;
        }

        h1 {
            font-size: 1.5em;
            margin-bottom: 0;
            font-family: 'Press Start 2P', system-ui;
            text-shadow: rgba(227, 61, 148, 0.7) 2px 2px 0px, rgba(76, 162, 183, 0.7) -2px -2px 0px;
        }

        .subtitle {
            margin-top: 5px;
            margin-bottom: 0;
        }

        .wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px;
            margin-top: 10px;
        }

        header {
            text-align: center;
        }

        .content {
            margin-top: 20px;
        }

        nav.main {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 5px;
            font-weight: 700;
            font-size: 0.7em;
            padding: 10px;
        }

        nav.main a {
            font-family: 'Press Start 2P', system-ui;
        }

        @media (max-width: 600px)
        {
            nav.main {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        nav.main a {
            text-align: center;
            padding: 5px;
            text-decoration: none;
            border: 2px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fce18c;
            color: #343a40;
        }

        nav.main a:hover {
            background-color: #FDDB73;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }

        footer img {
            display: initial;
        }

        .center {
            text-align: center;
            margin-bottom: 10px;
        }

        .flex {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sj-container {
            padding: 10px;
            border-radius: 10px;
            display: block;
            text-decoration: none;
            transition:  background 0.5s ease;
            background:  #FDE18C;
            color: black;
            border: 1px solid #FFC52C;
            margin-bottom: 10px;
        }

        .sj-container:hover {
            background: #FDDB73;
        }

        .sj-subtitle {
            font-size: 0.9em;
        }
        .sj-progress {
            box-sizing:border-box;
            padding-left:10px;
            height:100%;
            background:black;
            border-top-left-radius:15px;
            border-bottom-left-radius:15px;
            display:flex;
            align-items: center;
            color: white;
            max-width:100%;
        }

        .sj-progress-text {
            font-size: 0.8em;
            position: absolute;
            right: 0;
            left: 5px;
            bottom: 0;
            color: white;
            text-align: left;
        }

        .featured-image {
            margin: 0 auto 10px auto;
            display: flex;
            max-width: 600px;
            justify-content: center;
        }

        .featured-image img {
            max-height: 300px;
        }


    </style>

    <title>{{ $title }} - {{ $subtitle }}</title>

    <meta property='og:title' content='{{ $title }}' />
    <meta property='description' content='{{ $title }} - {{ $subtitle }}' />
    <meta property='og:description' content='{{ $title }} - {{ $subtitle }}' />
    <meta property='og:type' content='article' />
    <meta property='og:url' content='https://donationdaddy.rknight.me' />
    <meta property='og:image' content='/icons/{{ $assetpath }}/preview.png'>

    <link rel='apple-touch-icon' sizes='180x180' href='/icons/{{ $assetpath }}/apple-touch-icon.png'>
    <link rel='icon' type='image/png' sizes='32x32' href='/icons/{{ $assetpath }}/favicon-32x32.png'>
    <link rel='icon' type='image/png' sizes='16x16' href='/icons/{{ $assetpath }}/favicon-16x16.png'>
    <link rel='manifest' href='/icons/{{ $assetpath }}/site.webmanifest'>
    <link rel='mask-icon' href='/icons/{{ $assetpath }}/safari-pinned-tab.svg' color='#5bbad5'>
    <meta name='msapplication-TileColor' content='#da532c'>
    <meta name='theme-color' content='#ffffff'>
    <link rel='icon' type='image/x-icon' href='/icons/{{ $assetpath }}/favicon.ico'>

    <link rel='preconnect' href='https://fonts.bunny.net'>
    <link href='https://fonts.bunny.net/css2?family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400;1,700&family=Press+Start+2P&display=swap' rel='stylesheet'>

</head>

<body>

    <nav class='main'>
        <a href='https://coinme.dad/dy'>Coin Me, Daddy</a>
        <a href='https://deskmat.help'>Desk Mat Help</a>
        <a href='https://backpackhelp.rknight.me'>Backpack Help</a>
         <a href='https://donationtreats.rknight.me'>Donation Treats</a>
        <a href='https://septembed.rknight.me'>Septembed</a>
        <a href='/leaderboard'>Leaderboard</a>
{{--        <a href='https://stjude.omg.lol'>robb x omg.lol</a>--}}
    </nav>

    <div class="wrapper">
        <header>
            <h1>{{ $title }}</h1>
            <p class='subtitle'><em>{{ $subtitle }}</em></p>
        </header>

        <div class='content'>
            @yield('content')
        </div>

        <footer>
            <p class='subtitle'><small>Made by <a href="https://stjude.omg.lol">Robb Knight</small></a></p>

            <a href="https://donationdaddy.rknight.me"><img src="/icons/donationdaddy/DonationDaddy.png" height="50"></a>

        </footer>
    </div>
</body>
</html>
