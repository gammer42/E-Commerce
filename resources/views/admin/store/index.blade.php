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
            <a href="{{ route('store.index') }}">Store</a>
        </li>
        <li class="active">Store All</li>
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
                        <span class="caption-subject bold uppercase">List Of Stores</span>
                    </div>
                    <div class="btn-group">
                        <a href="#add" data-toggle="modal" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add New Store
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr>
                                <th style="display:none"></th>
                                <th style="width:8%">SL.</th>
                                <th style="width:25%">Store Name</th>
                                <th style="width:25%" data-orderable="false">Store Logo</th>
                                <th style="width:30%">Store Description</th>
                                <th style="width:7%" data-orderable="false">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                          @foreach ($stores as $i=>$store)   
                            <tr class="odd gradeX">
                                <td style="display:none"></td>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $store->name }}</td>
                                <td>
                                    <img src="{{ URL::to('storage/images/store/logos/'.$store->logo) }}" alt="" style="height:50px; width:50px;">
                                </td>
                                <td>{{ $store->description }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#view{{ $store->id }}" class="btn btn-xs sbold green"  data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#edit{{ $store->id }}" class="btn btn-xs sbold blue"  data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- <a href="#delete{{ $store->id }}" class="btn btn-xs sbold red" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a> -->
                                    </div>    
                                </td>
                            </tr>
                            <!-- View Modal -->
                            <div class="modal fade bs-modal-lg" id="view{{ $store->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                <i class="fas fa-times font-red"></i>
                                            </button>
                                            <h4 class="modal-title">Store Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <img src="{{ URL::to('storage/images/store/logos/'.$store->logo) }}" alt="store logo" class="img-responsive profile-square">
                                                                </div>          
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <p><b>Store Name</b></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p class="colon">:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p>{{ $store->name }}</p>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <p><b>Email Address</b></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p class="colon">:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p>{{ $store->email }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <p><b>Phone Number</b></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p class="colon">:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p>{{ $store->phone }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <p><b>VAT Number</b></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p class="colon">:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p>{{ $store->vat_no }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <p><b>City</b></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p class="colon">:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p>{{ $store->city }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <p><b>Location</b></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p class="colon">:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p>{{ $store->location }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <p><b>Post Code</b></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p class="colon">:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p>{{ $store->post_code }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <p><b>Address</b></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p class="colon">:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p>{{ $store->address }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <p><b>Description</b></p>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <p class="colon">:</p>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <p>{{ $store->description }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Edit Modal --}}
                            <div class="modal fade bs-modal-lg" id="edit{{ $store->id }}"  role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('store.update',$store->id) }}" class="horizontal-form" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times font-red"></i>
                                                </button>
                                                <h4 class="modal-title">Edit Store</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label" for="name">Store Name</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" id="name" name="name" class="form-control" value="{{ $store->name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label" for="email">Email</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="email" id="email" name="email" class="form-control" value="{{ $store->email }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label" for="phone">Phone</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" id="phone" name="phone" class="form-control" value="{{ $store->phone }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label" for="vat">VAT No.</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" id="vat" name="vat_no" class="form-control" value="{{ $store->vat_no }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                            
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label" for="name">City</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" id="name" name="city" class="form-control" value="{{ $store->city }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label" for="location">Location</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" id="location" name="location" class="form-control" value="{{ $store->location }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label" for="post_code">Post Code</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" id="post_code" name="post_code" class="form-control" value="{{ $store->post_code }}" required>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <!--/row-->
                                                
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label" for="address">Address</label>
                                                                <span class="text-danger">*</span>
                                                                <textarea name="address" id="address" rows="3"  class="form-control">{{ $store->address }}</textarea>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label" for="description">Description</label>
                                                                <textarea name="description" id="description" rows="3"  class="form-control">{{ $store->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                            
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="control-label">Store Logo</label>
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
                                                                        <img src="{{ URL::to('storage/images/store/logos/'.$store->logo) }}" alt="store logo" class="img-responsive" style="width: 200px; height: 200px;">
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn red btn-outline btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="logo" value="{{ $store->logo }}" accept="image/*"> </span>
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
                                                <button type="submit" class="btn blue btn-outline">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- Delete Modal   --}}
                            <div class="modal fade bs-modal-md" id="delete{{ $store->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('store.destroy', $store->id) }}" class="horizontal-form" method="POST">
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
<div class="modal fade bs-modal-lg" id="add"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('store.store') }}" class="horizontal-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times font-red"></i>
                    </button>
                    <h4 class="modal-title">Add A New Store</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="name">Store Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <span class="text-danger">*</span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="phone">Phone</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="vat">VAT No.</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="vat" name="vat_no" class="form-control" placeholder="VAT Number" required>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="name">City</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="name" name="city" class="form-control" placeholder="City Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="location">Location</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="location" name="location" class="form-control" placeholder="Location" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="post_code">Post Code</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="post_code" name="post_code" class="form-control" placeholder="Post Code" required>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="address">Address</label>
                                    <span class="text-danger">*</span>
                                    <textarea name="address" id="address" rows="3"  class="form-control"  placeholder="Address Here.."></textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <textarea name="description" id="description" rows="3"  class="form-control"  placeholder="Store's Description Here.."></textarea>
                                </div>
                            </div>
                        </div>
                        <!--/row-->

                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label">Store Logo</label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
                                            <img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" class="img-responsive" style="width: 200px; height: 200px;">
                                        </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="logo" accept="image/*"> </span>
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
                    <button type="submit" class="btn blue btn-outline">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
    
@endsection