@extends('layouts.master')

@section('pageTitle', __('role Roles'))

@section('head')
<link href="{{ asset('assets/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="disabled">Account Settings</li>
        <li>
            <a href="{{ route('account_settings.account') }}">Accounts</a>
        </li>
        <li class="active">Edit Account</li>
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
                        <span class="caption-subject bold uppercase">Edit Account</span>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('account.create') }}" class="btn sbold red">Add Account</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="{{ route('account.update', $accounts->id) }}" class="horizontal-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="acc_type">Account Type <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="acc_type" name="acc_type" required>
                                                    <option value="Bank"{{ $accounts->type == "Bank" ?"selected":"" }}>Bank</option>
                                                    <option value="Cash"{{ $accounts->type == "Cash" ?"selected":"" }}>Cash</option>
                                                    <option value="Mobile"{{ $accounts->type == "Mobile" ?"selected":"" }}>Mobile</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="acc_uses">Account Uses <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="acc_uses" name="acc_uses" required>
                                                    <option value="1"{{ $accounts->uses == 1 ? "selected":"" }}>Office Account</option>
                                                    <option value="2"{{ $accounts->uses == 2 ? "selected":"" }}>Shop Account</option>
                                                    <option value="3"{{ $accounts->uses == 3 ? "selected":"" }}>Both</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row bank">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="bank">Bank<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control" id="bank" name="bank">
                                                    @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}"{{ $accounts->bank_id == $bank->id ? "selected":""}}>{{ $bank->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row acc_no cash">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="acc_name">Account Name<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control input_c" name="acc_name" id="acc_name" value="{{ $accounts->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row acc_no bank mobile">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="number">Account Number<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control input_m input_b" name="number" id="number" value="{{ $accounts->number }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row bank">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="branch">Branch Name<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control input_b" name="branch" id="branch_name" value="{{ $accounts->branch }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row bank">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="address">Address<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control input_b" name="address" id="address" value="{{ $accounts->address }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group mobile">
                                            <div class="col-md-4">
                                                <label class="control-label">Type of Account<span class="font-red">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="radio-group">
                                                    <label class="radio-inline"><input type="radio" name="com_radio" value="0"{{ $accounts->type_of_account == 0 ? "checked":"" }}>Business</label>
                                                    <label class="radio-inline"><input type="radio" name="com_radio" value="1"{{ $accounts->type_of_account == 1 ? "checked":"" }}>Personal</label>
                                                    <label class="radio-inline"><input type="radio" name="com_radio" value="2"{{ $accounts->type_of_account == 2 ? "checked":"" }}>Agent</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mobile">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="acc_charge">Charge Per Transaction <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="acc_charge" id="acc_charge" value="{{ $accounts->transaction_cost }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="acc_des">Description</label>
                                            </div>
                                            <div class="col-md-8">
                                                <textarea name="acc_des" id="acc_des" rows="3" class="form-control">{{ $accounts->description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="acc_init">Initial Balance<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="acc_init" id="acc_init" value="{{ $accounts->initial_bal }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label class="control-label" for="store">Store Name<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="store[]" multiple="multiple" id="store-select" class="form-control" required>
                                                    <option disabled selected>Selected Stores</option>
                                                    <option disabled>Available Stores</option>
                                                    @foreach($stores as $store)
                                                    <option value="{{ $store->id }}"{{ $accounts->stores->contains($store->id)? "selected": ""}}> {{ $store->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                   <br><br>
                                    <div class="row pull-right">
                                       <div class="col-md-12">
                                            <button type="reset" id="reset" class="btn red btn-outline">Reset</button>
                                            <button type="submit" class="btn blue btn-outline">Submit</button>
                                       </div>
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
    <script type="text/javascript">
        $(window).on("load", function () {
            let val= $('#acc_type').val();
            if(val == "Cash") {
                $('.bank, .mobile').hide(500);
                $('.input_b, .input_m').prop("disabled", true);
                $('.cash').show(500);
                $('.input_c').prop("disabled", false);
            }
            else if(val == "Mobile") {
                $('.bank, .cash').hide(500);
                $('.input_b, .input_c').prop("disabled", true);
                $('.mobile').show(500);
                $('.input_m').prop("disabled", false);
            }
            else if(val == "Bank") {
                $('.mobile, .cash').hide(500);
                $('.input_m, .input_c').prop("disabled", true);
                $('.bank').show(500);
                $('.input_b').prop("disabled", false);
            }
        });
        $("#acc_type").change(function () {
            $("select option:selected").each(function () {

                if($(this).val() == "Cash") {
                    $('.bank, .mobile').hide(500);
                    $('.input_b, .input_m').prop("disabled", true);
                    $('.cash').show(500);
                    $('.input_c').prop("disabled", false);
                }
                else if($(this).val() == "Mobile") {
                    $('.bank, .cash').hide(500);
                    $('.input_b, .input_c').prop("disabled", true);
                    $('.mobile').show(500);
                    $('.input_m').prop("disabled", false);

                }
                else if($(this).val() == "Bank") {
                    $('.mobile, .cash').hide(500);
                    $('.input_m, .input_c').prop("disabled", true);
                    $('.bank').show(500);
                    $('.input_b').prop("disabled", false);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
  <script src="{{ asset('assets/js/jquery.multi-select.js') }}"></script>
  <script type="text/javascript">
  // run callbacks
      $('#store-select').multiSelect({
      afterSelect: function(values){
      },
      afterDeselect: function(values){
      }
    });
  </script>

@endsection
