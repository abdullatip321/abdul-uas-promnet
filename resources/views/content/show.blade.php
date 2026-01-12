{{-- resources/views/contents/show.blade.php --}}
@extends('template.app')

@section('title', 'Detail Content')
@section('menu-title', 'Detail Content')

@section('styles')
<style>
    .detail-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .content-header-section {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
    }

    .content-main-title {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    .content-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-top: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #666;
        font-size: 0.9rem;
    }

    .meta-item i {
        color: #667eea;
        font-size: 1rem;
    }

    .meta-label {
        font-weight: 600;
        color: #495057;
    }

    .content-status {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .status-publish {
        background: #d4edda;
        color: #155724;
    }

    .status-draft {
        background: #fff3cd;
        color: #856404;
    }

    .content-body {
        margin-top: 2rem;
    }

    .content-section {
        margin-bottom: 3rem;
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }

    .section-number {
        display: inline-block;
        
        color: black;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        text-align: center;
        line-height: 32px;
        font-weight: bold;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .section-content {
        color: #495057;
        line-height: 1.8;
        font-size: 1rem;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .section-image {
        margin-top: 1.5rem;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .section-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .image-caption {
        padding: 1rem;
        background: white;
        color: #666;
        font-size: 0.9rem;
        font-style: italic;
        text-align: center;
    }

    .action-bar {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        transition: all 0.2s;
    }

    .btn-back {
        background: #6c757d;
        color: white;
    }

    .btn-back:hover {
        background: #5a6268;
    }

    .btn-edit {
        background: var(--warning);
        color: white;
    }

    .btn-edit:hover {
        background: var(--warning-hover);
    }

    .btn-delete {
        background: var(--danger);
        color: white;
    }

    .btn-delete:hover {
        background: var(--danger-hover);
    }

    .empty-content {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }

    .empty-content i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .content-main-title {
            font-size: 1.5rem;
        }

        .content-meta {
            flex-direction: column;
            gap: 0.75rem;
        }

        .action-bar {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<!-- Action Bar -->
<div class="action-bar">
    <a href="{{ route('contents.index') }}" class="btn btn-back">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>
    <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-edit">
        <i class="fas fa-edit"></i>
        Edit
    </a>
    <form action="{{ route('contents.destroy', $content->id) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-delete delete-btn">
            <i class="fas fa-trash"></i>
            Hapus
        </button>
    </form>
</div>

<!-- Content Detail Card -->
<div class="detail-card">
    <!-- Header Section -->
    <div class="content-header-section">
        <h1 class="content-main-title">{{ $content->judul }}</h1>
        
        <div class="content-meta">
            <div class="meta-item">
                <i class="fas fa-user"></i>
                <span class="meta-label">Penulis:</span>
                <span>{{ $content->penulis->name ?? 'Unknown' }}</span>
            </div>
            
            <div class="meta-item">
                <i class="fas fa-calendar"></i>
                <span class="meta-label">Dibuat:</span>
                <span>{{ $content->created_at->format('d M Y, H:i') }}</span>
            </div>
            
            <div class="meta-item">
                <i class="fas fa-clock"></i>
                <span class="meta-label">Diupdate:</span>
                <span>{{ $content->updated_at->format('d M Y, H:i') }}</span>
            </div>
            
            <div class="meta-item">
                <i class="fas fa-link"></i>
                <span class="meta-label">Slug:</span>
                <span>{{ $content->slug }}</span>
            </div>
            
            <div class="meta-item">
                <i class="fas fa-info-circle"></i>
                <span class="meta-label">Status:</span>
                <span class="content-status status-{{ $content->status }}">
                    {{ ucfirst($content->status) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Content Body -->
    <div class="content-body">
        @if($content->isi->isEmpty())
            <div class="empty-content">
                <i class="fas fa-file-alt"></i>
                <p>Belum ada isi content</p>
            </div>
        @else
            @foreach($content->isi->sortBy('nomor') as $isi)
            <div class="content-section">
                <div class="section-number">{{ $isi->subjudul }}</div>
                
                @if($isi->isi)
                    <div class="section-content">{{ $isi->isi }}</div>
                @endif
                
                @if($isi->gambar)
                    <div class="section-image">
                        <img src="{{ asset('storage/' . $isi->gambar->path) }}" 
                             alt="{{ $isi->gambar->description ?? 'Content Image' }}">
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
    </div>

    <!-- Additional Images -->
    @if($content->gambar->whereNotIn('id', $content->isi->pluck('gambar_id'))->count() > 0)
    <div class="content-header-section" style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid #e9ecef;">
        <h3 style="font-size: 1.3rem; font-weight: 600; color: #333; margin-bottom: 1.5rem;">
            <i class="fas fa-images" style="color: #667eea;"></i>
            Gambar Tambahan
        </h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1rem;">
            @foreach($content->gambar->whereNotIn('id', $content->isi->pluck('gambar_id')) as $gambar)
            <div class="section-image">
                <img src="{{ asset('storage/' . $gambar->path) }}" 
                     alt="{{ $gambar->description ?? 'Additional Image' }}">
                @if($gambar->description)
                    <div class="image-caption">
                        {{ $gambar->description }}
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Delete confirmation
    document.querySelector('.delete-btn')?.addEventListener('click', function(e) {
        e.preventDefault();
        const form = this.closest('form');
        
        Swal.fire({
            title: 'Hapus Content?',
            html: `
                <p>Content <strong>{{ $content->judul }}</strong> akan dihapus permanen.</p>
                <p style="color: #dc3545;">Data yang dihapus tidak dapat dikembalikan!</p>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection