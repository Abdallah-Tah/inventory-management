@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-21 col-md-13">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Categories</h5>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                Add Category
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('layouts.message-flash')

                        <div class="card-body table-responsive">
                            <div style="clear: both;margin-top: 18px;">
                                <table id="dataTable" class="display table table-striped table-hover" cellspacing="0"
                                    width="100%"
                                    data-export-title="Exported data on {{ \carbon\carbon::now()->format('d/m/Y') }}">
                                    <thead class="p-3 mb-2 text-secondary">
                                        <tr class="text-center">
                                            <th>{{ __('Created at') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->created_at }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-success btn-sm"
                                                        data-toggle="modal" data-target="#editModal{{ $category->id }}">
                                                        {{ __('Edit') }}
                                                    </button>
                                                    <!--- Modal -->
                                                    <div class="modal fade" id="editModal{{ $category->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        Category</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('categories.update', $category->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="name">Name</label>
                                                                            <input type="text" class="form-control"
                                                                                id="name" name="name"
                                                                                value="{{ $category->name }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Update</button>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--- End Modal -->

                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-toggle="modal" data-target="#deleteModal{{ $category->id }}">
                                                        {{ __('Delete') }}
                                                    </button>

                                                    <!--- Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $category->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                        Category</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('categories.destroy', $category->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <p>Are you sure you want to delete this category?
                                                                        </p>
                                                                        <p>{{ $category->name }}</p>
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--- End Modal -->

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--- Modal -->
            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>                               
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
