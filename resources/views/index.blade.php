<!DOCTYPE html>
<html>

<head>
    <title>Laravel Task</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- For Datatable --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    {{-- For Data-Feather --}}
    <script src="https://kit.fontawesome.com/8efe6f18fe.js" crossorigin="anonymous"></script>

    {{-- For Sweetalert --}}
    <link rel="stylesheet" href="{{ url('css/sweetalert.min.css') }}">
    <script src="{{ url('js/sweetalert.min.js') }}"></script>

</head>

<body>
    @include('errors')
    <div class="container">
        <h1>Laravel Practical Task</h1>
        <div style="text-align: right"><a href="{{ route('user.create') }}"
                class="btn btn-primary waves-effect waves-float waves-light">Add New User</a></div>
        <br>
        <table class="table table-bordered dt-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Role</th>
                    <th>Profile Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>

<script>
    var ajax_datatable = '{{ route('user.ajax') }}';
    var ajax_status_change = '{{ route('user.ajax_status_change') }}';
</script>
<script src="{{ asset('js/list.js') }}"></script>
</html>
