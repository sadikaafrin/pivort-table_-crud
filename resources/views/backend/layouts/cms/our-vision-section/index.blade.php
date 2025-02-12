@extends('backend.app')

@section('title', 'Home - Hero Section')

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

                    <li class="breadcrumb-item text-muted"> CMS </li>
                    <li class="breadcrumb-item text-muted"> Our Mission Section </li>

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
                        <form method="POST" action="{{ route('admin.cms.our_vision.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="input-style-1 mt-4">
                                <label for="title">Title:</label>
                                <input type="text" placeholder="Enter Title" id="title"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ $our_vision->title ?? old('title') }}" />
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="input-style-1 mt-4">
                                <label for="sub_title">Sub Title:</label>
                                <input type="text" placeholder="Enter Title" id="sub_title"
                                    class="form-control @error('sub_title') is-invalid @enderror" name="sub_title"
                                    value="{{ $our_vision->sub_title ?? old('sub_title') }}" />
                                @error('sub_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="input-style-1 mt-4">
                                <label for="image_url">Image:</label>
                                <input type="file" id="image"
                                    class="form-control dropify @error('image_url') is-invalid @enderror" name="image_url"
                                    value="{{ old('image_url') }}"
                                    data-default-file="{{ asset($our_vision->image_url ?? 'backend/images/placeholder/image_placeholder.png') }}" />
                                @error('image_url')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary">Change</button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-danger me-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
