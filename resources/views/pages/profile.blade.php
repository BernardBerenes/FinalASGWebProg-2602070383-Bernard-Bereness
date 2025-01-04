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
                <h5>@lang('lang.profile_detail')</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>@lang('lang.gender'): </strong>{{ Auth::user()->gender }}</li>
                    <li class="list-group-item"><strong>@lang('lang.fields_of_interest'): </strong>{{ implode(', ', json_decode(Auth::user()->fields_of_interest, true)) }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>@lang('lang.profile_visibility')</h5>
                <form method="POST" action="{{ route('changeVisibility') }}" id="visibilityForm" class="d-flex align-items-center">
                    @csrf
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" id="profileVisibilityToggle" {{ Auth::user()->visibility ? 'checked' : '' }}>
                        <label class="form-check-label" for="profileVisibilityToggle">@lang('lang.make_profile_visible')</label>
                    </div>
                </form>
                <p class="text-muted mt-2">@lang('lang.toggle_visible')</p>
            </div>
        </div>
        <div class="mb-4">
            <h5>@lang('lang.your_avatar')</h5>
            <div class="row">
                @forelse($avatars as $avatar)
                    <div class="col-md-3 mb-3">
                        <div class="card text-center pt-3">
                            <img src="{{ asset('assets/images/default-avatar.png') }}" alt="Avatar" class="card-img-top" style="height: 100px; object-fit: contain;">
                            <div class="card-body">
                                <p class="card-text">{{ $avatar->name }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">@lang('lang.dont_have_avatar')</p>
                @endforelse
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('avatarMarketPage') }}" class="btn btn-primary">@lang('lang.buy_new_avatar')</a>
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
