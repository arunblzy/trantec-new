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
                <div class="row">
                    <div class="col-6">
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Name</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder=""
                                   name="name" id="name" autocomplete="off"  value="{{ $supplier?->name ?? '' }}" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Vendor Category</label>
                            <select id="vendor_category" multiple="multiple" name="vendor_category[]" class="form-control form-control-lg
                            form-control-solid">
                                @foreach($supplier?->vendorCategories ?? [] as $item)
                                    <option selected="selected" value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Email</label>
                            <input class="form-control form-control-lg form-control-solid" type="email" placeholder=""
                                   name="email" id="email" autocomplete="off" value="{{ $supplier?->email ?? '' }}" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Fax</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder=""
                                   name="fax" id="fax" autocomplete="off" value="{{ $supplier?->fax ?? '' }}" />
                        </div>

                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Address</label>
                            <textarea name="address" id="address" class="form-control form-control-lg
                    form-control-solid">{{ $supplier?->address ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Code</label>
                            <input readonly class="form-control form-control-lg form-control-solid" type="text"
                                   placeholder=""
                                   name="code" id="code" value="{{ $supplier?->code ?? '' }}" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">TRN</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder=""
                                   name="trn" id="trn" value="{{ $supplier?->trn ?? '' }}" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Phone</label>
                            <input class="form-control form-control-lg form-control-solid" type="tel" placeholder=""
                                   name="phone" id="phone" value="{{ $supplier?->phone ?? '' }}" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Credit Period</label>
                            <input class="form-control form-control-lg form-control-solid" type="text" placeholder=""
                                   name="credit_period" id="credit_period" value="{{ $supplier?->credit_period ?? '' }}" autocomplete="off" />
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">Country</label>
                            <select id="country" name="country" class="form-control form-control-lg
                            form-control-solid">
                                @if(!empty($supplier?->country))
                                    <option selected="selected" value="{{ $supplier?->country->id }}">{{
                                    $supplier?->country->name }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">State</label>
                            <select id="state" name="state" class="form-control form-control-lg
                            form-control-solid">
                                @if(!empty($supplier?->state))
                                    <option selected="selected" value="{{ $supplier?->state->id }}">{{
                                    $supplier?->state->name }}</option>
                                @endif
                            </select>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="required form-label fs-6 mb-2">City</label>
                            <select id="city" name="city" class="form-control form-control-lg
                            form-control-solid">
                                @if(!empty($supplier?->city))
                                    <option selected="selected" value="{{ $supplier?->city->id }}">{{
                                    $supplier?->city->name }}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <div id="kt_docs_repeater_advanced">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="kt_docs_repeater_advanced">
                            <div data-repeater-item class="item">
                                <div class="form-group row mb-5">
                                    <div class="col-md-3">
                                        <label class="form-label">Description:</label>
                                        <input type="text" name="contact_description[]" class="form-control
                                        form-control-lg
                                        form-control-solid">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Phone:</label>
                                        <input type="tel" name="contact_phone[]" class="form-control form-control-lg
                                        form-control-solid">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Mobile:</label>
                                        <input type="tel" name="contact_mobile[]" class="form-control form-control-lg
                                        form-control-solid">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Email:</label>
                                        <input type="email" name="contact_email[]" class="form-control form-control-lg
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
                    <div class="form-group d-flex flex-row-reverse">
                        <a href="javascript:void(0);" data-repeater-create class="btn btn-flex btn-light-primary
                        mb-6"
                           id="repeater-add">
                            <i class="ki-duotone ki-plus fs-3"></i>
                            Add
                        </a>
                    </div>
                    <!--end::Form group-->
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
                    },
                    'vendor_category[]': {
                        required: true
                    },
                    code: {
                        required: true
                    },
                    trn: {
                        required: true
                    },
                    fax: {
                        required: true
                    },
                    credit_period: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    // Repeater fields rules
                    'contact_description[]': {
                        required: true
                    },
                    'contact_phone[]': {
                        required: true
                    },
                    'contact_mobile[]': {
                        required: true
                    },
                    'contact_email[]': {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    name: "Please enter your name",
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    phone: "Please enter your phone number",
                    address: "Please enter your address",
                    'description[]': "Please enter a description",
                    'phone[]': "Please enter a phone number",
                    'mobile[]': "Please enter a mobile number",
                    'email[]': {
                        required: "Please enter an email address",
                        email: "Please enter a valid email address"
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
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
            $("#name").on("change", function (){
                let name = $('#name').val();
                if (name.trim() !== '' && name.length > 0) {
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

            // Add field
            $('#repeater-add').click(function() {
                let newField = $('#kt_docs_repeater_advanced .item:first').clone();
                newField.find('input').val(''); // Clear input value
                $('[data-repeater-list="kt_docs_repeater_advanced"]').append(newField);
            });

            // Remove field
            $('#kt_docs_repeater_advanced').on('click', '.repeater-delete', function() {
                $(this).closest('.form-group').remove();
            });
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
