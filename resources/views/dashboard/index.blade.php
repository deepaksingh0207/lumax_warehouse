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
                    <input type="file" class="d-none" name="" id="import_file">
                    <a class="btn app-btn-primary" href="#">
                        <i class='fas fa-arrow-up'></i>
                        Import Users
                    </a>
                </div>
            </div><!--//row-->
        </div><!--//table-utilities-->
    </div><!--//col-auto-->
</div>
<div class="row">
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th>Group</th>
                            <th class="cell">SAP Code</th>
                            <th class="cell">Name</th>
                            <th class="cell">Email</th>
                            <th class="cell">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td class="cell">{{ $user->group->name }}</td>
                            <td class="cell">{{ $user->sap_code }}</td>
                            <td class="cell"><span class="truncate">{{ $user->name }}</span></td>
                            <td class="cell">{{ $user->email }}</td>
                            <td class="cell">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="switch_checkbox_{{ $user->id }}" checked>
                                    <label class="form-check-label" for="mySwitch" id="switch_label_{{ $user->id }}">Active</label>
                                </div>
                            </td>
                        </tr>
                         @empty
                        <tr>
                            <td colspan="4" class="text-center">No Data found</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
                <hr>
                <!-- Pagination Links -->
                <div>
                    {{ $users->withQueryString()->links() }}
                </div>
            </div><!--//table-responsive-->

        </div><!--//app-card-body-->
    </div>
</div>
@endsection