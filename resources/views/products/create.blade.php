@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add New Product</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-1 col-form-label text-md-end">Title</label>

                                <div class="col-md-10">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="summary" class="col-md-1 col-form-label text-md-end">Summary</label>

                                <div class="col-md-10">
                                    <textarea id="summary" class="form-control @error('summary') is-invalid @enderror" name="summary">{{ old('summary') }}</textarea>
                                    @error('summary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-1 col-form-label text-md-end">Description</label>

                                <div class="col-md-10">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="owner_email" class="col-md-1 col-form-label text-md-end">Owner Email</label>

                                <div class="col-md-10">
                                    <input id="owner_email" type="text" class="form-control @error('owner_email') is-invalid @enderror" name="owner_email" value="{{ old('owner_email') }}" required autocomplete="owner_email" autofocus>
                                    @error('owner_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category" class="col-md-1 col-form-label text-md-end">Category</label>

                                <div class="col-md-10">
                                    <?php $cat_arr = ['Appliances', 'Computers', 'Electronics', 'Movies', 'Mobiles', 'Games' ];?>
                                    <select id="category" class="form-control @error('category') is-invalid @enderror" name="category[]" multiple="multiple" required>
                                        @foreach($cat_arr as $cat)
                                            <option value="{{$cat}}" {{ (collect(old('category'))->contains($cat)) ? 'selected':'' }}>{{$cat}}</option>
                                        @endforeach
                                    </select>

                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="type" class="col-md-1 col-form-label text-md-end">Type</label>

                                <div class="col-md-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Physical" name="type" id="Physical" checked {{ old('type') == 'Physical' ? 'checked' : ''  }}>
                                        <label class="form-check-label" for="Physical">
                                            Physical
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Digital" name="type" id="Digital" {{ old('type') == 'Digital' ? 'checked' : ''  }}>
                                        <label class="form-check-label" for="Digital">
                                            Digital
                                        </label>
                                    </div>

                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="expiry_date" class="col-md-1 col-form-label text-md-end">Expiry Date</label>

                                <div class="col-md-10">
                                    <input id="expiry_date" type="date" class="form-control @error('expiry_date') is-invalid @enderror" name="expiry_date" value="{{ old('expiry_date') }}" autocomplete="expiry_date" autofocus>
                                    @error('expiry_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-md-1 col-form-label text-md-end">Upload Image</label>

                                <div class="col-md-10">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="Choose image" autofocus accept="image/png, image/jpeg, image/jpg">
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-1">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

@endsection
