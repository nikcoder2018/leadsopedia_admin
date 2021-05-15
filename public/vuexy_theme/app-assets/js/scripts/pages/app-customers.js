/*=========================================================================================
    File Name: app-invoice-list.js
    Description: app-invoice-list Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(async function() {
    'use strict';
    const mypermissions = await $.get('/account/permissions');
    var has_full_access = $.inArray('full_access', mypermissions) != -1 ? true : false,
        can_show_customers = $.inArray('customers_show', mypermissions) != -1 ? true : false,
        can_add_credits_customers = $.inArray('customers_add_credits', mypermissions) != -1 ? true : false,
        can_add_subscription_customers = $.inArray('customers_add_subscription', mypermissions) != -1 ? true : false,
        can_create_customers = $.inArray('customers_create', mypermissions) != -1 ? true : false,
        can_edit_customerns = $.inArray('customers_edit', mypermissions) != -1 ? true : false,
        can_delete_customers = $.inArray('customers_delete', mypermissions) != -1 ? true : false,
        can_verify_customers = $.inArray('customers_verify', mypermissions) != -1 ? true : false,
        can_changestatus_customers = $.inArray('customers_delete', mypermissions) != -1 ? true : false;

    var dtCustomerTable = $('.customers-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/customers/all',
        URL = '/customers',
        API_TOKEN = $('[name=api-token]').attr('content'),
        new_customer_modal = '#new-customers-modal'; //new-role-modal

    // datatable
    if (dtCustomerTable.length) {
        var dtCustomer = dtCustomerTable.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL,
                type: "GET",
                data: {
                    api_token: API_TOKEN
                }
            }, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: 'responsive_id' },
                { data: 'id' },
                { data: 'id' }, // used for sorting so will hide this column
                { data: 'name' },
                { data: 'email' },
                { data: 'company' },
                { data: 'referrals' },
                { data: 'created_at' },
                { data: 'status' },
                { data: '' }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    orderable: false,
                    responsivePriority: 2,
                    targets: 0
                },
                {
                    // For Checkboxes
                    targets: 1,
                    orderable: false,
                    responsivePriority: 3,
                    render: function(data, type, full, meta) {
                        return (
                            '<div class="custom-control custom-checkbox"> <input class="custom-control-input dt-checkboxes" type="checkbox" value="" id="checkbox' +
                            data +
                            '" /><label class="custom-control-label" for="checkbox' +
                            data +
                            '"></label></div>'
                        );
                    },
                    checkboxes: {
                        selectAllRender: '<div class="custom-control custom-checkbox"> <input class="custom-control-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="custom-control-label" for="checkboxSelectAll"></label></div>'
                    }
                },
                {
                    targets: 2,
                    visible: false
                },
                {
                    // Avatar image/badge, Name and post
                    targets: 3,
                    responsivePriority: 1,
                    render: function(data, type, row, meta) {
                        var $user_img = row.avatar,
                            $name = row.name;

                        if ($user_img) {
                            // For Avatar image
                            var $output =
                                '<img src="' + $user_img + '" alt="Avatar" width="32" height="32">';
                        } else {
                            // For Avatar badge
                            var stateNum = row.status == 'active' ? 0 : 1;
                            var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                            var $state = states[stateNum],
                                $name = row.name,
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                            $output = '<span class="avatar-content">' + $initials + '</span>';
                        }

                        var colorClass = $user_img === '' ? ' bg-light-' + $state + ' ' : '';
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="avatar ' +
                            colorClass +
                            ' mr-1">' +
                            $output +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<span class="emp_name text-truncate font-weight-bold">' +
                            $name +
                            '</span>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        if (row.email_status == 'verified')
                            return `${row.email} <div class="badge badge-primary">${row.email_status}</div>`;
                        else
                            return `${row.email} <div class="badge badge-warning">${row.email_status}</div>`;
                    }
                },
                {
                    targets: 8,
                    render: function(data, type, row) {
                        if (row.status == 'active') {
                            return `<div class="badge badge-success">${row.status}</div>`
                        } else {
                            return `<div class="badge badge-danger">${row.status}</div>`
                        }
                    }
                },
                // {
                //     // Actions
                //     targets: -1,
                //     width: '100px',
                //     orderable: false,
                //     render: function(data, type, row, meta) {
                //         let elAction = '';
                //         if (can_show_customers || has_full_access) {
                //             elAction += `<a class="mr-1 text-primary" href="${URL}/${row.id}" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Customer Details">${feather.icons['user'].toSvg({ class: 'font-medium-2' })}</a>`;
                //         }
                //         if (can_verify_customers || has_full_access) {
                //             elAction += `<a class="mr-1 text-success btn-add-verify" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Manual Verify">${feather.icons['check-circle'].toSvg({ class: 'font-medium-2' })}</a>`;
                //         }
                //         if (can_add_credits_customers || has_full_access) {
                //             elAction += `<a class="mr-1 text-secondary btn-add-credits" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Add Credits">${feather.icons['plus-circle'].toSvg({ class: 'font-medium-2' })}</a>`;
                //         }
                //         if (can_add_subscription_customers || has_full_access) {
                //             elAction += `<a class="mr-1 text-default btn-add-subscription" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Add Subscription">${feather.icons['plus-square'].toSvg({ class: 'font-medium-2' })}</a>`;
                //         }
                //         elAction += `<a class="mr-1 text-danger btn-add-cancelsubscription" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Cancel Subscription">${feather.icons['x-square'].toSvg({ class: 'font-medium-2' })}</a>`;
                //         if (can_changestatus_customers || has_full_access) {
                //             if (row.status == 'active') {
                //                 elAction += `<a class="mr-1 text-warning btn-deactivate" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Deactivate">${feather.icons['user-x'].toSvg({ class: 'font-medium-2' })}</a>`;
                //             } else {
                //                 elAction += `<a class="mr-1 text-success btn-activate" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Activate">${feather.icons['user-check'].toSvg({ class: 'font-medium-2' })}</a>`;
                //             }
                //         }
                //         if (can_delete_customers || has_full_access) {
                //             elAction += `<a class="mr-1 btn-delete text-danger" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Delete">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>`;
                //         }
                //         return (
                //             `<div class="d-flex align-items-center col-actions">
                //             ${elAction}
                //             </div>
                //             `
                //         );

                //     }
                // }

                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    responsivePriority: 4,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        let elAction = '';
                        if (can_show_customers || has_full_access) {
                            elAction += `<a class="dropdown-item" href="${URL}/${row.id}" data-id="${row.id}">${feather.icons['user'].toSvg({ class: 'font-small-4 mr-50' })}Customer Details</a>`;
                        }
                        if (can_verify_customers || has_full_access) {
                            elAction += `<a class="dropdown-item btn-add-verify" href="javascript:void(0);" data-id="${row.id}">${feather.icons['check-circle'].toSvg({ class: 'font-small-4 mr-50' })}Manual Verify</a>`;
                        }
                        if (can_add_credits_customers || has_full_access) {
                            elAction += `<a class="dropdown-item btn-add-credits" href="javascript:void(0);" data-id="${row.id}">${feather.icons['plus-circle'].toSvg({ class: 'font-small-4 mr-50' })}Add Credits</a>`;
                        }
                        if (can_add_subscription_customers || has_full_access) {
                            elAction += `<a class="dropdown-item btn-add-subscription" href="javascript:void(0);" data-id="${row.id}">${feather.icons['plus-square'].toSvg({ class: 'font-small-4 mr-50' })}Add Subscription</a>`;
                        }
                        elAction += `<a class="dropdown-item btn-add-cancelsubscription" href="javascript:void(0);" data-id="${row.id}">${feather.icons['x-square'].toSvg({ class: 'font-small-4 mr-50' })}Cancel Subscription</a>`;
                        if (can_changestatus_customers || has_full_access) {
                            if (row.status == 'active') {
                                elAction += `<a class="dropdown-item btn-deactivate" href="javascript:void(0);" data-id="${row.id}">${feather.icons['user-x'].toSvg({ class: 'font-small-4 mr-50' })}Deactivate</a>`;
                            } else {
                                elAction += `<a class="dropdown-item btn-activate" href="javascript:void(0);" data-id="${row.id}">${feather.icons['user-check'].toSvg({ class: 'font-small-4 mr-50' })}Activate</a>`;
                            }
                        }
                        if (can_delete_customers || has_full_access) {
                            elAction += `<a class="dropdown-item btn-delete" href="javascript:void(0);" data-id="${row.id}">${feather.icons['trash'].toSvg({ class: 'font-small-4 mr-50' })}Delete</a>`;
                        }

                        return (
                            `<div class="d-inline-flex">
                                <a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">
                                    ${feather.icons['more-vertical'].toSvg({ class: 'font-small-4' })}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    ${elAction}
                                </div>
                            </div>
                            <a href="javascript:;" class="item-edit">
                                ${feather.icons['edit'].toSvg({ class: 'font-small-4' })}
                            </a>`
                        );
                    }
                }
            ],
            order: [
                [2, 'desc']
            ],
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search Customers',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle mr-2',
                    text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
                    buttons: [{
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: [3, 4, 5, 6, 7] }
                        }
                    ],
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                        $(node).parent().removeClass('btn-group');
                        setTimeout(function() {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                        }, 50);
                    }
                },
                {
                    text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add New Customer',
                    className: 'create-new btn btn-primary',
                    attr: {
                        'data-toggle': 'modal',
                        'data-target': '#modals-slide-in'
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    },
                    action: function(e, dt, button, config) {
                        location.href = '/customers/create';
                    }
                }
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details of ' + data.name;
                        }
                    }),
                    type: 'column',
                    renderer: function(api, rowIdx, columns) {
                        console.log(columns);
                        var data = $.map(columns, function(col, i) {

                            if (col.columnIndex != 1 && col.columnIndex != 2 && col.columnIndex != 9)
                                return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                    ?
                                    '<tr data-dt-row="' +
                                    col.rowIndex +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    '<td>' +
                                    col.title +
                                    ':' +
                                    '</td> ' +
                                    '<td>' +
                                    col.data +
                                    '</td>' +
                                    '</tr>' :
                                    '';
                        }).join('');

                        return data ? $('<table class="table"/>').append(data) : false;
                    }
                }
            },
            initComplete: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
                // Adding role filter once table initialized
                if (!can_create_customers) {
                    $('.btn-add-record').remove();
                }
            },
            drawCallback: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            }
        });
        $('div.head-label').html('<h6 class="mb-0">Customer Lists</h6>');
    }

    $(new_customer_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(new_user_modal).modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    console.log('test');
                    dtCustomer.ajax.reload();
                }
            }
        });
    });

    $(dtCustomerTable).on('click', '.btn-deactivate', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure you want to deactivate this customer?',
            text: "Enter your password to continue!",
            icon: 'warning',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Yes, deactivate it!',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false,
            showLoaderOnConfirm: true,
            preConfirm: (password) => {
                return fetch(` / customers / $ { id }
                                            /deactivate?password=${password}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function(result) {
            if (result.isConfirmed) {
                if (result.value.success) {
                    Swal.fire('Success!', result.value.msg, 'success').then(() => { dtCustomer.ajax.reload(); });
                } else {
                    Swal.fire('Failed!', result.value.msg, 'error').then(() => { dtCustomer.ajax.reload(); });
                }
            }
        });
    });

    $(dtCustomerTable).on('click', '.btn-activate', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure you want to activate this customer?',
            text: "Enter your password to continue!",
            icon: 'warning',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Yes, activate it!',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false,
            showLoaderOnConfirm: true,
            preConfirm: (password) => {
                return fetch(`/customers/${id}/activate?password=${password}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function(result) {
            if (result.isConfirmed) {
                if (result.value.success) {
                    Swal.fire('Success!', result.value.msg, 'success').then(() => { dtCustomer.ajax.reload(); });
                } else {
                    Swal.fire('Failed!', result.value.msg, 'error').then(() => { dtCustomer.ajax.reload(); });
                }
            }
        });
    });

    $(dtCustomerTable).on('click', '.btn-delete', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure you want to delete this customer?',
            text: "Enter your password to continue!",
            icon: 'warning',
            input: 'password',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Yes, activate it!',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false,
            showLoaderOnConfirm: true,
            preConfirm: (password) => {
                return fetch(`/customers/${id}/delete?password=${password}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function(result) {
            if (result.isConfirmed) {
                if (result.value.success) {
                    Swal.fire('Success!', result.value.msg, 'success').then(() => { dtCustomer.ajax.reload(); });
                } else {
                    Swal.fire('Failed!', result.value.msg, 'error').then(() => { dtCustomer.ajax.reload(); });
                }
            }
        });
    });

    $(dtCustomerTable).on('click', '.btn-add-credits', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Add additional extra credits to this customer.',
            text: "Enter the amount of credits:",
            icon: 'warning',
            input: 'number',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false,
            showLoaderOnConfirm: true,
            preConfirm: (credits) => {
                return fetch(`/customers/${id}/addcredits?amount=${credits}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function(result) {
            if (result.isConfirmed) {
                if (result.value.success) {
                    Swal.fire('Success!', result.value.msg, 'success').then(() => { dtCustomer.ajax.reload(); });
                } else {
                    Swal.fire('Failed!', result.value.msg, 'error').then(() => { dtCustomer.ajax.reload(); });
                }
            }
        });
    });

    $(dtCustomerTable).on('click', '.btn-add-subscription', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Add additional months to this customer subscription.',
            text: "How many months?",
            icon: 'warning',
            input: 'number',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false,
            showLoaderOnConfirm: true,
            preConfirm: (months) => {
                return fetch(`/customers/${id}/addsubscription?months=${months}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then(function(result) {
            if (result.isConfirmed) {
                if (result.value.success) {
                    Swal.fire('Success!', result.value.msg, 'success').then(() => { dtCustomer.ajax.reload(); });
                } else {
                    Swal.fire('Failed!', result.value.msg, 'error').then(() => { dtCustomer.ajax.reload(); });
                }
            }
        });
    });

    $('.select2').each(function() {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $this.parent()
        });
    });
});