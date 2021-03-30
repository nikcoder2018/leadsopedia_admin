/*=========================================================================================
    File Name: app-invoice-list.js
    Description: app-invoice-list Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(function() {
    'use strict';

    var tableImport = $('.table-import'),
        checkBoxAll = $('#checkboxSelectAll'),
        btnSave = $('.btn-save'),
        FILE_ID = $('.table-import').data('file-id'),
        API_TOKEN = $('[name=api-token]').attr('content');

    $.ajax({
        url: '/leads/import/' + FILE_ID + '/body',
        type: 'GET',
        beforeSend: function() {
            $('.spinner-container').append(`<div class="spinner-border" style="width: 3rem; height: 3rem" role="status">
                <span class="sr-only">Loading...</span>
            </div>`);
        },
        success: function(data) {
            $('.spinner-container').remove();
            tableImport.removeClass('d-none');

            let tbody = tableImport.find('tbody');

            $.each(data, function(index, item) {
                let fields = '';
                $.each(item, function(k, i) {
                    fields += `
                            <td>
                                <input type="text" name="fields[]" class="form-control" value="${i}">
                            </td>
                        `;
                });
                tbody.append(`
                <tr>
                    <td class="import-start-column">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" value="" id="checkbox${index}">
                            <label class="custom-control-label" for="checkbox${index}"></label>
                        </div>
                        ${fields}
                    </td>
                    
                </tr>
                `);
            });
        }
    });

    checkBoxAll.on('change', function() {
        if ($(this).is(':checked')) {
            tableImport.find('input[type=checkbox]').prop('checked', true);
        } else {
            tableImport.find('input[type=checkbox]').prop('checked', false);
        }
    });
    btnSave.on('click', function() {
        let header_empty = 0;
        let theadForm = $(tableImport).find('thead form');
        let header = {}
        $.each(theadForm.serializeArray(), function(index, item) {
            header[index] = item.value;
            if (header[index] == '') {
                header_empty++;
                return false;
            }
        });

        if (header_empty > 0) {
            Swal.fire({
                title: 'Warning!',
                text: 'Empty headers has been detected you like to continue?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    submitImport()

                    return false;
                }
            });
        } else {
            submitImport()
        }
    });

    function submitImport() {
        $.each(tableImport.find('tbody > tr'), async function(index, row) {
            if ($(row).find('input[type=checkbox]').is(':checked')) {

                let theadForm = $(tableImport).find('thead form');
                let header = {}
                let body = {}
                $.each(theadForm.serializeArray(), function(index, item) {
                    header[index] = item.value;
                });

                $.each($(row).find('input[type=text]').serializeArray(), function(index, item) {
                    if (header[index] != '') {
                        body[header[index]] = item.value;
                    }
                });

                body['_token'] = $('meta[name="csrf-token"]').attr('content');

                await $.ajax({
                    url: '/leads/import/data',
                    type: 'POST',
                    data: body,
                    beforeSend: function() {
                        $(row).find('.import-start-column').append(`
                            <div class="spinner spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        `);
                        $(row).find('input').prop('disabled', true);
                    },
                    success: function(resp) {
                        if (resp.success) {
                            $(row).find('.import-start-column').find('.spinner').replaceWith(feather.icons['check-circle'].toSvg({ class: 'ficon text-success' }))
                        } else {
                            $(row).find('.import-start-column').find('.spinner').replaceWith(`
                                <button type="button" class="btn btn-link px-0 py-0" data-toggle="tooltip" data-placement="top" title="${resp.msg}">${feather.icons['alert-circle'].toSvg({ class: 'ficon text-warning' })}</button>
                            `)
                            $(row).find('[data-toggle="tooltip"]').tooltip();
                        }
                    }
                })
            }
        });
    }

});