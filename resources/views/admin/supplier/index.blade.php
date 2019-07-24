@extends('layouts.master')
@section('head')

@endsection
@section('content')
<div class="page-content">
    
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home')}}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('supplier.index')}}">Supplier</a>
        </li>
        <li class="active">Supplier All</li>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List Of Suppliers</span>
                    </div>
                    <div class="btn-group">
                        <a href="#add" class="btn sbold red" data-toggle="modal"  data-backdrop="static" data-keyboard="false"> Add New Supplier</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr class="text-center">
                                <th>Serial</th>
                                <th>Code</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Contact Person</th>
                                <th>Contact Phone</th>
                                <th>Store</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            
                          @foreach ($suppliers as $i=>$supplier)   
                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $supplier->supplier_code }}</td>
                                <td><img src="{{ URL::to('storage/images/suppliers/'.$supplier->img) }}" alt="" style="height:50px; width:50px;"></td>
                                <td>{{ $supplier->supplier_name }}</td>
                                <td>{{ $supplier->contact_person }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->store_name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#view{{ $supplier->id }}" class="btn green btn-xs" data-toggle="modal"  data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#edit{{ $supplier->id }}" class="btn blue btn-xs" data-toggle="modal"  data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a data-toggle="modal" href="#delete{{ $supplier->id }}" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                            {{-- View Modal   --}}
                            <div class="modal fade bs-modal-lg" id="view{{ $supplier->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                <i class="fas fa-times font-red"></i>
                                            </button>
                                            <h4 class="modal-title">Supplier Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img src="{{ URL::to('storage/images/suppliers/'.$supplier->img) }}"  alt="Supplier Photo" class="img-responsive profile-square">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>Supplier Name</p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $supplier->supplier_name }}</p>
                                                        </div>
                                                    </div>
                                        
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>Supplier Code</p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $supplier->supplier_code }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>Contact Person</p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $supplier->contact_person }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>Phone Number</p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $supplier->phone }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>Email Address</p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $supplier->email }}</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>Store Name</p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $supplier->store_name }}</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>Vat Reg. No.</p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $supplier->vat_reg_num }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>Address</p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $supplier->address }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>Upazila</p>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <p class="colon">:</p>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <p>{{ $supplier->upazilas->name }}</p>
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
                                                            <p>{{ $supplier->description }}</p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>{{-- /.col-md-8 --}}
                                            </div>
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Delete Modal   --}}
                            <div class="modal fade bs-modal-md" id="delete{{ $supplier->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('supplier.destroy', $supplier->id ) }}" class="horizontal-form" method="POST">
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
                            {{-- Edit Modal --}}
                            <div class="modal fade bs-modal-lg" id="edit{{ $supplier->id }}" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('supplier.update', $supplier->id) }}" class="horizontal-form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times font-red"></i>
                                                </button>
                                                <h4 class="modal-title">Edit Supplier</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label" for="supplier_code">Supplier Code</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="text" id="supplier_code" name="supplier_code" class="form-control" value="{{ $supplier->supplier_code }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Supplier Name</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="text" id="supplier_name" name="supplier_name" class="form-control" value="{{ $supplier->supplier_name }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Contact Person</label>
                                                            <input type="text" id="contact_person" name="contact_person" class="form-control" value="{{ $supplier->contact_person }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label" for="email">Email Address</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="email" id="email" name="email" class="form-control" value="{{ $supplier->email }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Phone Number</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="tel" id="phone" name="phone" class="form-control" value="{{ $supplier->phone }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Store Name</label>
                                                            <input type="text" id="store" name="store" class="form-control" value="{{ $supplier->store_name }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label" for="email">Vat Registration No</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="text" id="vat" name="vat" class="form-control" value="{{ $supplier->vat_reg_num }}" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label" for="upazila">Location</label>
                                                            <select id="upazila" class="form-control select2" name="upazila" style="width:100%">
                                                                <option disabled selected>Select Location</option>
                                                                @foreach ($upazilas as $upazila)
                                                                <option value="{{ $upazila->id }}" {{ $supplier->upazila_id == $upazila->id? 'selected':'' }}>{{ $upazila->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                            
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label" for="address">Address</label>
                                                            <span class="text-danger">*</span>
                                                            <textarea class="form-control" name="address" id="address" rows="3">{{ $supplier->address }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label" for="description">Description</label>
                                                            <span class="text-danger">*</span>
                                                            <textarea class="form-control" name="description" id="description" rows="11">{{ $supplier->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label" for="img">Supplier Photo</label>
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
                                                                        <img src="{{ URL::to('storage/images/suppliers/'.$supplier->img) }}" alt="Supplier Photo" class="img-responsive" style="width: 200px; height: 200px;">
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn red btn-outline btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="img" id="img" accept="image/*"> </span>
                                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/row-->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn blue btn-outline">Submit</button>
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
<div class="modal fade bs-modal-lg" id="add" role="dialog">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('supplier.store') }}" class="horizontal-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times font-red"></i>
                    </button>
                    <h4 class="modal-title">Add A New Supplier</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="supplier_code">Supplier Code</label>
                                <span class="text-danger">*</span>
                                <input type="text" id="supplier_code" name="supplier_code" class="form-control" placeholder="Supplier Code" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Supplier Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" id="supplier_name" name="supplier_name" class="form-control" placeholder="Supplier Name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Contact Person</label>
                                <input type="text" id="contact_person" name="contact_person" class="form-control" placeholder="Contact Person" required>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="email">Email Address</label>
                                <span class="text-danger">*</span>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Phone Number</label>
                                <span class="text-danger">*</span>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Store Name</label>
                                <input type="text" id="store" name="store" class="form-control" placeholder="Store Name" required>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="email">Vat Registration No</label>
                                <span class="text-danger">*</span>
                                <input type="text" id="vat" name="vat" class="form-control" placeholder="Vat Registration No" required>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="upazila">Location</label>
                                <select id="upazila" class="form-control select2" name="upazila">
                                    <option disabled selected></option>
                                    @foreach ($upazilas as $upazila)
                                    <option value="{{ $upazila->id }}">{{ $upazila->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="address">Address</label>
                                <span class="text-danger">*</span>
                                <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="row">
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="description">Description</label>
                                <span class="text-danger">*</span>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="img">Supplier Photo</label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
                                            <img src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=DressUp" alt="" class="img-responsive" style="width: 200px; height: 200px;">
                                        </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="img" id="img" accept="image/*"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
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