@extends('layouts.app')
@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Users</h1>
    </div>
    <div class="col-auto">
        <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <form action="" method="post" id="user_import_form">
                        <input type="file" class="d-none" name="" id="import_file" accept=".csv">
                    </form>
                    <a class="btn app-btn-primary" id="upload-template">
                        <i class='fas fa-arrow-up'></i>
                        Import Users
                    </a>
                </div>
                <div class="col-auto">
                    
                    <a class="btn btn-warning" id="download-template">
                        <i class='fas fa-arrow-down' data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download Template"></i>
                    </a>
                </div>
            </div><!--//row-->
        </div><!--//table-utilities-->
    </div><!--//col-auto-->
</div>
<div class="row">
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive" id="users_table">
                @include('dashboard.table')
            </div><!--//table-responsive-->

        </div><!--//app-card-body-->
    </div>
</div>
<script>
    let import_user_url = "{{ route('dashboard.import_user') }}";
</script>
<script src="{{ asset('assets/js/portal/dashboard_index.js') }}"></script>
@endsection