{{-- resources/views/contents/edit.blade.php --}}
@extends('template.app')

@section('title', 'Edit Content')
@section('menu-title', 'Edit Content')

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

    .existing-image {
        max-width: 200px;
        max-height: 200px;
        margin-top: 0.5rem;
        border-radius: 6px;
        border: 2px solid #e9ecef;
    }

    .image-preview {
        max-width: 200px;
        max-height: 200px;
        margin-top: 0.5rem;
        border-radius: 6px;
        display: none;
    }

    .delete-image-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        padding: 0.5rem;
        background: #fff3cd;
        border-radius: 4px;
    }

    .delete-image-checkbox input {
        width: auto;
    }

    .btn-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e9ecef;
    }

    .btn-primary {
        background: var(--warning);
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
        background: var(--warning-hover);
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
    <form action="{{ route('contents.update', $content->id) }}" method="POST" enctype="multipart/form-data" id="contentForm">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="form-section">
            <h3 class="form-section-title">Informasi Dasar</h3>
            
            <div class="form-group">
                <label class="form-label">
                    Judul Content <span class="required">*</span>
                </label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                       value="{{ old('judul', $content->judul) }}" placeholder="Masukkan judul content" required>
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
                    <option value="draft" {{ old('status', $content->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="publish" {{ old('status', $content->status) == 'publish' ? 'selected' : '' }}>Publish</option>
                </select>
                @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Existing Content Sections -->
        <div class="form-section">
            <h3 class="form-section-title">Isi Content yang Ada</h3>
            
            <div id="isiContentContainer">
                @foreach($content->isi as $index => $isi)
                <div class="isi-content-item" data-index="{{ $index }}" data-id="{{ $isi->id }}">
                    <button type="button" class="remove-isi-btn" onclick="removeExistingIsi(this, {{ $isi->id }})">
                        <i class="fas fa-times"></i>
                    </button>

                    <input type="hidden" name="isi_content[{{ $index }}][id]" value="{{ $isi->id }}">

                    <div class="form-group">
                        <label class="form-label">Nomor Urut</label>
                        <input type="number" name="isi_content[{{ $index }}][nomor]" class="form-control" 
                               value="{{ old("isi_content.$index.nomor", $isi->nomor) }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Isi / Deskripsi</label>
                        <textarea name="isi_content[{{ $index }}][isi]" class="form-control" 
                                  placeholder="Tulis isi content...">{{ old("isi_content.$index.isi", $isi->isi) }}</textarea>
                    </div>

                    @if($isi->gambar)
                    <div class="form-group">
                        <label class="form-label">Gambar Saat Ini</label>
                        <div>
                            <img src="{{ asset('storage/' . $isi->gambar->path) }}" class="existing-image" alt="Current Image">
                            <div class="delete-image-checkbox">
                                <input type="checkbox" name="delete_gambars[]" value="{{ $isi->gambar->id }}" id="delete-{{ $isi->gambar->id }}">
                                <label for="delete-{{ $isi->gambar->id }}">Hapus gambar ini</label>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <!-- New Content Sections -->
        <div class="form-section">
            <h3 class="form-section-title">Tambah Bagian Content Baru</h3>
            
            <div id="newIsiContentContainer"></div>

            <button type="button" class="add-isi-btn" onclick="addNewIsiContent()">
                <i class="fas fa-plus"></i>
                Tambah Bagian Content
            </button>
        </div>

        <!-- Action Buttons -->
        <div class="btn-group">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                Update Content
            </button>
            <a href="{{ route('contents.index') }}" class="btn-secondary">
                <i class="fas fa-times"></i>
                Batal
            </a>
        </div>

        <!-- Hidden field for deleted isi_contents -->
        <input type="hidden" name="delete_isi_contents[]" id="deleteIsiContents" value="">
    </form>
</div>
@endsection

@section('scripts')
<script>
    let newIsiContentIndex = {{ $content->isi->count() }};
    let deletedIsiContentIds = [];

    function addNewIsiContent() {
        const container = document.getElementById('newIsiContentContainer');
        const newItem = document.createElement('div');
        newItem.className = 'isi-content-item';
        newItem.setAttribute('data-index', newIsiContentIndex);
        
        newItem.innerHTML = `
            <button type="button" class="remove-isi-btn" onclick="removeNewIsi(this)">
                <i class="fas fa-times"></i>
            </button>

            <div class="form-group">
                <label class="form-label">Nomor Urut</label>
                <input type="number" name="isi_content[${newIsiContentIndex}][nomor]" class="form-control" 
                       value="${newIsiContentIndex + 1}">
            </div>

            <div class="form-group">
                <label class="form-label">Isi / Deskripsi</label>
                <textarea name="isi_content[${newIsiContentIndex}][isi]" class="form-control" 
                          placeholder="Tulis isi content..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambars[]" class="form-control" 
                       accept="image/*" onchange="previewImageEdit(this, ${newIsiContentIndex})">
                <img class="image-preview" id="preview-${newIsiContentIndex}" alt="Preview">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Gambar</label>
                <input type="text" name="gambar_descriptions[]" class="form-control" 
                       placeholder="Deskripsi gambar (opsional)">
            </div>
        `;
        
        container.appendChild(newItem);
        newIsiContentIndex++;
    }

    function removeNewIsi(button) {
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

    function removeExistingIsi(button, isiId) {
        Swal.fire({
            title: 'Hapus bagian ini?',
            text: "Bagian content yang sudah ada akan dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                deletedIsiContentIds.push(isiId);
                updateDeleteIsiContentsInput();
                button.closest('.isi-content-item').remove();
            }
        });
    }

    function updateDeleteIsiContentsInput() {
        const container = document.querySelector('form');
        // Remove old inputs
        document.querySelectorAll('input[name="delete_isi_contents[]"]').forEach(el => el.remove());
        
        // Add new inputs
        deletedIsiContentIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_isi_contents[]';
            input.value = id;
            container.appendChild(input);
        });
    }

    function previewImageEdit(input, index) {
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