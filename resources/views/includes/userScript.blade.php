<script>

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
    /* user delete modal from usercontroller initiation */
    @if(!empty(Session::has('user_delete_code')) && Session::has('user_delete_code') == 99)

		$(function() {

        $('#userDeleteModal').modal('show');

    });

    @endif
    /* user edit modal initiaited in modal  */
    @if(!empty(Session::has('useredit_code')) && Session::has('useredit_code') == 3)

        $(function() {

        $('#userEditModal').modal('show');

    });

    @endif
</script>