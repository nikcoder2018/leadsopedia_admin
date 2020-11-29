<script>
    $('#form-add-payment').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp){
              if(resp.success){
                $('#addPaymentMethodModal').modal('toggle');
                Swal.fire({
                  title: 'Success!',
                  text: resp.msg,
                  icon: 'success'
                }).then(()=>{
                  let table = $('.table-payments tbody');
                  table.append(`
                  <tr>
                      <td>${resp.details.name}</td>
                      <td>
                          <a href="#" class="text-primary edit-paymentmethod" data-id="${resp.details.id}" data-toggle="tooltip" data-placement="left" title="Edit Payment Method"><i class="mdi mdi-pencil icon-md"></i></a>
                          <a href="#" class="text-danger delete-paymentmethod" data-id="${resp.details.id}" data-toggle="tooltip" data-placement="left" title="Delete Payment Method"><i class="mdi mdi-delete icon-md"></i></a>                    
                      </td>
                    </tr>
                  `);
                })
              }
            }
          });
        });

        $('.table-payments').on('click','.edit-paymentmethod', async function(){
            let id = $(this).data('id');
            let editModal = $('#editPaymentMethodModal');
            let editForm = editModal.find('form');
            editModal.modal('toggle');
            let paymentmethod = await $.ajax({
              url: "{{route('payment-methods.edit')}}",
              type: 'POST',
              data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id
              }
            });

            editForm.find('input[name=id]').val(paymentmethod.id);
            editForm.find('input[name=name]').val(paymentmethod.name);
            editForm.find('textarea[name=description]').val(paymentmethod.description);

            if(paymentmethod.details){
              let formAttributes = editForm.find('.attribute-lists');
              formAttributes.empty();
              $.each(paymentmethod.details, function(index, detail){
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

        $('#form-edit-payment').on('submit', function(e){
          e.preventDefault();

          $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(resp){
              if(resp.success){
                $('#editPaymentMethodModal').modal('toggle');
                Swal.fire({
                  title: 'Success!',
                  text: resp.msg,
                  icon: 'success'
                }).then(()=>{
                  let table = $('.table-payments tbody');
                  table.find('[data-id='+resp.method.id+']').parent().parent().replaceWith(`
                  <tr>
                      <td>${resp.method.name}</td>
                      <td>
                          <a href="#" class="text-primary edit-paymentmethod" data-id="${resp.method.id}" data-toggle="tooltip" data-placement="left" title="Edit Payment Method"><i class="mdi mdi-pencil icon-md"></i></a>
                          <a href="#" class="text-danger delete-paymentmethod" data-id="${resp.method.id}" data-toggle="tooltip" data-placement="left" title="Delete Payment Method"><i class="mdi mdi-delete icon-md"></i></a>                    
                      </td>
                    </tr>
                  `);
                })
              }
            }
          });
        });

        $('.table-payments').on('click','.delete-paymentmethod', function(){
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
                      url: "{{route('payment-methods.destroy')}}",
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
                            let table = $('.table-payments tbody');
                            table.find('[data-id='+deleteData.id+']').parent().parent().fadeOut(600);
                          }
                      });
                  }
              }
          })
        });
</script>