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

    $(document).ready(function(){
        $.ajax({
            type: 'GET',
            url: '/sms/get/getDispatched',
            dataType: "JSON", // data type expected from server
            success: function (data) {
                data.forEach( function(data) {
                    // console.log(data);
                    sms_names.push(data);
                });
                var table = $('#dispatched').DataTable({
                    data: data,

                    "ordering": false,
                    columns: [
                        {title:"SMS name" , data:"name"},
                        {title:"Network" , data:"network"},
                    ]
                });
                $('#dispatched tbody').on('click', 'tr', function () {
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
                            var tableMessages = $('#dispatchedMessages').DataTable({
                                data: JSON.parse(res),
                                destroy:true,
                                "ordering": false,
                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ],
                                columns: [
                                    {title:"CFID" , data:"cfid"},
                                    {title:"Debtor Number" , data:"debtor_number"},
                                    {title:"Cost" , data:"cost"},
                                    {title:"Sent" , data:"sent"},
                                    {title:"Error" , data:"error_message"},
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