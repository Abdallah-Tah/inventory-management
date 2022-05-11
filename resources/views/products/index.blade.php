@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-21 col-md-13">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('Product') }}</h5>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts.message-flash')

                        <div class="card-body table-responsive">
                            <div style="clear: both;margin-top: 18px;">
                                <table id="dataTable" class="display table table-striped table-hover" cellspacing="0"
                                    width="100%" data-export-title="Exported data on {{ \carbon\carbon::now()->format('d/m/Y') }}">
                                    <thead class="p-3 mb-2 text-secondary">
                                        <tr class="text-center">
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th style="width: 35%;">{{ __('Description') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Category') }}</th>
                                            <th>{{ __('Stock') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="text-center">
                                                    <img src="{{ asset('/images/'.$product->image)}}" alt="{{ $product->name }}"
                                                        width="100px" height="100px"> 
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-success btn-sm"
                                                        data-toggle="modal" data-target="#editModal{{ $product->id }}">
                                                        {{ __('Edit') }}
                                                    </button>

                                                    <!--- Modal -->
                                                    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        {{ __('Edit') }}
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('products.update', $product->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Name') }}</label>
                                                                            <input type="text" class="form-control" id="name"
                                                                                name="name" value="{{ $product->name }}">
                                                                                @error('name')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="description">{{ __('Description') }}</label>
                                                                            <input type="text" class="form-control" id="description"
                                                                                name="description" value="{{ $product->description }}">
                                                                                @error('description')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="price">{{ __('Price') }}</label>
                                                                            <input type="text" class="form-control" id="price"
                                                                                name="price" value="{{ $product->price }}">
                                                                                @error('price')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="stock">{{ __('Category') }}</label>
                                                                            <select class="form-control" id="category_id"
                                                                                name="category_id">
                                                                                @foreach ($categories as $category)
                                                                                    <option value="{{ $category->id }}"
                                                                                        {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                                                        {{ $category->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('category_id')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="stock">{{ __('Stock') }}</label>
                                                                            <input type="text" class="form-control" id="stock"
                                                                                name="stock" value="{{ $product->stock }}">
                                                                                @error('stock')
                                                                                <span class="invalid-feedback" role="alert">
                                                                                    <strong>{{ $message }}</strong>
                                                                                </span>
                                                                                @enderror
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ __('Close') }}</button>
                                                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-toggle="modal" data-target="#deleteModal{{ $product->id }}">
                                                        {{ __('Delete') }}
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        {{ __('Delete') }}
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <div class="model-body">
                                                                        <p>{{ __('Are you sure you want to delete this product?') }}</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">{{ __('Close') }}</button>
                                                                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
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


    <!-- Button trigger modal -->
 

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Add Product')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="{{ __('Name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="{{ __('Description') }}">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">{{ __('Price') }}</label>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="{{ __('Price') }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock">{{ __('Stock') }}</label>
                            <input type="text" class="form-control" id="stock" name="stock"
                                placeholder="{{ __('Stock') }}">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">{{ __('Category') }}</label>
                            <select class="form-control" id="category_id" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">{{ __('Image') }}</label>
                            <input type="file" class="form-control" id="image" name="image"
                                placeholder="{{ __('Image') }}">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
