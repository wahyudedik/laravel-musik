<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Musik</title>

    <!-- Tabler CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.30.0/tabler-icons.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: 'Instrument Sans', sans-serif;
        }

        .navbar-dark {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .hero-section {
            padding: 120px 0;
            background: linear-gradient(180deg, #121212 0%, #000000 100%);
        }

        .feature-card {
            background-color: #121212;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            background-color: #1d1d1d;
            transform: translateY(-5px);
        }

        .btn-spotify {
            background-color: #1DB954;
            color: #fff;
            border: none;
        }

        .btn-spotify:hover {
            background-color: #1ed760;
            color: #fff;
        }

        .text-spotify {
            color: #1DB954;
        }

        .footer {
            background-color: #121212;
            padding: 40px 0;
        }

        .playlist-card {
            background-color: #181818;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .playlist-card:hover {
            background-color: #282828;
        }

        .artist-card {
            background-color: #181818;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .artist-card:hover {
            background-color: #282828;
        }

        .artist-image {
            border-radius: 50%;
            overflow: hidden;
        }

        .music-player {
            background-color: #181818;
            border-top: 1px solid #282828;
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 15px 0;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <!-- Navbar -->
<header class="navbar navbar-expand-md navbar-dark d-print-none sticky-top">
    <div class="container">
        <h1 class="navbar-brand d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('landing') }}" class="text-white text-decoration-none">
                <i class="ti ti-music me-2"></i>
                Laravel<span class="text-spotify fw-bold">Musik</span>
            </a>
        </h1>
        
        <!-- Search Component -->
        <div class="d-none d-md-block mx-auto" style="width: 40%;">
            <div class="position-relative">
                <input type="text" class="form-control bg-dark border-0 rounded-pill text-white" 
                    placeholder="Search for songs, artists, or playlists" 
                    style="padding-left: 40px; padding-right: 40px;">
                <div class="position-absolute top-50 start-0 translate-middle-y ms-3">
                    <i class="ti ti-search text-muted"></i>
                </div>
                <div class="position-absolute top-50 end-0 translate-middle-y me-3">
                    <i class="ti ti-microphone text-muted"></i>
                </div>
            </div>
        </div>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center justify-content-end">
                <ul class="navbar-nav">
                    <!-- Mobile Search (visible only on small screens) -->
                    <li class="nav-item d-md-none mb-2">
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-0">
                                <i class="ti ti-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control bg-dark border-0 text-white" 
                                placeholder="Search">
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Premium</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Support</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Download</a>
                    </li>
                    <li class="nav-item px-2">|</li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Sign In</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </div>
</header>


    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4">Music for everyone.</h1>
                    <p class="fs-4 mb-4">Millions of songs. No credit card needed.</p>
                    <button class="btn btn-spotify btn-lg px-4 py-2 rounded-pill">
                        GET LARAVEL MUSIK FREE
                    </button>
                </div>
                <div class="col-lg-6">
                    <div class="ratio ratio-16x9 rounded-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1000"
                            class="object-fit-cover" alt="Music Experience">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trending Section - Asymmetrical Layout -->
    <section class="py-5 position-relative">
        <div class="position-absolute top-0 end-0 d-none d-lg-block">
            <svg width="350" height="350" viewBox="0 0 350 350" fill="none" xmlns="http://www.w3.org/2000/svg"
                style="opacity: 0.05">
                <circle cx="175" cy="175" r="175" fill="#1DB954" />
            </svg>
        </div>
        <div class="container position-relative">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="mb-0">Trending now</h2>
                <a href="#" class="text-spotify text-decoration-none d-flex align-items-center">
                    <span class="me-2">View all</span>
                    <i class="ti ti-chevron-right"></i>
                </a>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="playlist-card p-0 h-100">
                        <div class="ratio ratio-1x1 position-relative rounded-4 overflow-hidden">
                            <img src="https://picsum.photos/id/11/600/600" class="object-fit-cover"
                                alt="Featured Playlist">
                            <div
                                class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-to-b from-transparent to-dark">
                            </div>
                            <div class="position-absolute bottom-0 start-0 p-4 w-100">
                                <span class="badge bg-spotify mb-2">Featured</span>
                                <h3 class="text-white mb-1">This Week's Top Hits</h3>
                                <p class="text-white-50 mb-3">The most popular tracks right now</p>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-spotify rounded-pill px-4">
                                        <i class="ti ti-player-play me-2"></i> Play Now
                                    </button>
                                    <button class="btn btn-dark rounded-pill px-3">
                                        <i class="ti ti-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row g-4 h-100">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="col-md-6">
                                <div class="playlist-card p-0 h-100">
                                    <div class="d-flex align-items-center p-3 rounded-4"
                                        style="background-color: rgba(30,30,30,0.7); backdrop-filter: blur(10px);">
                                        <div class="ratio ratio-1x1 rounded-3 overflow-hidden" style="width: 80px;">
                                            <img src="https://picsum.photos/id/{{ 12 + $i }}/300/300"
                                                class="object-fit-cover" alt="Playlist {{ $i }}">
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <h5 class="mb-1">Top Hits {{ $i }}</h5>
                                            <p class="text-muted small mb-0">{{ rand(100, 999) }}K listeners</p>
                                        </div>
                                        <button class="btn btn-spotify btn-icon rounded-circle ms-auto">
                                            <i class="ti ti-player-play"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endfor
                        <div class="col-12 mt-3">
                            <div class="playlist-card p-0">
                                <div class="d-flex align-items-center p-3 rounded-4"
                                    style="background: linear-gradient(90deg, #1DB954 0%, #0D5E2A 100%);">
                                    <div class="me-3">
                                        <i class="ti ti-flame fs-1 text-white"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-white mb-1">Made For You</h5>
                                        <p class="text-white-50 mb-0">Personalized playlists based on your listening
                                            habits</p>
                                    </div>
                                    <button class="btn btn-dark btn-icon rounded-circle ms-auto">
                                        <i class="ti ti-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- New Releases Section - With Horizontal Scrolling -->
    <section class="py-5 overflow-hidden">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="mb-0">New releases</h2>
                <div class="d-flex gap-2">
                    <button class="btn btn-icon btn-dark rounded-circle new-release-prev">
                        <i class="ti ti-chevron-left"></i>
                    </button>
                    <button class="btn btn-icon btn-dark rounded-circle new-release-next">
                        <i class="ti ti-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="new-releases-slider position-relative">
                <div class="d-flex gap-4 pb-4"
                    style="overflow-x: auto; scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none;">
                    @for ($i = 1; $i <= 10; $i++)
                        <div style="min-width: 200px; max-width: 200px;">
                            <div class="playlist-card p-3 h-100 rounded-4">
                                <div class="position-relative mb-3">
                                    <div class="ratio ratio-1x1 rounded-3 overflow-hidden">
                                        <img src="https://picsum.photos/id/{{ 20 + $i }}/300/300"
                                            class="object-fit-cover" alt="Album {{ $i }}">
                                    </div>
                                    <div class="position-absolute bottom-0 end-0 p-2">
                                        <button class="btn btn-spotify btn-icon rounded-circle shadow-lg">
                                            <i class="ti ti-player-play"></i>
                                        </button>
                                    </div>
                                    @if ($i % 3 == 0)
                                        <div class="position-absolute top-0 start-0 m-2">
                                            <span class="badge bg-dark">New</span>
                                        </div>
                                    @endif
                                </div>
                                <h5 class="mb-1 text-truncate">
                                    {{ ['Euphoria', 'Midnight Tales', 'Summer Vibes', 'Electric Dreams', 'Acoustic Sessions'][$i % 5] }}
                                </h5>
                                <p class="text-muted small">
                                    {{ ['Dua Lipa', 'The Weeknd', 'Taylor Swift', 'BTS', 'Billie Eilish'][$i % 5] }}
                                </p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Albums and Singles Section - With Mixed Layout -->
    <section class="py-5" style="background: linear-gradient(180deg, #000000 0%, #0A0A0A 100%);">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-spotify mb-2 text-uppercase letter-spacing-2">Editor's picks</h6>
                <h2 class="display-6">Popular Albums & Singles</h2>
                <p class="text-muted w-md-75 mx-auto">The most streamed music from around the world</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="rounded-4 overflow-hidden position-relative">
                        <div class="ratio ratio-16x9">
                            <img src="https://picsum.photos/id/30/800/450" class="object-fit-cover"
                                alt="Featured Album">
                        </div>
                        <div
                            class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-to-t from-black to-transparent d-flex align-items-end">
                            <div class="p-4 w-100">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <span class="badge bg-spotify mb-2">Album of the Month</span>
                                        <h3 class="mb-1">Renaissance</h3>
                                        <p class="mb-3 text-white-50">Beyoncé</p>
                                    </div>
                                    <div class="ms-auto">
                                        <button class="btn btn-spotify rounded-pill px-4 me-2">
                                            <i class="ti ti-player-play me-2"></i> Play
                                        </button>
                                        <button class="btn btn-dark btn-icon rounded-circle">
                                            <i class="ti ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="playlist-card p-3 rounded-4">
                                <div class="ratio ratio-1x1 mb-3 position-relative rounded-3 overflow-hidden">
                                    <img src="https://picsum.photos/id/31/300/300" class="object-fit-cover"
                                        alt="Album 2">
                                    <div class="position-absolute bottom-0 end-0 p-2">
                                        <button class="btn btn-spotify btn-icon rounded-circle">
                                            <i class="ti ti-player-play"></i>
                                        </button>
                                    </div>
                                </div>
                                <h5 class="mb-1">Future Nostalgia</h5>
                                <p class="text-muted small">Dua Lipa</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="playlist-card p-3 rounded-4">
                                <div class="ratio ratio-1x1 mb-3 position-relative rounded-3 overflow-hidden">
                                    <img src="https://picsum.photos/id/32/300/300" class="object-fit-cover"
                                        alt="Album 3">
                                    <div class="position-absolute bottom-0 end-0 p-2">
                                        <button class="btn btn-spotify btn-icon rounded-circle">
                                            <i class="ti ti-player-play"></i>
                                        </button>
                                    </div>
                                </div>
                                <h5 class="mb-1">Midnights</h5>
                                <p class="text-muted small">Taylor Swift</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="playlist-card p-3 rounded-4">
                                <div class="ratio ratio-1x1 mb-3 position-relative rounded-3 overflow-hidden">
                                    <img src="https://picsum.photos/id/33/300/300" class="object-fit-cover"
                                        alt="Single 1">
                                    <div class="position-absolute bottom-0 end-0 p-2">
                                        <button class="btn btn-spotify btn-icon rounded-circle">
                                            <i class="ti ti-player-play"></i>
                                        </button>
                                    </div>
                                </div>
                                <h5 class="mb-1">Flowers</h5>
                                <p class="text-muted small">Miley Cyrus</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="playlist-card p-3 rounded-4">
                                <div class="ratio ratio-1x1 mb-3 position-relative rounded-3 overflow-hidden">
                                    <img src="https://picsum.photos/id/34/300/300" class="object-fit-cover"
                                        alt="Single 2">
                                    <div class="position-absolute bottom-0 end-0 p-2">
                                        <button class="btn btn-spotify btn-icon rounded-circle">
                                            <i class="ti ti-player-play"></i>
                                        </button>
                                    </div>
                                </div>
                                <h5 class="mb-1">Blinding Lights</h5>
                                <p class="text-muted small">The Weeknd</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Artists Section - Carousel Style -->
    <section class="py-5 position-relative">
        <div class="position-absolute top-50 start-0 translate-middle-y d-none d-lg-block">
            <svg width="250" height="250" viewBox="0 0 250 250" fill="none"
                xmlns="http://www.w3.org/2000/svg" style="opacity: 0.03">
                <circle cx="125" cy="125" r="125" fill="#ffffff" />
            </svg>
        </div>
        <div class="container position-relative">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <h2>Popular Artists</h2>
                    <p class="text-muted">Follow your favorite artists to never miss new releases</p>
                </div>
                <div class="col-lg-6 d-flex justify-content-end align-items-center">
                    <div class="d-flex gap-2">
                        <button class="btn btn-icon btn-dark rounded-circle artist-prev">
                            <i class="ti ti-chevron-left"></i>
                        </button>
                        <button class="btn btn-icon btn-dark rounded-circle artist-next">
                            <i class="ti ti-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="artists-carousel position-relative">
                <div class="d-flex gap-4 pb-4"
                    style="overflow-x: auto; scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none;">
                    <div style="min-width: 240px; max-width: 240px;">
                        <div class="artist-card p-4 text-center rounded-4 h-100"
                            style="background: linear-gradient(145deg, #1e1e1e 0%, #0a0a0a 100%);">
                            <div class="position-relative mb-4">
                                <div class="ratio ratio-1x1 artist-image mx-auto position-relative"
                                    style="max-width: 180px;">
                                    <img src="https://picsum.photos/id/40/300/300" class="object-fit-cover"
                                        alt="Artist 1">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-10 rounded-circle">
                                    </div>
                                </div>
                                <div class="position-absolute top-50 start-50 translate-middle opacity-0 hover-show">
                                    <button class="btn btn-spotify btn-lg btn-icon rounded-circle shadow-lg">
                                        <i class="ti ti-player-play fs-2"></i>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-1">Drake</h4>
                            <p class="text-muted">15.5M followers</p>
                            <button class="btn btn-outline-light btn-sm rounded-pill px-4">
                                <i class="ti ti-plus me-1"></i> Follow
                            </button>
                        </div>
                    </div>

                    <div style="min-width: 240px; max-width: 240px;">
                        <div class="artist-card p-4 text-center rounded-4 h-100"
                            style="background: linear-gradient(145deg, #1e1e1e 0%, #0a0a0a 100%);">
                            <div class="position-relative mb-4">
                                <div class="ratio ratio-1x1 artist-image mx-auto position-relative"
                                    style="max-width: 180px;">
                                    <img src="https://picsum.photos/id/41/300/300" class="object-fit-cover"
                                        alt="Artist 2">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-10 rounded-circle">
                                    </div>
                                </div>
                                <div class="position-absolute top-50 start-50 translate-middle opacity-0 hover-show">
                                    <button class="btn btn-spotify btn-lg btn-icon rounded-circle shadow-lg">
                                        <i class="ti ti-player-play fs-2"></i>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-1">Ariana Grande</h4>
                            <p class="text-muted">12.8M followers</p>
                            <button class="btn btn-outline-light btn-sm rounded-pill px-4">
                                <i class="ti ti-plus me-1"></i> Follow
                            </button>
                        </div>
                    </div>

                    <div style="min-width: 240px; max-width: 240px;">
                        <div class="artist-card p-4 text-center rounded-4 h-100"
                            style="background: linear-gradient(145deg, #1e1e1e 0%, #0a0a0a 100%);">
                            <div class="position-relative mb-4">
                                <div class="ratio ratio-1x1 artist-image mx-auto position-relative"
                                    style="max-width: 180px;">
                                    <img src="https://picsum.photos/id/42/300/300" class="object-fit-cover"
                                        alt="Artist 3">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-10 rounded-circle">
                                    </div>
                                </div>
                                <div class="position-absolute top-50 start-50 translate-middle opacity-0 hover-show">
                                    <button class="btn btn-spotify btn-lg btn-icon rounded-circle shadow-lg">
                                        <i class="ti ti-player-play fs-2"></i>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-1">BTS</h4>
                            <p class="text-muted">22.1M followers</p>
                            <button class="btn btn-outline-light btn-sm rounded-pill px-4">
                                <i class="ti ti-plus me-1"></i> Follow
                            </button>
                        </div>
                    </div>

                    <div style="min-width: 240px; max-width: 240px;">
                        <div class="artist-card p-4 text-center rounded-4 h-100"
                            style="background: linear-gradient(145deg, #1e1e1e 0%, #0a0a0a 100%);">
                            <div class="position-relative mb-4">
                                <div class="ratio ratio-1x1 artist-image mx-auto position-relative"
                                    style="max-width: 180px;">
                                    <img src="https://picsum.photos/id/43/300/300" class="object-fit-cover"
                                        alt="Artist 4">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-10 rounded-circle">
                                    </div>
                                </div>
                                <div class="position-absolute top-50 start-50 translate-middle opacity-0 hover-show">
                                    <button class="btn btn-spotify btn-lg btn-icon rounded-circle shadow-lg">
                                        <i class="ti ti-player-play fs-2"></i>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-1">Billie Eilish</h4>
                            <p class="text-muted">11.3M followers</p>
                            <button class="btn btn-outline-light btn-sm rounded-pill px-4">
                                <i class="ti ti-plus me-1"></i> Follow
                            </button>
                        </div>
                    </div>

                    <div style="min-width: 240px; max-width: 240px;">
                        <div class="artist-card p-4 text-center rounded-4 h-100"
                            style="background: linear-gradient(145deg, #1e1e1e 0%, #0a0a0a 100%);">
                            <div class="position-relative mb-4">
                                <div class="ratio ratio-1x1 artist-image mx-auto position-relative"
                                    style="max-width: 180px;">
                                    <img src="https://picsum.photos/id/44/300/300" class="object-fit-cover"
                                        alt="Artist 5">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-10 rounded-circle">
                                    </div>
                                </div>
                                <div class="position-absolute top-50 start-50 translate-middle opacity-0 hover-show">
                                    <button class="btn btn-spotify btn-lg btn-icon rounded-circle shadow-lg">
                                        <i class="ti ti-player-play fs-2"></i>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-1">Bad Bunny</h4>
                            <p class="text-muted">18.7M followers</p>
                            <button class="btn btn-outline-light btn-sm rounded-pill px-4">
                                <i class="ti ti-plus me-1"></i> Follow
                            </button>
                        </div>
                    </div>

                    <div style="min-width: 240px; max-width: 240px;">
                        <div class="artist-card p-4 text-center rounded-4 h-100"
                            style="background: linear-gradient(145deg, #1e1e1e 0%, #0a0a0a 100%);">
                            <div class="position-relative mb-4">
                                <div class="ratio ratio-1x1 artist-image mx-auto position-relative"
                                    style="max-width: 180px;">
                                    <img src="https://picsum.photos/id/45/300/300" class="object-fit-cover"
                                        alt="Artist 6">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-10 rounded-circle">
                                    </div>
                                </div>
                                <div class="position-absolute top-50 start-50 translate-middle opacity-0 hover-show">
                                    <button class="btn btn-spotify btn-lg btn-icon rounded-circle shadow-lg">
                                        <i class="ti ti-player-play fs-2"></i>
                                    </button>
                                </div>
                            </div>
                            <h4 class="mb-1">The Weeknd</h4>
                            <p class="text-muted">14.2M followers</p>
                            <button class="btn btn-outline-light btn-sm rounded-pill px-4">
                                <i class="ti ti-plus me-1"></i> Follow
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Genre Section - Visual Grid -->
    <section class="py-5 bg-black">
        <div class="container">
            <h2 class="mb-4">Browse by genre</h2>
            <div class="row g-3">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden position-relative"
                        style="background-color: #8c67aa;">
                        <div class="p-4 d-flex flex-column justify-content-between h-100">
                            <h4 class="text-white mb-0">Pop</h4>
                            <div class="position-absolute bottom-0 end-0">
                                <img src="https://picsum.photos/id/50/120/120" class="img-fluid rounded-circle"
                                    style="transform: rotate(25deg);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden position-relative"
                        style="background-color: #ba5d07;">
                        <div class="p-4 d-flex flex-column justify-content-between h-100">
                            <h4 class="text-white mb-0">Hip-Hop</h4>
                            <div class="position-absolute bottom-0 end-0">
                                <img src="https://picsum.photos/id/51/120/120" class="img-fluid rounded-circle"
                                    style="transform: rotate(25deg);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden position-relative"
                        style="background-color: #e8115b;">
                        <div class="p-4 d-flex flex-column justify-content-between h-100">
                            <h4 class="text-white mb-0">Rock</h4>
                            <div class="position-absolute bottom-0 end-0">
                                <img src="https://picsum.photos/id/52/120/120" class="img-fluid rounded-circle"
                                    style="transform: rotate(25deg);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden position-relative"
                        style="background-color: #dc148c;">
                        <div class="p-4 d-flex flex-column justify-content-between h-100">
                            <h4 class="text-white mb-0">Dance</h4>
                            <div class="position-absolute bottom-0 end-0">
                                <img src="https://picsum.photos/id/53/120/120" class="img-fluid rounded-circle"
                                    style="transform: rotate(25deg);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden position-relative"
                        style="background-color: #1d8954;">
                        <div class="p-4 d-flex flex-column justify-content-between h-100">
                            <h4 class="text-white mb-0">Indie</h4>
                            <div class="position-absolute bottom-0 end-0">
                                <img src="https://picsum.photos/id/54/120/120" class="img-fluid rounded-circle"
                                    style="transform: rotate(25deg);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden position-relative"
                        style="background-color: #509bf5;">
                        <div class="p-4 d-flex flex-column justify-content-between h-100">
                            <h4 class="text-white mb-0">R&B</h4>
                            <div class="position-absolute bottom-0 end-0">
                                <img src="https://picsum.photos/id/55/120/120" class="img-fluid rounded-circle"
                                    style="transform: rotate(25deg);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden position-relative"
                        style="background-color: #509bf5;">
                        <div class="p-4 d-flex flex-column justify-content-between h-100">
                            <h4 class="text-white mb-0">R&B</h4>
                            <div class="position-absolute bottom-0 end-0">
                                <img src="https://picsum.photos/id/55/120/120" class="img-fluid rounded-circle"
                                    style="transform: rotate(25deg);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden position-relative"
                        style="background-color: #477d95;">
                        <div class="p-4 d-flex flex-column justify-content-between h-100">
                            <h4 class="text-white mb-0">K-Pop</h4>
                            <div class="position-absolute bottom-0 end-0">
                                <img src="https://picsum.photos/id/56/120/120" class="img-fluid rounded-circle"
                                    style="transform: rotate(25deg);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="ratio ratio-1x1 rounded-4 overflow-hidden position-relative"
                        style="background-color: #b49bc8;">
                        <div class="p-4 d-flex flex-column justify-content-between h-100">
                            <h4 class="text-white mb-0">Latin</h4>
                            <div class="position-absolute bottom-0 end-0">
                                <img src="https://picsum.photos/id/57/120/120" class="img-fluid rounded-circle"
                                    style="transform: rotate(25deg);">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Laravel Musik?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="ti ti-music text-spotify fs-1 me-3"></i>
                            <h3 class="mb-0">Millions of Songs</h3>
                        </div>
                        <p class="text-muted">Stream any song, anywhere, anytime. Discover new music
                            every day.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="ti ti-device-laptop text-spotify fs-1 me-3"></i>
                            <h3 class="mb-0">Cross-Platform</h3>
                        </div>
                        <p class="text-muted">Listen on your phone, tablet, computer, TV, and more
                            devices.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <i class="ti ti-playlist text-spotify fs-1 me-3"></i>
                            <h3 class="mb-0">Custom Playlists</h3>
                        </div>
                        <p class="text-muted">Create your own playlists or enjoy our curated
                            collections.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-5" style="background: linear-gradient(90deg, #1DB954 0%, #0D5E2A 100%);">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-3">
                    <div class="p-3">
                        <h2 class="display-4 fw-bold text-white">70M+</h2>
                        <p class="text-white-50 fs-5">Tracks</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3">
                        <h2 class="display-4 fw-bold text-white">4B+</h2>
                        <p class="text-white-50 fs-5">Playlists</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3">
                        <h2 class="display-4 fw-bold text-white">180+</h2>
                        <p class="text-white-50 fs-5">Countries</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-3">
                        <h2 class="display-4 fw-bold text-white">450M+</h2>
                        <p class="text-white-50 fs-5">Users</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Comparison -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-6">Why go Premium?</h2>
                <p class="text-muted w-md-50 mx-auto">Upgrade your listening experience with Premium</p>
            </div>
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="table-responsive">
                        <table class="table table-dark table-borderless">
                            <thead>
                                <tr class="border-bottom">
                                    <th style="width: 50%">Features</th>
                                    <th class="text-center">Free</th>
                                    <th class="text-center text-spotify">Premium</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-3">Ad-free music listening</td>
                                    <td class="text-center"><i class="ti ti-x text-muted"></i></td>
                                    <td class="text-center"><i class="ti ti-check text-spotify"></i></td>
                                </tr>
                                <tr>
                                    <td class="py-3">Download to listen offline</td>
                                    <td class="text-center"><i class="ti ti-x text-muted"></i></td>
                                    <td class="text-center"><i class="ti ti-check text-spotify"></i></td>
                                </tr>
                                <tr>
                                    <td class="py-3">Play songs in any order</td>
                                    <td class="text-center"><i class="ti ti-x text-muted"></i></td>
                                    <td class="text-center"><i class="ti ti-check text-spotify"></i></td>
                                </tr>
                                <tr>
                                    <td class="py-3">High quality audio (up to 320 kbps)</td>
                                    <td class="text-center"><i class="ti ti-x text-muted"></i></td>
                                    <td class="text-center"><i class="ti ti-check text-spotify"></i></td>
                                </tr>
                                <tr>
                                    <td class="py-3">Cancel anytime</td>
                                    <td class="text-center"><i class="ti ti-check text-muted"></i></td>
                                    <td class="text-center"><i class="ti ti-check text-spotify"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-dark">
        <div class="container text-center">
            <h2 class="display-5 mb-4">Ready to start listening?</h2>
            <button class="btn btn-spotify btn-lg px-5 py-3 rounded-pill">
                GET LARAVEL MUSIK FREE
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <h1 class="navbar-brand pe-0 pe-md-3 mb-3">
                        <a href="{{ route('landing') }}" class="text-white text-decoration-none">
                            <i class="ti ti-music me-2"></i>
                            Laravel<span class="text-spotify fw-bold">Musik</span>
                        </a>
                    </h1>
                </div>
                <div class="col-6 col-lg-3">
                    <h5 class="mb-3">Company</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">About</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Jobs</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">For the
                                Record</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h5 class="mb-3">Communities</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">For Artists</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Developers</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Advertising</a>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h5 class="mb-3">Social</h5>
                    <div class="d-flex gap-3 mb-3">
                        <a href="#" class="text-muted text-decoration-none fs-3"><i
                                class="ti ti-brand-instagram"></i></a>
                        <a href="#" class="text-muted text-decoration-none fs-3"><i
                                class="ti ti-brand-twitter"></i></a>
                        <a href="#" class="text-muted text-decoration-none fs-3"><i
                                class="ti ti-brand-facebook"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="row">
                <div class="col-12">
                    <p class="text-muted small">© 2023 Laravel Musik. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Music Player (Fixed at Bottom) -->
    <div class="music-player">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="d-flex align-items-center">
                        <img src="https://picsum.photos/id/65/50/50" class="rounded me-3" alt="Current track">
                        <div>
                            <h6 class="mb-0">Song Title</h6>
                            <small class="text-muted">Artist Name</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column align-items-center">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <button class="btn btn-icon text-muted"><i class="ti ti-player-skip-back"></i></button>
                            <button class="btn btn-spotify btn-icon rounded-circle"><i
                                    class="ti ti-player-play"></i></button>
                            <button class="btn btn-icon text-muted"><i class="ti ti-player-skip-forward"></i></button>
                        </div>
                        <div class="d-flex align-items-center w-100">
                            <small class="text-muted me-2">0:00</small>
                            <div class="progress flex-grow-1" style="height: 4px;">
                                <div class="progress-bar bg-spotify" style="width: 25%"></div>
                            </div>
                            <small class="text-muted ms-2">3:45</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center justify-content-end gap-3">
                        <button class="btn btn-icon text-muted"><i class="ti ti-volume"></i></button>
                        <div class="progress" style="width: 80px; height: 4px;">
                            <div class="progress-bar bg-white" style="width: 70%"></div>
                        </div>
                        <button class="btn btn-icon text-muted"><i class="ti ti-maximize"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize slider functions
            const newReleaseContainer = document.querySelector('.new-releases-slider > div');
            const artistContainer = document.querySelector('.artists-carousel > div');

            // New releases navigation
            document.querySelector('.new-release-prev').addEventListener('click', function() {
                newReleaseContainer.scrollBy({
                    left: -600,
                    behavior: 'smooth'
                });
            });

            document.querySelector('.new-release-next').addEventListener('click', function() {
                newReleaseContainer.scrollBy({
                    left: 600,
                    behavior: 'smooth'
                });
            });

            // Artists navigation
            document.querySelector('.artist-prev').addEventListener('click', function() {
                artistContainer.scrollBy({
                    left: -500,
                    behavior: 'smooth'
                });
            });

            document.querySelector('.artist-next').addEventListener('click', function() {
                artistContainer.scrollBy({
                    left: 500,
                    behavior: 'smooth'
                });
            });

            // Play button functionality
            const playButtons = document.querySelectorAll('.btn-spotify.btn-icon');
            playButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon.classList.contains('ti-player-play')) {
                        icon.classList.remove('ti-player-play');
                        icon.classList.add('ti-player-pause');
                    } else {
                        icon.classList.remove('ti-player-pause');
                        icon.classList.add('ti-player-play');
                    }
                });
            });

            // Add hover effect styles for artist cards
            document.head.insertAdjacentHTML('beforeend', `
                <style>
                    .hover-show {
                        transition: opacity 0.3s ease;
                    }
                    .artist-image:hover + .hover-show,
                    .hover-show:hover {
                        opacity: 1 !important;
                    }
                </style>
            `);
        });
    </script>
</body>

</html>
