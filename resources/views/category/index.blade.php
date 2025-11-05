@extends('layout')
@section('title', 'Category')
@section('pagetitle', 'Category')

@section('main')
    <div class="w-full p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-white">
            <!-- Left Side: Add Category -->
            <div class="col-span-1 ">
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-lg font-semibold mb-4">Add Category</h2>
                        <form action=" {{ route('storeCategory') }} " method="POST">
                            @csrf
                            <div class="form-control mb-4 ">
                                <input type="text" name="category" placeholder="Enter category"
                                    class="input input-bordered w-full focus:outline-none"  />
                            </div>
                            <div class="form-control">
                                <button type="submit" class="btn btn-primary w-full">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side: Category Table -->
            <div class="col-span-1 md:col-span-2">
                <form action=" {{ route('categoryIndex') }} " method="GET" class="flex items-center gap-2 ">
                    <div class="join mb-2">
                        <input type="text" name="category" value="{{ request('category') }}"
                            class="input join-item focus:outline-none" placeholder="Search..." />
                        <button class="btn join-item btn-primary " type="submit">Find</button>

                    </div>
                    <a href="{{ route('categoryIndex') }}" class="btn  bg-base-300  ml-auto">
                        Clear
                    </a>
                </form>
                <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100  text-base-content">

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($category as $cat)
                                <tr>
                                    <td class="uppercase"> {{ $cat->category }} </td>
                                    <td>
                                        <a href=" {{ route('editCategory', $cat->id) }} ">
                                            <button class="btn btn-info">
                                                Edit
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <form action=" {{ route('deleteCategory', $cat->id) }} " method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="uppercase">No Categories Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $category->links('vendor.pagination.simple-tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
