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
        can_show_subsplan = $.inArray('subsplan_show', mypermissions) != -1 ? true : false,
        can_create_subsplan = $.inArray('subsplan_create', mypermissions) != -1 ? true : false,
        can_edit_subsplan = $.inArray('subsplan_edit', mypermissions) != -1 ? true : false,
        can_delete_subsplan = $.inArray('subsplan_delete', mypermissions) != -1 ? true : false;

    var dtSubsPlanTable = $('.subsplans-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/subscriptions/all',
        URL = '/subscriptions',
        API_TOKEN = $('[name=api-token]').attr('content'),
        new_subsplan_modal = '#new-subsplan-modal',
        edit_subsplan_modal = '#edit-subsplan-modal'; //new-role-modal

    // datatable
    if (dtSubsPlanTable.length) {
        var dtSubsPlan = dtSubsPlanTable.DataTable({
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
                { data: 'title' },
                { data: 'description' },
                { data: 'duration' },
                { data: 'price' },
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
                        let elAction = '';
                        if (can_edit_subsplan || has_full_access) {
                            elAction += `<a class="mr-1 btn-edit text-info" href="javascript:void(0);" data-id="${row.id}" data-toggle="tooltip" data-placement="top" title="Edit">${feather.icons['edit'].toSvg({ class: 'font-medium-2' })}</a>`;
                        }
                        if (can_delete_subsplan || has_full_access) {
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
                searchPlaceholder: 'Search Subscriptions',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'Create New',
                className: 'btn btn-primary btn-add-record ml-2',
                action: function(e, dt, button, config) {
                    $(new_subsplan_modal).modal('show');
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
                if (!can_create_subsplan && !has_full_access) {
                    $('.btn-add-record').remove();
                }
            },
            drawCallback: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            }
        });
    }

    $(new_subsplan_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(new_subsplan_modal).modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    dtSubsPlan.ajax.reload();
                }
            }
        });
    });

    dtSubsPlanTable.on('click', '.btn-edit', async function() {
        let id = $(this).data().id;
        let form = $(edit_subsplan_modal).find('form');
        $(edit_subsplan_modal).modal('show');

        const subscription = await $.get(`/subscriptions/${id}/edit`);

        form.find('input[name=id]').val(subscription.id);
        form.find('input[name=title]').val(subscription.title);
        form.find('textarea[name=description]').val(subscription.description);
        form.find('input[name=months]').val(subscription.months);
        form.find('input[name=price]').val(subscription.price);
        form.find('input[name=search_limits]').val(subscription.search_limits);
        form.find('input[name=search_leads_limits]').val(subscription.search_leads_limits);
        form.find('input[name=credits]').val(subscription.credits);
        form.find('input[name=css_class]').val(subscription.css_class);
        form.find('input[name=css_btn_class]').val(subscription.css_btn_class);


        let attributes = form.find('[data-repeater-list="attributes"]');
        attributes.empty();

        await $.each(subscription.priviledges, function(index, item) {
            $(`
            <div data-repeater-item>
                <div class="row d-flex align-items-end">
                    <div class="col-md-10 col-12">
                        <div class="form-group">
                            <label for="itemname">Value</label>
                            <input type="text" class="form-control" id="itemname" name="attributes[${index}][text]" value="${item.description}"/>
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

    $(edit_subsplan_modal).on('submit', 'form', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    $(edit_subsplan_modal).modal('hide');
                    $(edit_subsplan_modal).find('form')[0].reset();
                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    dtSubsPlanTable.ajax.reload();
                }
            }
        });
    });


    $(dtSubsPlanTable).on('click', '.btn-delete', function() {
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
            buttonsStyling: false,
        }).then(async function(result) {
            if (result.isConfirmed) {
                const deleteData = await $.get(`${URL}/${id}/delete`);
                if (deleteData.success) {
                    toastr['success'](deleteData.msg, 'Deleted!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    dtSubsPlan.ajax.reload();
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

    $('.attribute-lists').repeater({
        show: function() {
            $(this).slideDown();
            // Feather Icons
            if (feather) {
                feather.replace({ width: 14, height: 14 });
            }
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this priviledge?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });
});