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
        <li class="active">Transactions</li>
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
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase" id="transaction_title">List of Customer Transactions</span>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('account_management.add_customer_transaction') }}" class="btn sbold red" id="transaction_btn" data-toggle="modal" data-backdrop="static" data-keyboard="false"> Add Customer Transaction
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills">
                                <li class="active"><a  data-toggle="tab" href="#customer" onclick="getTabID('customer')">Customer</a></li>
                                <li><a data-toggle="tab" href="#supplier" onclick="getTabID('supplier')">Supplier</a></li>
                                <li><a data-toggle="tab" href="#office" onclick="getTabID('office')">Office</a></li>
                                <li><a data-toggle="tab" href="#employee" onclick="getTabID('employee')">Employee</a></li>
                                {{-- <li><a data-toggle="tab" href="#investor" onclick="getTabID('investor')">Investor</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div id="customer" class="tab-pane fade in active">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Transaction No.</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Customer</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Store</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td>11</td>
                                                <td>xxxxx</td>
                                                <td>xxxxx </td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>20/12/20</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#customerView" class="btn green btn-xs" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('account_management.edit_customer_transaction') }}" class="btn blue btn-xs" id="trx_btn_edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            {{-- Modal View   --}}
                                            <div class="modal fade bs-modal-md" id="customerView" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Customer Transaction Details</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                {{-- <div class="col-md-4">
                                                                    <img src="storage/images/users/photos/" alt="" class="img-responsive profile-square">
                                                                </div> --}}
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Transaction No.</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>1224</p>
                                                                        </div>
                                                                    </div>
                                                        
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Type</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Receive</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Customer</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Omar Faruk</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Amount Paid</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>10101010 BDT.</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Details</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="rTable" id="">
                                                                                <div class="rTableRow">
                                                                                    <div class="rTableHead text-center"><strong>SL.</strong></div>
                                                                                    <div class="rTableHead text-center"><strong>Invoice No.</strong></div>
                                                                                    <div class="rTableHead text-center"><strong>Amount</strong></div>
                                                                                </div>
                                                                                <div class="rTableRow" id="rowTable">
                                                                                    <div class="rTableCell text-center">1</div>
                                                                                    <div class="rTableCell text-center">121314</div>
                                                                                    <div class="rTableCell text-center">100000 BDT.</div>
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p><b>Payment Date</b></p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>12/12/12</p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Description</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Method</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Bank</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account/Card No.</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Documents</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Not Available</p>
                                                                        </div>
                                                                    </div>
                                                                </div>{{-- /.col-md-8 --}}
                                                            </div>{{-- /.row --}}
                                                        </div> {{-- /.panel-body --}}
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- /.Modal View --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div id="supplier" class="tab-pane fade">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Account Name</th>
                                                <th>Account Uses</th>
                                                <th>Intial Balance</th>
                                                <th>Current Balance</th>
                                                <th>Store</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td>120</td>
                                                <td>xxxxx</td>
                                                <td>xxxxx </td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#supplierView" class="btn green btn-xs"  data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('account_management.edit_supplier_transaction') }}" class="btn blue btn-xs" id="trx_btn_edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            {{-- Modal View   --}}
                                            <div class="modal fade bs-modal-md" id="supplierView" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Supplier Transaction Details</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                {{-- <div class="col-md-4">
                                                                    <img src="storage/images/users/photos/" alt="" class="img-responsive profile-square">
                                                                </div> --}}
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Transaction No.</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>1224</p>
                                                                        </div>
                                                                    </div>
                                                        
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Type</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Receive</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Customer</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Omar Faruk</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Amount Paid</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>10101010 BDT.</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Details</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="rTable" id="">
                                                                                <div class="rTableRow">
                                                                                    <div class="rTableHead text-center"><strong>SL.</strong></div>
                                                                                    <div class="rTableHead text-center"><strong>Invoice No.</strong></div>
                                                                                    <div class="rTableHead text-center"><strong>Amount</strong></div>
                                                                                </div>
                                                                                <div class="rTableRow" id="rowTable">
                                                                                    <div class="rTableCell text-center">1</div>
                                                                                    <div class="rTableCell text-center">121314</div>
                                                                                    <div class="rTableCell text-center">100000 BDT.</div>
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p><b>Payment Date</b></p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>12/12/12</p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Description</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Method</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Bank</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account/Card No.</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Documents</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Not Available</p>
                                                                        </div>
                                                                    </div>
                                                                </div>{{-- /.col-md-8 --}}
                                                            </div>{{-- /.row --}}
                                                        </div> {{-- /.panel-body --}}
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- /.Modal View --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div id="office" class="tab-pane fade">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Mobile Bank</th>
                                                <th>Account No.</th>
                                                <th>Account Uses</th>
                                                <th>Intial Balance</th>
                                                <th>Branch</th>
                                                <th>Current Balance</th>
                                                <th>Store</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td>120</td>
                                                <td>xxxxx</td>
                                                <td>xxxxx </td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#officeView" class="btn green btn-xs"  data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('account_management.edit_office_transaction') }}" class="btn blue btn-xs" id="trx_btn_edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            {{-- Modal View   --}}
                                            <div class="modal fade bs-modal-md" id="officeView" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Office Transaction Details</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                {{-- <div class="col-md-4">
                                                                    <img src="storage/images/users/photos/" alt="" class="img-responsive profile-square">
                                                                </div> --}}
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Transaction No.</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>1224</p>
                                                                        </div>
                                                                    </div>
                                                        
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Type</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Receive</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Customer</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Omar Faruk</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Amount Paid</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>10101010 BDT.</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Details</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="rTable" id="">
                                                                                <div class="rTableRow">
                                                                                    <div class="rTableHead text-center"><strong>SL.</strong></div>
                                                                                    <div class="rTableHead text-center"><strong>Invoice No.</strong></div>
                                                                                    <div class="rTableHead text-center"><strong>Amount</strong></div>
                                                                                </div>
                                                                                <div class="rTableRow" id="rowTable">
                                                                                    <div class="rTableCell text-center">1</div>
                                                                                    <div class="rTableCell text-center">121314</div>
                                                                                    <div class="rTableCell text-center">100000 BDT.</div>
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p><b>Payment Date</b></p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>12/12/12</p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Description</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Method</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Bank</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account/Card No.</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Documents</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Not Available</p>
                                                                        </div>
                                                                    </div>
                                                                </div>{{-- /.col-md-8 --}}
                                                            </div>{{-- /.row --}}
                                                        </div> {{-- /.panel-body --}}
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- /.Modal View --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div id="employee" class="tab-pane fade">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Bank</th>
                                                <th>Account Uses</th>
                                                <th>Intial Balance</th>
                                                <th>Branch</th>
                                                <th>Current Balance</th>
                                                <th>Store</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td>120</td>
                                                <td>xxxxx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#employeeView" class="btn green btn-xs"  data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('account_management.edit_employee_transaction') }}" class="btn blue btn-xs" id="trx_btn_edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            {{-- Modal View   --}}
                                            <div class="modal fade bs-modal-md" id="employeeView" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Empolyee Transaction Details</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                {{-- <div class="col-md-4">
                                                                    <img src="storage/images/users/photos/" alt="" class="img-responsive profile-square">
                                                                </div> --}}
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Transaction No.</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>1224</p>
                                                                        </div>
                                                                    </div>
                                                        
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Type</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Receive</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Customer</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Omar Faruk</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Amount Paid</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>10101010 BDT.</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Details</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="rTable" id="">
                                                                                <div class="rTableRow">
                                                                                    <div class="rTableHead text-center"><strong>SL.</strong></div>
                                                                                    <div class="rTableHead text-center"><strong>Invoice No.</strong></div>
                                                                                    <div class="rTableHead text-center"><strong>Amount</strong></div>
                                                                                </div>
                                                                                <div class="rTableRow" id="rowTable">
                                                                                    <div class="rTableCell text-center">1</div>
                                                                                    <div class="rTableCell text-center">121314</div>
                                                                                    <div class="rTableCell text-center">100000 BDT.</div>
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p><b>Payment Date</b></p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>12/12/12</p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Description</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Method</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Bank</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account/Card No.</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Documents</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Not Available</p>
                                                                        </div>
                                                                    </div>
                                                                </div>{{-- /.col-md-8 --}}
                                                            </div>{{-- /.row --}}
                                                        </div> {{-- /.panel-body --}}
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- /.Modal View --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div id="investor" class="tab-pane fade">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Bank</th>
                                                <th>Account Uses</th>
                                                <th>Intial Balance</th>
                                                <th>Branch</th>
                                                <th>Current Balance</th>
                                                <th>Store</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td>120</td>
                                                <td>xxxxx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#investorView" class="btn green btn-xs"  data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('account_management.edit_investor_transaction') }}" class="btn blue btn-xs" id="trx_btn_edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            {{-- Modal View   --}}
                                            <div class="modal fade bs-modal-md" id="investorView" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Investor Transaction Details</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                {{-- <div class="col-md-4">
                                                                    <img src="storage/images/users/photos/" alt="" class="img-responsive profile-square">
                                                                </div> --}}
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Transaction No.</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>1224</p>
                                                                        </div>
                                                                    </div>
                                                        
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Type</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Receive</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Customer</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Omar Faruk</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Amount Paid</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>10101010 BDT.</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Details</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <div class="rTable" id="">
                                                                                <div class="rTableRow">
                                                                                    <div class="rTableHead text-center"><strong>SL.</strong></div>
                                                                                    <div class="rTableHead text-center"><strong>Invoice No.</strong></div>
                                                                                    <div class="rTableHead text-center"><strong>Amount</strong></div>
                                                                                </div>
                                                                                <div class="rTableRow" id="rowTable">
                                                                                    <div class="rTableCell text-center">1</div>
                                                                                    <div class="rTableCell text-center">121314</div>
                                                                                    <div class="rTableCell text-center">100000 BDT.</div>
                                                                                </div>
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p><b>Payment Date</b></p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>12/12/12</p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Description</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Payment Method</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
            
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Bank</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Account/Card No.</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <p>Documents</p>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <p class="colon">:</p>
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <p>Not Available</p>
                                                                        </div>
                                                                    </div>
                                                                </div>{{-- /.col-md-8 --}}
                                                            </div>{{-- /.row --}}
                                                        </div> {{-- /.panel-body --}}
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- /.Modal View --}}
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function getTabID(id){
            $("#transaction_title").html('List Of '+id+' Transactions');
            $("#transaction_btn").html('Add New '+id+' Transaction');
            var url = "transactions/add-"+id+"-transaction";
            $("#transaction_btn").attr("href", url);

            var edit_url = "transactions/edit-"+id+"-transaction";
            // alert(edit_url);
            $("#trx_btn_edit").attr("href", edit_url);
        }
    </script>
@endsection

