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
        can_show_lead = $.inArray('leads_show', mypermissions) != -1 ? true : false,
        can_create_lead = $.inArray('eads_create', mypermissions) != -1 ? true : false,
        can_edit_lead = $.inArray('eads_edit', mypermissions) != -1 ? true : false,
        can_delete_lead = $.inArray('eads_delete', mypermissions) != -1 ? true : false;

    var dtLeadsTable = $('.leads-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/leads/all?type=contacts',
        URL = '/leads',
        API_TOKEN = $('[name=api-token]').attr('content');

    // datatable
    if (dtLeadsTable.length) {
        var dtLeads = dtLeadsTable.DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: API_URL,
                type: "GET",
                data: function(d) {
                    d.api_token = API_TOKEN;
                    d.last_id = dtLeadsTable.attr('last-id')
                }
            }, // JSON file to add data
            autoWidth: false,
            columns: [
                // columns according to JSON
                { data: 'responsive_id' },
                { data: 'name' },
                { data: 'title' },
                { data: 'industry' },
                { data: 'email' },
                { data: 'phone' },
                { data: 'website' },
                { data: 'street' },
                { data: 'city' },
                { data: 'state' },
                { data: 'region' },
                { data: 'country' },
                { data: '' }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    responsivePriority: 2,
                    targets: 0
                },
                {
                    // Actions
                    targets: -1,
                    width: '80px',
                    orderable: false,
                    render: function(data, type, row, meta) {
                        dtLeadsTable.attr('last-id', row.id);
                        let elAction = '';
                        if (can_edit_lead || has_full_access) {
                            elAction += `<a class="mr-1 btn-lead-edit text-info" href="javscript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Edit Data">${feather.icons['edit'].toSvg({ class: 'font-medium-2' })}</a>`;
                        }
                        if (can_delete_lead || has_full_access) {
                            elAction += `<a class="mr-1 btn-lead-delete text-danger" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Delete data">${feather.icons['trash'].toSvg({ class: 'font-medium-2' })}</a>`;
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
                [0, 'asc']
            ],
            dom: '<"row d-flex justify-content-between align-items-center m-1"' +
                '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-lg-right text-left "B>>' +
                '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pr-lg-1 p-0"f<"invoice_status ml-sm-2">>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            displayLength: 10,
            lengthMenu: [10, 25, 50, 75, 100, 500],
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search Data',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                    extend: 'collection',
                    className: 'btn btn-primary btn-import btn-sm dropdown-toggle mr-2',
                    text: feather.icons['download'].toSvg({ class: 'font-small-4 mr-50' }) + 'Import Leads',
                    buttons: [{
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'By CSV',
                            className: 'dropdown-item',
                            action: function(e, dt, button, config) {
                                $('.upload-csv-form input[type=file]').trigger('click');
                            }
                        },

                    ],
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                        $(node).parent().removeClass('btn-group');
                        setTimeout(function() {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                        }, 50);
                    }
                },
                // {
                //     text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add New Record',
                //     className: 'create-new btn btn-primary',
                //     attr: {
                //         'data-toggle': 'modal',
                //         'data-target': '#modals-slide-in'
                //     },
                //     init: function(api, node, config) {
                //         $(node).removeClass('btn-secondary');
                //     }
                // }
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Details of ' + data.first_name + ' ' + data.last_name;
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
            initComplete: function(resp) {
                $(document).find('[data-toggle="tooltip"]').tooltip();
                $(".dataTables_filter input")
                    .unbind() // Unbind previous default bindings
                    .bind("input", function(e) { // Bind our desired behavior
                        // If the length is 3 or more characters, or the user pressed ENTER, search
                        if (this.value.length >= 3 || e.keyCode == 13) {
                            // Call the API search function
                            dtLeads.search(this.value).draw();
                        }
                        // Ensure we clear the search if they backspace far enough
                        if (this.value == "") {
                            dtLeads.search("").draw();
                        }
                        return;
                    });
                // Adding role filter once table initialized
                if (!can_create_lead) {
                    $('.btn-import').remove();
                }
            },
            drawCallback: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            },
            rowCallback: function(row, data, index) {
                $(document).find('[data-toggle="tooltip"]').tooltip();
                var api = this.api();
                $('td:eq(0)', row).html((index + 1) + (api.page() * api.page.len()));
            },
        });
    }

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

    $('.upload-csv-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('body').append(`
                <div class="spinner-ovelay spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="spinner-backdrop"></div>
                `);
            },
            uploadProgress: function(event, position, total, percentComplete) {

            },
            success: function(resp) {
                if (resp.success) {
                    window.location = '/leads/import/' + resp.file_id
                }
            }
        })
    });

    $(document).on('click', '.btn-lead-delete', function() {
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
                return fetch(`/leads/${id}/delete?password=${password}`)
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
                    $('body').removeClass('modal-open');
                    $('.dtr-bs-modal').removeClass('show');
                    $('.modal-backdrop').remove();
                    Swal.fire('Success!', result.value.msg, 'success').then(() => { dtLeads.ajax.reload(); });
                } else {
                    Swal.fire('Failed!', result.value.msg, 'error').then(() => { dtLeads.ajax.reload(); });
                }
            }
        });
    });

});