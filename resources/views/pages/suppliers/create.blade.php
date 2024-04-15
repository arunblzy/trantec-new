@extends('layouts.admin')
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Create Supplier</h1>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            {{--  =============================================  --}}
            <form id="supplier-create-form" class="form" method="post" action="{{ $storeUrl }}" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Name</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder=""
                                   name="name" id="name" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Vendor Category</label>
                            <select id="vendor_category" multiple="multiple" name="vendor_category[]" class="form-control form-control-lg
                            form-control-solid">

                            </select>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" placeholder=""
                                   name="email" id="email" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Fax</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder=""
                                   name="fax" id="fax" autocomplete="off" />
                        </div>

                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Address</label>
                            <textarea name="address" id="address" class="form-control form-control-lg
                    form-control-solid"></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Code</label>
                            <input readonly class="form-control form-control-lg form-control-solid" type="text"
                                   placeholder=""
                                   name="code" id="code" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">TRN</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder=""
                                   name="trn" id="trn" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Phone</label>
                            <input class="form-control form-control-lg form-control-solid" type="tel" placeholder=""
                                   name="phone" id="phone" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Credit Period</label>
                            <input class="form-control form-control-lg form-control-solid" type="tel" placeholder=""
                                   name="phone" id="phone" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Country</label>
                            <select id="country" name="country" class="form-control form-control-lg
                            form-control-solid">
                            </select>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">State</label>
                            <select id="state" name="state" class="form-control form-control-lg
                            form-control-solid">
                            </select>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">City</label>
                            <select id="city" name="city" class="form-control form-control-lg
                            form-control-solid">
                            </select>
                        </div>
                    </div>
                </div>

                <!--begin::Repeater-->
                <div id="kt_docs_repeater_advanced">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="kt_docs_repeater_advanced">
                            <div data-repeater-item>
                                <div class="form-group row mb-5">
                                    <div class="col-md-3">
                                        <label class="form-label">Description:</label>
                                        <input type="text" name="description" class="form-control form-control-lg
                                        form-control-solid">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Phone:</label>
                                        <input type="text" name="phone" class="form-control form-control-lg
                                        form-control-solid">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Mobile:</label>
                                        <input type="text" name="mobile" class="form-control form-control-lg
                                        form-control-solid">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Email:</label>
                                        <input type="email" name="email" class="form-control form-control-lg
                                        form-control-solid">
                                    </div>

                                    <div class="col-md-2">
                                        <a href="javascript:;" data-repeater-delete class="btn btn-flex btn-sm
                                        btn-light-danger mt-3 mt-md-9 repeater-delete">
                                            <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group">
                        <a href="javascript:;" data-repeater-create class="btn btn-flex btn-light-primary mb-6"
                           id="repeater-add">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Add
                        </a>
                    </div>
                    <!--end::Form group-->
                </div>
                <!--end::Repeater-->

                <button id="supplier-create-form-submit" type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.suppliers.index') }}" id="supplier-create-form-cancel" class="btn
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
            $('#supplier-create-form').validate({
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
                        type: 'post',
                        data: $(form).serialize(),
                        success: function(response) {
                            Swal.fire({
                                text: "Supplier created successfully!",
                                icon: "success",
                                buttonsStyling: !1,
                                confirmButtonText: "Ok, got it!",
                                customClass: { confirmButton: "btn btn-primary" }
                            }).then(function (e) {
                                location.href = $('#supplier-create-form-cancel').attr('href');
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


            $("#name").on("keyup", function (){
                let name = $('#name').val();
                if (name.trim() !== '' && name.length > 3) {
                    // Make AJAX request
                    $.ajax({
                        url: '{{ route('admin.suppliers.generate-code') }}',
                        type: 'POST',
                        data: { name: name },
                        success: function(response) {
                            $('#code').val(response.code);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });


            $('#repeater-add').on('click', function (){
                formRepeater();
            });
            $('.repeater-delete').on('click', function (){
                // 
            });


            const formRepeater = () => {

            }
        });

        $('#vendor_category').select2({
            ajax: {
                url: "{{ route('get.select2',['table' => 'vendor_categories']) }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response.data
                    };
                },
                cache: true,
            },
            minimumInputLength: 0
        });

        $('#country').on('change', function (){
            $('#state').empty();
            $('#city').empty();
        });
        $('#state').on('change', function (){
            $('#city').empty();
        });

        $('#country').select2({
            ajax: {
                url: "{{ route('get.select2',['table' => 'countries']) }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response.data
                    };
                },
                cache: true,
            },
            minimumInputLength: 1
        });

        $('#state').select2({
            ajax: {
                url: "{{ route('get.select2',['table' => 'states']) }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term,
                        id : $('#country').val()
                    };
                },
                processResults: function (response) {
                    return {
                        results: response.data
                    };
                },
                cache: true,
            },
            minimumInputLength: 1
        });

        $('#city').select2({
            ajax: {
                url: "{{ route('get.select2',['table' => 'cities']) }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term,
                        id : $('#state').val()
                    };
                },
                processResults: function (response) {
                    return {
                        results: response.data
                    };
                },
                cache: true,
            },
            minimumInputLength: 1
        });

    </script>


@endpush
