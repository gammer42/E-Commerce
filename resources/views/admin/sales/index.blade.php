@extends('layouts.master')

@section('pageTitle', __('role Roles')) 

@section('head')
<script>
     $(document).ready(function(){
        $(".search_item").hover(function(){
            $(this).css("background-color", "green");
            }, function(){
            $(this).css("background-color", "#fff");
        });
    });
</script>
@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="active">Sales</li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Sales</span>
                    </div>
                </div>
                <form action="" method="POST">
                    <div class="portlet-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label class="control-label" for="product_name">Select Search Type <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="radio-group">
                                                <label class="radio-inline"><input type="radio" name="com_radio" value="1" checked="checked">Product Name/Code</label>
                                                <label class="radio-inline"><input type="radio" name="com_radio" value="0">Bar Code</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-12 sales-return-search" id="pro_search">
                                        <div class="col-md-11 sales-input">
                                            <div class="form-group" >
                                                <input type="text" class="form-control" onkeyup="p_search(this.value)" id="search" name="sale_search" placeholder="Search" autocomplete="off">
                                                <input type="hidden" type="text" name="selected_product" id="selected_product">
                                                <div id="item" style="background:#fff;"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 sales-btn">
                                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- form-body --}}
                    </div>
                </form>
            </div>
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group" id="salesBtn">
                                <a href="#holdSale" class="btn sbold blue" data-toggle="modal" data-backdrop="static" data-keyboard="false">Hold Sale</a>
                                <a href="#saleRestore" class="btn sbold green" data-toggle="modal" data-backdrop="static" data-keyboard="false">Sale Restore</a>
                                <a href="{{ route('sales.sale_returns') }}" class="btn sbold red" data-toggle="modal" data-backdrop="static" data-keyboard="false">Sell Return</a>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product&nbsp;Name</th>
                                <th>Attr.</th>
                                <th>P.&nbsp;Code</th>
                                <th>&nbsp;Stock&nbsp;</th>
                                <th>&nbsp;&nbsp;Qty&nbsp;&nbsp;</th>
                                <th>Unit&nbsp;Price</th>
                                <th>Dis(%)</th>
                                <th>VAT(%)</th>
                                <th>&nbsp;&nbsp;Total&nbsp;&nbsp;</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cart_item">
                            {{-- <tr>
                                <td style="width:10%">xxx xxxxx</td>
                                <td style="width:10%">P103994</td>
                                <td style="width:10%">
                                    <select name="" id="" class="">
                                        <option value="">1234</option>
                                        <option value="">1234</option>
                                        <option value="">1234</option>
                                    </select>
                                </td>
                                <td style="width:10%"><input type="text" id="" name="" min="0" style="width:100%"></td>
                                <td style="width:10%"><input type="text" id="" name="" min="1" style="width:100%"></td>
                                <td style="width:10%"><input type="text" id="" name="" min="1" style="width:100%"></td>
                                <td style="width:10%"><input type="text" id="" name="" min="0" max="100" class="" min="0" style="width:100%"></td>
                                <td style="width:10%"><input type="text" id="" name=""   min="0" max="100" class="" min="0" style="width:70%"></td>
                                <td style="width:17%"><input type="text" id="" name="" class="" min="0" style="width:100%"></td>
                                <td style="width:3%"><a href="#" class="btn red btn-xs" id=""><i class="fas fa-times"></i></a></td>
                            </tr>   --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style=""></td>
                                <td style=""></td>
                                <td style=""></td>
                                <td style=""></td>
                                <td style=""></td>
                                <td style=""></td>
                                <td style=""></td>
                                <td style="">Grand Total</td>
                                <td style="width:15%" id="gt">
                                    <input type="text" id="grand_total" name="grand_total" value="0" class="form-control" readonly>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#delivery_alert" id="delivery_btn" onclick="cusDelivery()" class="btn sbold red" data-toggle="modal" data-backdrop="static" data-keyboard="false">Add Delivery Service</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="delivery_details">
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="sales_note" class="control-label">Note</label>
                                </div>
                                <div class=" col-md-6">
                                    <textarea name="slaes_note" id="slaes_note" rows="4" class="form-control" placeholder="Sales Note Here..."></textarea>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            
        </div>
                      
        <div class="col-md-4">
            <div class="card sticky">
                <div class="card-heading" id="sales_summary_heading">
                    Payment Summary
                </div>
                <div class="card-body" id="sales_summary_content">
                    <p class="payment_title">Item in Cart:  <span id="in_cart"><span>0.00</span></span></p>
                    <p class="discount_title"><button id="manual_discount_p" class="btn sbold purple">Discount 0% :</button><input id='manual_discount' class='control' onclick="discount_chk()" type="checkbox"><label class="switch" for='discount'><output class="slider" for='discount'></output></label> <label id="saleDiscount" data-value="0">0.00</label></p>
                    <p class="discountCus_title"><button id="cusDiscount_p" data-value="0" class="btn sbold red">Cus. Dis. 0% :</button><input id='discountCus' class='control' onclick="cus_discount_chk()" type="checkbox"><label class="switch" for='discountCus'><output class="slider" for='discountCus'></output></label> <label id="cusDiscount" data-value="0">0.00</label></p>
                    <div class="card-heading" id="sales_summary_heading2">
                        <span>BDT.</span>
                        <h4>Total: <span id="round_total">0.00</span></h4>
                    </div>
                    <div class="card-body2" id="sales_summary_content2">
                        <h5>Paid Amount : <span>100.00</span></h5>
                        <h5>Round : <input id='control' class='control' type="checkbox"><label class="switch" for='control'><output class="slider" for='control'></output></label> <label id="discountValue">100.00</label></h5>
                        <h5>Due : <span>00.00</span></h5>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-heading" id="sales_customer_heading">
                    Customer
                </div>
                <div class="card-body" id="sales_customer_content">
                    <div class="form-body">
                        <form action="">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <select id="single" class="sales-person form-control select2">
                                            <option value="" selected disabled>Sales Person</option>
                                            @foreach($persons as $person)
                                            <option value="{{$person->id}}">{{$person->contact_p_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <a href="#add" class="btn sbold red" data-toggle="modal" data-backdrop="static" data-keyboard="false">Add
                                                </a>
                                            </div>
                                            <div class="col-md-10">
                                                <select id="single" class="customer_discount customer form-control select2">
                                                    <option value="" selected disabled>Customer Name</option>
                                                    @foreach($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-heading" id="sales_discount_heading">
                    Discount
                </div>
                <div class="card-body" id="sales_discount_content">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label class="control-label" for="discount">Discount(%)</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="discount" onkeyup="discount_parcentage(this.value)" id="discount" max="100" class="form-control" placeholder="%">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label class="control-label" for="dis_taka">Discount Taka</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="dis_taka" onkeyup="discount_taka(this.value)" id="dis_taka" class="form-control" placeholder="Discount Taka">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label class="control-label" for="card_promotion">Card Promotion</label>
                                </div>
                                <div class="col-md-7">
                                    <select id="single card_promotion" name="card_promotion" class="form-control select2">
                                        <option value="" selected disabled>Select One</option>
                                        <option value="1">xxxxxxxx</option>
                                        <option value="2">ppppppppp</option>
                                        <option value="3">kkkkkkkk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-heading" id="sales_payment_heading">
                    Payment
                </div>
                <div class="card-body" id="sales_payment_content">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label class="control-label" for="cash_payment">Cash Payment</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="cash_payment" id="cash_payment" class="form-control" placeholder="Cash">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label class="control-label" for="cash_given">Cash Given</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="cash_given" id="cash_given" class="form-control" placeholder="Cash Paid">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label class="control-label" for="dis_taka">Charge Amount</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="charge_amount" id="charge_amount" class="form-control" placeholder="Charge Amount" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="sales_payment_content2">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <label class="control-label" for="card_payment">Card Payment</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="card_payment" id="card_payment" class="form-control" placeholder="Card Payment">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <label class="control-label" for="card_number">Card Number</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" name="card_number" id="card_number" class="form-control" placeholder="Card Number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <label class="control-label" for="card_type">Card Type</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select id="card_type" class="form-control">
                                            <option value="" selected disabled>Select One</option>
                                            <option value="1">VISA</option>
                                            <option value="2">Ammex</option>
                                            <option value="3">Masterd</option>
                                            <option value="4">Nexus</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-5">
                                        <label class="control-label" for="bank_name">Bank Name</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select id="bank_name single" class="form-control select2">
                                            <option value="" selected disabled>Select One</option>
                                            <option value="1">DBBL</option>
                                            <option value="2">BRAC</option>
                                            <option value="3">SCB</option>
                                            <option value="4">EBL</option>
                                            <option value="6">HSBC</option>
                                            <option value="7">SEB</option>
                                            <option value="8">LBB</option>
                                            <option value="9">NCC</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>  
            
            <div class="card">
                <div class="card-heading" id="sales_mobile_heading">
                    Mobile
                </div>
                <div class="card-body" id="sales_mobile_content">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label class="control-label" for="amount">Amount</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label class="control-label" for="mobile_bank">Mobile Bank</label>
                                </div>
                                <div class="col-md-7">
                                    <select id="mobile_bank" name="mobile_bank" class="form-control">
                                        <option value="" selected disabled>Select One</option>
                                        <option value="1">Rocket</option>
                                        <option value="2">Bkash</option>
                                        <option value="3">Nogod</option>
                                        <option value="4">Ucash</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label class="control-label" for="trans_id">Transaction ID.</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="trans_id" id="trans_id" class="form-control" placeholder="Transaction ID.">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-5">
                                    <label class="control-label" for="rec_no">Receiver No.</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="rec_no" id="rec_no" class="form-control" placeholder="Receiver Number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body" id="sales_print">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group" id="salesBtn">
                                <a href="#" class="btn sbold orange">A4 Print</a>
                                <a href="#" class="btn sbold orange">Sale & Print</a>
                                <a href="#" class="btn sbold orange" >Sale</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Modal -->
<div class="modal fade bs-modal-lg" id="add"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="" class="horizontal-form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times"></i>
                    </button>
                    <h4 class="modal-title">Add Customer</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="membership_id">Membership ID</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="membership_id" name="membership_id" class="form-control" value="123456" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="customer_type">Customer Type</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control" name="customer_type" id="customer_type" required>
                                        <option value="" disabled selected>Select One</option>
                                        <option value="1">Gold</option>
                                        <option value="1">Silver</option>
                                        <option value="1">Platinum</option>
                                        {{-- @foreach ($types as $type)
                                            <option value="{{$type->id}}">{{$type->type_name}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Full Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
                                </div>
                            </div>
                            
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="phone">Phone</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone Number">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn blue btn-outline" data-dismiss="modal">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade bs-modal-md" id="delivery_alert" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div class="font-red">
                    <strong>Please Select Customer First!</strong>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Delivery Service Modal -->
<div class="modal fade bs-modal-lg" id="add_delivery_service"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="" id="add_delivery" class="horizontal-form" method="POST">
            @csrf
            <span id="cus"></span>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times"></i>
                    </button>
                    <h4 class="modal-title">Add Delivery Service</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="person_type">Person Type</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control" name="person_type" id="person_type" required>
                                        <option value="" disabled selected>Select One</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Agent">Agent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="invoice" value="{{$invoice}}">
                        <div class="row staff" style="display:none">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="delivery_person">Delivery Person</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control staffInput" name="delivery_person" id="delivery_person_staff">
                                        <option value="" disabled selected>Select One</option>
                                        @foreach($persons as $person)
                                        <option value="{{$person->id}}">{{$person->contact_p_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="service_name_staff">Service Name</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control service_name staffInput" name="service_name" id="service_name_staff">
                                        <option value="" disabled selected>Select One</option>
                                        <option value="Regular">Regular</option>
                                        <option value="On Time Delivery">On Time Delivery</option>
                                        <option value="Rickshaw">Rickshaw</option>
                                        <option value="Convence">Convence</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="service_range_staff">Service Range</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control service_range staffInput" name="service_range" id="service_range_staff" >
                                        <option value="" disabled selected>Select One</option>
                                        <option value="1">400 To 600</option>
                                        <option value="2">601 To 800</option>
                                        <option value="3">801 To 1000</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row staff" style="display:none">
                            <div class="col-md-4">
                                <div class="form-group"  id="service_charge_s">
                                    <label class="control-label" for="delivery_charge">Delivery Charge</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="delivery_charge" name="delivery_charge" class="form-control staffInput" placeholder="Delivery Charge">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="paid_amount">Paid Amount</label>
                                    <input type="text" id="paid_amount" name="paid_amount" class="form-control staffInput" placeholder="Paid Amount">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="cod_charge">COD Charge</label>
                                    <input type="text" id="cod_charge" name="cod_charge" class="form-control staffInput" placeholder="COD Charge">
                                </div>
                            </div>
                        </div>
                        <div class="row staff" style="display:none">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="account_type_staff">Accounts</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control select2 staffInput" name="account" id="account_type_staff">
                                        @foreach($accounts as $account)
                                        <option value="{{$account->id}}" onclick="type({{$account->type}})">{{$account->number}}&nbsp;{{$account->name}}-{{$account->type}}-{{$account->branch}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4" id="reffRowStaff" style="display:none">
                                <div class="form-group">
                                    <label class="control-label" for="reffInputStaff">Reff Transaction No</label>
                                    <input type="text" id="reffInputStaff" name="reff" class="form-control reffInputStaff staffInput" placeholder="Reff Transaction No">
                                </div>
                            </div>
                            
                            <div class="col-md-4" id="nullRow"></div>
                        </div>
                        <!--/row-->
                        <div class="row agent" style="display:none">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="agent_name">Agent Name</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control agentInput add_agent_name" name="agent_name" id="agent_name">
                                        <option value="" disabled selected>Select One</option>
                                        @foreach($agents as $agent)
                                        <option value="{{$agent->id}}">{{$agent->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="delivery_person">Delivery Person</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control agentInput agent_person" name="delivery_person" id="delivery_person">
                                        <option value="" disabled selected>Select One</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="service_name">Service Name</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control agentInput service_name" name="service_name" id="service_name">
                                        <option value="" disabled selected>Select One</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row agent" style="display:none">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="service_range">Service Range</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control agentInput service_range" name="service_range" id="service_range">
                                        <option value="" disabled selected>Select One</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="charge">
                                    <label class="control-label" for="delivery_charge">Delivery Charge</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="delivery_charge" name="delivery_charge" class="form-control agentInput" placeholder="Delivery Charge">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="paid_amount">Paid Amount</label>
                                    <input type="text" id="paid_amount" name="paid_amount" class="form-control agentInput" placeholder="Paid Amount">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="cod_charge">COD Charge</label>
                                    <input type="text" id="cod_charge" name="cod_charge" class="form-control agentInput" placeholder="COD Charge">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row agent" style="display:none">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="memo_no">Memo No</label>
                                    <input type="text" id="memo_no" name="memo_no" class="form-control agentInput" placeholder="Memo No">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="account_type_agent">Accounts</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control agentInput select2" name="account" id="account_type_agent">
                                        <option value="" disabled selected>Select One</option>
                                        @foreach($accounts as $account)
                                        <option value="{{$account->id}}" onclick="type({{$account->type}})">{{$account->number}}&nbsp;{{$account->name}}-{{$account->type}}-{{$account->branch}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-md-4" id="reffRowAgent" style="display:none">
                                <div class="form-group">
                                    <label class="control-label" for="reffInputAgent">Reff Transaction No</label>
                                    <input type="text" id="reffInputAgent" name="reff" class="form-control reffInputAgent agentInput" placeholder="Reff Transaction No">
                                </div>
                            </div>
                        </div>
                        <div class="row address_customer">
                            <div class="col-md-12">
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Address Type</th>
                                            <th>Division/City</th>
                                            <th>District/Area</th>
                                            <th>Addresss</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cus_address_in">

                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn sbold red" id="addressAdd">Add Address</button>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="add_del_submit" class="btn blue btn-outline">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Sale Restore Modal -->
<div class="modal fade bs-modal-lg" id="saleRestore"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="" class="horizontal-form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times"></i>
                    </button>
                    <h4 class="modal-title">Sale Restore</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th>Invoice ID.</th>
                                        <th>Station</th>
                                        <th>Customer ID.</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>12123234235</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>12/12/2010 12:12:12</td>
                                        <td>
                                            <a href="#" class="btn sbold red">Restore</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--/row-->
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
    
@section('script')

    <script>
        $("#person_type").change(function () {
            $('.staff, .agent').css('display','none');
            $('.staffInput, .agentInput').prop( "disabled", true );
            $("select option:selected").each(function () {
                if($(this).val() == "Staff") {
                    $('.agent').hide(1000);
                    $('.address_customer').hide();
                    $('.agent').css('display','none');
                    $('.agentInput').prop( "disabled", true );
                    $('.staff').show(1000);
                    $('.address_customer').show(1000);
                    $('.staff').css('display','block');
                    $('.staffInput').prop( "disabled", false );
                }else if($(this).val() == "Agent") {
                    $('.staff').hide(1000);
                    $('.address_customer').hide();
                    $('.staff').css('display','none');
                    $('.staffInput').prop( "disabled", true );
                    $('.agent').show(1000);
                    $('.address_customer').show(1000);
                    $('.agent').css('display','block');
                    $('.agentInput').prop( "disabled", false );
                }
            });
        });
    </script>
    <script>

        $("#account_type_staff").change(function () {
            $("select option:selected").each(function () {
                var staff = $(this).val();
                if(staff == "Mobile") {
                    $('#reffRowStaff').css('display','block');
                    $('.reffInputStaff').prop( "disabled", false);

                }else if(staff == "Bank"){
                    $('#reffRow').css('display','none');
                    $('.reffInputStaff').prop( "disabled", true );
                }
                else if(staff == "Others"){
                    $('#reffRowStaff').css('display','none');
                    $('.reffInputStaff').prop( "disabled", true );
                }
            });
        });
    </script>
    <script>
        $("#account_type_agent").change(function () {
            $("select option:selected").each(function () {
                var agent = $(this).val();
                if(agent == "Mobile") {
                    $('#reffRowAgent').css('display','block');
                    $('.reffInputAgent').prop( "disabled", false);

                }else if(agent == "Bank"){
                    $('#reffRow').css('display','none');
                    $('.reffInputAgent').prop( "disabled", true );
                }
                else if(agent == "Others"){
                    $('#reffRowAgent').css('display','none');
                    $('.reffInputAgent').prop( "disabled", true );
                }
            });
        });

        $(document).ready(function(){
            $('.agent_person').change(function() {
                $(".agent_person  option:selected").each(function (){
                    var item_id = $(this).val();
                    $('.service_name').empty().append('<option selected disabled>Add Delivery Person</option>');
                    $.ajax({
                        type:'GET',
                        url:"{{ url('agent/person/service') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                            let options_range;
                            let options_service;
                            $.each( result.services, function( key, value ) {
                                options_service =options_service +'<option value="'+value.id+'">'+value.cost_name+'</option>';
                                $(".service_name").empty().append('<option selected disabled>Select Agent Person</option>'+options_service);
                            });
                        }
                    });
                });
            });
            $('.service_name').change(function() {
                $(".service_name  option:selected").each(function (){
                    var item_id = $(this).val();
                    $('.service_range').empty().append('<option selected disabled>Select Service First</option>');
                    $.ajax({
                        type:'GET',
                        url:"{{ url('agent/person/ranges') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                            let options_range;
                            $.each( result.ranges, function( key, value ) {
                                options_range =options_range +'<option value="'+value.id+'">'+value.from+' To '+value.to+'</option>';
                                $(".service_range").empty().append('<option selected disabled>Select Range</option>'+options_range);
                            });
                        }
                    });
                });
            });
            $('.service_range').change(function() {
                $(".service_range  option:selected").each(function (){
                    var item_id = $(this).val();
                    $.ajax({
                        type:'GET',
                        url:"{{ url('agent/person/service/charge') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                            $('#charge').empty().html('<label class="control-label" for="delivery_charge">Delivery Charge</label>'+
                                    '<span class="text-danger">*</span><input type="text" id="delivery_charge" value="'+result.charge+'" name="delivery_charge" class="form-control" readonly required>');
                        }
                    });
                });
            });
        });

    </script>
    
    <script>

        $(document).ready(function(){
            $('.add_agent_name').change(function() {
                $(".add_agent_name  option:selected").each(function (){
                    var item_id = $(this).val();
                    $('.agent_person').empty().append('<option selected disabled>Add Delivery Person</option>');
                    $.ajax({
                        type:'GET',
                        url:"{{ url('agent/person') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                        let options;
                        $.each( result.agent_person, function( key, value ) {
                            options =options +'<option value="'+value.id+'">'+value.contact_p_name+'</option>';
                            $(".agent_person").empty().append('<option selected disabled>Select Agent Person</option>'+options);
                        });
                        }
                    });
                });
            });
            $('#delivery_person_staff').change(function(){
                $("#delivery_person_staff  option:selected").each(function (){
                    var item_id = $(this).val();
                    $('#service_name_staff').empty().append('<option selected disabled>Add Delivery Person</option>');
                    $.ajax({
                        type:'GET',
                        url:"{{ url('agent/person/service') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                            let options_range;
                            let options_service;
                            $.each( result.services, function( key, value ) {
                                options_service =options_service +'<option value="'+value.id+'">'+value.cost_name+'</option>';
                                $("#service_name_staff").empty().append('<option selected disabled>Select Agent Person</option>'+options_service);
                            });
                        }
                    });
                });
            });
            $('#service_name_staff').change(function() {
                $("#service_name_staff  option:selected").each(function (){
                    var item_id = $(this).val();
                    $('#service_range_staff').empty().append('<option selected disabled>Select Service First</option>');
                    $.ajax({
                        type:'GET',
                        url:"{{ url('agent/person/ranges') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                            let options_range;
                            $.each( result.ranges, function( key, value ) {
                                options_range =options_range +'<option value="'+value.id+'">'+value.from+' To '+value.to+'</option>';
                                $("#service_range_staff").empty().append('<option selected disabled>Select Range</option>'+options_range);
                            });
                        }
                    });
                });
            });
            $('#service_range_staff').change(function() {
                $("#service_range_staff  option:selected").each(function (){
                    var item_id = $(this).val();
                    $.ajax({
                        type:'GET',
                        url:"{{ url('agent/person/service/charge') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                            $('#service_charge_s').empty().html('<label class="control-label" for="delivery_charge">Delivery Charge</label>'+
                                    '<span class="text-danger">*</span>'+
                                    '<input type="text" id="delivery_charge" value="'+result.charge+'" name="delivery_charge" class="form-control" readonly required>');
                            $('#paid_amount').attr('max',result.charge);
                        }
                    });
                });
            });
        });

        $("#addressAdd").click(function () {
            $('#newShipping').toggle(500);
            // $('#addressAdd').html('Remove Address');
        });
    </script>
    <script>

        $('.customer').change( function(){
            $('#delivery_btn').attr('href','#add_delivery_service');
            // c_id = $(this).val();
            // alert('c_id');
            // $.ajax({
            //     type:'GET',
            //     url:"{{ url('customer/commission') }}/"+c_id,
            //     data:{id:c_id},

            //     success:function(result){
            //         dis = result.dis;
            //         cus_discount(dis);
            //         console.log(dis);
            //         $('#discountCus').removeAttr('chacked');
            //         $('#discountCus').attr('value', true);
            //         $('#manual_discount').removeAttr('chacked');
            //         $('#manual_discount').attr('value', false);
            //     }
            // });
        });

        function cusDelivery(){
            let customer = $('.customer').val();
            $('#cus').html('<input id="cust" value="'+customer+'" name="customer" hidden>');
            // if(customer>0){
            //     let link = 'sales/delivery/add/';
            //     $('#add_delivery').attr("action",link);
            // }
            $.ajax({
                type:'GET',
                url:"{{ url('customer/address/ad') }}/"+customer,
                data:{id:customer},

                success:function(result){
                    let options;
                    $.each( result.address, function( key, value ) {
                        let type;
                        if(value.address_type==1){
                            type = 'Permanent'
                        }
                        if(value.address_type==2){
                            type = 'Present'
                        }
                        if(value.address_type==3){
                            type = 'Work'
                        }
                        if(value.address_type==4){
                            type = 'Delivery'
                        }
                        let district;
                        let division;
                        let div_id;
                        $.ajax({
                            type:'GET',
                            url:"{{ url('customer/address/ds') }}/"+value.district_id,
                            data:{id:value.district_id},

                            success:function(result){
                                let a = result.district;
                                district = a.name;
                                div_id = a.division_id;
                                $.ajax({
                                    type:'GET',
                                    url:"{{ url('customer/address/dv') }}/"+div_id,
                                    data:{id:div_id},

                                    success:function(result){
                                        let b = result.division;
                                        division = b.name;
                                        options =options +'<tr><td><input type="radio" name="radio_shipping" value="'+value.id+'"></td><td>'+type+'</td><td>'+division+'</td><td>'+district+'</td><td>'+value.street+'</td></tr>';
                                        $("#cus_address_in").empty().append(options+'<tr id="newShipping" style="display:none">'+
                                        '<td><input type="radio" name="radio_shipping" value="0"></td>'+
                                        '<td>Shipping Address</td>'+
                                        '<td>'+
                                            '<select class="form-control division select2"  onchange="div(this.value)" name="division" id="division">'+
                                                '<option value="" disabled selected>Select One</option>'+
                                                '@foreach($divisions as $division)'+
                                                '<option value="{{$division->id}}">{{$division->name}}</option>'+
                                                '@endforeach'+
                                            '</select>'+
                                        '</td>'+
                                        '<td>'+
                                            '<select class="form-control select2" name="district" id="district">'+
                                                '<option value="" disabled selected>Select Division First</option>'+
                                            '</select>'+
                                       '</td>'+
                                        '<td>'+
                                            '<textarea class="form-control" name="shipping_address" id="shipping_address" rows="2"></textarea>'+
                                        '</td>'+
                                    '</tr>');
                                    }
                                });
                            }
                        });
                    });
                }
            });
        }
    </script>

    <script>
        function div(div_id){
            $.ajax({
                type:'GET',
                url:"{{ url('customer/address/dst') }}/"+div_id,
                data:{id:div_id},
                success:function(result){
                    let options;
                    $.each( result.district, function( key, value ) {
                        options =options +'<option value="'+value.id+'">'+value.name+'</option>';
                        $('#district').html('<option value="" disabled selected>Select District</option>'+options);
                    });
                }
            });
        }

        function type(type){
            alert(type);
            if(type == "Mobile") {
                $('#reffRowAgent').css('display','block');
                $('.reffInputAgent').prop( "disabled", false);

            }else if(type == "Bank"){
                $('#reffRow').css('display','none');
                $('.reffInputAgent').prop( "disabled", true );
            }
            else if(type == "Others"){
                $('#reffRowAgent').css('display','none');
                $('.reffInputAgent').prop( "disabled", true );
            }
        }
    </script>
      
    <script>
        $(document).on('click', '.order_remove_btn', function(){  
            $(this).parents('tr').remove();
        });
        $(document).ready(function(){
            $("#add_delivery").submit(function(e) {
                e.preventDefault(); 
                var form = $("#add_delivery").serialize();
                var url = '/sales/delivery/add';
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    data:form,
                    dataType: "json",
                    success: function(result){
                        let type = result.delivery_type;
                        let agent = result.agent_name;
                        let agent_person = result.delivery_person;
                        let service = result.service_name;
                        let from = result.start_range;
                        let to = result.end_range;
                        let account = result.account;
                        let cod = result.cod;
                        let address = result.address;
                        let charge = result.delivery_charge;
                        let paid = result.paid;
                        let due = result.due;
                        let ref = result.ref;
                        if(type == 'Agent'){
                            $('#delivery_details').html('<ul class="list-group borderless">'+
                                '<li class="list-group-item"><b>Delivery Type : </b> &nbsp; &nbsp; &nbsp; &nbsp; '+type+'</li>'+
                                '<li class="list-group-item"><b>Agent Name : </b> &nbsp; &nbsp; &nbsp; &nbsp; '+agent+'</li>'+
                                '<li class="list-group-item"><b>Delivery Person :</b>  &nbsp; &nbsp; &nbsp; &nbsp; '+agent_person+'</li>'+
                                '<li class="list-group-item"><b>Service Name :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+service+'</li>'+
                                '<li class="list-group-item"><b>Service Range :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+from+'&nbsp;To&nbsp;'+to+'</li>'+
                                '<li class="list-group-item"><b>Accounts :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+account+'</li>'+
                                '<li class="list-group-item"><b>Reff Transaction No :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+ref+'</li>'+
                                '<li class="list-group-item"><b>COD Charge :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+cod+'</li>'+
                                '<li class="list-group-item"><b>Delivery Address :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+address+'</li>'+
                                '<li class="list-group-item"><b>Delivery Charge :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+charge+'</li>'+
                                '<li class="list-group-item"><b>Paid Amount :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+paid+'</li>'+
                                '<li class="list-group-item"><b>Due Amount :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+due+'</li>'+
                            '</ul>');
                            $('.modal.in').modal('hide');
                        }
                        if(type == 'Staff'){
                            $('#delivery_details').html('<ul class="list-group borderless">'+
                                '<li class="list-group-item"><b>Delivery Type : </b> &nbsp; &nbsp; &nbsp; &nbsp; '+type+'</li>'+
                                '<li class="list-group-item"><b>Delivery Person :</b>  &nbsp; &nbsp; &nbsp; &nbsp; '+agent_person+'</li>'+
                                '<li class="list-group-item"><b>Service Name :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+service+'</li>'+
                                '<li class="list-group-item"><b>Service Range :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+from+'&nbsp;To&nbsp;'+to+'</li>'+
                                '<li class="list-group-item"><b>Accounts :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+account+'</li>'+
                                '<li class="list-group-item"><b>Reff Transaction No :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+ref+'</li>'+
                                '<li class="list-group-item"><b>COD Charge :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+cod+'</li>'+
                                '<li class="list-group-item"><b>Delivery Address :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+address+'</li>'+
                                '<li class="list-group-item"><b>Delivery Charge :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+charge+'</li>'+
                                '<li class="list-group-item"><b>Paid Amount :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+paid+'</li>'+
                                '<li class="list-group-item"><b>Due Amount :</b>   &nbsp; &nbsp; &nbsp; &nbsp; '+due+'</li>'+
                            '</ul>');
                            $('.modal.in').modal('hide');
                        }
                            
                        
                    }
                });
            });
        });
    </script>
    //Product Search Query      
    <script>
        function p_search(query){
            $.ajax({
                type:'GET',
                url:"{{ url('product/search/onkeyup') }}",
                data:{query:query},
                dataType:'Json',
                success:function(data){
                    let options = '';
                    $('#item').empty();
                    $.each( data.data, function( key, value ){
                        let randomColor = '#'+ ('ffffff' + Math.floor(Math.random()*16777215).toString(16)).slice(-6);
                        options =options +'<div style="background:#fff;cursor:pointer;" onclick="get_data('+value.id+')" class="search_item" data-id="'+value.id+'" id="search_item'+value.id+'" data-name="'+value.name+'" data-code="'+value.product_code+'">'+value.name+'('+value.product_code+')</div>';
                        $('#item').html(options);
                    });
                }
            });
        }
        function get_data(id){
            let uid = $("#search_item"+id).data("id");
            let name = $("#search_item"+id).data("name");
            let code = $("#search_item"+id).data("code");
            let p_name = name+'('+code+')';
            $('#pro_search').html('<div class="col-md-11 sales-input">'+
                                '<div class="form-group" >'+
                                    '<input type="text" class="form-control" onkeyup="p_search(this.value)" id="search" name="sale_search" value="'+p_name+'" placeholder="Search" autocomplete="off">'+
                                    '<input type="hidden" type="text" name="selected_product" id="selected_product" value="'+uid+'">'+
                                    '<div id="item" style="background:#fff;"></div>'+
                                '</div>'+
                                '<div class="col-md-1 sales-btn">'+
                                    '<a onclick="cart_product('+uid+')" class="btn btn-default"><i class="fas fa-search"></i></a>'+
                                '</div>');
        }
    </script>

    <script>
        function cart_product(pid){
            let valu = $('#qty'+pid).val();
            let id = $('#'+pid).val();
            if(valu!=null){
                $('#qty'+pid).attr('value', parseInt(valu)+1);
                sum_p(pid);
            }else {
            $.ajax({
                type:'GET',
                url:"{{ url('product/search/cart') }}/"+pid,
                data:{id:pid},
                dataType: 'Json',
                success:function(result){
                    if(result.error){
                        alert(result.error);
                    }else{
                    let product_id = result.product_id;
                    let product_name = result.product_name;
                    let product_code = result.product_code;
                    let stock = result.stock;
                    let price = result.price;
                    let attr = result.attribute;
                    let loo = '';
                    $.each( attr, function( key, value ){
                        loo = loo+'<span>'+value.value+',</span><br>';
                    });
                    sum_grand_total(price);    
                    $("#cart_item").append('<tr>'+
                        '<td>'+product_name+'</td>'+
                        '<td style="width:10%">'+loo+'</td>'+
                        '<td>'+product_code+'</td>'+
                        '<td>'+stock+'</td>'+
                        '<input type="hidden" id="'+product_id+'" data-value="'+product_id+'" value="'+product_id+'" name="id[]" class="form-control" required>'+
                        '<td><input type="text" id="qty'+product_id+'" onkeyup="sum_p('+product_id+')" value="1" name="qty[]" class="form-control" max="'+stock+'" min="1"></td>'+
                        '<td><input type="text" id="price'+product_id+'" onkeyup="sum_p('+product_id+')" value="'+price+'" name="price[]" class="form-control" min="1" required readonly></td>'+
                        '<td><input type="text" id="dis'+product_id+'" onkeyup="sum_p('+product_id+')" name="dis[]" value="0" class="form-control" max="100" min="0"></td>'+
                        '<td><input type="text" id="vat'+product_id+'" onkeyup="sum_p('+product_id+')" name="vat[]" value="0" class="form-control" max="100" min="0"></td>'+
                        '<td style="width:15%"><input type="text" id="total'+product_id+'" name="total[]" value="'+price+'" class="form-control" readonly></td>'+
                        '<td style="width:5%"><a class="btn red btn-xs order_remove_btn" onclick="sub_grand_total('+product_id+')" id="order_remove_btn"><i class="fas fa-times"></i></a></td>'+
                    '</tr>');
                    }
                }
            });
            }
        }

        function sum_p(id){
            let qty = $('#qty'+id).val();
            let price = $('#price'+id).val();
            let dis = $('#dis'+id).val();
            let vat = $('#vat'+id).val();
            let pre_total = $('#total'+id).val();

            let total = (qty*price);
            discount = ((total*dis)/100);
            discount = Math.round(discount);
            total = total-discount;
            vat_total=((total*vat)/100);
            vat_total = Math.round(vat_total);
            total=total+vat_total;
            $('#total'+id).attr('value',total);
            sum_grand_total(total-pre_total);
        }

        function sub_grand_total(id){
            let sub_total = $('#total'+id).val();
            let alpha = $('#grand_total').val();
            beta=parseInt(alpha)-parseInt(sub_total);
            $('#gt').html('<input type="text" id="grand_total" name="grand_total" value="'+beta+'" class="form-control" readonly>');
            $('#h_total').html('Total '+beta+' Tk.');
            $('#in_cart').html('<span>'+beta+'</span>');
            $('#in_cart').attr('data-value',beta);
            $('#round_total').html(beta);
            $('#dis_taka').attr('max',beta);
            alert('Sub(-Total)')
            discount();
        }

        function sum_grand_total(total){
            let alpha = $('#grand_total').val();
            beta=parseInt(alpha)+parseInt(total);
            $('#gt').html('<input type="text" id="grand_total" name="grand_total" value="'+beta+'" class="form-control" readonly>');
            $('#in_cart').html('<span>'+beta+'</span>');
            $('#round_total').html(beta);
            $('#dis_taka').attr('max',beta);            
            alert('Sub(+total) :'+beta);
            discount();
        }

        function due(p_val){
            let total = $('#grand_total').val();
            let value = p_val;
            let due = parseInt(total)-parseInt(value);
            if(due==0)
            $('#due').html('(Payable: 0.00 Tk.)');
            if(due<0){
                let payable = parseInt(value)-parseInt(total);
                $('#due').html('(Payable: '+payable+' Tk.)');
            }
            if(due>0){
                $('#due').html('(Due: '+due+' Tk.)');
            }
        }

        $('.customer_discount').change( function(){
            // $('#delivery_btn').attr('href','#add_delivery_service');
            c_id = $(this).val();
            alert('c_id');
            $.ajax({
                type:'GET',
                url:"{{ url('customer/commission') }}/"+c_id,
                data:{id:c_id},

                success:function(result){
                    dis = result.dis;
                    let a = cus_discount(dis);
                    alert(a);
                    $('#discountCus').removeAttr('chacked');
                    $('#discountCus').attr('value', true);
                    $('#manual_discount').removeAttr('chacked');
                    $('#manual_discount').attr('value', false);
                }
            });
        });

        // function discount_parcentage(discount){
        //     let total = $('#grand_total').val();
        //     let customer_parcentage = $('#cusDiscount_p').data('value');
        //     let c_taka = 0;
        //     if(discount<100 && discount>0){
        //         $('#dis_taka').attr('disable', true)
        //         let dis_taka = (parseInt(total)*parseInt(discount))/100;
        //         c_taka = cus_discount(customer_parcentage);
        //         grand_total = parseInt(total)-(dis_taka+c_taka);
        //         $('#round_total').html(grand_total);
        //     }else{
        //         $('#dis_taka').attr('disable', false)
        //     }
        // }
        // function discount_taka(discount){
        //     let total = $('#grand_total').val();
        //     let customer_parcentage = $('#cusDiscount_p').data('value');
        //     let c_taka = 0;
        //     if(discount>0){
        //         $('#discount').attr('disable', true)
        //         c_taka = cus_discount(customer_parcentage);
        //         let grand_total = parseInt(r_total)-(parseInt(discount)+c_taka);
        //         $('#round_total').html(grand_total);
        //     }else {
        //         $('#discount').attr('disable', false)
        //     }
        // }

        function cus_discount(par){
            let total = $('#grand_total').val();
            let discount_taka = (parseInt(total)*parseInt(par))/100;
            let grand_total = parseInt(total)-parseInt(discount_taka);
            $('#round_total').html(grand_total);
            $('#cusDiscount_p').html('Cus. Dis. '+par+'%');
            $('#cusDiscount_p').attr('data-value',par);
            $('#cusDiscount').html(discount_taka);
            $('#cusDiscount').attr('data-value', discount_taka);
            alert('customer discount'+ grand_total+' '+ discount_taka);
            return discount_taka;
        }

        function discount(){
            cus_discount_chk();
            // discount_chk();
            alert('Discount Function');
        } 

        
        function cus_discount_chk(){
            togBtn= $('#discountCus');
            togBtn.val(togBtn.prop('checked'));
            let alpha = $('#cusDiscount_p').data('value');
            if(togBtn.val()==true){
                 cus_discount(alpha);
            }
            if(togBtn.val()==true){
                cus_discount(-alpha);
            }
            let parcent = 0;
            let taka = 0;
            parcent = $('#discount').val();
            taka = $('#dis_taka').val();
            if(parcent>0){
                discount_parcentage(discount);
            }
            if(taka>0){
                discount_taka(taka);
            }
            alert('cus_discount_chk alpha'+alpha+ ', parcent '+parcent+', taka'+ taka);
        }

        // function discount_chk(){
        //     alert('Hello');
        //     togBtn= $('#manual_discount');
        //     togBtn.val(togBtn.prop('checked'));
        //     let alpha = $('#saleDiscount').data('value');
        //     if(togBtn.val()==true){
        //         discount_taka(alpha);
        //     }else discount_taka(-alpha);
        // }

    </script>

@endsection