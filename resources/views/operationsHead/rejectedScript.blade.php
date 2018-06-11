<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // alert("await dispatch script");
    var sms_names = [];
    var smsData;
    //get sms names
    $('#datatableRow').hide();

    $(document).ready(function(){
        $.ajax({
            type: 'GET',
            url: '/sms/operationsHead/get/getRejected',
            dataType: "JSON", // data type expected from server
            success: function (data) {
                console.log(data);
                data.forEach( function(data) {
                    // console.log(data);
                    sms_names.push(data);
                });
                var table = $('#rejectedAll').DataTable({
                    data: data,

                    "ordering": false,
                    columns: [
                        {title:"SMS name" , data:"name"},
                        {title:"Network" , data:"network"},
                        {title:"User" , data:"user"},
                    ]
                });
                $('#rejectedAll tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    var id = data.id;
                    //data = JSON.stringify(data);
                    // console.log(data);
                    //alert(data);
                    $.ajax({
                        url: '{!! route('teamLeader.GetSmsTemplate') !!}',
                        type: 'POST',
                        data: JSON.stringify(data),
                        contentType: 'json',
                        processData: false,
                        success: function( res ){
                            console.log(res);
                            var tableMessages = $('#rejectedMessagesAll').DataTable({
                                data: JSON.parse(res),
                                destroy:true,
                                "ordering": false,
                                columns: [
                                    {title:"CFID" , data:"cfid"},
                                    {title:"Debtor Number" , data:"debtor_number"},
                                    {title:"Messages" , data:"message_string"},
                                ]
                            });
                        },
                        error: function(err){
                            alert(JSON.stringify(err));
                        }
                    });
                    $('#datatableRow').show();
                } );

            },
            error: function() {
                console.log('Error: ' + data);
            }
        });

    });
</script>