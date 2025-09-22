@extends('layouts.app')
@section('content')
<style>
    .item-checkbox {
        scale: 1.4;
        cursor: pointer;
    }
</style>
<div class="alert alert-danger d-none" role="alert" id = "alert_msg_div">
  
</div>
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Item Labels</h1>
    </div>
    <div class="col-auto">
        <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2">
                        <label for="vendor_code" style="min-width: 100px;">Vendor Code : </label>
                        <input type="text" name="" id="vendor_code" class="form-control" value="000122003" readonly>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2">
                        <div class="col-auto">
                            <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search Item Name, Item Code, Sap Code" style="min-width: 400px;">
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn app-btn-primary" id="search_btn">Search</button>
                        </div>
                    </div>

                </div><!--//col-->
            </div><!--//row-->
        </div><!--//table-utilities-->
    </div><!--//col-auto-->
    <div class="col-auto">
        <button type="button" class="btn app-btn-primary" id="print_btn">Print</button>
    </div>
</div>
<div class="row">
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body mt-2">
            <div class="table-responsive" id="items_table">
                @include('item_labels.table')
            </div><!--//table-responsive-->

        </div><!--//app-card-body-->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="printModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Print Settings</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table class="table table-bordered app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">SAP Code</th>
                                <th class="cell">ITEM CODE</th>
                                <th class="cell">STD QTY</th>
                                <th class="cell">PACKING</th>
                                <th class="cell">M.R.P</th>
                                <th class="cell">UOM</th>
                                <th class="cell">DESCRIPTION</th>
                            </tr>
                        </thead>
                        <tbody id="modal_table_tbody">

                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <label for="print_qty" class="form-control-label">PRINT QTY : </label>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="print_qty" id="print_qty" class="form-control" placeholder="Enter Qty">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="d-flex gap-5">
                        <div class="form-check">
                            <input class="form-check-input label-type-checkbox" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="item" checked>
                            <label class="form-check-label label-type-checkbox" for="flexRadioDefault1">
                                Item Label
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input label-type-checkbox" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="semi_inner">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Semi Inner
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input label-type-checkbox" type="radio" name="flexRadioDefault" id="flexRadioDefault3" value="inner">
                            <label class="form-check-label" for="flexRadioDefault3">
                                Inner Label
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input label-type-checkbox" type="radio" name="flexRadioDefault" id="flexRadioDefault3" value="outer">
                            <label class="form-check-label" for="flexRadioDefault3">
                                Outer Label
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <label for="">Label Print Profile : </label>
                    </div>
                    <div class="col-md-6" id = "item_dropdown">
                        <select class="form-select form-select mb-3" aria-label="Large select example">
                            <option selected disabled>Select Label Profile : </option>
                            <option value="1">ITEM 75MM X 50MM - 1UP</option>
                            <option value="1">ITEM 50MM X 38MM - 2UP</option>
                            <option value="1">ITEM 100MM X 75MM - 1UP</option>
                            <option value="1">ITEM 35MM X 20MM - 3UP</option>
                            <option value="1">ITEM 75MM X 50MM - 1UP - EXPORT</option>
                            <option value="1">ITEM 50MM X 38MM - 2UP - EXPORT</option>
                            <option value="1">ITEM VT 38MM X 50MM - 1UP</option>
                            <option value="1">ITEM 50MM X 50MM - 2UP</option>
                        </select>
                    </div>
                    <div class="col-md-6 d-none" id = "semi_inner_dropdown">
                        <select class="form-select form-select mb-3" aria-label="Large select example">
                            <option selected disabled>Select Label Profile : </option>
                            <option value="1">SEMI INNER 50MM X 38MM - 2UP</option>
                            <option value="1">SEMI INNER 75MM X 50MM - 1UP</option>
                            <option value="1">SEMI INNER 100MM X 75MM - 1UP</option>
                            <option value="1">SEMI INNER 75MM X 50MM - 1UP - EXPORT</option>
                            <option value="1">SEMI INNER 50MM X 38MM - 2UP - EXPORT</option>
                        </select>
                    </div>
                    <div class="col-md-6 d-none" id="inner_dropdown">
                        <select class="form-select form-select mb-3" aria-label="Large select example">
                            <option selected disabled>Select Label Profile : </option>
                            <option value="1">INNER 75MM X 50MM - 1UP</option>
                            <option value="1">INNER 50MM X 38MM - 2UP</option>
                            <option value="1">INNER 100MM X 75MM - 1UP</option>
                            <option value="1">INNER 75MM X 50MM - 1UP - EXPORT</option>
                            <option value="1">INNER 50MM X 38MM - 2UP - EXPORT</option>
                            <option value="1">INNER 83MM X 55MM - 1UP</option>
                        </select>
                    </div>
                    <div class="col-md-6 d-none" id="outer_dropdown">
                        <select class="form-select form-select mb-3" aria-label="Large select example">
                            <option selected disabled>Select Label Profile : </option>
                            <option value="1">OUTER 50MM X 38MM - 2UP</option>
                            <option value="1">OUTER 75MM X 50MM - 1UP</option>
                            <option value="1">OUTER 100MM X 75MM - 1UP</option>
                            <option value="1">OUTER 75MM X 50MM - 1UP - EXPORT</option>
                            <option value="1">OUTER 50MM X 38MM - 2UP - EXPORT</option>
                            <option value="1">OUTER 35MM X 20MM - 3UP</option>
                            <option value="1">INNER 83MM X 55MM - 1UP</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn app-btn-primary">Print Label</button>
            </div>
        </div>
    </div>
</div>

<script>
    let item_label_index_url = "{{ route('item-labels') }}";
</script>

<script src="{{ asset('assets/js/portal/item_labels_index.js') }}"></script>
@endsection