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