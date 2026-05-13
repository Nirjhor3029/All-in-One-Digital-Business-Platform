@extends('layouts.dashboard')

@section('title', 'Profile - ' . config('app.name'))

@section('content')
<div class="max-w-3xl space-y-6">
    <h1 class="font-display text-3xl font-bold">Settings</h1>
    <div class="bg-white rounded-card shadow-card p-6 sm:p-8">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="bg-white rounded-card shadow-card p-6 sm:p-8">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="bg-white rounded-card shadow-card p-6 sm:p-8">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
