<script>
    function uploadTabs(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        var view = document.getElementById(cityName).style.display = "block";
        console.log( evt);
        evt.currentTarget.className += " active";
    }

    $(document).ready( function () {
        //retrieving  the just uploaded sms template data
        var smsTemplateData =  $('#smsTemp').text();
        var smsTemplateName = $('#smsTemp2').text();
        var tabListener = $('#tabListener').val();
        smsTemplateName = JSON.parse(smsTemplateName);
       // console.log(smsTemplateName.id);
        $('#sms_names_id').val(smsTemplateName.id);
        //console.log(tabListener);
        if( tabListener == "handle" ){

            var tab = document.getElementById("#upload").style.display = "block";
            tab.className += " active";
        }
      //  var DataSet = JSON.parse(smsTemplateData);
        $('#datatableRow').show()
        console.log(JSON.parse(smsTemplateData));
        var Table = $('#uploaded-template').DataTable({
            data: JSON.parse(smsTemplateData) ,
            scrollX:50,
            scrollCollapse: true,
            "ordering": false,
            hideEmptyCols: true,
            columns: [
                { title: "Cfid"+'<p type="hidden" id='+'{$cfid"}'+'  draggable="true" ondragstart="drag(event)" >{$cfid"}</p>'
                   , data: "cfid" },
                { title: "Debtor Name"+'<p type="hidden" id="{$debtor_name}"  draggable="true" ondragstart="drag(event)" >{$debtor_name}</p>'
                    , data: "debtor_name" },
                { title: "Debtor Number"+'<p type="hidden" id='+'{$debtor_number}'+'  draggable="true" ondragstart="drag(event)" >{$debtor_number}</p>'
                    ,data: "debtor_number" },
                { title: "PTP Amount"+'<p type="hidden" id='+'{$ptp_amount}'+'  draggable="true" ondragstart="drag(event)" >{$ptp_amount}</p>'
                    , data: "ptp_amount" },
                { title: "PTP Date"+'<p type="hidden" id='+'{$ptp_date}'+'  draggable="true" ondragstart="drag(event)" >{$ptp_date}</p>'
                    , data: "ptp_date" },
                { title: "Client"+'<p type="hidden" id='+'{$client}'+'  draggable="true" ondragstart="drag(event)" >{$client}</p>'
                    , data: "client" },
                { title: "Account Number"+'<p type="hidden" id='+'{$account_number}'+'  draggable="true" ondragstart="drag(event)" >{$account_number}</p>'
                    , data: "account_number" },
                { title: "Paybill Number"+'<p type="hidden" id='+'{$paybill_number}'+'  draggable="true" ondragstart="drag(event)" >{$paybill_number}</p>'
                    , data: "paybill_number" },
                { title: "Acm Name"+'<p type="hidden" id='+'{$acm_name}'+'  draggable="true" ondragstart="drag(event)" >{$acm_name}</p>'
                    , data: "acm_name" },
                { title: "Acm Number"+'<p type="hidden" id='+'{$acm_number}'+'  draggable="true" ondragstart="drag(event)" >{$acm_number}</p>'
                    , data: "acm_number" },
                { title: "Acm Email"+'<p type="hidden" id='+'{$acm_email}'+'  draggable="true" ondragstart="drag(event)" >{$acm_email}</p>'
                    , data: "acm_email" },
                { title: "Balance"+'<p type="hidden" id='+'{$balance}'+'  draggable="true" ondragstart="drag(event)" >{$balance}</p>'
                    , data: "balance" },
                { title: "Waiver Amount"+'<p type="hidden" id='+'{$waiver_amount}'+'  draggable="true" ondragstart="drag(event)" >{$waiver_amount}</p>'
                    , data: "waiver_amount" },
                { title: "Waived Amount"+'<p type="hidden" id='+'{$waived_amount}'+'  draggable="true" ondragstart="drag(event)" >{$waived_amount}</p>'
                    , data: "waived_amount" },
                /*{ title: "Uploaded At", data: "created_at" },*/

            ]
        });
       //work on displaying view with datatables
        $('#Table tbody').on( 'click', 'td', function () {
            alert( table.cell( this ).data() );
        } );
        //after data
    });

        function allowDrop(ev) {
        ev.preventDefault();
        }

        function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
        }


</script>