{{--
<script>
$(document).ready(function() {

	var path_question_table;
	/* hide tables to be displayed only when nessesary */
	$('#questions_table').hide();
	$('#options_table').hide();
	$('#paths_table').hide();
	/* from question controller to display question edit form */
	@if(!empty(Session::has('questionEdit_code')) && Session::has('questionEdit_code') == 5)

		$(function() {

			$('#questionEditModal').modal('show');

		});

	@endif
	/* from question controller to display question destroy alert form */
	@if(!empty(Session::has('questionDelete_code')) && Session::has('questionDelete_code') == 5)

		$(function() {

			$('#questiondestroyModal').modal('show');

		});

	@endif
	/* from pathcontroller edit returns error that helps diplay modal for updating */
	@if(!empty(Session::has('error_code')) && Session::has('error_code') == 5)

		$(function() {

		    $('#pathEditModal').modal('show');

		});

	@endif
	/* path delete confirmation modal initiated in path controller */
	@if(!empty(Session::has('delete_code')) && Session::has('delete_code') == 7)

		$(function() {

		    $('#pathDeleteModal').modal('show');

		});

	@endif

	/* user edit modal initiaited in modal  */
	@if(!empty(Session::has('useredit_code')) && Session::has('useredit_code') == 3)

		$(function() {

		    $('#userEditModal').modal('show');

		});

	@endif
	/* user delete modal from usercontroller initiation */
	@if(!empty(Session::has('user_delete_code')) && Session::has('user_delete_code') == 99)

		$(function() {

		    $('#userDeleteModal').modal('show');

		});

	@endif
	--}}
{{--show add path modal --}}{{--

    @if(!empty(Session::has('addPath_code')) && Session::has('addPath_code') == 8600)

		$(function() {


        $('#addPathModal').modal('show');

        });

    @endif
    --}}
{{-- show add question modal --}}{{--

     @if(!empty(Session::has('addQuestion_code')) && Session::has('addQuestion_code') == 8601)

		$(function() {


        $('#addQuestionModal').modal('show');

    });

    @endif

    --}}
{{-- add options modal--}}{{--


    @if(!empty(Session::has('addOption_code')) && Session::has('addOption_code') == 8605)

		$(function() {


        $('#addOptionModal').modal('show');

    });

    @endif

	/* datatables for users */
	$(function() {
		var user_table = $('#users-table').DataTable({

	        processing: true,
	        serverSide: true,
	        retrieve: true,
	        ajax: '{!! route('users.index') !!}',

	        columns: [
	            {data: 'id', name: 'id'},
	            {data: 'name', name: 'name'},
	            {data: 'email', name: 'email'},
	            {data: 'created_at', name: 'created_at'},
	            {data: 'updated_at', name: 'updated_at'},
	           	{data: 'action', name: 'action', orderable: false, searchable: false}
	    	]

	    });


	});


	/* all questions lists datatables */

		 $(function() {
			 $('#questionsTable').show();

		 $('#questions_Table').DataTable({
			        processing: true,
			        serverSide: true,
			        retrieve: true,
			        ajax: '{!! route('questions.index') !!}',

			        columns: [

			            {data: 'string', name: 'string'},
			            {data: 'is_optional', name: 'is_optional'},
			            {data: 'is_dichotomous', name: 'is_dichotomous'},
			            {data: 'sequence', name: 'sequence'},
			            {data: 'has_options', name: 'has_options'},
			            {data: 'has_options', name: 'has_options'},
			            {data: 'path_id', name: 'path_id'},
			            {data: 'action', name: 'action', orderable: false, searchable: false}
			    	]

	       		});

	 });
	 /* all options lists datatables*/
	 $(function () {
		 $('#paths_table').hide();
		 $('#questions_table').hide();
		  $('#options-table').show();
	       	$('#options-table').DataTable({
		        processing: true,
		        serverSide: true,
		        retrieve: true,
		        ajax: '{!! route('options.index') !!}',

		        columns: [

		            {data: 'options_string', name: 'options_string'}

		    	]
		    });
	 });
	/* datatables for paths  */
	$(function() {
		$('#paths_table').show();
		$('#questions_table').hide();
        $('#options_table').hide();
		var table = $('#paths-table').DataTable({
		        processing: true,
		        serverSide: true,
		        retrieve: true,
		        ajax: '{!! route('paths.index') !!}',

		        columns: [

		             {data: 'name', name: 'name'},
		             {data: 'sequence', name: 'sequence'},
		             {data: 'action', name: 'action', orderable: false, searchable: false}
		         ]

		    });

	    /* datatables for questions related to a path , displays when path is clicked on */
        	 $('#paths-table tbody').on('click', 'tr', function () {

    		        var data = table.row( this ).data();
    		        var id = data.id;
    		        $('#questions_table').show();
    		        path_question_table =  $('#questions-table').DataTable({
    				        processing: true,
    				        serverSide: true,
    				        retrieve: true,
    				        ajax: "/paths/"+ id,

    				        columns: [
    				        	  	{data: 'string', name: 'string'},
    					            {data: 'is_optional', name: 'is_optional'},
    					            {data: 'is_dichotomous', name: 'is_dichotomous'},
    					            {data: 'sequence', name: 'sequence'},
    					            {data: 'has_options', name: 'has_options'},
    					            {data: 'progress', name: 'progress'},
    					            {data: 'path_id', name: 'path_id'},
    					            {data: 'action', name: 'action', orderable: false, searchable: false}

    				    	]
    				    });

                    /* datatables for options displayed upon click of question, displays options relating
                    to a single question*/
                	 $('#questions-table tbody').on('click', 'tr', function () {

                	        var question_data = path_question_table.row( this ).data();
                	        var id = question_data.id;
                	        $('#options_table').show();
                	       	$('#questionsOptions-table').DataTable({
                		        processing: true,
                		        serverSide: true,
                		        retrieve: true,
                		        ajax: "/questions/"+ id,

                		        columns: [

                		            {data: 'options_string', name: 'options_string'}

                		    	]
                		    });
                    });

        	   });
	});


});

</script>
--}}
