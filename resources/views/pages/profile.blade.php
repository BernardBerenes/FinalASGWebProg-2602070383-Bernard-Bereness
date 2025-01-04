@extends('layout.main')

@section('content')
<div class="container mt-4">
    <div class="text-center mb-4">
        <h1>{{ Auth::user()->name }}'s Profile</h1>
        <p class="text-muted">{{ Auth::user()->email }}</p>
        <img src="{{ asset('assets/images/default-avatar.png') }}" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
    </div>
    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Profile Details</h5>
            <ul class="list-group">
                <li class="list-group-item"><strong>Gender: </strong>{{ Auth::user()->gender }}</li>
                <li class="list-group-item"><strong>Profession:</strong>{{ Auth::user()->fields_of_interest }}</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h5>Profile Visibility</h5>
            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="profileVisibilityToggle" {{ Auth::user()->visibility ? 'checked' : '' }}>
                <label class="form-check-label" for="profileVisibilityToggle">Make Profile Visible</label>
            </div>
            <p class="text-muted mt-2">Toggle to show or hide your profile from others.</p>
        </div>
    </div>
    <div class="mb-4">
        <h5>Your Avatars</h5>
        <div class="row">
            {{-- @forelse($avatars as $avatar) --}}
                <div class="col-md-3 mb-3">
                    <div class="card text-center">
                        <img src="{{ asset('assets/images/default-avatar.png') }}" alt="Avatar" class="card-img-top" style="height: 100px; object-fit: contain;">
                        <div class="card-body">
                            <p class="card-text">{{ 'PP' }}</p>
                        </div>
                    </div>
                </div>
            {{-- @empty --}}
                <p class="text-muted">You don't have any avatars yet.</p>
            {{-- @endforelse --}}
        </div>
    </div>
    <div class="text-center">
        <a href="" class="btn btn-primary">Buy New Avatars</a>
    </div>
</div>
@endsection
