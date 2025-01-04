@extends('layout.main')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <h5>Filter</h5>
                <form method="GET" action="{{ route('friendPage') }}">
                    <div class="mb-3">
                        <label for="genderFilter" class="form-label">@lang('lang.gender')</label>
                        <select name="gender" id="genderFilter" class="form-select">
                            <option value="">@lang('lang.all')</option>
                            <option value="Male" {{ $gender_filter == 'Male' ? 'selected' : ''}}>@lang('lang.male')</option>
                            <option value="Female" {{ $gender_filter == 'Female' ? 'selected' : ''}}>@lang('lang.female')</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fieldInterestFilter" class="form-label">@lang('lang.fields_of_interest')</label>
                        <input type="text" name="fields_of_interest" id="fieldInterestFilter" class="form-control" placeholder="@lang('lang.search')" value="{{ $fields_of_interest_filter }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">@lang('lang.apply_filter')</button>
                </form>
            </div>
            <div class="col-md-9">
                <h3 class="mb-4">@lang('lang.friend')</h3>
                <div class="row">
                    @foreach($users as $user)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <form method="POST" action="{{ route('addFriend', ['receiver_id'=>$user->id]) }}" class="card-body d-flex align-items-center">
                                    @csrf
                                    <img src="{{ asset('assets/images/default-avatar.png') }}" class="rounded-circle me-3" alt="User Avatar" style="height: 60px; width: 60px; object-fit: cover;">
                                    <div>
                                        <h5 class="card-title mb-1">{{ $user->name }}</h5>
                                        <p class="card-text mb-1 text-muted">{{ Str::limit(implode(', ', json_decode($user->fields_of_interest, true)), 20, '...') }}</p>
                                        <button type="submit" class="btn btn-primary btn-sm">👍 @lang('lang.add_friend')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
