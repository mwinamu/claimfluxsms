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
    /* team leader  */
    $('#datatableRow').hide();

    $(document).ready(function(){
      //  var data = JSON.parse(sms_names);
       // console.log(smsData);
        $.ajax({
            type: 'GET',
            url: '/sms/operationsHead/get/awaiting',
            dataType: "JSON", // data type expected from server
            success: function (data) {
                data.forEach( function(data) {
                    // console.log(data);
                    sms_names.push(data);
                });
                var table = $('#awaiting_Dispatch').DataTable({
                    data: data,

                    "ordering": false,
                    columns: [
                        {title:"SMS name" , data:"name"},
                        {title:"Network" , data:"network"},
                        {title:"User" , data:"user"},
                    ]
                });
                $('#awaiting_Dispatch tbody').on('click', 'tr', function () {
                    var data = table.row( this ).data();
                    var id = data.id;
                    $('#sms_namesID').val(id);
                    $.ajax({
                        url: '{!! route('teamLeader.GetSmsTemplate') !!}',
                        type: 'POST',
                        data: JSON.stringify(data),
                        contentType: 'json',
                        processData: false,
                        success: function( res ){
                            console.log(res);
                            var tableMessages = $('#awaiting_DispatchMessages').DataTable({
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