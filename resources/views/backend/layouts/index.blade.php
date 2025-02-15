@extends('backend.app')
@section('title', 'Dashboard')
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

                    <li class="breadcrumb-item text-muted">
                        Dashboards </li>

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Toolbar-->

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3 mt-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h1 class="fs-2hx fw-bold text-gray-800 me-2 lh-1">2</h1>
                                <h4 class="fs-4 fw-semibold text-gray-400 mt-5">{{ __('messages.total_users') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mt-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h1 class="fs-2hx fw-bold text-gray-800 me-2 lh-1">2</h1>
                                <h4 class="fs-4 fw-semibold text-gray-400 mt-5">{{ __('messages.total_blog') }}</h4>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mt-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h1 class="fs-2hx fw-bold text-gray-800 me-2 lh-1">2</h1>
                                <h4 class="fs-4 fw-semibold text-gray-400 mt-5">{{ __('messages.total_users') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mt-4">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h1 class="fs-2hx fw-bold text-gray-800 me-2 lh-1">2</h1>
                                <h4 class="fs-4 fw-semibold text-gray-400 mt-5">{{ __('messages.total_product') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
