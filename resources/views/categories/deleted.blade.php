@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-21 col-md-13">
                <div class="card">
                    <div class="card-header">
                        </h5>Deleted Categories</h5>
                    </div>
                    <div class="card-body">
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
                                                <tr class="text-center">
                                                    <td>{{ $category->created_at }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>
                                                        <button class="btn btn-primary"
                                                            class="btn btn-outline-success btn-sm" data-toggle="modal"
                                                            data-target="#restoreModal{{ $category->id }}">
                                                            {{ __('Restore') }}
                                                        </button>
                                                        <div class="modal fade" id="restoreModal{{ $category->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            {{ __('Restore') }}</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('categories.restore', $category->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <p>{{ __('Are you sure you want to restore this category?') }}
                                                                            </p>
                                                                            <p>{{ __('Category name:') }}
                                                                                {{ $category->name }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ __('Close') }}</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">{{ __('Restore') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <button class="btn btn-danger"
                                                            class="btn btn-outline-success btn-sm" data-toggle="modal"
                                                            data-target="#deleteModal{{ $category->id }}">
                                                            {{ __('Delete') }}
                                                        </button>
                                                        <div class="modal fade" id="deleteModal{{ $category->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            {{ __('Delete') }}</h5>
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
                                                                            @method('PUT')
                                                                            <div class="modal-body">
                                                                                {{ __('Are you sure you want to delete this product?') }}
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">{{ __('Close') }}</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">{{ __('Delete') }}</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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
            </div>
        </div>
    </div>
@endsection
