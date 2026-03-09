@extends('layout')
@section('title', 'Account Settings')
@section('pagetitle', 'Account Settings')

@section('main')
    <div>

        <form action="{{ route('changeCreds') }}" method="POST">

            @method('PUT')
            @csrf

            <div class="mb-4 flex flex-col">
                <label for="newUsername" class="mb-2 font-semibold">New Username</label>
                <input type="text" id="newUsername" name="newUsername" class="input text-white px-3 py-2 border rounded w-md"
                    value="{{ $username }}" />
            </div>

            <div class="mb-4 flex flex-col">
                <label for="currentPassword" class="mb-2 font-semibold">Current Password</label>
                <input type="password" id="currentPassword" name="currentPassword"
                    class="input text-white px-3 py-2 border rounded w-md" />
            </div>

            <div class="mb-4 flex flex-col">
                <label for="newPassword" class="mb-2 font-semibold">New Password</label>
                <input type="password" id="newPassword" name="newPassword"
                    class="input text-white px-3 py-2 border rounded w-md" />
            </div>

            <div class="mb-4 flex flex-col">
                <label for="newPassword_confirmation" class="mb-2 font-semibold">Confirm Password</label>
                <input type="password" id="newPassword_confirmation" name="newPassword_confirmation"
                    class="input text-white px-3 py-2 border rounded w-md" />
            </div>

            <button class="mb-4 mt-4 btn w-md bg-neutral">Update</button>

        </form>

    </div>
@endsection
