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
        <li class="active">Categories</li>
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
                        <span class="caption-subject bold uppercase">List Of Product Categories</span>
                    </div>
                    <div class="btn-group">
                        <a href="#add" class="btn sbold red" data-toggle="modal" data-backdrop="static" data-keyboard="false"> Add New Category
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr class="text-center">
                                <th>Serial</th>
                                <th>Category Name</th>
                                <th>Parent Category Name</th>
                                <th>Category Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($categories as $i=>$category)
                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $category->name }}</td>
                                @if(isset($category->parent->name))
                                <td>{{ $category->parent->name }}</td>
                                @else
                                <td>No Parent Category</td>
                                @endif
                                <td>{{ $category->description }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="#edit{{ $category->id }}" class="btn btn-xs sbold blue"  data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a href="#delete{{ $category->id }}" class="btn btn-xs sbold red" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                    </div>    
                                </td>
                                <!-- Delete Modal -->
                                <div class="modal fade bs-modal-md" id="delete{{ $category->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{ route('categories.destroy', $category->id) }}" class="horizontal-form" method="POST">
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
                                <!-- Edit Modal -->
                                <div class="modal fade bs-modal-md" id="edit{{ $category->id }}"  role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{ route('categories.update', $category->id) }}" class="horizontal-form" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                        <i class="fas fa-times font-red"></i>
                                                    </button>
                                                    <h4 class="modal-title">Edit Category</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4">
                                                                    <label class="control-label" for="cat_name">Category Name<span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="text" id="cat_name" name="cat_name" class="form-control" value="{{ $category->name }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4">
                                                                    <label class="control-label" for="sub_name">Parent Category<span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <select class="form-control select2" name="sub_name">
                                                                        <option value="{{ $category->id }}"{{ $category->id == $category->parent_id ? "selected" : "" }}>{{ $category->name }}</option>
                                                                        @foreach($p_categories as $p_category)
                                                                        <option value="{{ $p_category->id }}">{{ $p_category->name }}</option>
                                                                        @endforeach
                                                                        <option value="0">Also as Parent</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4">
                                                                    <label class="control-label" for="description">Description</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <textarea name="description" id="description" rows="3" class="form-control">{{ $category->description }}</textarea>
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
                                
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade bs-modal-md" id="add" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form action="{{ route('categories.store') }}" class="horizontal-form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times font-red"></i>
                    </button>
                    <h4 class="modal-title">Add A New Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="control-label" for="cat_name">Category Name<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                        <input type="text" id="cat_name" name="cat_name" class="form-control" placeholder="Category Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="control-label" for="sub_name">Parent Category<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control select parent category" name="sub_name">
                                        <option value="" selected disabled>Select One</option>
                                        <option value="0">Also as Parent</option>
                                        @foreach($p_categories as $p_category)
                                            <option value="{{ $p_category->id }}">{{ $p_category->name }}</option>
                                        @endforeach
                                    </select>
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
