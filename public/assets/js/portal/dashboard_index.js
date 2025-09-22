$(document).ready(function () {
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let pageUrl = $(this).attr('href');

        $.ajax({
            url: pageUrl,
            success: function(data) {
                $('#users_table').html(data);
            }
        });
    });

    $('#download-template').on('click', function () {
        let data = [
            ['SAP CODE' , 'Name' , 'Email' , 'Mobile']
        ];

        let csvContent = '';

        csvContent += data[0].join(',') + '\n';

        for (let i = 1; i < data.length; i++) {
            csvContent += data[i].join(',') + '\n';
        }

        let csvData = encodeURIComponent(csvContent);

        let link = document.createElement('a');
        link.setAttribute('href',`data:text/csv;charset=utf-8,${csvData}`);
        link.setAttribute('download','import_user.csv');

        document.body.appendChild(link);

        link.click();

        document.body.removeChild(link);
    });

    $('#upload-template').on('click', function () {
        $('#import_file').trigger('click');
    });

    $('#import_file').on('change', function () {
        let formData = new FormData($('#user_import_form')[0]);

        $.ajax({
            type: "POST",
            url: import_user_url,
            data: formData,
            dataType: "dataType",
            processData:false,
            contentType:false,
            headers:{
                'X-CSRF-TOKEN' : csrfToken,
            },
            success: function (response) {
                
            },
            error:function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});