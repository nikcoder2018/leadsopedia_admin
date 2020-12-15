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
    const api_token = $('[name=api-token]').attr('content');
    const mypermissions = await $.get('/account/permissions');
    var has_full_access = $.inArray('full_access', mypermissions) != -1 ? true : false,
        can_show_settings = $.inArray('settings_show', mypermissions) != -1 ? true : false,
        can_update_settings = $.inArray('settings_update', mypermissions) != -1 ? true : false;

    let pill_general = $('#pill-general'),
        tab_general = $('#general'),
        tab_general_form = tab_general.find('form'),
        pill_payments = $('#pill-payments'),
        tab_payments = $('#payments'),
        new_payment_method_modal = $('#new-payment-method-modal'),
        edit_payment_method_modal = $('#edit-payment-method-modal'),
        tab_payments_table = tab_payments.find('table'),
        pill_integration = $('#pill-integrations'),
        tab_integration = $('#integrations'),
        new_integration_modal = $('#new-integration-modal'),
        edit_integration_modal = $('#edit-integration-modal'),
        tab_integration_table = tab_integration.find('table');

    general_settings();

    pill_payments.on('click', async function() {
        payments_settings();
    });
    pill_integration.on('click', async function() {
        integration_settings();
    });

    async function general_settings() {
        tab_general_form.hide();
        tab_general.addClass('d-flex justify-content-center align-items-center');
        tab_general.append(`
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        `);

        const general = await $.get('/api/settings/init', { api_token, type: 'general' });

        tab_general_form.show();
        tab_general.removeClass('d-flex justify-content-center align-items-center');
        tab_general.find('.spinner-border').remove();

        tab_general_form.find('input[name=landing_web_title]').val(general.defaults.landing_web_title);
        tab_general_form.find('input[name=front_web_title]').val(general.defaults.front_web_title);
        tab_general_form.find('input[name=backoffice_web_title]').val(general.defaults.backoffice_web_title);

        $.each(general.languages, function(index, language) {
            let selected = '';
            if (general.defaults.language == language.code) selected = 'selected';
            $(`<option value="${language.code}" ${selected}>${language.name}</option>`).appendTo(tab_general_form.find('select[name=language]'));
        });

        $.each(general.currencies, function(index, currency) {
            let selected = '';
            if (general.defaults.currency == currency.abbreviation) selected = 'selected';
            $(`<option value="${currency.abbreviation}" ${selected}>${currency.currency} ${currency.symbol}</option>`).appendTo(tab_general_form.find('select[name=currency]'));
        });

        $.each(general.timezones, function(index, timezone) {
            let selected = '';
            if (general.defaults.timezone == timezone.value) selected = 'selected';
            $(`<option value="${timezone.value}" ${selected}>${timezone.text}</option>`).appendTo(tab_general_form.find('select[name=timezone]'));
        });

        tab_general_form.on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp.success) {
                        toastr['success'](resp.msg, 'Success!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                    }
                }
            });
        });
    }

    function payments_settings() {
        if (tab_payments_table.length && !$.fn.dataTable.isDataTable(tab_payments_table)) {
            var dtPaymentsTable = tab_payments_table.DataTable({
                ajax: {
                    url: '/api/payments/all',
                    type: "GET",
                    data: {
                        api_token
                    }
                }, // JSON file to add data
                autoWidth: false,
                columns: [
                    // columns according to JSON
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'description' },
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
                        render: function(data, type, full, meta) {
                            return (
                                `<div class="d-flex align-items-center col-actions">
                                  <a class="mr-1 btn-edit" href="javascript:void(0);" data-id="${full.id}" data-toggle="tooltip" data-placement="top" title="Edit">${feather.icons['edit-2'].toSvg({ class: 'font-medium-2' })}</a>
                                  <a class="mr-1 btn-delete" href="javascript:void(0);" data-toggle="tooltip" data-id="${full.id}" data-placement="top" title="Delete">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>
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
                    searchPlaceholder: 'Search Payment Methods',
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                // Buttons with Dropdown
                buttons: [{
                    text: 'Add Payment Method',
                    className: 'btn btn-primary btn-sm btn-add-record ml-2',
                    action: function(e, dt, button, config) {
                        $(new_payment_method_modal).modal('show');
                    }
                }],
                // For responsive popup
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function(row) {
                                var data = row.data();
                                return 'Details of ' + data.title;
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

        new_payment_method_modal.on('submit', 'form', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp.success) {
                        new_payment_method_modal.modal('hide');
                        new_payment_method_modal.find('form')[0].reset();
                        toastr['success'](resp.msg, 'Success!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        dtPaymentsTable.ajax.reload();
                    }
                }
            });
        });

        dtPaymentsTable.on('click', '.btn-edit', async function() {
            let id = $(this).data().id;
            let form = $(edit_payment_method_modal).find('form');
            $(edit_payment_method_modal).modal('show');

            const payment = await $.get(`/payment-methods/${id}/edit`);

            form.find('input[name=id]').val(payment.id);
            form.find('input[name=name]').val(payment.name);
            form.find('textarea[name=description]').val(payment.description);

            let attributes = form.find('[data-repeater-list="attributes"]');

            await $.each(payment.details, function(index, detail) {
                $(`
                <div data-repeater-item>
                    <div class="row d-flex align-items-end">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="itemname">Name</label>
                                <input type="text" class="form-control" id="itemname" name="attributes[${index}][name]" value="${detail.name}"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="itemvalue">Value</label>
                                <input type="text" class="form-control" id="itemvalue" name="attributes[${index}][value]" value="${detail.value}"/>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 mb-50">
                            <div class="form-group">
                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                    <i data-feather="x" class="mr-25"></i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
                `).appendTo($(attributes));
            });

            await $('.attribute-lists-edit').repeater({
                show: function() {
                    console.log($(this));
                    $(this).slideDown();
                    // Feather Icons
                    if (feather) {
                        feather.replace({ width: 14, height: 14 });
                    }
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this attribute?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });

        dtPaymentsTable.on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(async function(result) {
                if (result.isConfirmed) {
                    const deleteData = await $.get(`/payment-methods/${id}/delete`);
                    if (deleteData.success) {
                        toastr['success'](deleteData.msg, 'Deleted!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        dtPaymentsTable.ajax.reload();
                    }
                }
            });
        });

    }

    function integration_settings() {
        if (tab_integration_table.length && !$.fn.dataTable.isDataTable(tab_integration_table)) {
            var dtIntegrationsTable = tab_integration_table.DataTable({
                ajax: {
                    url: '/api/integrations/all',
                    type: "GET",
                    data: {
                        api_token
                    }
                }, // JSON file to add data
                autoWidth: false,
                columns: [
                    // columns according to JSON
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'group' },
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
                            if (row.group) {
                                return row.group.name
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        // Actions
                        targets: -1,
                        width: '80px',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return (
                                `<div class="d-flex align-items-center col-actions">
                                  <a class="mr-1 btn-edit" href="javascript:void(0);" data-id="${full.id}" data-toggle="tooltip" data-placement="top" title="Edit">${feather.icons['edit-2'].toSvg({ class: 'font-medium-2' })}</a>
                                  <a class="mr-1 btn-delete" href="javascript:void(0);" data-toggle="tooltip" data-id="${full.id}" data-placement="top" title="Delete">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>
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
                    searchPlaceholder: 'Search Integration',
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                // Buttons with Dropdown
                buttons: [{
                    text: 'Add',
                    className: 'btn btn-primary btn-sm btn-add-record',
                    action: function(e, dt, button, config) {
                        new_integration_modal.modal('show');
                    }
                }, {
                    text: 'Groups',
                    className: 'btn btn-success btn-sm',
                    action: function(e, dt, button, config) {

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
                },
                drawCallback: function() {
                    $(document).find('[data-toggle="tooltip"]').tooltip();
                }
            });
        }

        new_integration_modal.on('submit', 'form', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp.success) {
                        new_integration_modal.modal('hide');
                        new_integration_modal.find('form')[0].reset();
                        toastr['success'](resp.msg, 'Success!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        dtIntegrationsTable.ajax.reload();
                    }
                }
            });
        });

        dtIntegrationsTable.on('click', '.btn-edit', async function() {
            let id = $(this).data().id;
            let form = $(edit_integration_modal).find('form');
            $(edit_integration_modal).modal('show');

            const integration = await $.get(`/integrations/${id}/edit`);

            form.find('input[name=id]').val(integration.id);
            form.find('input[name=name]').val(integration.name);
            form.find('input[name=app_key]').val(integration.app_key);
            form.find('textarea[name=description]').val(integration.description);
            form.find('select[name=status]').val(integration.status);
            form.find('select[name=group]').val(integration.group ? integration.group.name : '');
            form.find('select[name=scope]').val(integration.scope);

            let attributes = form.find('[data-repeater-list="attributes"]');
            attributes.empty();

            await $.each(integration.keys, function(index, item) {
                $(`
                <div data-repeater-item>
                    <div class="row d-flex align-items-end">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="itemkey">Name</label>
                                <input type="text" class="form-control" id="itemkey" name="attributes[${index}][key]" value="${item.key}"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="itemname">Value</label>
                                <input type="text" class="form-control" id="itemname" name="attributes[${index}][name]" value="${item.name}"/>
                            </div>
                        </div>
                        <div class="col-md-2 col-12 mb-50">
                            <div class="form-group">
                                <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                    <i data-feather="x" class="mr-25"></i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
                `).appendTo($(attributes));
            });

        });

        edit_integration_modal.on('submit', 'form', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp.success) {
                        edit_integration_modal.modal('hide');
                        edit_integration_modal.find('form')[0].reset();
                        toastr['success'](resp.msg, 'Success!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        dtIntegrationsTable.ajax.reload();
                    }
                }
            });
        });


        dtIntegrationsTable.on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(async function(result) {
                if (result.isConfirmed) {
                    const deleteData = await $.get(`/integrations/${id}/delete`);
                    if (deleteData.success) {
                        toastr['success'](deleteData.msg, 'Deleted!', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                        dtIntegrationsTable.ajax.reload();
                    }
                }
            });
        });
    }

    // form repeater jquery

    $('.attribute-lists').repeater({
        show: function() {
            console.log($(this));
            $(this).slideDown();
            // Feather Icons
            if (feather) {
                feather.replace({ width: 14, height: 14 });
            }
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this attribute?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });

});