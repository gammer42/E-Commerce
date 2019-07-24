@extends('layouts.master')

@section('pageTitle', __('role Roles'))

@section('head')

@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="disabled">Account Management</li>
        <li>
            <a href="{{ route('account_management.transactions') }}">Transactions</a>
        </li>
        <li class="active">Add Customer Transaction</li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Add Customer Transaction</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="" class="horizontal-form" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row" id="add_transaction">
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="trans_id">Transaction No.</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="trans_id" id="trans_id" class="form-control" value="{{ $string }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="store_id">Store<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control select2 stores" id="store_id" name="store_id" required>
                                                    <option selected disabled>Select One</option>
                                                    @foreach ($stores as $store)
                                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="customer_id">Customer <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control select2 customers" id="customer_id" name="customer_id" required>
                                                    <option selected disabled>Select One</option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="paid_amount">Amount Paid <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="paid_amount" id="paid_amount" class="form-control" placeholder="Paid Amount" required>
                                            </div>
                                        </div>
                                    </div>

                                    <span id="unpaidTable" class="unpaid"></span>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="payment_date">Payment Date <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="input-group input-large date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years" id="full_width_input">
                                                    <input type="text" id="payment_date" name="payment_date" class="form-control" readonly="">
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fas fa-calendar-alt font-red"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="des">Description</label>
                                            </div>
                                            <div class="col-md-8">
                                                <textarea name="des" id="des" rows="3" class="form-control" placeholder="Description Here....."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="account_type">Account<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="account_type" name="account_type" required>
                                                    <option selected disabled>Select One</option>
                                                    @foreach ($accounts as $account)
                                                    <option value="{{ $account->bank_id }}">{{ $account->banks->name }}--{{ $account->number }}</option>
                                                    @endforeach
                                                </select>
                                                <div id="balance" class="font-red"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row payment_row" style="display:none">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="payment_method">Payment Method</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="payment_method" name="payment_method">
                                                    <option value="" selected>Select One</option>
                                                    <option value="card">Card</option>
                                                    <option value="cheque">Cheque</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row cheque" style="display:none">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="bank">Bank Name</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="bank" class="form-control inputMethodCheque" id="bank">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row cheque" style="display:none">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="acc_no">Account/Card No.</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="acc_no" class="form-control inputMethodCheque" id="acc_no">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row card" id="card" style="display:none">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="card">Card</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control inputMethodCard" id="card" name="card">
                                                    <option selected disabled>Select One</option>
                                                    <option value="1">VISA</option>
                                                    <option value="2">Masterd</option>
                                                    <option value="3">Ammex</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row card" id="card" style="display:none">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="acc_no">Account/Card No.</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="acc_no" class="form-control inputCard2" id="acc_no">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row card" id="card" style="display:none">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="ref_no">Reff Transaction No</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="ref_no" class="form-control inputCard3" id="ref_no">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ./card --}}

                                    {{-- mobile --}}
                                    <div class="row mobile" id="mobile" style="display:none">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="acc_no">Account/Card No.</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="acc_no" class="form-control inputMobile1" id="acc_no">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mobile" id="mobile" style="display:none">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="ref_no">Reff Transaction No</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="ref_no" class="form-control inputMobile2" id="ref_no">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row pull-right">
                                        <button type="reset" id="reset" class="btn red btn-outline">Reset</button>
                                        <button type="submit" class="btn blue btn-outline">Submit</button>
                                    </div>
                                </div>
                                {{-- col-md-7 --}}
                                <div class="col-md-5 documents">
                                    <div class="row">
                                        <h5 id="docs_title">Document</h5>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="docs_name">Name</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="docs_name" id="docs_name inputNumber" class="form-control" placeholder="Document Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="docs_des">Description</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea name="docs_des" id="docs_des" rows="6" class="form-control" placeholder="Document Description Here.."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label class="control-label" for="docs_file">Select File</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput" id="file">
                                                        <span class="btn green btn-file">
                                                            <span class="fileinput-new"> Browse </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" name="docs_file" accept="docs,pdf,image/*"> </span>
                                                        <span class="fileinput-filename"> </span>
                                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- col-md-5 --}}
                            </div>
                            {{-- /row --}}
                        </div>
                        {{-- form-body --}}
                    </form>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

@endsection

@section('script')

    <script>
        $("#customer_id, #store_id").change(function () {
            $("select option:selected").each(function () {
                if($(this).val() == "customer_id") {

                    var unpaidTable =   '<div class="row">'+
                                            '<div class="form-group">'+
                                                '<div class="col-md-4">'+
                                                    '<label class="control-label" for="unpaid_orders">Unpaid Orders <span class="text-danger">*</span></label>'+
                                                '</div>'+
                                                '<div class="col-md-8">'+
                                                    '<table class="table table-striped table-bordered">'+
                                                        '<thead>'+
                                                            '<tr>'+
                                                                '<th style="width:30%">Invoice</th>'+
                                                                '<th style="width:20%">Total</th>'+
                                                                '<th style="width:20%">Due</th>'+
                                                                '<th style="width:30%">Pay</th>'+
                                                            '</tr>'+
                                                        '</thead>'+
                                                        '<tbody>'+
                                                            '<tr>'+
                                                                '<td>A1313</td>'+
                                                                '<td>100000</td>'+
                                                                '<td>10</td>'+
                                                                '<td>'+
                                                                    '<input type="text" class="form-control" name="" value="" step="0.01">'+
                                                                '</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                                '<td>A1313</td>'+
                                                                '<td>100000</td>'+
                                                                '<td>10</td>'+
                                                                '<td>'+
                                                                    '<input type="text" class="form-control" name="">'+
                                                                '</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                                '<td class="borderless"></td>'+
                                                                '<td class="borderless" style="padding-top:15px;">Total&nbsp;Due:</td>'+
                                                                '<td class="borderless" style="padding-top:15px;">1000</td>'+
                                                                '<td class="borderless"><input type="text" class="form-control" name="" value="213124" readonly></td>'+
                                                            '</tr>'+
                                                        '</tbody>'+
                                                    '</table>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>';
                    $('#unpaidTable').empty().html(unpaidTable);

                }
                if($(this).val() == "0") {
                    $('#unpaidTable').empty();
                }
            });
        });
    </script>

    <script>
        $("#account_type").change(function () {
            $('.payment_row, .mobile').css('display','none');
            $('.inputMethodMobile').prop( "disabled", true );
            $("select option:selected").each(function () {
                $('#balance').html('13131231.12');
                if($(this).val() == "Bank") {
                    $('.payment_row').toggle(700);
                    $('.mobile, .card, .cheque').css('display','none');
                }else if($(this).val() == "Mobile") {
                    $('.mobile').toggle(700);
                    $('.inputMobile').prop( "disabled", false);
                    $('.payment_row, .card, .cheque').css('display','none');
                }else if($(this).val() == "Others") {
                    $('.payment_row, .card, .cheque').css('display','none');
                }
            });
        });
    </script>

    <script>
        $("#payment_method").change(function () {
            $('.cheque, .card, .mobile').css('display','none');
            $('.inputMethodCard, .inputMethodCheque, .inputMethodMobile').prop( "disabled", true );
            $("select option:selected").each(function () {
                if($(this).val() == "cheque") {
                    $('.cheque').toggle(700);
                    $('.inputMethodCheque').prop( "disabled", false );
                    $('.card, .mobile').css('display','none');
                } else if($(this).val() == "card") {
                    $('.card').toggle(700);
                    $('.inputMethodCard').prop( "disabled", false);
                    $('.cheque, .mobile').css('display','none');
                }
            });
        });
    </script>
    <script>
        $("#reset").click(function () {
            $('.unpaidTable, .payment_row, .cheque, .card, .mobile').css('display','none');
            $('.unpaidTable, .payment_row, .cheque, .card, .mobile').val();
            $('#balance, #unpaidTable').empty();
        });
    </script>
    <script>
        $(".stores").change(function () {
            $(".stores option:selected").each(function () {
                let unpaidtable = '<div class="row">'+
                                        '<div class="form-group">'+
                                            '<div class="col-md-4">'+
                                                '<label class="control-label" for="unpaid_orders">Unpaid Orders <span class="text-danger">*</span></label>'+
                                            '</div>'+
                                            '<div class="col-md-8">'+
                                                '<table class="table table-striped table-bordered">'+
                                                    '<thead>'+
                                                        '<tr>'+
                                                            '<th style="width:30%">Invoice</th>'+
                                                            '<th style="width:20%">Total</th>'+
                                                            '<th style="width:20%">Due</th>'+
                                                            '<th style="width:30%">Pay</th>'+
                                                        '</tr>'+
                                                    '</thead>'+
                                                '</table>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                $('.unpaid').empty().html(unpaidtable);
            });
        });
    </script>
    <script>
        $(".customers").change(function () {
            $(".customers option:selected").each(function () {
                var unpaidTable =   '<div class="row">'+
                    '<div class="form-group">'+
                        '<div class="col-md-4">'+
                            '<label class="control-label" for="unpaid_orders">Unpaid Orders <span class="text-danger">*</span></label>'+
                        '</div>'+
                        '<div class="col-md-8">'+
                            '<table class="table table-striped table-bordered">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th style="width:30%">Invoice</th>'+
                                        '<th style="width:20%">Total</th>'+
                                        '<th style="width:20%">Due</th>'+
                                        '<th style="width:30%">Pay</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                    '<tr>'+
                                        '<td>A1313</td>'+
                                        '<td>100000</td>'+
                                        '<td>10</td>'+
                                        '<td>'+
                                            '<input type="text" class="form-control" name="" value="" step="0.01">'+
                                        '</td>'+
                                    '</tr>'+

                                    '<tr>'+
                                        '<td>A1313</td>'+
                                        '<td>100000</td>'+
                                        '<td>10</td>'+
                                        '<td>'+
                                            '<input type="text" class="form-control" name="">'+
                                        '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td class="borderless"></td>'+
                                        '<td class="borderless" style="padding-top:15px;">Total&nbsp;Due:</td>'+
                                        '<td class="borderless" style="padding-top:15px;">1000</td>'+
                                        '<td class="borderless"><input type="text" class="form-control" name="" value="213124" readonly></td>'+
                                    '</tr>'+
                                '</tbody>'+
                            '</table>'+
                        '</div>'+
                    '</div>'+
                '</div>';
        $('#unpaidTable').empty().html(unpaidTable);
            });
        });
    </script>
@endsection
