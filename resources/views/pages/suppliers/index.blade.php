@extends('layouts.admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css')  }}">
@endpush
@section('content')
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                 data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                 class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">All Suppliers
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    {{--  <small class="text-muted fs-7 fw-bold my-1 ms-1"></small>  --}}
                </h1>
            </div>
        </div>
    </div>
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            {{--  =============================================  --}}
            <div class="d-flex flex-stack mb-5">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-2">...</span>
                    <input id="search" type="text" data-kt-docs-table-filter="search" class="form-control
                    form-control-solid
                    w-250px ps-15" placeholder="Search Suppliers"/>
                </div>

                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                    <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                       title="Add Supplier">
                        <span class="svg-icon svg-icon-2">...</span>
                        Add Supplier
                    </a>
                </div>

            </div>

            <table data-url="{{ $allSuppliersUrl }}" data-delete-base-url="{{ $deleteBaseUrl }}"
                   data-append-query-string="{{ $appendQueryString }}"
                   id="suppliers_table"
                   class="table
            align-middle
            table-row-dashed
            fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        ID
                    </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th class="min-w-100px text-end">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                </tbody>
            </table>
            {{--  =============================================  --}}
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        let dt;
        document.addEventListener('DOMContentLoaded', function() {
            let table = $('#suppliers_table');
            let search = $('#search');
            let url = table.attr('data-url');
            dt = table.DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": url,
                    "type": "GET",
                    "data": function (d){
                        d.term = search.val();
                    }
                },
                "columns": [
                    { "data": "id", "name": "id", },
                    { "data": "name","name": "name", },
                    { "data": "email","name": "email", },
                    { "data": "phone","name": "phone", },
                    { "data": "address","name": "address", },
                    { "data": "created_at","name": "created_at", },
                    { "data": "updated_at","name": "updated_at", },
                    {
                        data: null,
                        name: 'id',
                        render: function (data, type, full, meta) {
                            let editUrl = "{{ route('admin.suppliers.index') }}/" + data.id + "/edit";
                            let deleteBaseUrl = table.attr('data-delete-base-url');
                            let deleteUrl = deleteBaseUrl+'/'+data.id+table.attr('data-append-query-string');
                            return '<div class="d-flex justify-content-end flex-shrink-0">' +
                                '<a href="'+editUrl+'" class="btn btn-icon btn-bg-light btn-active-color-primary ' +
                                'btn-sm ' +
                                'me-1">' +
                                '<span class="svg-icon svg-icon-3">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                                '<path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />' +
                                '<path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />' +
                                '</svg>' +
                                '</span>' +
                                '</a>' +
                                '<a href="#" data-url="'+deleteUrl+'" data-id="'+data.id+'" ' +
                                'class="btn btn-icon delete-item ' +
                                'btn-bg-light ' +
                                'btn-active-color-primary ' +
                                'btn-sm">' +
                                '<span class="svg-icon svg-icon-3">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" ' +
                                'fill="none">' +
                                '<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17' +
                                '.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>' +
                                '<path opacity="0.5" ' +
                                'd="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 ' +
                                '5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>' +
                                '<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 ' +
                                '4V4H9V4Z"' +
                                ' fill="black"/>' +
                                '</svg>' +
                                '</span>' +
                                '</a>' +
                                '</div>' +
                                '';
                        }
                    },
                ],
                order: [[ 0, 'desc' ]],
            });
            $(document).on('keyup','#search', function (e){
                e.preventDefault();
                dt.draw();
            });

            $(document).on('click','.delete-item', function (e){
                e.preventDefault();
                let deleteUrl = $(this).attr('data-url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this item!',
                    icon: 'warning',
                    showCancelButton: true,
                    buttonsStyling: !1,
                    confirmButtonText: "Yes, delete it!",
                    customClass: { confirmButton: "btn btn-danger", cancelButton: "btn btn-secondary" },
                    cancelButtonText: 'Cancel'
                }).then(function (result) {
                    if(result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'delete',
                            success: function(response) {
                                Swal.fire({
                                    text: "Supplier deleted successfully!",
                                    icon: "success",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: { confirmButton: "btn btn-primary" }
                                }).then(function (e) {
                                    dt.draw();
                                });
                            },
                            error: function(xhr, status, error) {
                                let errMsg = statusMessages[xhr.status];
                                Swal.fire({
                                    text: errMsg,
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: { confirmButton: "btn btn-primary" },
                                });
                            }
                        });
                    }
                });
            });
        });

    </script>
@endpush
