{{-- resources/views/contents/index.blade.php --}}
@extends('template.app')

@section('title', 'Daftar Content')
@section('menu-title', 'Manajemen Content')

@section('styles')
<style>
    .content-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
    }

    .content-title {
        font-weight: 600;
        color: #333;
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .filter-group {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .filter-select {
        padding: 0.5rem 1rem;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 0.875rem;
        background-color: white;
        cursor: pointer;
    }

    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        opacity: 0.9;
    }

    .status-publish {
        background-color: #d4edda;
        color: #155724;
    }

    .status-draft {
        background-color: #fff3cd;
        color: #856404;
    }
</style>
@endsection

@section('content')
<div class="content-header">
    <!-- Stats Cards -->
    <div class="stats-card">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-value">{{ $contents->total() }}</div>
                <div class="stat-label">Total Content</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ \App\Models\Content::where('status', 'publish')->count() }}</div>
                <div class="stat-label">Published</div>
            </div>
            <div class="stat-item">
                <div class="stat-value">{{ \App\Models\Content::where('status', 'draft')->count() }}</div>
                <div class="stat-label">Draft</div>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <div class="controls-row">
        <div class="search-wrapper">
            <form action="{{ route('contents.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="search-input" placeholder="Cari judul content..." 
                       value="{{ request('search') }}">
                <div class="filter-group">
                    <select name="status" class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="publish" {{ request('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <a href="{{ route('contents.create') }}" class="add-member-btn">
            <i class="fas fa-plus"></i>
            Tambah Content
        </a>
    </div>
</div>

<!-- Table -->
<div class="table-wrapper">
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contents as $index => $content)
                <tr>
                    <td>{{ $contents->firstItem() + $index }}</td>
                    <td>
                        @if($content->gambar->first())
                            <img src="{{ asset('storage/' . $content->gambar->first()->path) }}" 
                                 alt="Thumbnail" class="content-image">
                        @else
                            <div class="content-image" style="background: #e9ecef; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="color: #adb5bd;"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="content-title" title="{{ $content->judul }}">
                            {{ $content->judul }}
                        </div>
                        <small class="text-muted">{{ $content->slug }}</small>
                    </td>
                    <td>{{ $content->penulis->name ?? 'Unknown' }}</td>
                    <td>
                        <span class="status-badge status-{{ $content->status }}">
                            {{ ucfirst($content->status) }}
                        </span>
                    </td>
                    <td>{{ $content->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('contents.show', $content->id) }}" class="action-btn btn-view" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('contents.edit', $content->id) }}" class="action-btn btn-edit" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('contents.destroy', $content->id) }}" method="POST" 
                                  class="delete-form" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="action-btn btn-delete delete-btn" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">
                        <i class="fas fa-inbox" style="font-size: 3rem; color: #dee2e6;"></i>
                        <p style="margin-top: 1rem; color: #6c757d;">Belum ada content</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($contents->hasPages())
    <div class="pagination-wrapper">
        {{ $contents->links() }}
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Delete confirmation
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            
            Swal.fire({
                title: 'Hapus Content?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
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
    });

    // Success/Error messages
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>
@endsection