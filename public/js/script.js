$(document).ready(function () {

    //Фильтр по наименованиям мероприятий
    $('.table-filters input').on('input', function () {
        filterTable($(this).parents('table'));
    });

    //Функия фильтра
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

    // при открытии модального окна редактирования event (панель администратора)
    $('#modal_02').on('show.bs.modal', function (event) {
        // получить кнопку, которая его открыло
        let button = $(event.relatedTarget);
        // извлечь информацию из атрибута data-content
        let content = button.data('content');
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

    //////////// Устанавить / удалить чекбоксы в таблице Access
    $('#access_table').hide(500); //при открытии окна access_table скрываем
    $("#status").change(function () { //при изменении select
        if ($(this).val() == 3) { //если статус темы "закрытая" ( id==3 )
            $('#access_table').show(500); // открываем access_table
            $('input[type=checkbox]').each(function () { //начинаем перебирать все чекбокмы
                if ($(this).prop("disabled") == false) //если элемент цикла (чекбокс) не закрыт disabled
                {
                    $(this).removeAttr('checked'); // то снимаем чекбокс
                }
            })
        } else {
            $('.access').attr('checked', true); //иначе ставим для всех чекбоксы
            $('#access_table').hide(500); //скрываем access_table

        }
    });

    // при открытии модального окна добавления темы
    $('#modal_03').on('show.bs.modal', function (event) {
        // получить кнопку, которая его открыло
        let button = $(event.relatedTarget);
        // извлечь информацию из атрибута data-content
        let id = button.data('content');
        console.log(id);
        $(this).find('#add_theme_form').attr('action', 'events/' + id + '/themes'); //устанавливаем лоя аттрибута action новое значение
    })
///Добавление нового message
    $('#btnAddMessage').click(function() {
        $.ajax({
            method: 'POST',
            url: `/messages`,
            data: $('#addMessage').serialize(),
            success: function(data) {
                $('#messagesBlock').append('                            <div class="row justify-content-center" id="block_add_message" >\n' +
                    '                                    <div class="col-md-12">\n' +
                    '                                        <div class="form-group">\n' +
                    '                                            <ul class="list-group">\n' +
                    '                                                <li class="list-group-item list-group-item-secondary">\n' +
                    data.message +
                    '                                                </li>\n' +
                    '                                            </ul>\n' +
                    '                                        </div>\n' +
                    '\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' ).show(700);
                $('#message').val('');
            }
        });
        return false;
    });


//////////////////
});





