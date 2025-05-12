@extends('layouts.app')

@section('title', 'loginRegister')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Daftar Akun Baru</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="NAMA_PEMBELI" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="NAMA_PEMBELI" name="NAMA_PEMBELI" value="{{ old('NAMA_PEMBELI') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="EMAIL_PEMBELI" class="form-label">Email</label>
                            <input type="email" class="form-control" id="EMAIL_PEMBELI" name="EMAIL_PEMBELI" value="{{ old('EMAIL_PEMBELI') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="NO_PEMBELI" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" id="NO_PEMBELI" name="NO_PEMBELI" value="{{ old('NO_PEMBELI') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="ALAMAT_PEMBELI" class="form-label">Alamat</label>
                            <textarea class="form-control" id="ALAMAT_PEMBELI" name="ALAMAT_PEMBELI" rows="3" required>{{ old('ALAMAT_PEMBELI') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
