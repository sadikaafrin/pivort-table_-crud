@extends('backend.app')

@section('title', 'Balance')

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

                    <li class="breadcrumb-item text-muted"> Balance </li>
                    <li class="breadcrumb-item text-muted"> Balance List </li>

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
                <div class="card p-5">
                    <div class="card-style mb-30">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn btn-primary" id="addButton" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" type="button">Add New</button>
                        </div>
                        <div class="table-wrapper table-responsive">
                            <table id="data-table" class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Dynamic Data --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Category Add Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="create-category">
                    <form id="create-form">
                        @csrf
                        <div class="input-style-1 mb-4">
                            <label for="balance">Balance:</label>
                            <input type="text" placeholder="Enter Available Balance" id="balance"
                                class="form-control @error('balance') is-invalid @enderror" name="balance"
                                value="{{ old('balance') }}" />

                            <span id="create-category-error" class="text-danger"></span>

                        </div>

                        <button type="submit" class="btn btn-primary float-end">Save</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    {{--  Edit Modal  --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="edit-category">
                    <form id="edit-form">
                        @csrf
                        <div class="input-style-1 mb-4">
                            <label for="edit_balance">Balance:</label>
                            <input type="text" placeholder="Enter Category name" id="edit_balance"
                                class="form-control @error('balance') is-invalid @enderror" name="balance" />
                            <span id="edit-balance-error" class="text-danger"></span>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



@push('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }
            });
            if (!$.fn.DataTable.isDataTable('#data-table')) {
                let dTable = $('#data-table').DataTable({
                    order: [],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: true,
                    responsive: true,
                    serverSide: true,

                    language: {
                        processing: `<div class="text-center">
                            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                          </div>
                            </div>`
                    },

                    scroller: {
                        loadingIndicator: false
                    },
                    pagingType: "full_numbers",
                    dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l><'col-md-2 col-sm-4 px-0'f>>tipr",
                    ajax: {
                        url: "{{ route('admin.available.balance.index') }}",
                        type: "get",
                    },

                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'balance',
                            name: 'balance',
                            orderable: true,
                            searchable: true
                        },

                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });

                dTable.buttons().container().appendTo('#file_exports');
                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        // Status Change Confirm Alert
        function showStatusChangeAlert(id) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update the status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusChange(id);
                }
            });
        }
        // Status Change
        function statusChange(id) {
            let url = "{{ route('admin.available.balance.status', ':id') }}";
            $.ajax({
                type: "POST",
                url: url.replace(':id', id),
                success: function(resp) {
                    console.log(resp);
                    // Reloade DataTable
                    $('#data-table').DataTable().ajax.reload();
                    if (resp.success === true) {
                        // show toast message
                        toastr.success(resp.message);
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    // location.reload();
                }
            });
        }

        // delete Confirm
        function showDeleteConfirm(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure you want to delete this record?',
                text: 'If you delete this, it will be gone forever.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id);
                }
            });
        }
        // Delete Button
        function deleteItem(id) {
            let url = "{{ route('admin.available.balance.destroy', ':id') }}";
            let csrfToken = '{{ csrf_token() }}';
            $.ajax({
                type: "DELETE",
                url: url.replace(':id', id),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(resp) {
                    console.log(resp);
                    // Reloade DataTable
                    $('#data-table').DataTable().ajax.reload();
                    if (resp.success === true) {
                        // show toast message
                        toastr.success(resp.message);

                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    // location.reload();
                }
            })
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#create-form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let url = "{{ route('admin.available.balance.store') }}";

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    success: function(resp) {
                        $('#data-table').DataTable().ajax.reload();

                        if (resp.success === true) {
                            toastr.success(resp.message);

                            clearModal('#exampleModal');
                        } else if (resp.errors) {
                            toastr.error(resp.errors[0]);
                        } else {
                            toastr.error(resp.message);
                        }
                    },
                    error: function(xhr) {
                        handleXhrErrors(xhr, '#create-category-error');
                    }
                });
            });

            function clearModal(modalId) {
                $(modalId).modal('hide');
                $('#create-form')[0].reset();
                $('#create-category-error').text('');
            }

            function handleXhrErrors(xhr, errorSelector) {
                let errors = xhr.responseJSON.errors;
                if (errors && errors.balance) {
                    $(errorSelector).text(errors.balance[0]);
                } else {
                    $(errorSelector).text('Something went wrong. Please try again.');
                }
            }
        });

        //open edit modal
        //edit category
        $('body').on('click', '.edit', function() {
            var id = $(this).data('id');
            var url = "{{ route('admin.available.balance.edit', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        // Fill the modal form with fetched data
                        $('#edit_balance').val(response.data.balance);
                        $('#edit-form').append(
                            '<input type="text" hidden id="version_id" name="id" value="' +
                            response.data
                            .id + '">');
                        $('#editModal').modal('show');
                    } else {
                        toastr.error('Something went wrong. Try again later.');
                    }
                },
            });
        });

        // Update Category via AJAX
        $('#edit-form').on('submit', function(e) {
            e.preventDefault();

            var formData = $(this).serialize();
            var id = $(this).find("#version_id").val();
            console.log(id);

            var url = "{{ route('admin.available.balance.update') }}";

            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'),
                },
                success: function(response) {
                    if (response.success) {
                        $('#data-table').DataTable().ajax.reload();
                        toastr.success(response.message);
                        $('#editModal').modal('hide');
                        $('#edit-form')[0].reset();
                    } else if (response.errors) {
                        $('.text-danger').text('');
                        $.each(response.errors, function(key, value) {
                            $('#edit-' + key + '-error').text(value[0]);
                        });
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    handleXhrErrors(xhr, 'edit-form');
                }
            });
        });

        // Clear modal inputs
        function clearModal(modalId) {
            $('#' + modalId + ' input, #' + modalId + ' textarea').val('');
            $('#' + modalId + ' span.text-danger').text('');
        }
    </script>
@endpush
