$(document).ready(function () {
    $('.item-checkbox').on('click', function () {
       $('.item-checkbox').not(this).prop('checked', false);  
    });

    $('#print_btn').click(function (e) { 
        e.preventDefault();
        $("#alert_msg_div").addClass("d-none");
        $('#alert_msg_div').html("");
        
        let record_id;

        $('.item-checkbox:checked').each(function() {
            record_id = $(this).val();
        });

        if(!record_id) {
            $('#alert_msg_div').html("Please click on checkbox to select item for printing");
            $("#alert_msg_div").removeClass("d-none");
            return;
        }

        console.log({record_id});
        
        let tr_html = $(".row_"+record_id).clone();
        tr_html.find('td').eq(0).remove();

        $('#modal_table_tbody').html(tr_html);

        $('#printModal').modal('show');
    });
});