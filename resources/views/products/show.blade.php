@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="product-card">
                            <h1> {{ $product->title }} </h1>

                            <div class="d-flex">
                                @can(['update-product'], $product)
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-success me-2"> Edit </a>
                                    <form action="{{ route('products.destroy',$product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete it?');">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-outline-danger">Delete</button>
                                    </form>
                                @endcan
                            </div>

                            <hr>
                            <div class="row me-3">
                                <div class="col-sm-8">
                                    <p> {!! $product->description !!} </p>
                                </div>
                                <div class="col-sm-3">
                                    <img src="{{ asset('storage/'.$product->image) }}" width="350">
                                </div>

                            </div>
                            <hr>

                            <div class="row justify-content-between" style="font-size: 12px;">
                                <div class="col-sm-6">
                                    <p>
                                        Category: <strong> {{ $product->category }} </strong>
                                        <br>
                                        Types: <strong> {{ $product->type }} </strong>
                                    </p>
                                </div>
                                <div class="col-sm-6 text-end">
                                    <p>
                                        Created by: <strong> {{ $product->user->name }} </strong>
                                        <br>
                                        Expires in: <strong> {{ $product->expiry_date }} </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
