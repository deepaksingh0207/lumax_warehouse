$(document).ready(function () {
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let pageUrl = $(this).attr('href');
        let search_val = $('#search-orders').val();

        $.ajax({
            type:"POST",
            url: pageUrl,
            headers:{
                'X-CSRF-TOKEN' : csrfToken,
            },
            dat:{search_val : search_val},
            success: function(data) {
                $('#items_table').html(data);
            }
        });
    });

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

        $('#modal_item_id').val(record_id);

        $('#modal_table_tbody').html(tr_html);

        $('#printModal').modal('show');
    });

    $('#search_btn').on('click', function () {
        let search_val = $('#search-orders').val();

        $.ajax({
            type: "POST",
            url: item_label_index_url,
            data: {search_val : search_val},
            headers:{
                'X-CSRF-TOKEN' : csrfToken,
            },
            success: function (response) {
                $('#items_table').html(response);
            }
        });
    });

    $('.label-type-checkbox').on('change', function () {
        let label_type = $(this).val();
        
        if(label_type == 'item') {
            $('#item_dropdown').removeClass('d-none');
            $('#semi_inner_dropdown').addClass('d-none');
            $('#inner_dropdown').addClass('d-none');
            $('#outer_dropdown').addClass('d-none');
        }

        if(label_type == 'semi_inner') {
            $('#item_dropdown').addClass('d-none');
            $('#semi_inner_dropdown').removeClass('d-none');
            $('#inner_dropdown').addClass('d-none');
            $('#outer_dropdown').addClass('d-none');
        }

        if(label_type == 'inner') {
            $('#item_dropdown').addClass('d-none');
            $('#semi_inner_dropdown').addClass('d-none');
            $('#inner_dropdown').removeClass('d-none');
            $('#outer_dropdown').addClass('d-none');
        }

        if(label_type == 'outer') {
            $('#item_dropdown').addClass('d-none');
            $('#semi_inner_dropdown').addClass('d-none');
            $('#inner_dropdown').addClass('d-none');
            $('#outer_dropdown').removeClass('d-none');
        }
    });
    
    $('#modal_print_btn').on('click', function () {
        let item_id = $('#modal_item_id').val();
        let label_type = $('input[name="label_type"]:checked').val();

        let label_profile = '';
        if(label_type == 'item') {
            label_profile = $('#item_dropdown').val();
        }
    });
});