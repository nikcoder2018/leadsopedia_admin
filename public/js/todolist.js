(function($) {
    'use strict';
    $(function() {
        var priviledgesListItem = $('.priviledges-list');
        var priviledgesListInput = $('.priviledges-list-input');
        var counter = 0;
        $('.priviledges-list-add-btn').on("click", function(event) {
            event.preventDefault();
            counter = $(priviledgesListItem.find('li:last-child')[0]).attr('counter');
            if (counter) {
                counter++;
            } else {
                counter = 0;
            }

            var item = $(this).prevAll('.priviledges-list-input').val();
            if (item) {
                priviledgesListItem.append(`
                <li counter='${counter}'>
                  <div class='form-check'>
                    <input type='hidden' name='priviledges[${counter}][description]' value='${item}'/>
                    <label class='form-check-label'><input class='checkbox' name='priviledges[${counter}][enabled]' type='checkbox'/>${item}<i class='input-helper'></i></label>
                  </div>
                  <i class='remove mdi mdi-close-circle-outline'></i>
                </li>
                `);
                priviledgesListInput.val("");
            }

        });

        priviledgesListItem.on('change', '.checkbox', function() {
            if ($(this).attr('checked')) {
                $(this).removeAttr('checked');
            } else {
                $(this).attr('checked', 'checked');
            }

            $(this).closest("li").toggleClass('completed');

        });

        priviledgesListItem.on('click', '.remove', function() {
            $(this).parent().remove();
        });

    });
})(jQuery);