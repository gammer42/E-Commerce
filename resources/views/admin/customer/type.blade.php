@extends('layouts.master')

@section('head')

@endsection

@section('content')
<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('customer.index') }}">Customers</a>
        </li>
        <li class="active">Type</li>
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
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Customer Types</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a data-toggle="modal" href="#add" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add New Type
                        </a>
                    </div>  
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Customer Type</th>
                                <th>Dis.(%)</th>
                                <th>Target Sale(BDT)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customerTypes as $i=>$type) 
                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $type->type_name }}</td>
                                <td>{{ $type->discount }}</td>
                                <td>{{ $type->target_sale }}</td>
                                <td>
                                    <div class="btn-group">
                                        <form action="{{ route('customertype.destroy',$type->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')    
                                            <a class="btn btn-xs sbold blue" data-toggle="modal" href="#edit{{ $type->id }}" data-backdrop="static" data-keyboard="false">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="btn btn-xs sbold red" data-toggle="modal" href="#delete{{ $type->id }}" data-backdrop="static" data-keyboard="false">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </form>
                                    </div>
                                    <div class="modal fade bs-modal-lg" id="edit{{ $type->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                        <i class="fas fa-times font-red"></i>
                                                    </button>
                                                    <h4 class="modal-title">Customer Type</h4>
                                                </div>
                                                <form action="{{ route('customertype.update',$type->id) }}" class="form" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Type Name</label>
                                                                        <span class="text-danger">*</span>
                                                                        <input type="text" id="type_name" name="type_name" class="form-control" value="{{ $type->type_name }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Type Discount (%)</label>
                                                                        <span class="text-danger">*</span>
                                                                        <input type="text" id="type_discount" name="type_discount" class="form-control" value="{{ $type->discount }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Target Sale (BDT)</label>
                                                                        <span class="text-danger">*</span>
                                                                        <input type="text" id="target_sale" name="target_sale" class="form-control" value="{{ $type->target_sale }}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/row-->
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn blue btn-outline">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->

                                    {{-- Delete Modal   --}}
                                    <div class="modal fade bs-modal-md" id="delete{{ $type->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                            <form action="{{ route('customertype.destroy',$type->id) }}" class="horizontal-form" method="POST">
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
                                                        <button type="submit" class="btn blue btn-outline">Yes <i class="fas fa-check"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade bs-modal-lg" id="add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times font-red"></i>
                    </button>
                    <h4 class="modal-title">Customer Type</h4>
                </div>
                <form action="{{ route('customertype.store') }}" class="form" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Type Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" id="type_name" name="type_name" class="form-control" placeholder="Type Name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Type Discount (%)</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" id="type_discount" name="type_discount" class="form-control" placeholder="Type Discount" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Target Sale (BDT)</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" id="target_sale" name="target_sale" class="form-control" placeholder="Target Sale" required>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn blue btn-outline">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>

@endsection

@section('script')
   
@endsection
