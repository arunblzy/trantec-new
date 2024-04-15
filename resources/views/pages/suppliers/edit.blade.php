@extends('layouts.admin')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit Supplier Details</h1>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            {{--  =============================================  --}}
            <form id="supplier-update-form" class="form" method="post" action="{{ $supplierUpdateUrl }}" autocomplete="off">
                @csrf
                <div class="fv-row mb-10">
                    <label class="required form-label fs-6 mb-2">Name</label>
                    <input value="{{ $supplier?->name ?? '' }}" class="form-control form-control-lg form-control-solid"
                           type="text"
                           placeholder=""
                           name="name" id="name" autocomplete="off" />
                </div>
                <div class="fv-row mb-10">
                    <label class="required form-label fs-6 mb-2">Email</label>
                    <input value="{{ $supplier?->email ?? '' }}" class="form-control form-control-lg
                    form-control-solid" type="email" placeholder=""
                           name="email" id="email" autocomplete="off" />
                </div>

                <div class="fv-row mb-10">
                    <label class="required form-label fs-6 mb-2">Phone</label>
                    <input value="{{ $supplier?->phone ?? '' }}" class="form-control form-control-lg form-control-solid" type="tel" placeholder=""
                           name="phone" id="phone" autocomplete="off" />
                </div>

                <div class="fv-row mb-10">
                    <label class="required form-label fs-6 mb-2">Address</label>
                    <textarea name="address" id="address" class="form-control form-control-lg
                    form-control-solid">{{ $supplier?->address ?? '' }}</textarea>
                </div>

                <button id="supplier-update-form-submit" type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.suppliers.index') }}" id="supplier-update-form-cancel" class="btn
                btn-outline-secondary">Cancel</a>
            </form>
            {{--  =============================================  --}}
        </div>
    </div>
@endsection
@include('plugins.validation')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#supplier-update-form').validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                    },
                    address: {
                        required: true
                    }
                },
                messages: {
                    name: "Please enter your name",
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    phone: "Please enter your phone number",
                    address: "Please enter your address"
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element); // Display error message after the input field
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        type: 'put',
                        data: $(form).serialize(),
                        success: function(response) {
                            Swal.fire({
                                text: "Supplier details updated successfully!",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-primary" }
                            }).then(function (e) {
                                location.href = $('#supplier-update-form-cancel').attr('href');
                            });
                        },
                        error: function(xhr, status, error) {
                            var errors = xhr.responseJSON.errors;
                            if (errors || xhr.status === 422) {
                                $.each(errors, function(key, value) {
                                    let elementById = $('#'+key + '-error');
                                    (elementById.is('*')) ? elementById.remove() : '';
                                    let element = $('[name="' + key + '"]');
                                    element.addClass('error');
                                    element.after('<label id="' + key + '-error" class="error ' +
                                        '" for="' + key + '" >' + value[0] +
                                        '</label>');
                                });
                            } else {
                                let errMsg = statusMessages[xhr.status];
                                Swal.fire({
                                    text: errMsg,
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: { confirmButton: "btn btn-primary" },
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>


@endpush
