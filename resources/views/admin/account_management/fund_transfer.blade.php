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
        <li class="active">Fund Transfer</li>
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
        <div class="col-md-5">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">New Transfer</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="" class="horizontal-form" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-5">
                                                <label class="control-label" for="account_from">Account From</label>
                                            </div>
                                            <div class="col-md-7">
                                                <select class="form-control select2" id="account_from" name="account_from">
                                                    <option value="" selected>Select One</option>
                                                    <option value="1">Acc. From One</option>
                                                    <option value="2">Acc. From Two</option>
                                                    <option value="3">Acc. From Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <span id="balance_row"></span>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-5">
                                                <label class="control-label" for="account_to">Account To</label>
                                            </div>
                                            <div class="col-md-7">
                                                <select class="form-control select2" id="account_to" name="account_to">
                                                    <option value="" selected>Select One</option>
                                                    <option value="1">Acc. To One</option>
                                                    <option value="2">Acc. To Two</option>
                                                    <option value="3">Acc. To Three</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

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
                                                <label class="control-label" for="description">Description</label>
                                            </div>
                                            <div class="col-md-7">
                                                <textarea name="description" id="description" rows="5" class="form-control" placeholder="Description Here..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                                                
                                    <div class="row pull-right">
                                        <div class="col-md-12">
                                            <button type="reset" id="reset" class="btn red btn-outline">Reset</button>
                                            <button type="submit" class="btn blue btn-outline">Submit</button>
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
        <div class="col-md-7">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List Of Fund Transfers</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:5%">SL.</th>
                                <th style="width:15%">Amount&nbsp;From</th>
                                <th style="width:15%">Amount&nbsp;To</th>
                                <th style="width:15%">Amount&nbsp;(BDT)</th>
                                <th style="width:25%">&nbsp;&nbsp;Date&nbsp;&nbsp;</th>
                                <th style="width:25%">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Bkash</td>
                                <td>Agent</td>
                                <td>100000</td>
                                <td>13 July 2109 6.00 pm</td>
                                <td>xxxxxxx xxxxxx xxxxxxxx</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Bkash</td>
                                <td>xxxxxxxxxxx</td>
                                <td>1000</td>
                                <td>13 July 2109 6.00 pm</td>
                                <td>xxxxxxx xxxxxx xxxxxxxx</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>xxxxxxxxxxxxx</td>
                                <td>xxxxxxx xxxxxxxxx</td>
                                <td>222222</td>
                                <td>13 July 2109 6.00 pm</td>
                                <td>xxxxxxx xxxxxx xxxxxxxx</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $("#account_from").change(function () {
            $("select option:selected").each(function () {

                var row ='<div class="row">'+
                            '<div class="col-md-5">'+
                                '<p id=""><b>Balance</b></p>'+
                            '</div>'+
                            '<div class="col-md-offset-1 col-md-6">'+
                                '<p id="balance" class="font-red">121124 TK.</p>'+
                            '</div>'+
                        '</div>';
                $('#balance_row').html(row);
            });
        });
    </script>

    <script>
        $("#reset").click(function () {
            $('#balance_row').empty();
        });
    </script>
@endsection
