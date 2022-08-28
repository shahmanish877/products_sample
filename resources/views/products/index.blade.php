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
                    <div class="card-header d-flex justify-content-between align-items-baseline">
                        All Products
                        <div>
                            @auth
                                <a href="{{ route('products.create') }}" class="btn btn-success"> Add New </a>
                            @endauth
                        </div>
                    </div>

                    <div class="card-body">

                        @foreach($products as $product )
                            <div class="row">
                                <div class="col-sm-2">
                                    <a href="{{ route('products.show',$product->id) }}">
                                        <img src="{{ asset('storage/'.$product->image) }}" width="150">
                                    </a>
                                </div>
                                <div class="col-sm-10">
                                    <a href="{{ route('products.show',$product->id) }}" class="h4 text-decoration-none fw-bold">
                                        {{ $product->title }}
                                    </a>

                                    <p> <strong>Summary:</strong> {!!  $product->summary  !!} </p>
                                </div>

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

                                <div class="d-flex p-2 justify-content-end">
                                    @can(['update-product'], $product)
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-success me-2"> Edit </a>
                                        <form action="{{ route('products.destroy',$product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete it?');">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    @endcan
                                </div>

                                @if (!$loop->last)
                                    <hr>
                                @endif
                            </div>
                        @endforeach

                        <div class="d-flex">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
