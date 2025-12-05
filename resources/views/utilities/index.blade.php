@extends('layout')
@section('title', 'Utilities')
@section('pagetitle', 'Utilities')

@section('main')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-white">

    {{-- Order Archive --}}
    <div class="card bg-base-100 shadow-xl border border-gray-200">
        <div class="card-body">
            <h2 class="card-title text-lg font-bold">Order Archive</h2>
            <p>View and manage archived orders. Restore or permanently delete old order records.</p>
            <div class="card-actions justify-end mt-4">
                <a href="" 
                   class="btn btn-primary">Go to Order Archive</a>
            </div>
        </div>
    </div>

    {{-- Product Archive --}}
    <div class="card bg-base-100 shadow-xl border border-gray-200">
        <div class="card-body">
            <h2 class="card-title text-lg font-bold">Product Archive</h2>
            <p>View and manage archived products. Restore products or permanently remove them from inventory.</p>
            <div class="card-actions justify-end mt-4">
                <a href=" {{ route('productArchive') }} " 
                   class="btn btn-primary">Go to Product Archive</a>
            </div>
        </div>
    </div>

    {{-- Backup --}}
    <div class="card bg-base-100 shadow-xl border border-gray-200">
        <div class="card-body">
            <h2 class="card-title text-lg font-bold">Backup</h2>
            <p>Create database backups, download, or restore previous backups to ensure data safety.</p>
            <div class="card-actions justify-end mt-4">
                <a href="" 
                   class="btn btn-primary">Manage Backups</a>
            </div>
        </div>
    </div>

</div>

@endsection
