@extends('layouts.master')

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
            <a href="{{ route('products.index') }}">Products</a>
        </li>
        <li class="active">Unit</li>
    </ul>
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
    </div>
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
                        <span class="caption-subject bold uppercase">List Of Units</span>
                    </div>
                    <div class="btn-group">
                        <a href="#add" class="btn sbold red" data-toggle="modal" data-backdrop="static" data-keyboard="false"> Add New Unit
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                {{-- <th>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th> --}}
                                <th style="width:10%;"> Serial </th>
                                <th style="width:30%;"> Name </th>
                                <th style="width:50%;"> Description </th>
                                <th style="width:10%;"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($units as $i=>$unit)
                            <tr class="odd gradeX">
                                {{-- <td>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes" value="1" />
                                        <span></span>
                                    </label>
                                </td> --}}
                                <td>{{ $i+1 }}</td>
                                <td>{{ $unit->name }}</td>
                                <td>{{ $unit->description }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#edit{{ $unit->id }}" class="btn btn-xs sbold blue"  data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#delete{{ $unit->id }}" class="btn btn-xs sbold red" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>    
                                </td>
                            </tr>

                            {{-- Edit Modal --}}
                            <div class="modal fade bs-modal-md" id="edit{{ $unit->id }}"  role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('unit.update',$unit->id) }}" class="horizontal-form" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times font-red"></i>
                                                </button>
                                                <h4 class="modal-title">Edit Unit</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4">
                                                                <label class="control-label" for="name">Unit Name<span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                    <input type="text" id="name" name="name" class="form-control" value="{{ $unit->name }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4">
                                                                <label class="control-label" for="description">Description</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea name="description" id="description" rows="3" class="form-control">{{ $unit->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn blue btn-outline">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Delete Modal   --}}
                            <div class="modal fade bs-modal-md" id="delete{{ $unit->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('unit.destroy', $unit->id) }}" class="horizontal-form" method="POST">
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
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade bs-modal-md" id="add"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form action="{{ route('unit.store') }}" class="horizontal-form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times font-red"></i>
                    </button>
                    <h4 class="modal-title">Add A New Unit</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="control-label" for="name">Unit Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Unit Name" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="control-label" for="description">Description</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="description" id="description" rows="3" class="form-control" placeholder=" Category Description Here..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn blue btn-outline">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
    
@endsection
