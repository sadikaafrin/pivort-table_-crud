@extends('backend.app')

@section('title', 'Create Dynamic Page')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <div class=" container-fluid  d-flex flex-stack flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <!--begin::Title-->
                <h1 class="text-dark fw-bold my-1 fs-2">
                    Dashboard <small class="text-muted fs-6 fw-normal ms-1"></small>
                </h1>
                <!--end::Title-->

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">
                            Home </a>
                    </li>

                    <li class="breadcrumb-item text-muted"> Product </li>
                    <li class="breadcrumb-item text-muted"> Product Page </li>

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Toolbar-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-4">
                    <div class="card card-body">
                        <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="input-style-1 mt-4">
                                <label for="name">Platform:</label>
                                <select id="name" name="category_id"
                                    class="form-control @error('name') is-invalid @enderror">
                                    <option value="" disabled selected>Select a Platform</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('name') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-style-1 mt-4">
                                <label for="usage">Usage:</label>
                                <input type="text" placeholder="Enter Title" id="usage"
                                    class="form-control @error('name') is-invalid @enderror" name="usage"
                                    value="{{ old('usage') }}" />
                                @error('usage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-style-1 mt-4">
                                <label for="name">Version:</label>
                                <select class="js-example-basic-multiple form-control" name="version_id[]"
                                    multiple="multiple">
                                    @foreach ($versions as $version)
                                        <option value="{{ $version->id }}">
                                            {{ $version->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('version_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="input-style-1 mt-4">
                                <label for="delivery_time">Delivery Time:</label>
                                <input type="text" placeholder="Enter Title" id="delivery_time"
                                    class="form-control @error('delivery_time') is-invalid @enderror" name="delivery_time"
                                    value="{{ old('delivery_time') }}" />
                                @error('delivery_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="input-style-1 mt-4">
                                <label for="name">Available Balance:</label>
                                <select class="js-example-basic-multiple form-control" name="available_balance_id[]"
                                    multiple="multiple">
                                    @foreach ($availableBalance as $allBalance)
                                        <option value="{{ $allBalance->id }}">
                                            {{ $allBalance->balance }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('available_balance_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-style-1 mt-4">
                                <label for="image">Image:</label>
                                <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"
                                    id="image" />
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="input-style-1 mt-4">
                                <label for="stock">Stock:</label>
                                <input type="text" placeholder="Enter Title" id="stock"
                                    class="form-control @error('name') is-invalid @enderror" name="stock"
                                    value="{{ old('stock') }}" />
                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.product.index') }}" class="btn btn-danger me-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#page_content'))
            .catch(error => {
                console.error(error);
            });
    </script>


  
@endpush

@push('style')
    <style>
        .tagify {
            width: 100%;
            max-width: 700px;
        }
    </style>
@endpush
