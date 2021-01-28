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
        can_show_transaction = $.inArray('transactions_show', mypermissions) != -1 ? true : false,
        can_restore_transaction = $.inArray('transactions_restore', mypermissions) != -1 ? true : false,
        can_archive_transaction = $.inArray('transactions_archive', mypermissions) != -1 ? true : false,
        can_delete_transaction = $.inArray('transactions_delete', mypermissions) != -1 ? true : false;

    var dtTransactionsTable = $('.transactions-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/transactions/all',
        URL = '/transactions',
        API_TOKEN = $('[name=api-token]').attr('content');

    // datatable
    if (dtTransactionsTable.length) {
        var dtTransactions = dtTransactionsTable.DataTable({
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
                { data: 'invoice_number' },
                { data: 'customer' },
                { data: 'payment_method' },
                { data: 'for' },
                { data: 'amount' },
                { data: 'status' },
                { data: 'date' },
                { data: '' }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    targets: 0
                },
                {
                    targets: 6,
                    render: function(data, type, row) {
                        return `<div class="${row.status_class}">${row.status}</div>`
                    }
                },
                {
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        let elAction = '';
                        if (can_show_transaction || has_full_access) {
                            elAction += `<a class="mr-1 text-primary btn-details" href="/transactions/${row.id}/details" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="View Details">${feather.icons['file-text'].toSvg({ class: 'font-medium-2' })}</a>`;
                        }
                        if (can_archive_transaction || has_full_access) {
                            elAction += `<a class="mr-1 text-warning btn-archive" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Archive">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>`;
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
                searchPlaceholder: 'Search Transactions',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details of ' + data.invoice_number;
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

            },
            drawCallback: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            }
        });
    }

    $(dtTransactionsTable).on('click', '.btn-archive', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This data will not be visible here!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, archive it!',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline-danger ml-1'
            },
            buttonsStyling: false,
        }).then(async function(result) {
            if (result.isConfirmed) {
                const deleteData = await $.get(`${URL}/${id}/archive`);
                if (deleteData.success) {
                    toastr['success'](deleteData.msg, 'Deleted!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    dtTransactions.ajax.reload();
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