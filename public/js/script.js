$(document).ready(function () {

    //Фильтр по наименованиям мероприятий
    $('.table-filters input').on('input', function () {
        filterTable($(this).parents('table'));
    });

    function filterTable($table) {
        let $filters = $table.find('.table-filters td');
        let $rows = $table.find('.table-data');
        $rows.each(function (rowIndex) {
            let valid = true;
            $(this).find('td').each(function (colIndex) {
                if ($filters.eq(colIndex).find('input').val()) {
                    if ($(this).html().toLowerCase().indexOf($filters.eq(colIndex).find('input').val().toLowerCase()) == -1) {
                        valid = valid && false;
                    }
                }
            });
            if (valid === true) {
                $(this).css('display', '');
            } else {
                $(this).css('display', 'none');
            }
        });
    }

    // при открытии модального окна (панель администратора)
    $('#modal_02').on('show.bs.modal', function (event) {
        // получить кнопку, которая его открыло
        let button = $(event.relatedTarget)
        // извлечь информацию из атрибута data-content
        let content = button.data('content')
        // вывести эту информацию в элемент, имеющий id="content"
        let id = content.id;
        let old_name = content.name;
        let old_date = content.date;
        let old_manager = content.manager;

        console.log(content);
        console.log(old_manager);

        $(this).find('#edit_form').attr('action', 'admin/events/' + id + '/update');
        $(this).find('#name').val(old_name);
        $(this).find('#date').val(old_date);
    })

    ///не используется
    function get_event(id) {
        // $('#modal_02').empty();
        $.get('admin/events/show/' + id, function (data) {
            console.log(data);
            //    $('#modal_02').modal('show');
        });
    }

//////////////////
});





