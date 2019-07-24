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
        <li class="active">Brand</li>
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
                        <span class="caption-subject bold uppercase">List Of Brands</span>
                    </div>
                    <div class="btn-group">
                        <a data-toggle="modal" href="#add" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add New Brand
                        </a>
                    </div> 
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr class="text-center">
                                <th style="width:8%">SL.</th>
                                <th style="width:25%">Brand Name</th>
                                <th style="width:25%">Brand Logo</th>
                                <th style="width:30%">Brand Description</th>
                                <th style="width:12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $i=>$brand)
                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $brand->name }}</td>
                                <td><img src="{{ URL::to('storage/images/brands/'.$brand->logo) }}" alt="" style="height:50px; width:50px;"></td>
                                <td>{{ $brand->description }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#edit{{ $brand->id }}" class="btn btn-xs sbold blue"  data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a  href="#delete{{ $brand->id }}" class="btn btn-xs sbold red" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                    </div>    
                                </td>
                            </tr>

                            {{-- Edit Modal --}}
                            <div class="modal fade bs-modal-md" id="edit{{ $brand->id }}"  role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('brands.update',$brand->id) }}" class="horizontal-form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times font-red"></i>
                                                </button>
                                                <h4 class="modal-title">Edit Brand</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4">
                                                                <label class="control-label" for="brand_name">Bramd Name<span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="brand_name" name="name" class="form-control" value="{{ $brand->name }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                            
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4">
                                                                <label class="control-label" for="description">Description<span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea name="description" id="description" rows="3" class="form-control" required>{{ $brand->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                            
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4">
                                                                <label class="control-label" for="logo">Brand Logo<span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 120px; height: 120px;">
                                                                            <img src="{{ URL::to('storage/images/brands/'.$brand->logo) }}" alt="" class="img-responsive" style="width: 200px; height: 200px;">
                                                                        </div>
                                                                        <div>
                                                                            <span class="btn red btn-outline btn-file">
                                                                                <span class="fileinput-new"> Select image </span>
                                                                                <span class="fileinput-exists"> Change </span>
                                                                                <input type="file" name="image" id="logo" value="{{ $brand->logo }}" accept="image/*"></span>
                                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                            <div class="modal fade bs-modal-md" id="delete{{ $brand->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('brands.destroy', $brand->id) }}" class="horizontal-form" method="POST">
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
        <form action="{{ route('brands.store') }}" class="horizontal-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times font-red"></i>
                    </button>
                    <h4 class="modal-title">Add A New Brand</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="control-label" for="brand_name">Bramd Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                        <input type="text" id="brand_name" name="name" class="form-control" placeholder="Brand Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="control-label" for="description">Description<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="description" id="description" rows="3" class="form-control" placeholder=" Brand Description Here..." required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="control-label" for="logo">Brand Logo<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 120px; height: 120px;">
                                                <img src="http://www.placehold.it/120x120/EFEFEF/AAAAAA&amp;text=no+image" alt="" class="img-responsive" style="width: 200px; height: 200px;">
                                            </div>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="image" id="logo" accept="image/*"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
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
