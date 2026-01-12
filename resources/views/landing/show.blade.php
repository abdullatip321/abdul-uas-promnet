{{-- resources/views/landing/show.blade.php --}}
@extends('template.landing')

@section('title', $content->judul . ' - Laravel Blog')

@section('styles')
<style>
    .article-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4rem 0 2rem;
        margin-bottom: 3rem;
    }

    .article-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        opacity: 0.95;
    }

    .meta-item i {
        font-size: 1.1rem;
    }

    .article-container {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        padding: 3rem;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        margin-bottom: 3rem;
    }

    .article-section {
        margin-bottom: 3rem;
    }

    .section-number {
        /* display: inline-flex; */
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
        color: black;
        border-radius: 50%;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .section-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #374151;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .section-image {
        margin-top: 2rem;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .section-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .image-caption {
        padding: 1rem;
        background: #F9FAFB;
        text-align: center;
        color: #6B7280;
        font-style: italic;
        font-size: 0.95rem;
    }

    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: var(--primary);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: background 0.3s;
        margin-bottom: 2rem;
    }

    .back-button:hover {
        background: var(--primary-hover);
        color: white;
    }

    .share-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid #E5E7EB;
    }

    .share-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
    }

    .share-facebook {
        background: #1877F2;
        color: white;
    }

    .share-twitter {
        background: #1DA1F2;
        color: white;
    }

    .share-whatsapp {
        background: #25D366;
        color: white;
    }

    .share-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: white;
    }

    @media (max-width: 768px) {
        .article-title {
            font-size: 1.75rem;
        }

        .article-container {
            padding: 1.5rem;
        }

        .section-text {
            font-size: 1rem;
        }

        .share-buttons {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<!-- Article Header -->
<div class="article-header">
    <div class="container">
        <div class="mb-3">
            <a href="{{ route('landing') }}" class="back-button">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Beranda
            </a>
        </div>
        
        <h1 class="article-title">{{ $content->judul }}</h1>
        
        <div class="article-meta">
            <div class="meta-item">
                <i class="fas fa-user"></i>
                <span>{{ $content->penulis->name ?? 'Unknown' }}</span>
            </div>
            <div class="meta-item">
                <i class="far fa-calendar"></i>
                <span>{{ $content->created_at->format('d M Y') }}</span>
            </div>
            <div class="meta-item">
                <i class="far fa-clock"></i>
                <span>{{ ceil(str_word_count($content->isi->pluck('isi')->implode(' ')) / 200) }} min read</span>
            </div>
        </div>
    </div>
</div>

<!-- Article Content -->
<div class="container">
    <div class="article-container">
        @if($content->isi->isEmpty())
            <div class="empty-state">
                <i class="fas fa-file-alt"></i>
                <h3>Artikel Kosong</h3>
                <p class="text-muted">Konten artikel belum tersedia</p>
            </div>
        @else
            @foreach($content->isi->sortBy('nomor') as $index => $isi)
            <div class="article-section">
                @if($isi->subjudul)
                    <div class="section-number">{{ $isi->subjudul }}</div>
                @endif
                
                @if($isi->isi)
                    <div class="section-text">{{ $isi->isi }}</div>
                @endif
                
                @if($isi->gambar)
                    <div class="section-image">
                        <img src="{{ asset('storage/' . $isi->gambar->path) }}" 
                             alt="{{ $isi->gambar->description ?? $content->judul }}"
                             loading="lazy">
                        @if($isi->gambar->description)
                            <div class="image-caption">
                                {{ $isi->gambar->description }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            @endforeach
        @endif

        <!-- Share Buttons -->
        <div class="share-buttons">
            <strong>Bagikan Artikel:</strong>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
               target="_blank" 
               class="share-btn share-facebook">
                <i class="fab fa-facebook-f"></i>
                Facebook
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($content->judul) }}" 
               target="_blank" 
               class="share-btn share-twitter">
                <i class="fab fa-twitter"></i>
                Twitter
            </a>
            <a href="https://wa.me/?text={{ urlencode($content->judul . ' - ' . request()->fullUrl()) }}" 
               target="_blank" 
               class="share-btn share-whatsapp">
                <i class="fab fa-whatsapp"></i>
                WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection