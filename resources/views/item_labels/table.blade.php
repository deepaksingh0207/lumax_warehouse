<table class="table table-bordered app-table-hover mb-0 text-left">
    <thead>
        <tr>
            <th></th>
            <th class="cell">SAP Code</th>
            <th class="cell">ITEM CODE</th>
            <th class="cell">STD QTY</th>
            <th class="cell">PACKING</th>
            <th class="cell">M.R.P</th>
            <th class="cell">UOM</th>
            <th class="cell">DESCRIPTION</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
        <tr class="row_{{ $item->id }}">
            <td>
                <div class="form-check">
                    <input class="form-check-input item-checkbox" name="item_checkbox" type="checkbox" value="{{ $item->id }}">
                </div>
            </td>
            <td class="cell">{{ $item->sap_code }}</td>
            <td class="cell"><span class="truncate">{{ $item->item_code }}</span></td>
            <td class="cell">{{ $item->std_qty }}</td>
            <td class="cell">{{ $item->packing }}</td>
            <td class="cell">{{ $item->mrp  }}</td>
            <td class="cell">{{ $item->uom }}</td>
            <td class="cell">{{ $item->description }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">No Data found</td>
        </tr>
        @endforelse
    </tbody>
</table>
<hr>
<!-- Pagination Links -->
<div>
    {{ $items->withQueryString()->links() }}
</div>