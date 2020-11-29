<script>
    function ucwords (str) {
        return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
            return $1.toUpperCase();
        });
    }

    $('#form-add-integration').on('submit', function(e){
        let form = $(this);
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp){
                if(resp.success){
                $('#addIntegrationModal').modal('toggle');
                form[0].reset();
                form.find('.attribute-lists').empty();
                Swal.fire({
                    title: 'Success!',
                    text: resp.msg,
                    icon: 'success'
                }).then(()=>{
                    let table = $('.table-integrations tbody');
                    let group_name = 'None';
                    if(resp.integration.group != undefined || resp.integration.group != null){
                        group_name = resp.integration.group.name
                    }
                    table.append(`
                    <tr>
                        <td>${resp.integration.name}</td>
                        <td>${ucwords(group_name)}</td>
                        <td>${ucwords(resp.integration.status)}</td>
                        <td>
                            <a href="#" class="text-primary edit-integration" data-id="${resp.integration.id}" data-toggle="tooltip" data-placement="left" title="Edit Integration"><i class="mdi mdi-pencil icon-md"></i></a>
                            <a href="#" class="text-danger delete-integration" data-id="${resp.integration.id}" data-toggle="tooltip" data-placement="left" title="Delete Integration"><i class="mdi mdi-delete icon-md"></i></a>                    
                        </td>
                    </tr>
                    `);
                })
                }
            }
        });
    });
    $('.table-integrations').on('click','.edit-integration', async function(){
        let id = $(this).data('id');
        let editModal = $('#editIntegrationModal');
        let editForm = editModal.find('form');
        editModal.modal('toggle');
        let integration = await $.ajax({
            url: "{{route('integrations.edit')}}",
            type: 'POST',
            data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id
            }
        });

        editForm.find('input[name=id]').val(integration.id);
        editForm.find('input[name=name]').val(integration.name);
        editForm.find('input[name=app_key]').val(integration.app_key);
        editForm.find('textarea[name=description]').val(integration.description);
        editForm.find('select[name=status]').val(integration.status);
        editForm.find('select[name=group_id]').val(integration.group_id);
        editForm.find('select[name=scope]').val(integration.scope);

        if(integration.attributes_default){
            let formAttributes = editForm.find('.attribute-lists');
            formAttributes.empty();
            $.each(integration.attributes_default, function(index, detail){
            formAttributes.append(`
                <div class="list-items d-flex mb-2">
                <input type="text" style="width:30% !important" name="attributes[${formAttributes.find('.list-items').length}][name]" value="${detail.name}" class="form-control" placeholder="Name" required>
                <input type="text" style="width:70% !important" name="attributes[${formAttributes.find('.list-items').length}][value]" value="${detail.value}" class="form-control" placeholder="Value" required>
                <button class="btn btn-sm btn-danger btn-delete" type="button"><i class="fa fa-trash"></i></button>
                </div>
            `);
            });
        }
    });
    $('#form-edit-integration').on('submit', function(e){
        e.preventDefault();

        $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
        success: function(resp){
            if(resp.success){
            $('#editIntegrationModal').modal('toggle');
            Swal.fire({
                title: 'Success!',
                text: resp.msg,
                icon: 'success'
            }).then(()=>{
                let table = $('.table-integrations tbody');
                let group_name = 'None';
                if(resp.integration.group != undefined || resp.integration.group != null){
                    group_name = resp.integration.group.name
                }
                table.find('[data-id='+resp.integration.id+']').parent().parent().replaceWith(`
                <tr>
                    <td>${resp.integration.name}</td>
                    <td>${ucwords(group_name)}</td>
                    <td>${ucwords(resp.integration.status)}</td>
                    <td>
                        <a href="#" class="text-primary edit-integration" data-id="${resp.integration.id}" data-toggle="tooltip" data-placement="left" title="Edit Integration"><i class="mdi mdi-pencil icon-md"></i></a>
                        <a href="#" class="text-danger delete-integration" data-id="${resp.integration.id}" data-toggle="tooltip" data-placement="left" title="Delete Integration"><i class="mdi mdi-delete icon-md"></i></a>                    
                    </td>
                </tr>
                `);
            })
            }
        }
        });
    });
    $('.table-integrations').on('click','.delete-integration', function(){
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                const deleteData = await $.ajax({
                    url: "{{route('integrations.destroy')}}",
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id
                    }
                });
                
                if(deleteData.success){
                    Swal.fire(
                        'Deleted!',
                        deleteData.msg,
                        'success'
                    ).then(result=>{
                        if(result){
                        let table = $('.table-integrations tbody');
                        table.find('[data-id='+deleteData.id+']').parent().parent().fadeOut(600);
                        }
                    });
                }
            }
        })
    });

    var groupListItem = $('.integrations-group-list');
    var groupListInput = $('.integrations-group-list-input');
    var counter = 0;
    $('.integrations-group-list-add-btn').on("click", function(event) {
        event.preventDefault();
        counter = $(groupListItem.find('li:last-child')[0]).attr('counter');
        if (counter) {
            counter++;
        } else {
            counter = 0;
        }

        var item = $(this).prevAll('.integrations-group-list-input').val();

        if (item) {
            $.ajax({
                url: "{{route('integrationgroups.store')}}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    name: item
                },
                success: function(resp){
                    if(resp.success){
                        groupListItem.append(`
                            <li counter='${counter}' class='justify-content-between'>
                                <div style='width:80%'>
                                    <input type='hidden' class='form-control' name='id' value='${resp.group.id}'/>
                                    <input type='hidden' class='form-control' name='name' value='${resp.group.name}'/>
                                    <label class='form-check-label'>${resp.group.name}<i class='input-helper'></i></label>
                                </div>
                                <div>
                                    <i class='save mdi mdi-checkbox-marked-circle-outline' style='display:none'></i>
                                    <i class='edit mdi mdi-pencil-circle-outline'></i>
                                    <i class='remove mdi mdi-close-circle-outline'></i>
                                </div>
                            </li>
                        `);
                        groupListInput.val("");
                    }
                }
            });
            
        }
    });

    groupListItem.on('change', '.checkbox', function() {
        if ($(this).attr('checked')) {
            $(this).removeAttr('checked');
        } else {
            $(this).attr('checked', 'checked');
        }

        $(this).closest("li").toggleClass('completed');

    });
    groupListItem.on('click', '.edit', async function() {
        let id = $(this).parent().parent().find('input[name=id]');
        let name = $(this).parent().parent().find('input[name=name]');
        let label = $(this).parent().parent().find('label');

        name.attr('type', 'text');
        label.hide();

        let group = await $.ajax({
            url: "{{route('integrationgroups.edit')}}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id.val()
            }
        });

        name.val(group.name);

        $(this).hide();
        $(this).siblings('.save').show();
        
    });
    groupListItem.on('click', '.save', function() {
        let id = $(this).parent().parent().find('input[name=id]');
        let name = $(this).parent().parent().find('input[name=name]');
        let label = $(this).parent().parent().find('label');
        name.attr('type','hidden');
        label.show();
        label.text(name.val());
        $(this).hide();
        $(this).siblings('.edit').show();

        $.ajax({
            url: "{{route('integrationgroups.update')}}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: id.val(),
                name: name.val()
            }
        });
    });
    groupListItem.on('click', '.remove', function() {
        let id = $(this).parent().parent().find('input[name=id]');
        let parent = $(this).parent().parent();
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this group!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{route('integrationgroups.destroy')}}",
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id.val()
                    },
                    success: function(resp){
                        if(resp.success){
                            parent.remove();
                        }
                    }
                });
            }
    });
    });
</script>