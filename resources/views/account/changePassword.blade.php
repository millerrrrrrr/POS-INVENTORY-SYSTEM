@extends('layout')
@section('title', 'Change Password')
@section('pagetitle', 'Change Password')

@section('main')
    <form action=" {{ route('changePasswordPost') }}" method="POST">
    @csrf

    <div class="mb-4 flex flex-col">
        <label for="currentPassword" class="mb-2 font-semibold">Current Password</label>
        <input type="password" id="currentPassword" name="currentPassword" class="input text-white px-3 py-2 border rounded w-md" />
    </div>

    <div class="mb-4 flex flex-col">
        <label for="newPassword" class="mb-2 font-semibold">New Password</label>
        <input type="password" id="newPassword" name="password" class="input text-white px-3 py-2 border rounded w-md" />
    </div>

    <div class="mb-4 flex flex-col">
        <label for="confirmPassword" class="mb-2 font-semibold">Confirm Password</label>
        <input type="password" id="confirmPassword" name="password_confirmation" class="input text-white px-3 py-2 border rounded w-md" />
    </div>

    <button class="mb-4 mt-4 btn w-md bg-neutral">Update</button>
</form>


@endsection
