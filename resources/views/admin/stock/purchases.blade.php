@extends('layouts.master')
@section('head')

@endsection
@section('php')
    <?php

    ?>
@endsection
@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('purchases') }}">Purchase</a>
        </li>
        <li class="active">Purchase Details</li>
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
                        <span class="caption-subject bold uppercase">List Of Purchases</span>
                    </div>
                    <div class="btn-group">
                        <a data-toggle="modal" href="#add" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add New Purchase
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                            <tr class="text-center">
                                <th>#SL.</th>
                                <th>Invoice ID.</th>
                                <th>Amount</th>
                                <th>Supplier Name</th>
                                <th>Memo</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $i=>$purchase)
                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $purchase->invoice_no }}</td>
                                <td>{{ $purchase->price }}</td>
                                <td>{{ $purchase->suppliers->supplier_name }}</td>
                                <td>
                                    <img src="{{ url('storage/images/purchase/memo/'.$purchase->memo) }}" alt="memo" class="img-rounded" style="width:150px; height:70px">
                                </td>
                                <td>{{ $purchase->date}}</td>
                                <td>
                                    <a href="#view{{ $purchase->id }}" data-toggle="modal" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold green">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a data-toggle="modal" href="#edit{{ $purchase->id }}" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold blue">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a data-toggle="modal" href="#delete{{ $purchase->id }}" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold red">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                 {{-- View Modal --}}
                                <div class="modal fade bs-modal-md" id="view{{$purchase->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Purchase Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <img src="{{ url('storage/images/purchase/memo/'.$purchase->memo) }}" alt="memo" class="img-responsive center-block">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Edit Modal --}}
                                <div class="modal fade bs-modal-md" id="edit{{ $purchase->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{ route('purchases.update',$purchase->id ) }}" class="horizontal-form" enctype="multipart/form-data" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                        <i class="fas fa-times font-red"></i>
                                                    </button>
                                                    <h4 class="modal-title">Purchase</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Invoice ID.</label>
                                                                    <span class="text-danger">*</span>
                                                                    <input type="text" id="invoice" name="invoice" class="form-control" value="{{ $purchase->invoice_no }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Total Price</label>
                                                                    <span class="text-danger">*</span>
                                                                    <input type="text" id="price" name="price" class="form-control" value="{{ $purchase->price }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Supplier Name</label>
                                                                    <span class="text-danger">*</span>
                                                                    <select class="form-control" name="supplier" id="supplier">
                                                                        @foreach($suppliers as $supplier)
                                                                        <option value="{{ $supplier->id }}"{{$purchase->supplier_id==$supplier->id? 'selected':''}}>{{ $supplier->supplier_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Memo</label>
                                                                    <div class="input-group fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width:100%; max-height:200px;">
                                                                            <img src="{{ url('storage/images/purchase/memo/'.$purchase->memo) }}" alt="" /> </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%; max-height: 200px;"> </div>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Select image </span>
                                                                                <span class="fileinput-exists"> Change </span>
                                                                                <input type="file" name="memo" accept="image/*">
                                                                            </span>
                                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                            <br>
                                                                            <span class="text-primary"><small>Use jpg,jpeg,png,gif only.</small></span> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Purchase Date</label>
                                                                    <span class="text-danger">*</span>
                                                                    <input class = "form-control  date-picker" type = "text" value="{{ $purchase->date }}" id = "date">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn default" type="button">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn green btn-outline">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- Modal Delete   --}}
                                <div class="modal fade bs-modal-md" id="delete{{ $purchase->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{ route('purchases.destroy', $purchase->id) }}" class="horizontal-form" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                        <i class="fas fa-times font-red"></i>
                                                    </button>
                                                    <h4 class="modal-title">Delete this entry</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="font-red">
                                                        <strong>Warning!</strong> Are you sure you want to delete this Record?
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn red btn-outline" data-dismiss="modal"><i class="fas fa-times"></i> No</button>
                                                    <button type="submit" class="btn blue btn-outline">Yes <i class="fa fa-check"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>   
                            </tr>
                           
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    {{-- Modal Add --}}
    <div class="modal fade bs-modal-md" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form action="{{ route('purchases.store') }}" class="horizontal-form" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                            <i class="fas fa-times font-red"></i>
                        </button>
                        <h4 class="modal-title">Purchase</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Invoice ID.</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" id="invoice" name="invoice" class="form-control" placeholder="A000191" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Total Price</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" id="price" name="price" class="form-control" placeholder="A000191" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Supplier Name</label>
                                        <span class="text-danger">*</span>
                                        <select class="form-control" name="supplier" id="supplier">
                                            <option value="" selected disabled>Select One</option>
                                            @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Purchase Date</label>
                                    <span class="text-danger">*</span>
                                    <div class="input-group date date-picker pull-left">
                                        <input name="date" class="form-control" type="text" id ="date">
                                        <span class="input-group-btn">
                                            <button class="btn default date-set" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Memo</label>
                                        <div class="input-group fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width:100%; max-height:200px;">
                                                <img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%; max-height: 200px;"> </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="memo" accept="image/*">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn green btn-outline">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
   
@endsection