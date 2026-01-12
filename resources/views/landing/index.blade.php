{{-- resources/views/landing/index.blade.php --}}
@extends('template.landing')

@section('title', 'Laravel Blog - Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="hero-title">Selamat Datang di Laravel Blog</h1>
        <p class="hero-subtitle">
            Temukan artikel menarik tentang teknologi, programming, dan pengembangan web
        </p>
        
        <form action="{{ route('landing') }}" method="GET" class="search-box">
            <input type="text" name="search" class="search-input" 
                   placeholder="Cari artikel..." 
                   value="{{ request('search') }}">
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</section>

<!-- Blog Grid -->
<section class="container mb-5">
    @if(request('search'))
        <div class="mb-4">
            <h5>Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></h5>
            <small class="text-muted">Ditemukan {{ $contents->total() }} artikel</small>
        </div>
    @endif

    @if($contents->isEmpty())
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>Belum Ada Artikel</h3>
            <p class="text-muted">Artikel akan muncul di sini setelah dipublikasikan</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($contents as $content)
            <div class="col-md-6 col-lg-4">
                <div class="blog-card">
                    <div style="position: relative;">
                        @if($content->gambar->first())
                            <img src="{{ asset('storage/' . $content->gambar->first()->path) }}" 
                                 alt="{{ $content->judul }}" 
                                 class="blog-image">
                        @else
                            <div class="blog-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="font-size: 3rem; color: white; opacity: 0.5;"></i>
                            </div>
                        @endif
                        <span class="status-badge">Published</span>
                    </div>
                    
                    <div class="blog-content">
                        <a href="{{ route('landing.show', $content->slug) }}" class="blog-title">
                            {{ $content->judul }}
                        </a>
                        
                        <p class="blog-excerpt">
                            {{ $content->isi->first()->isi ?? 'Baca selengkapnya untuk melihat isi artikel ini...' }}
                        </p>
                        
                        <div class="blog-meta">
                            <div class="author-info">
                                <img src="{{ asset('img-profile/profile.jpg') }}" 
                                     alt="{{ $content->penulis->name ?? 'Author' }}" 
                                     class="author-avatar">
                                <span class="author-name">{{ $content->penulis->name ?? 'Unknown' }}</span>
                            </div>
                            <span class="blog-date">
                                <i class="far fa-calendar"></i>
                                {{ $content->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($contents->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $contents->links() }}
        </div>
        @endif
    @endif
</section>
@endsection