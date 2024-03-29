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
        can_show_filters = $.inArray('filters_show', mypermissions) != -1 ? true : false,
        can_create_filters = $.inArray('filters_create', mypermissions) != -1 ? true : false,
        can_edit_filters = $.inArray('filters_edit', mypermissions) != -1 ? true : false,
        can_delete_filters = $.inArray('filters_delete', mypermissions) != -1 ? true : false;

    var dtCategoryTable = $('.category-list-table'),
        isRtl = $('html').attr('data-textdirection') === 'rtl',
        API_URL = '/api/filters/industry/category/data',
        URL = '/filters',
        API_TOKEN = $('[name=api-token]').attr('content'),
        add_category_modal = $('#add-industry-category-modal'),
        edit_category_modal = $('#edit-industry-category-modal');

    if (dtCategoryTable.length) {
        var dtCategory = dtCategoryTable.DataTable({
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
                { data: 'name' },
                { data: '' }
            ],
            columnDefs: [{
                // Actions
                targets: -1,
                width: '80px',
                orderable: false,
                render: function(data, type, row, meta) {
                    let elAction = '';
                    if (can_edit_filters || has_full_access) {
                        elAction += `<a class="mr-1 btn-edit text-info" href="javascript:void(0);" data-id="${row._id}" data-toggle="tooltip" data-placement="top" title="Edit">${feather.icons['edit'].toSvg({ class: 'font-medium-2' })}</a>`;
                    }
                    if (can_delete_filters || has_full_access) {
                        elAction += `<a class="mr-1 btn-delete text-danger" href="javascript:void(0);" data-id="${row._id}" data-toggle="tooltip" data-placement="top" title="Delete">${feather.icons['delete'].toSvg({ class: 'font-medium-2' })}</a>`;
                    }
                    return (
                        `<div class="d-flex align-items-center col-actions">
                            ${elAction}
                        </div>
                        `
                    );

                }
            }],
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
                searchPlaceholder: 'Search',
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            // Buttons with Dropdown
            buttons: [{
                text: 'Add',
                className: 'btn btn-primary btn-add-record ml-2',
                action: function(e, dt, button, config) {
                    $(add_category_modal).modal('show');
                }
            }],
            initComplete: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            },
            drawCallback: function() {
                $(document).find('[data-toggle="tooltip"]').tooltip();
            }
        });
    }
    dtCategoryTable.on('click', '.btn-edit', async function() {
        var form = edit_category_modal.find('form');
        var id = $(this).data('id');

        edit_category_modal.modal('show');

        const filter = await $.get('/filter/industry/category/' + id + '/edit');
        form.find('input[name=id]').val(filter._id);
        form.find('input[name=name]').val(filter.name);
    });
    add_category_modal.on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    add_category_modal.modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                    dtCategory.ajax.reload();
                } else {
                    toastr['error'](resp.msg, 'Failed!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                }
            }
        });
    });
    edit_category_modal.on('submit', 'form', function(e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp) {
                if (resp.success) {
                    edit_category_modal.modal('hide');
                    $(form)[0].reset();

                    toastr['success'](resp.msg, 'Success!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });

                    dtCategory.ajax.reload();
                }
            }
        });
    });

    dtCategoryTable.on('click', '.btn-edit', async function() {
        var form = edit_category_modal.find('form');
        var id = $(this).data('id');

        edit_category_modal.modal('show');

        const filter = await $.get('/filter/industry/category/' + id + '/edit');
        form.find('input[name=id]').val(filter._id);
        form.find('input[name=name]').val(filter.name);
    });

    dtCategoryTable.on('click', '.btn-delete', async function() {
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
                const deleteData = await $.get(`/filter/industry/category/${id}/delete`);
                if (deleteData.success) {
                    toastr['success'](deleteData.msg, 'Deleted!', {
                        closeButton: true,
                        tapToDismiss: false,
                        rtl: isRtl
                    });
                    dtCategory.ajax.reload();
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