<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f4f0e8">
    <meta name="description" content="Jelajahi pilihan biji kopi sangrai DKVoc. Temukan kopi untuk seduhan di rumah.">
    <title>DKVoc — Biji Kopi Sangrai Pilihan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --paper: #f4f0e8;
            --paper-deep: #e9e2d5;
            --ink: #24231f;
            --muted: #6e6a60;
            --coffee: #754a32;
            --leaf: #52634c;
            --line: rgba(36, 35, 31, .18);
            --serif: 'Playfair Display', Georgia, serif;
            --sans: 'DM Sans', sans-serif;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; background: var(--paper); color: var(--ink); font-family: var(--sans); }
        a { color: inherit; text-decoration: none; }
        img { display: block; max-width: 100%; }
        .site-shell { max-width: 1600px; margin: 0 auto; overflow: hidden; }
        .topline { display: flex; justify-content: center; padding: 10px 24px; background: var(--leaf); color: #f8f5ed; font-size: 10px; letter-spacing: 0; text-align: center; }
        .topline span { opacity: .94; }
        .header { display: flex; align-items: center; justify-content: space-between; padding: 23px clamp(22px, 5.4vw, 88px); border-bottom: 1px solid var(--line); }
        .brand { display: flex; flex-direction: column; font-family: var(--serif); font-size: 21px; font-weight: 700; line-height: .95; }
        .brand small { margin-top: 6px; font-family: var(--sans); font-size: 9px; font-weight: 600; letter-spacing: 0; }
        .nav { display: flex; align-items: center; gap: clamp(17px, 3vw, 42px); font-size: 12px; font-weight: 600; }
        .nav a:not(.nav-cta):hover, .text-link:hover { color: var(--coffee); }
        .nav-cta, .button-dark { display: inline-flex; justify-content: center; align-items: center; min-height: 44px; padding: 0 19px; background: var(--ink); color: var(--paper); font-size: 11px; font-weight: 600; transition: background .2s, transform .2s; }
        .nav-cta:hover, .button-dark:hover { background: var(--coffee); transform: translateY(-2px); }
        .menu-toggle { display: none; border: 0; padding: 8px; background: transparent; color: var(--ink); font: inherit; font-size: 12px; }

        .hero { display: grid; grid-template-columns: 1.08fr .92fr; gap: 5vw; align-items: center; padding: clamp(56px, 8vw, 126px) clamp(22px, 8vw, 128px) clamp(68px, 9vw, 140px); }
        .eyebrow { display: flex; align-items: center; gap: 11px; color: var(--leaf); font-size: 10px; font-weight: 700; }
        .eyebrow::before { width: 28px; height: 1px; background: currentColor; content: ''; }
        h1, h2, h3, p { margin-top: 0; }
        .hero h1 { max-width: 760px; margin: 25px 0 23px; font-family: var(--serif); font-size: clamp(54px, 7.3vw, 108px); font-weight: 500; letter-spacing: 0; line-height: .99; }
        .hero h1 em { color: var(--coffee); font-weight: 500; }
        .hero-copy { max-width: 410px; margin-bottom: 28px; color: var(--muted); font-size: 14px; line-height: 1.8; }
        .hero-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 23px; }
        .text-link { display: inline-flex; align-items: center; gap: 9px; font-size: 11px; font-weight: 700; transition: color .2s; }
        .text-link span { font-size: 17px; }
        .hero-visual { position: relative; min-height: 450px; }
        .hero-photo { width: 100%; height: clamp(390px, 48vw, 650px); object-fit: cover; object-position: 52% center; }
        .photo-stamp { position: absolute; right: -22px; bottom: 33px; display: grid; width: 112px; height: 112px; place-items: center; border-radius: 50%; background: #c5ceaa; color: var(--ink); text-align: center; transform: rotate(9deg); }
        .photo-stamp span { max-width: 76px; font-family: var(--serif); font-size: 15px; line-height: 1.15; }
        .image-note { position: absolute; bottom: -31px; left: 0; color: var(--muted); font-size: 9px; }

        .ticker { overflow: hidden; padding: 19px 0; border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); background: var(--paper-deep); white-space: nowrap; }
        .ticker-track { display: flex; width: max-content; animation: drift 32s linear infinite; }
        .ticker span { padding: 0 24px; font-family: var(--serif); font-size: 17px; }
        .ticker b { color: var(--coffee); font-family: var(--sans); font-size: 12px; font-weight: 500; }
        @keyframes drift { to { transform: translateX(-50%); } }

        .intro { display: grid; grid-template-columns: .72fr 1.28fr; gap: 9vw; padding: clamp(80px, 11vw, 166px) clamp(22px, 10vw, 160px); }
        .section-index { color: var(--coffee); font-size: 10px; font-weight: 700; }
        .intro h2 { max-width: 820px; margin-bottom: 25px; font-family: var(--serif); font-size: clamp(37px, 5vw, 69px); font-weight: 500; letter-spacing: 0; line-height: 1.08; }
        .intro h2 em { color: var(--leaf); font-weight: 500; }
        .intro-copy { max-width: 590px; color: var(--muted); font-size: 14px; line-height: 1.85; }
        .intro-link { margin-top: 18px; }

        .chapters { display: grid; grid-template-columns: 1fr 1fr; gap: 0; padding: 0 clamp(22px, 8vw, 128px) clamp(90px, 12vw, 170px); }
        .chapter { display: grid; grid-template-columns: .9fr 1.1fr; gap: 24px; align-items: center; padding: 23px 0; border-top: 1px solid var(--line); }
        .chapter:nth-child(odd) { margin-right: 36px; }
        .chapter:nth-child(even) { margin-left: 36px; }
        .chapter-copy { padding-right: 5px; }
        .chapter-number { color: var(--coffee); font-size: 10px; }
        .chapter h3 { margin: 13px 0 9px; font-family: var(--serif); font-size: 27px; font-weight: 500; }
        .chapter p { margin: 0; color: var(--muted); font-size: 11px; line-height: 1.65; }
        .chapter img { width: 100%; height: 230px; object-fit: cover; }
        .chapter:nth-child(2) { margin-top: 92px; }
        .chapter:nth-child(3) { margin-top: -75px; }
        .chapter:nth-child(4) { margin-top: 18px; }

        .menu-section { padding: clamp(76px, 10vw, 142px) clamp(22px, 8vw, 128px); background: #29352c; color: #f4f0e8; }
        .menu-heading { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 47px; }
        .menu-heading .eyebrow { color: #c5ceaa; }
        .menu-heading h2 { max-width: 590px; margin: 18px 0 0; font-family: var(--serif); font-size: clamp(42px, 6vw, 78px); font-weight: 500; letter-spacing: 0; line-height: 1; }
        .menu-heading .text-link { flex: 0 0 auto; padding-bottom: 7px; }
        .menu-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .menu-item { min-width: 0; border-top: 1px solid rgba(244, 240, 232, .36); }
        .menu-item img, .menu-placeholder { width: 100%; height: 245px; object-fit: cover; }
        .menu-placeholder { display: grid; place-items: center; background: #485747; color: #d9dec9; font-family: var(--serif); font-size: 46px; }
        .menu-meta { display: flex; justify-content: space-between; gap: 10px; padding-top: 17px; }
        .menu-meta h3 { margin: 0; font-family: var(--serif); font-size: 22px; font-weight: 500; }
        .menu-meta span { color: #d5c29c; font-size: 11px; white-space: nowrap; }
        .menu-item p { margin: 11px 0 0; color: rgba(244, 240, 232, .68); font-size: 11px; line-height: 1.65; }
        .empty-menu { grid-column: 1 / -1; color: rgba(244, 240, 232, .75); font-size: 14px; }

        .experience { display: grid; grid-template-columns: 1fr 1fr; min-height: 590px; background: #d8c8ae; }
        .experience-image { min-height: 490px; }
        .experience-image img { width: 100%; height: 100%; object-fit: cover; }
        .experience-content { display: flex; flex-direction: column; justify-content: center; padding: clamp(42px, 8vw, 120px); }
        .experience-content .eyebrow { color: #78513a; }
        .experience-content h2 { margin: 21px 0; font-family: var(--serif); font-size: clamp(40px, 5.3vw, 72px); font-weight: 500; letter-spacing: 0; line-height: 1.03; }
        .experience-content p { max-width: 450px; margin-bottom: 27px; color: #5f5549; font-size: 13px; line-height: 1.8; }

        .closing { padding: clamp(83px, 12vw, 174px) 22px; text-align: center; }
        .closing .eyebrow { justify-content: center; }
        .closing h2 { max-width: 930px; margin: 22px auto 27px; font-family: var(--serif); font-size: clamp(49px, 8vw, 112px); font-weight: 500; letter-spacing: 0; line-height: .98; }
        .closing p { max-width: 470px; margin: 0 auto 30px; color: var(--muted); font-size: 13px; line-height: 1.7; }

        .story-trigger { border: 0; background: transparent; padding: 0; cursor: pointer; color: inherit; }
        .story-backdrop { position: fixed; inset: 0; z-index: 25; background: rgba(22, 18, 15, .36); opacity: 0; pointer-events: none; transition: opacity .25s ease; }
        .story-backdrop.is-visible { opacity: 1; pointer-events: auto; }
        .story-panel { position: fixed; inset: 0; z-index: 30; display: flex; width: 100%; height: 100vh; height: 100dvh; flex-direction: column; overflow-y: auto; padding: clamp(24px, 5vw, 72px) clamp(24px, 8vw, 120px); background: #f8f3eb; transform: translateX(100%); transition: transform .32s ease; }
        .story-panel.is-open { transform: translateX(0); }
        .story-panel-header { display: flex; width: min(100%, 1120px); align-items: center; justify-content: space-between; gap: 16px; margin: 0 auto clamp(42px, 8vh, 90px); }
        .story-panel-content { width: min(100%, 1120px); margin: auto; }
        .story-panel .eyebrow { color: var(--coffee); }
        .story-panel h3 { max-width: 1000px; margin: 18px 0 28px; font-family: var(--serif); font-size: clamp(42px, 8vw, 92px); font-weight: 500; line-height: 1.02; }
        .story-panel p { max-width: 820px; margin: 0 0 18px; color: var(--muted); line-height: 1.8; font-size: clamp(15px, 1.5vw, 18px); }
        .story-close { border: 1px solid var(--line); background: transparent; color: var(--ink); width: 42px; height: 42px; font-size: 22px; cursor: pointer; }

        .footer { display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; gap: 20px; padding: 28px clamp(22px, 5.4vw, 88px); border-top: 1px solid var(--line); }
        .footer-brand { font-family: var(--serif); font-size: 19px; font-weight: 700; }
        .footer-nav { display: flex; gap: 22px; color: var(--muted); font-size: 10px; }
        .copyright { justify-self: end; color: var(--muted); font-size: 10px; }
        .reveal { animation: rise .8s both; }
        @keyframes rise { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
        @media (prefers-reduced-motion: reduce) { *, *::before, *::after { scroll-behavior: auto !important; animation-duration: .01ms !important; animation-iteration-count: 1 !important; transition-duration: .01ms !important; } }

        @media (max-width: 850px) {
            .hero { gap: 35px; grid-template-columns: 1fr .85fr; padding-inline: 6vw; }
            .hero-visual { min-height: 370px; }
            .hero-photo { height: 430px; }
            .intro { gap: 40px; padding-inline: 7vw; }
            .chapters { padding-inline: 5vw; }
            .chapter { grid-template-columns: 1fr; gap: 15px; }
            .chapter img { height: 190px; }
            .chapter:nth-child(odd) { margin-right: 18px; }
            .chapter:nth-child(even) { margin-left: 18px; }
            .menu-section { padding-inline: 6vw; }
            .menu-item img, .menu-placeholder { height: 200px; }
            .memory-content { padding: 45px; }
        }
        @media (max-width: 640px) {
            .topline { font-size: 9px; }
            .header { position: relative; padding: 18px 21px; }
            .brand { font-size: 19px; }
            .menu-toggle { display: inline-flex; }
            .nav { position: absolute; z-index: 5; top: calc(100% - 1px); right: 0; left: 0; display: none; align-items: stretch; gap: 0; padding: 8px 21px 20px; border-bottom: 1px solid var(--line); background: var(--paper); }
            .nav.is-open { display: flex; flex-direction: column; }
            .nav a { padding: 12px 0; }
            .nav .nav-cta { margin-top: 8px; padding: 0 16px; }
            .hero { grid-template-columns: 1fr; gap: 33px; padding: 55px 22px 72px; }
            .hero h1 { max-width: 540px; font-size: clamp(54px, 15vw, 83px); }
            .hero-copy { font-size: 13px; }
            .hero-visual { min-height: 0; padding-right: 12px; }
            .hero-photo { height: 420px; }
            .photo-stamp { right: -6px; bottom: 12px; width: 91px; height: 91px; }
            .photo-stamp span { font-size: 12px; }
            .image-note { bottom: -24px; }
            .intro { grid-template-columns: 1fr; gap: 22px; padding: 80px 24px; }
            .intro h2 { font-size: 46px; }
            .chapters { grid-template-columns: 1fr; gap: 26px; padding: 0 24px 90px; }
            .chapter, .chapter:nth-child(odd), .chapter:nth-child(even) { grid-template-columns: .88fr 1.12fr; gap: 18px; margin: 0; }
            .chapter:nth-child(2), .chapter:nth-child(3), .chapter:nth-child(4) { margin: 0; }
            .chapter img { height: 185px; }
            .chapter h3 { font-size: 23px; }
            .menu-section { padding: 78px 23px; }
            .menu-heading { align-items: start; flex-direction: column; margin-bottom: 32px; }
            .menu-heading h2 { font-size: 54px; }
            .menu-grid { grid-template-columns: 1fr; gap: 32px; }
            .menu-item img, .menu-placeholder { height: 255px; }
            .experience { grid-template-columns: 1fr; }
            .experience-image { min-height: 0; height: 330px; }
            .experience-content { padding: 58px 25px 68px; }
            .experience-content h2 { font-size: 54px; }
            .closing { padding: 90px 24px; }
            .closing h2 { font-size: 59px; }
            .footer { grid-template-columns: 1fr auto; gap: 15px; padding: 25px 22px; }
            .footer-nav { grid-column: 1 / -1; grid-row: 2; flex-wrap: wrap; gap: 14px 20px; }
            .copyright { grid-column: 2; grid-row: 1; }
        }
    </style>
</head>
<body>
<div class="site-shell">
    <div id="story-backdrop" class="story-backdrop" aria-hidden="true"></div>
    <aside id="project-story-panel" class="story-panel" aria-hidden="true" aria-label="Latar belakang project">
        <div class="story-panel-header">
            <div class="eyebrow">Latar belakang</div>
            <button type="button" class="story-close" aria-label="Tutup panel" data-close-story>×</button>
        </div>
        <div class="story-panel-content">
            <div class="eyebrow">DKVoc</div>
            <h3>Project ini lahir dari rasa ingin membuat kopi lebih dekat dengan keseharian.</h3>
            <p>DKVoc adalah website simulasi toko kopi digital, dibuat untuk menampilkan pengalaman menjelajahi produk, mengenal karakter kopi, dan mencoba alur pemesanan secara online. Semua produk dan transaksi di website ini hanya untuk demonstrasi—DKVoc bukan toko resmi dan tidak menerima pesanan atau pembayaran sungguhan.</p>
            <p>Website ini merupakan proyek mandiri yang saya kerjakan sebagai bagian dari pembelajaran di SMK. Proyek ini menjadi ruang untuk menerapkan hal-hal yang saya pelajari sekaligus memenuhi tugas sekolah yang akan dinilai oleh guru.</p>
            <p>Dengan menjelaskan bahwa ini adalah simulasi proyek sekolah, saya ingin menjaga ekspektasi pengunjung: website ini adalah karya pembelajaran, bukan layanan komersial resmi.</p>
            <a class="button-dark" href="#menu" data-close-story>Jelajahi kopi</a>
        </div>
    </aside>

    <header class="header">
        <a class="brand" href="{{ url('/') }}">DKVoc<small>BIJI KOPI SANGRAI PILIHAN</small></a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-nav">Menu <span aria-hidden="true">+</span></button>
        <nav class="nav" id="main-nav" aria-label="Navigasi utama">
            <a href="#cerita">Tentang kopi</a>
            <a href="#menu">Koleksi</a>
            <a href="#cara-belanja">Cara belanja</a>
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a href="{{ route('admin.menus.index') }}">Kelola produk</a>
                @else
                    <a href="{{ route('wishlist.index') }}">Wishlist</a>
                    <a href="{{ route('menus.index') }}">Buka katalog</a>
                @endif
            @else
                <a class="nav-auth-link" href="{{ route('login') }}">Masuk</a>
                <a class="nav-cta" href="{{ route('register') }}">Daftar <span aria-hidden="true">↗</span></a>
            @endauth
        </nav>
    </header>

    <main>
        <section class="hero" aria-labelledby="hero-title">
            <div class="reveal">
                <div class="eyebrow">DKVoc</div>
                <h1 id="hero-title">Temukan biji kopi <em>favoritmu.</em></h1>
                <p class="hero-copy">Jelajahi pilihan biji kopi sangrai untuk teman seduh di rumah. Kenali karakter tiap produk, pilih jumlahnya, lalu lanjutkan pemesanan lewat katalog.</p>
                <div class="hero-actions">
                    <a class="button-dark" href="#menu">Jelajahi koleksi <span aria-hidden="true">&nbsp;↗</span></a>
                    <button class="story-trigger text-link" type="button" aria-expanded="false" aria-controls="project-story-panel">Latar belakang project <span aria-hidden="true">→</span></button>
                </div>
            </div>
            <div class="hero-visual reveal">
                <img class="hero-photo" src="{{ asset('images/DapoerKopiFOtoKopiDiDepanJeep.png') }}" alt="Biji kopi sangrai dan perlengkapan untuk menyeduh kopi">
                <div class="photo-stamp" aria-label="Temukan seduhan favorit"><span>Temukan<br>seduhan<br>favoritmu</span></div>
                <p class="image-note">PILIH BIJI · TENTUKAN SEDUHAN · NIKMATI JEDA</p>
            </div>
        </section>

        <div class="ticker" aria-label="Informasi kopi">
            <div class="ticker-track" aria-hidden="true">
                @for ($i = 0; $i < 2; $i++)
                    <span>Kenali karakter biji kopi</span><b>✳</b><span>Pilih sangrai yang kamu suka</span><b>✳</b><span>Temukan teman seduhmu</span><b>✳</b>
                @endfor
            </div>
        </div>

        <section class="intro" id="cerita">
            <div class="section-index">01 / PILIHAN KOPI</div>
            <div>
                <h2>Seduhan nikmat dimulai dari <em>biji yang tepat.</em></h2>
                <p class="intro-copy">Jelajahi pilihan biji kopi sangrai DKVoc dan temukan karakter yang cocok dengan seleramu. Pilih kopi untuk melengkapi seduhan dan rutinitas harianmu.</p>
                <a class="text-link intro-link" href="#menu">Lihat pilihan biji kopi <span aria-hidden="true">→</span></a>
            </div>
        </section>

        <section class="chapters" aria-label="Panduan memilih biji kopi">
            <article class="chapter">
                <div class="chapter-copy"><span class="chapter-number">LANGKAH 01</span><h3>Pilih karakter</h3><p>Baca deskripsi produk untuk mengenali karakter kopi yang ingin kamu coba.</p></div>
                <img src="{{ asset('images/DapoerKopiFotoBijiKopi3.png') }}" alt="Biji kopi pilihan sebelum diseduh">
            </article>
            <article class="chapter">
                <div class="chapter-copy"><span class="chapter-number">LANGKAH 02</span><h3>Tentukan seduhan</h3><p>Bayangkan cara seduh favoritmu dan pilih kopi yang cocok untuk rutinitas harian.</p></div>
                <img src="{{ asset('images/DapoerKopiFotoCangkirKopi2.png') }}" alt="Kopi disiapkan untuk dinikmati">
            </article>
            <article class="chapter">
                <div class="chapter-copy"><span class="chapter-number">LANGKAH 03</span><h3>Atur keranjang</h3><p>Pilih jumlah produk di keranjang sebelum melanjutkan pemesanan.</p></div>
                <img src="{{ asset('images/DapoerKopiWadahHijauPutih.png') }}" alt="Secangkir kopi yang sudah diseduh">
            </article>
            <article class="chapter">
                <div class="chapter-copy"><span class="chapter-number">PILIHAN</span><h3>Seduh di rumah</h3><p>Temukan biji kopi yang menemani ritual minum kopi sehari-hari.</p></div>
                <img src="{{ asset('images/DapoerKopiCangkirKopi.png') }}" alt="Peralatan kopi untuk menyeduh di rumah">
            </article>
        </section>

        <section class="menu-section" id="menu">
            <div class="menu-heading">
                <div><div class="eyebrow">02 / BIJI KOPI SANGRAI</div><h2>Pilih kopi untuk seduhanmu.</h2></div>
                @auth
                    <a class="text-link" href="{{ auth()->user()->isAdmin() ? route('admin.menus.index') : route('menus.index') }}">{{ auth()->user()->isAdmin() ? 'Kelola katalog' : 'Lihat seluruh katalog' }} <span aria-hidden="true">↗</span></a>
                @else
                    <a class="text-link" href="{{ route('menus.index') }}">Jelajahi katalog <span aria-hidden="true">↗</span></a>
                @endauth
            </div>
            <div class="menu-grid">
                @forelse ($menus as $menu)
                    <article class="menu-item">
                        @if ($menu->foto)
                            <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}">
                        @else
                            <div class="menu-placeholder" aria-hidden="true">VOC</div>
                        @endif
                        <div class="menu-meta"><h3>{{ $menu->nama_menu }}</h3><span>Rp {{ number_format($menu->harga, 0, ',', '.') }}</span></div>
                        <p>{{ $menu->deskripsi ?: 'Salah satu rasa yang menemani cerita DKVoc.' }}</p>
                    </article>
                @empty
                    <p class="empty-menu">Koleksi kopi sedang disiapkan. Kembali lagi untuk melihat biji kopi sangrai pilihan.</p>
                @endforelse
            </div>
        </section>

        <section class="experience" id="cara-belanja">
            <div class="experience-image"><img src="{{ asset('images/DapoerKopiKasir.png') }}" alt="Biji kopi dan perlengkapan untuk membuat seduhan"></div>
            <div class="experience-content">
                <div class="eyebrow">03 / PEMESANAN</div>
                <h2>Pilih, pesan, nikmati.</h2>
                <p>Temukan biji kopi yang kamu suka, masukkan ke keranjang, lalu atur jumlah sebelum menyelesaikan pemesanan.</p>
                @guest
                    <a class="text-link" href="{{ route('login') }}">Masuk untuk mencoba katalog <span aria-hidden="true">↗</span></a>
                @else
                    <a class="text-link" href="{{ auth()->user()->isAdmin() ? route('admin.menus.index') : route('menus.index') }}">{{ auth()->user()->isAdmin() ? 'Kelola produk' : 'Coba katalog' }} <span aria-hidden="true">↗</span></a>
                @endguest
            </div>
        </section>

        <section class="closing">
            <div class="eyebrow">DKVoc · KOPI UNTUK JEDA SEHARI-HARI</div>
            <h2>Seduh sesuatu yang kamu suka.</h2>
            <p>Jelajahi pilihan biji kopi sangrai untuk seduhan favorit di rumah.</p>
            <a class="button-dark" href="#menu">Lihat koleksi kopi <span aria-hidden="true">&nbsp;↑</span></a>
        </section>
    </main>

    <footer class="footer">
        <a class="footer-brand" href="{{ url('/') }}">DKVoc</a>
        <nav class="footer-nav" aria-label="Navigasi footer"><a href="#cerita">Tentang kopi</a><a href="#menu">Koleksi</a><a href="#cara-belanja">Cara belanja</a>@guest<a href="{{ route('login') }}">Masuk</a><a href="{{ route('register') }}">Daftar</a>@endguest</nav>
        <span class="copyright">Kopi untuk jeda sehari-hari · {{ date('Y') }}</span>
    </footer>
</div>
<script>
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('#main-nav');
    const storyBackdrop = document.getElementById('story-backdrop');
    const storyPanel = document.getElementById('project-story-panel');
    const storyTrigger = document.querySelector('.story-trigger');
    const closeStoryButtons = document.querySelectorAll('[data-close-story]');

    const setStoryOpen = (isOpen) => {
        storyPanel?.classList.toggle('is-open', isOpen);
        storyBackdrop?.classList.toggle('is-visible', isOpen);
        storyPanel?.setAttribute('aria-hidden', String(!isOpen));
        storyBackdrop?.setAttribute('aria-hidden', String(!isOpen));

        if (storyTrigger) {
            storyTrigger.setAttribute('aria-expanded', String(isOpen));
        }
    };

    storyTrigger?.addEventListener('click', () => {
        const isOpen = !storyPanel?.classList.contains('is-open');
        setStoryOpen(isOpen);
    });

    closeStoryButtons.forEach((button) => {
        button.addEventListener('click', () => setStoryOpen(false));
    });

    storyBackdrop?.addEventListener('click', () => setStoryOpen(false));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            setStoryOpen(false);
        }
    });

    menuToggle?.addEventListener('click', () => {
        const isOpen = mainNav.classList.toggle('is-open');
        menuToggle.setAttribute('aria-expanded', String(isOpen));
        menuToggle.querySelector('span').textContent = isOpen ? '×' : '+';
    });

    mainNav?.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            mainNav.classList.remove('is-open');
            menuToggle?.setAttribute('aria-expanded', 'false');
            if (menuToggle) menuToggle.querySelector('span').textContent = '+';
        });
    });
</script>
</body>
</html>
