@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-21 col-md-13">
                <div class="card">
                    <div class="card-header">
                        </h5>Deleted Products</h5>
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
                                                <th>{{ __('Image') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('Category') }}</th>
                                                <th>{{ __('Stock') }}</th>
                                                <th>{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $product->image) }}" width="100"
                                                            height="100" alt="{{ $product->name }}">
                                                    </td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>{{ $product->stock }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#restoreModal{{ $product->id }}">
                                                            {{ __('Restore') }}
                                                        </button>

                                                        <div class="modal fade" id="restoreModal{{ $product->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="restoreModalLabel{{ $product->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="restoreModalLabel{{ $product->id }}">
                                                                            {{ __('Restore') }}
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('products.restore', $product->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="modal-body">
                                                                                <p>{{ __('Are you sure you want to restore this product?') }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-dismiss="modal">{{ __('Close') }}</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">
                                                                                    {{ __('Restore') }}
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteModal{{ $product->id }}">
                                                            {{ __('Delete') }}
                                                        </button>

                                                        <div class="modal fade" id="deleteModal{{ $product->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="deleteModalLabel{{ $product->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel{{ $product->id }}">
                                                                            {{ __('Delete Product') }}</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('products.force-delete', $product->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('GET')
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
