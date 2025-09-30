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

    $(".item-cell").on("click", function () {
        let item_id = $(this).closest('tr').data("item-id");
        console.log({item_id});

        let checked = $('input[type="checkbox"][name="item_checkbox"][value="'+item_id+'"]').prop("checked");
        console.log({checked});
        if(checked) {
            $('input[type="checkbox"][name="item_checkbox"]').prop("checked" ,false);
            $('input[type="checkbox"][name="item_checkbox"][value="'+item_id+'"]').prop("checked" ,false);
        }
        else {
            $('input[type="checkbox"][name="item_checkbox"]').prop("checked" ,false);
            $('input[type="checkbox"][name="item_checkbox"][value="'+item_id+'"]').prop("checked" ,true);
        }
    });

    $('#print_btn').click(function (e) { 
        e.preventDefault();
        $('#modal_table_tbody').html("");
        $('#err_list').html("");
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
            $('#item_dropdown_div').removeClass('d-none');
            $('#semi_inner_dropdown_div').addClass('d-none');
            $('#inner_dropdown_div').addClass('d-none');
            $('#outer_dropdown_div').addClass('d-none');
        }

        if(label_type == 'semi_inner') {
            $('#item_dropdown_div').addClass('d-none');
            $('#semi_inner_dropdown_div').removeClass('d-none');
            $('#inner_dropdown_div').addClass('d-none');
            $('#outer_dropdown_div').addClass('d-none');
        }

        if(label_type == 'inner') {
            $('#item_dropdown_div').addClass('d-none');
            $('#semi_inner_dropdown_div').addClass('d-none');
            $('#inner_dropdown_div').removeClass('d-none');
            $('#outer_dropdown_div').addClass('d-none');
        }

        if(label_type == 'outer') {
            $('#item_dropdown_div').addClass('d-none');
            $('#semi_inner_dropdown_div').addClass('d-none');
            $('#inner_dropdown_div').addClass('d-none');
            $('#outer_dropdown_div').removeClass('d-none');
        }
    });
    
    $('#modal_print_btn').on('click', function () {
        console.log('CLICKED');
        let error = 0;
        let message = [];
        let print_qty = $('#print_qty').val();
        let item_id = $('#modal_item_id').val();
        let label_type = $('input[name="label_type"]:checked').val();

        let label_profile = '';
        if(label_type == 'item') {
            label_profile = $('#item_dropdown').val();
        }

        if(label_type == 'semi_inner') {
            label_profile = $('#semi_inner_dropdown').val();
        }

        if(label_type == 'inner') {
            label_profile = $('#inner_dropdown').val();
        }

        if(label_type == 'outer') {
            label_profile = $('#outer_dropdown').val();
        }

        if(item_id == '' || item_id == undefined || item_id == null) {
            error = 1;
            message.push("Item Data Not Found");
        }

        if(label_type == '' || label_type == undefined || label_type == null) {
            error = 1;
            message.push("Please select Label Type");
        }

        if(label_profile == '') {
            error = 1;
            message.push("Please Select Label Profile for Print");
        }

        console.log({item_id,print_qty,label_type,label_profile,message});
        console.log('Message Length' , message.length);
        
        if(message.length > 0) {
            let err_msg_html = '';
            for(let i = 0 ; i < message.length ; i++) {
                err_msg_html += '<li class="list-group-item list-group-item-danger mt-2">'+ message[i] +'</li>';
            }

            let html = `<div class="alert alert-danger alert-dismissible" role="alert">
                <ol class="list-group list-group-numbered">
                    ${err_msg_html}
                </ol>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`;

            $('#modal_error_msg_div').html(html);
            $('#modal_error_msg_div').removeClass('d-none');
        }
        else {
            $('#modal_error_msg_div').addClass('d-none');
            $.ajax({
                type: "POST",
                url: create_pdf_url,
                data: {item_id : item_id , print_qty : print_qty , label_type : label_type , label_profile : label_profile},
                dataType: "json",
                headers:{
                    'X-CSRF-TOKEN' : csrfToken,
                },
                success: function (response) {
                    if(response.status) {
                        const base64Pdf = response.encoded_pdf_data;
                        const filename = response.pdf_file_name;
                        const binaryString = atob(base64Pdf);

                        const len = binaryString.length;
                        const bytes = new Uint8Array(len);
                        for (let i = 0; i < len; i++) {
                            bytes[i] = binaryString.charCodeAt(i);
                        }

                        const blob = new Blob([bytes], { type: 'application/pdf' });
                        const link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);

                        link.download = filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                    else {
                        
                    }
                }
            });
        }

    });
});