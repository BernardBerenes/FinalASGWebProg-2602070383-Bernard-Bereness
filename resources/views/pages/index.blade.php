@extends('layout.main')

@section('content')
<div class="container mt-4">
    <div class="text-center mb-4">
        <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" alt="...">
        <h1>Welcome to ConnectFriend</h1>
        <p>Find friends based on your interests and profession</p>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <select id="genderFilter" class="form-select">
                <option value="" selected>Filter by Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="col-md-8">
            <input type="text" id="searchField" class="form-control" placeholder="Search by Hobby or Field of Work">
        </div>
    </div>
    <div class="row" id="userGallery">
        @foreach($users as $user)
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="d-flex justify-content-center mt-4">
                        <img src="{{ asset('assets/images/default-avatar.png') }}" class="card-img-top" alt="User Photo" style="width: 150px; height: 150px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">Profession: {{ Str::limit(implode(', ', json_decode($user->fields_of_interest, true)), 30, '...') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('friendPage') }}" class="btn btn-primary">See More</a>
    </div>
</div>
@endsection