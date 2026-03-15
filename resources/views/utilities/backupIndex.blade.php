@extends('layout')
@section('title', 'Manage Backups')
@section('pagetitle', 'Manage Backups')

@section('main')
    <div class="p-4">



        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Database Backups</h2>
            <a href="{{ route('backup.database') }}"
                class="btn bg-gray-800 hover:bg-gray-700 border-none text-white px-4 py-2 rounded">
                Backup
            </a>
        </div>

        @if ($backups->count() > 0)
            <div class="overflow-x-auto ">
                <table class="table table-s">
                    <thead>
                        <tr class="bg-gray-200 text-black">
                            <th class="px-4 py-2 text-center">#</th>
                            <th class="px-4 py-2 text-center">Filename</th>
                            <th class="px-4 py-2 text-center">Created At</th>
                            <th class="px-4 py-2 text-center">Size</th>
                            <th class="px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($backups as $key => $file)
                            <tr class="{{ $key % 2 == 0 ? 'bg-gray-100' : '' }}">
                                <td class="px-4 py-2 text-center">{{ $key + 1 }}</td>
                                <td class="px-4 py-2 text-center">{{ $file->getFilename() }}</td>
                                <td class="px-4 py-2 text-center">{{ date('Y-m-d H:i:s', $file->getCTime()) }}</td>
                                <td class="px-4 py-2 text-center">{{ number_format($file->getSize() / 1024, 2) }} KB</td>
                                <td>
                                    <div class="flex items-center gap-3 justify-center">

                                        {{-- Download --}}
                                        <a href="{{ route('backup.download', $file->getFilename()) }}"
                                            class="bg-gray-700 hover:bg-gray-800 p-2 rounded-md text-white backup-download-btn"
                                            title="Download">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('backup.delete', $file->getFilename()) }}" method="POST"
                                            class="backup-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-gray-700 hover:bg-gray-800 p-2 rounded-md text-white"
                                                title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0115.916 21H8.084a2.25 2.25 0 01-2.244-2.327L5.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.02-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No backups found.</p>
        @endif
        <div class="mt-4">
            {{ $backups->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Delete backup confirmation
            document.querySelectorAll(".backup-delete-form").forEach(function(form) {
                form.addEventListener("submit", function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: "Delete Backup?",
                        text: "This will permanently delete the backup file.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Download backup confirmation
            document.querySelectorAll(".backup-download-btn").forEach(function(link) {
                link.addEventListener("click", function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: "Download Backup?",
                        text: "Do you want to download this backup file?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonColor: "#16a34a",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, download it",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = link.href;
                        }
                    });
                });
            });

        });
    </script>
@endsection
