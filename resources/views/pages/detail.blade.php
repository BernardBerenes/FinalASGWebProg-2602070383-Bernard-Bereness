@extends('layout.main')

@section('content')
    <div class="container mt-4">
        <div class="text-center mb-4">
            <h1>{{ $user->name }}'s Profile</h1>
            <p class="text-muted">{{ $user->email }}</p>
            <img src="{{ $user->profile_picture ?: asset('assets/images/default-avatar.png') }}" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>@lang('lang.profile_detail')</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>@lang('lang.gender'): </strong>{{ $user->gender }}</li>
                    <li class="list-group-item"><strong>@lang('lang.fields_of_work'): </strong>{{ implode(', ', json_decode($user->fields_of_work, true)) }}</li>
                    <li class="list-group-item"><strong>LinkedIn: </strong><a href="{{ $user->linkedin_username }}" target="_blank" rel="noopener noreferrer">{{ $user->linkedin_username }}</a></li>
                </ul>
            </div>
        </div>
    </div>
    <script>
        const toggle = document.getElementById('profileVisibilityToggle');
        const form = document.getElementById('visibilityForm');

        toggle.addEventListener('change', () => {
            form.submit();
        });
    </script>
@endsection
