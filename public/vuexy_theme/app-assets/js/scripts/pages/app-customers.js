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
                { data: 'id' },
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
                    responsivePriority: 2,
                    targets: 0
                },
                {
                    targets: 2,
                    render: function(data, type, row) {
                        if (row.email_status == 'verified')
                            return `${row.email} <div class="badge badge-primary">${row.email_status}</div>`;
                        else
                            return `${row.email} <div class="badge badge-warning">${row.email_status}</div>`;
                    }
                },
                {
                    targets: 6,
                    render: function(data, type, row) {
                        if (row.status == 'active') {
                            return `<div class="badge badge-success">${row.status}</div>`
                        } else {
                            return `<div class="badge badge-danger">${row.status}</div>`
                        }
                    }
                },
                {
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        let elAction = '';
                        // if (can_show_customers || has_full_access) {
                        //     elAction += `<a class="mr-1 text-primary" href="${URL}/${row.id}" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Customer Details">${feather.icons['user'].toSvg({ class: 'font-medium-2' })}</a>`;
                        // }
                        if (can_add_credits_customers || has_full_access) {
                            elAction += `<a class="mr-1 text-secondary btn-add-credits" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Add Credits">${feather.icons['plus-circle'].toSvg({ class: 'font-medium-2' })}</a>`;
                        }
                        if (can_add_subscription_customers || has_full_access) {
                            elAction += `<a class="mr-1 text-default btn-add-subscription" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Add Subscription">${feather.icons['plus-square'].toSvg({ class: 'font-medium-2' })}</a>`;
                        }
                        if (can_changestatus_customers || has_full_access) {
                            if (row.status == 'active') {
                                elAction += `<a class="mr-1 text-warning btn-deactivate" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Deactivate">${feather.icons['user-x'].toSvg({ class: 'font-medium-2' })}</a>`;
                            } else {
                                elAction += `<a class="mr-1 text-success btn-activate" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Activate">${feather.icons['user-check'].toSvg({ class: 'font-medium-2' })}</a>`;
                            }
                        }
                        if (can_delete_customers || has_full_access) {
                            elAction += `<a class="mr-1 btn-delete text-danger" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Delete">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>`;
                        }
                        return (
                            `<div class="d-flex align-items-center col-actions">
                            ${elAction}
                            </div>
                            `
                        );

                    }
                }
            ],
            order: [
                [1, 'desc']
            ],
            dom: '<"row d-flex justify-content-between align-items-center m-1"' +
                '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-lg-right text-left "B>>' +
                '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pr-lg-1 p-0"f<"invoice_status ml-sm-2">>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search Users',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'Add Customer',
                className: 'btn btn-primary btn-add-record ml-2',
                action: function(e, dt, button, config) {
                    $(new_customer_modal).modal('show');
                }
            }],
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
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table',
                        columnDefs: [{
                            targets: 1,
                            visible: false
                        }, {
                            targets: 2,
                            visible: false
                        }]
                    })
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
                return fetch(`/customers/${id}/deactivate?password=${password}`)
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