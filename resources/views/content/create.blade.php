{{-- resources/views/contents/create.blade.php --}}
@extends('template.app')

@section('title', 'Tambah Content')
@section('menu-title', 'Tambah Content Baru')

@section('styles')
<style>
    .form-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e9ecef;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #495057;
        font-size: 0.9rem;
    }

    .form-label .required {
        color: #dc3545;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ced4da;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: border-color 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.8rem;
        margin-top: 0.25rem;
    }

    .isi-content-item {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 6px;
        margin-bottom: 1rem;
        border: 1px solid #e9ecef;
        position: relative;
    }

    .remove-isi-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #dc3545;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
    }

    .remove-isi-btn:hover {
        background: #c82333;
    }

    .add-isi-btn {
        background: #667eea;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .add-isi-btn:hover {
        background: #5568d3;
    }

    .image-preview {
        max-width: 200px;
        max-height: 200px;
        margin-top: 0.5rem;
        border-radius: 6px;
        display: none;
    }

    .btn-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e9ecef;
    }

    .btn-primary {
        background: var(--success);
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary:hover {
        background: var(--success-hover);
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
        padding: 0.75rem 2rem;
        border: none;
        border-radius: 6px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
</style>
@endsection

@section('content')
<div class="form-card">
    <form action="{{ route('contents.store') }}" method="POST" enctype="multipart/form-data" id="contentForm">
        @csrf

        <!-- Basic Information -->
        <div class="form-section">
            <h3 class="form-section-title">Informasi Dasar</h3>
            
            <div class="form-group">
                <label class="form-label">
                    Judul Content <span class="required">*</span>
                </label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                       value="{{ old('judul') }}" placeholder="Masukkan judul content" required>
                @error('judul')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    Status <span class="required">*</span>
                </label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="">Pilih Status</option>
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                </select>
                @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Content Sections -->
        <div class="form-section">
            <h3 class="form-section-title">Isi Content</h3>
            
            <div id="isiContentContainer">
                <div class="isi-content-item" data-index="0">
                    <div class="form-group">
                        <label class="form-label">Nomor Urut</label>
                        <input type="number" name="isi_content[0][nomor]" class="form-control" 
                               value="1" placeholder="1">
                    </div>  

                    <div class="form-group">
                        <label for="isi-content-0-isi" class="form-label">
                            Subjudul 
                        </label>
                        <input type="text" name="isi_content[0][subjudul]" class="form-control">

                    </div>

                    <div class="form-group">
                        <label class="form-label">Isi / Deskripsi</label>
                        <textarea name="isi_content[0][isi]" class="form-control" 
                                  placeholder="Tulis isi content..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="gambars[]" class="form-control image-input" 
                               accept="image/*" onchange="previewImageCreate(this, 0)">
                        <img class="image-preview" id="preview-0" alt="Preview">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi Gambar</label>
                        <input type="text" name="gambar_descriptions[]" class="form-control" 
                               placeholder="Deskripsi gambar (opsional)">
                    </div>
                </div>
            </div>

            <button type="button" class="add-isi-btn" onclick="addIsiContent()">
                <i class="fas fa-plus"></i>
                Tambah Bagian Content
            </button>
        </div>

        <!-- Action Buttons -->
        <div class="btn-group">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                Simpan Content
            </button>
            <a href="{{ route('contents.index') }}" class="btn-secondary">
                <i class="fas fa-times"></i>
                Batal
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let isiContentIndex = 1; // Ganti nama variabel agar tidak konflik

    function addIsiContent() {
        const container = document.getElementById('isiContentContainer');
        const newItem = document.createElement('div');
        newItem.className = 'isi-content-item';
        newItem.setAttribute('data-index', isiContentIndex);
        
        newItem.innerHTML = `
            <button type="button" class="remove-isi-btn" onclick="removeIsiContent(this)">
                <i class="fas fa-times"></i>
            </button>

            <div class="form-group">
                <label class="form-label">Nomor Urut</label>
                <input type="number" name="isi_content[${isiContentIndex}][nomor]" class="form-control" 
                       value="${isiContentIndex + 1}" placeholder="${isiContentIndex + 1}">
            </div>

            <div class="form-group">
                <label class="form-label">Isi / Deskripsi</label>
                <textarea name="isi_content[${isiContentIndex}][isi]" class="form-control" 
                          placeholder="Tulis isi content..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambars[]" class="form-control image-input" 
                       accept="image/*" onchange="previewImageCreate(this, ${isiContentIndex})">
                <img class="image-preview" id="preview-${isiContentIndex}" alt="Preview">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Gambar</label>
                <input type="text" name="gambar_descriptions[]" class="form-control" 
                       placeholder="Deskripsi gambar (opsional)">
            </div>
        `;
        
        container.appendChild(newItem);
        isiContentIndex++;
    }

    function removeIsiContent(button) {
        Swal.fire({
            title: 'Hapus bagian ini?',
            text: "Bagian content ini akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                button.closest('.isi-content-item').remove();
            }
        });
    }

    function previewImageCreate(input, index) {
        const preview = document.getElementById(`preview-${index}`);
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Form validation
    document.getElementById('contentForm').addEventListener('submit', function(e) {
        const judul = document.querySelector('input[name="judul"]').value;
        const status = document.querySelector('select[name="status"]').value;

        if (!judul || !status) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: 'Judul dan Status harus diisi!',
            });
            return false;
        }
    });
</script>
@endsection