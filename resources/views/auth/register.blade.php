{{-- resources/views/auth/register.blade.php --}}
@extends('template.landing')

@section('title', 'Register - Laravel Blog')

@section('styles')
<style>
    .auth-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 0;
    }

    .auth-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        padding: 3rem;
        width: 100%;
        max-width: 450px;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
    }

    .auth-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .auth-subtitle {
        color: #6B7280;
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--dark);
        font-size: 0.9rem;
    }

    .form-control {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .form-control.is-invalid {
        border-color: var(--danger);
    }

    .invalid-feedback {
        display: block;
        color: var(--danger);
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .password-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6B7280;
        cursor: pointer;
        padding: 0.5rem;
    }

    .password-toggle:hover {
        color: var(--primary);
    }

    .password-strength {
        margin-top: 0.5rem;
        font-size: 0.85rem;
    }

    .strength-bar {
        height: 4px;
        background: #E5E7EB;
        border-radius: 2px;
        margin-top: 0.5rem;
        overflow: hidden;
    }

    .strength-fill {
        height: 100%;
        transition: all 0.3s;
        border-radius: 2px;
    }

    .strength-weak { background: #EF4444; width: 33%; }
    .strength-medium { background: #F59E0B; width: 66%; }
    .strength-strong { background: #10B981; width: 100%; }

    .terms-check {
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .terms-check input {
        width: 18px;
        height: 18px;
        margin-top: 0.1rem;
        cursor: pointer;
        flex-shrink: 0;
    }

    .terms-check a {
        color: var(--primary);
        text-decoration: none;
    }

    .terms-check a:hover {
        text-decoration: underline;
    }

    .btn-register {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 2rem 0;
        color: #6B7280;
        font-size: 0.9rem;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid #E5E7EB;
    }

    .divider span {
        padding: 0 1rem;
    }

    .login-link {
        text-align: center;
        color: #6B7280;
        font-size: 0.95rem;
    }

    .login-link a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }

    .alert-danger {
        background: #FEE2E2;
        color: #991B1B;
        border: 1px solid #FCA5A5;
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-logo">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2 class="auth-title">Buat Akun Baru</h2>
            <p class="auth-subtitle">Daftar untuk mulai menulis artikel</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" id="registerForm">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" 
                       name="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       placeholder="Masukkan nama lengkap"
                       value="{{ old('name') }}"
                       required 
                       autofocus>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" 
                       name="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       placeholder="nama@email.com"
                       value="{{ old('email') }}"
                       required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="password-wrapper">
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Minimal 8 karakter"
                           onkeyup="checkPasswordStrength()"
                           required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                        <i class="far fa-eye" id="toggleIcon1"></i>
                    </button>
                </div>
                <div class="password-strength">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthBar"></div>
                    </div>
                    <small id="strengthText"></small>
                </div>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <div class="password-wrapper">
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation"
                           class="form-control" 
                           placeholder="Ulangi password"
                           required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                        <i class="far fa-eye" id="toggleIcon2"></i>
                    </button>
                </div>
            </div>

            <div class="terms-check">
                <input type="checkbox" name="terms" id="terms" required>
                <label for="terms">
                    Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                </label>
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus"></i>
                Daftar Sekarang
            </button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login Di Sini</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    function checkPasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        strengthBar.className = 'strength-fill';
        
        if (strength <= 2) {
            strengthBar.classList.add('strength-weak');
            strengthText.textContent = 'Password lemah';
            strengthText.style.color = '#EF4444';
        } else if (strength <= 4) {
            strengthBar.classList.add('strength-medium');
            strengthText.textContent = 'Password sedang';
            strengthText.style.color = '#F59E0B';
        } else {
            strengthBar.classList.add('strength-strong');
            strengthText.textContent = 'Password kuat';
            strengthText.style.color = '#10B981';
        }
    }

    // Form validation
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const passwordConfirmation = document.getElementById('password_confirmation').value;
        const terms = document.getElementById('terms').checked;

        if (password !== passwordConfirmation) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Password Tidak Cocok',
                text: 'Password dan konfirmasi password harus sama!',
            });
            return false;
        }

        if (!terms) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Anda harus menyetujui Syarat & Ketentuan',
            });
            return false;
        }
    });
</script>
@endsection