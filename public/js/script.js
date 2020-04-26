function get_update_event(id) {
    $('#modal_02').empty();
     $.get( 'admin/events/show/'+id, function( data ) {
         $('#modal_02').show();
        // $('#modal_02').append(data);
     });
}
