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
        <li>
            <a href="{{ route('sales.index') }}">Sales</a>
        </li>
        <li>
            <a href="{{ route('sales.sales_commission') }}">Sales Commission</a>
        </li>
        <li class="active">Add Sales Transaction</li>
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
                        <span class="caption-subject bold uppercase">Add Sales Transaction</span>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('sales.edit_sales_transaction') }}" class="btn sbold red">Edit Sale Transaction</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="" class="horizontal-form" method="get">
                        @csrf
                        <div class="form-body">
                            <div class="row" id="add_transaction">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="store_id">Stores <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="store_id" name="category_id" required>
                                                    <option value="" selected >Select One</option>
                                                    <option value="1">xxxxxxxx</option>
                                                    <option value="2">aaaaa</option>
                                                    <option value="3">bbbb</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label">Sales Commission Type<span class="font-red">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="radio-group">
                                                    <label class="radio-inline"><input type="radio" name="com_radio" value="1" checked="checked">New Sales Commission</label>
                                                    <label class="radio-inline"><input type="radio" name="com_radio" value="0">Due Sales Commission</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="person_id">Sales Person <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="person_id" name="person_id" required>
                                                    <option value="" selected>Select One</option>
                                                    <option value="show">Person One</option>
                                                    <option value="show">Person Two</option>
                                                    <option value="show">Person Three</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <br><br>
                                            <div class="salesPersonTable" id="salesPersonTable" style="display:none;">
                                                <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                                    <thead>
                                                        <tr role="row" class="heading">
                                                            <th>
                                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                    <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                                    <span></span>
                                                                </label>
                                                            </th>
                                                            <th> Invoice </th>
                                                            <th> Date </th>
                                                            <th> Invoice&nbsp;Total </th>
                                                            <th> Com. </th>
                                                            <th> Pay </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr role="row" class="filter">
                                                            <td>
                                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                    <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>A1313</td>
                                                            <td>12/12/2018</td>
                                                            <td>100000</td>
                                                            <td>10</td>
                                                            <td>
                                                                <input type="text" class="form-control" name="" value="" disabled>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="filter">
                                                            <td>
                                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                    <input type="checkbox" class="single-checkable" data-set="#sample_2 .checkboxes" />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>A1313</td>
                                                            <td>12/12/2018</td>
                                                            <td>100000</td>
                                                            <td>10</td>
                                                            <td>
                                                                <input type="text" class="form-control" name="" value="" disabled>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="filter">
                                                            <td>
                                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                    <input type="checkbox" class="single-checkable" data-set="#sample_2 .checkboxes" />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>A1313</td>
                                                            <td>12/12/2018</td>
                                                            <td>100000</td>
                                                            <td>10</td>
                                                            <td>
                                                                <input type="text" class="form-control" name="" value="" disabled>
                                                            </td>
                                                        </tr>
                                                        <tr role="row" class="filter">
                                                            <td>
                                                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                                    <input type="checkbox" class="single-checkable" data-set="#sample_2 .checkboxes" />
                                                                    <span></span>
                                                                </label>
                                                            </td>
                                                            <td>A1313</td>
                                                            <td>12/12/2018</td>
                                                            <td>100000</td>
                                                            <td>10</td>
                                                            <td>
                                                                <input type="text" class="form-control" name="" value="" disabled>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- .row --}}

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="total">Total<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="total" value="1000" disabled>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="amount">Paid Amount<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="checkbox-inline text-muted control-label" style="font-size:16px; font-weight:400; margin-top:5px">
                                                    <input type="checkbox" value=""> Sataled
                                                </label>
                                            </div>

                                            <div class="col-md-4">
                                                <input type="text" name="amount" class="form-control" id="amount" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- /.row --}}

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="payment_type">Payment Type<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="payment_type" name="payment_type" required>
                                                    <option selected disabled>Select One</option>
                                                    <option value="bank">DBBL</option>
                                                    <option value="bank">Brac</option>
                                                    <option value="bank">EBL</option>
                                                    <option value="mobile">UCash</option>
                                                    <option value="others">Primary Station</option>
                                                    <option value="others">SA Paribahan</option>
                                                    <option value="others">Cash Account</option>
                                                    <option value="others">Manager</option>
                                                    <option value="others">Due Account</option>
                                                </select>
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
                                                <input type="text" name="acc_no" class="form-control inputMethodCard" id="acc_no">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row card" id="card" style="display:none">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="ref_no">Reff Transaction No</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="ref_no" class="form-control inputMethodCard" id="ref_no">
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
                                                <input type="text" name="acc_no" class="form-control inputMethodCard" id="acc_no">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mobile" id="mobile" style="display:none">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="ref_no">Reff Transaction No</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="ref_no" class="form-control inputMethodCard" id="ref_no">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="note">Note</label>
                                            </div>
                                            <div class="col-md-8">
                                                <textarea name="note" id="note" rows="3" class="form-control" placeholder="Note Here....."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row pull-right">
                                        <button type="reset" id="reset" class="btn red btn-outline">Reset</button>
                                        <button type="submit" class="btn blue btn-outline">Submit</button>
                                    </div>
                                </div>
                                {{-- col-md-10 --}}
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
        $("#person_id").change(function () {
            $('.salesPersonTable').css('display','none');
            $("select option:selected").each(function () {
                if($(this).val() == "show") {
                    $('.salesPersonTable').toggle(1000);
                }
            });
        });
    </script>

    <script>
        $("#payment_type").change(function () {
            $('.payment_row, .mobile').css('display','none');
            $('.inputMethodMobile').prop( "disabled", true );
            $("select option:selected").each(function () {
                if($(this).val() == "bank") {
                    $('.payment_row').toggle(700);
                    $('.mobile, .card, .cheque').css('display','none');
                }else if($(this).val() == "mobile") {
                    $('.mobile').toggle(700);
                    $('.inputMobile').prop( "disabled", false);
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
            $('.salesPersonTable, .payment_row, .cheque, .card, .mobile').css('display','none');
            $('.salesPersonTable, .payment_row, .cheque, .card, .mobile').val();
        });
    </script>

@endsection
