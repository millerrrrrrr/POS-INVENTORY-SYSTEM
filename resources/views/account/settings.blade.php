@extends('layout')
@section('title', 'Account Settings')
@section('pagetitle', 'Account Settings')

@section('main')
    <div>

        <div class="mb-4 flex flex-col">
            <label for="currentPassword" class="mb-2 font-semibold">Username</label>
            <input type="text" id="currentPassword" name="currentPassword"
                class="input text-white px-3 py-2 border rounded w-md" readonly value=" {{ $user->username }} " / >

            <a href=" {{ route('changeUsername') }} ">
                <button class="mb-4 mt-4 btn w-md bg-neutral">Change Username or Password</button>
            </a>

        </div>

        {{-- <div class="mb-4 flex flex-col">
           <a href="">
             <button class="mb-4 mt-4 btn w-md bg-neutral">Change Passowrd</button>
           </a>
        </div> --}}

     


        {{-- <button class="mb-4 mt-4 btn w-md bg-neutral">Update</button> --}}
    </div>


@endsection
