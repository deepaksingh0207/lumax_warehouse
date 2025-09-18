@extends('layouts.app')
@section('content')
<h1 class="app-page-title">Users</h1>
<div class="row">
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            <div class="table-responsive">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th class="cell">SAP Code</th>
                            <th class="cell">Name</th>
                            <th class="cell">Email</th>
                            <th class="cell">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="cell">000015346</td>
                            <td class="cell"><span class="truncate">John Sanders</span></td>
                            <td class="cell">john.sanders@lumaxworld.in</td>
                            <td class="cell">
                                <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="mySwitch">
                                <label class="form-check-label" for="mySwitch" id = "switch_label_">Example Switch</label>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div><!--//table-responsive-->

        </div><!--//app-card-body-->
    </div>
</div>
@endsection