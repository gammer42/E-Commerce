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
        <li>
            <a href="{{ route('sales.index') }}">Sales</a>
        </li>
        <li class="active">Sales Person</li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-12">
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
                        <span class="caption-subject bold uppercase">List Of Sales Persons</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a data-toggle="modal" href="#add" class="btn sbold red" data-backdrop="static" data-keyboard="false">Add Sale Person</a>
                    </div>
                </div>
                <div class="portlet-body">
                    
                    <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Person name</th>
                                <th>User Type</th>
                                <th>Phone</th>
                                <th>Commission</th>
                                <th>Balance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($persons as $i=>$person)
                            <tr class="odd gradeX">
                                <td>{{$i+1}}</td>
                                <td>{{ $person->name }}</td>
                                <td>{{ $person->type }}</td>
                                <td>{{ $person->phone }}</td>
                                <td>{{ $person->commission }}</td>
                                <td>{{ $person->balance }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a data-toggle="modal" href="#edit{{$person->id}}" class="btn blue btn-xs" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a data-toggle="modal" href="#delete" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                    </div>
                                </td>

                                {{-- Edit Modal --}}
                                <div class="modal fade bs-modal-md" id="edit{{$person->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <form action="{{route('person.update', $person->id)}}" class="horizontal-form" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Edit Sale Person</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-4">
                                                                    <label class="control-label" for="person_type_edit">Person Type<span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <select class="form-control" onclick="person_id({{$person->id}})" name="person_type" id="person_type_edit{{$person->id}}" required>
                                                                        <option value="" selected disabled>Select One</option>
                                                                        <option value="Customer"{{$person->type=="Customer"?"selected":""}}>Customer</option>
                                                                        <option value="User"{{$person->type=="User"?"selected":""}}>User</option>
                                                                        <option value="Investor"{{$person->type=="Investor"?"selected":""}}>Investor</option>
                                                                        <option value="Supplier"{{$person->type=="Supplier"?"selected":""}}>Supplier</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                
                                                        <div class="row person_row_edit" id="per_name_edit{{$person->id}}">
                                                            <div class="form-group" id="per_edit{{$person->id}}">
                                                                <div class="col-md-4">
                                                                    <label class="control-label" for="person_name">Person Name<span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6" id="per_select_edit{{$person->id}}">
                                                                    @if($person->type=="Customer")
                                                                    <select class="form-control customer" name="person" id="customer_edit{{$person->id}}" required>
                                                                        <option value="" selected disabled>Select One</option>
                                                                        @foreach($customers as $customer)
                                                                        <option value="{{$customer->id}}" {{$person->fk_id==$customer->id?"selected":""}}>{{$customer->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @elseif($person->type=="Supplier")
                                                                    <select class="form-control supplier" name="person" id="supplier_edit{{$person->id}}" required>
                                                                        <option value="" selected disabled>Select One</option>
                                                                        @foreach($suppliers as $supplier)
                                                                        <option value="{{$supplier->id}}" {{$person->fk_id==$supplier->id?"selected":""}}>{{$supplier->supplier_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @else
                                                                    <select class="form-control person" name="person" id="person_edit{{$person->id}}" required>
                                                                        <option value="" selected disabled>Select One</option>
                                                                        @foreach($users as $user)
                                                                        <option value="{{$user->id}}" {{$person->fk_id==$user->id?"selected":""}}>{{$user->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row person_row_edit">
                                                            <div class="form-group">
                                                                <div class="col-md-4">
                                                                    <label class="control-label" for="commission">Commission(%)<span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="text" name="commission" id="commission" value="{{ $person->commission }}" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/row-->
                                                    </div>
                                                    <!--/form-body-->
                                                </div>
                                                <!--/modal-body-->
                                                <div class="modal-footer">
                                                    <button type="button" id="reset" onclick="e_reset({{$person->id}})" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn blue btn-outline">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- Delete Modal   --}}
                                {{-- <div class="modal fade bs-modal-md" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <form action="#" class="horizontal-form" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title"><b>Delete this entry</b></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-danger">
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
                                </div> --}}
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

{{-- Add Modal --}}
<div class="modal fade bs-modal-md" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form action="{{route('person.store')}}" class="horizontal-form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Add Sale Person</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="control-label" for="person_type">Person Type<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" name="person_type" id="person_type" required>
                                        <option selected disabled>Select One</option>
                                        <option value="Customer">Customer</option>
                                        <option value="User">User</option>
                                        <option value="Investor">Investor</option>
                                        <option value="Supplier">Supplier</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/row-->

                        <div class="row person_row per_name" style="display:none" id="per_name">
                            
                        </div>
                        <!--/row-->
                        <div class="row person_row" style="display:none">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="control-label" for="commission">Commission(%)<span class="text-danger">*</span></label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="commission" id="commission" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <!--/form-body-->
                </div>
                <!--/modal-body-->
                <div class="modal-footer">
                    <button type="button" id="add_reset" class="btn red btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn blue btn-outline">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')

    <script>
        $("#person_type").change(function () {
 
            let type = $(this).val();
            if(type==='Customer'){
                $('#per_name').html('<div class="form-group">'+
                                '<div class="col-md-4">'+
                                    '<label class="control-label" for="person">Person Name<span class="text-danger">*</span></label>'+
                                '</div>'+
                                '<div class="col-md-6" >'+
                                    '<select class="form-control person" name="person" id="person" required>'+
                                        '<option value="" selected disabled>Select One</option>'+
                                        '@foreach($users as $user)'+
                                        '<option value="{{$user->id}}">{{$user->name}}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                    '<select class="form-control customer" name="person" id="customer" required>'+
                                        '<option value="" selected disabled>Select One</option>'+
                                        '@foreach($customers as $customer)'+
                                        '<option value="{{$customer->id}}">{{$customer->name}}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                    '<select class="form-control supplier" name="person" id="supplier" required>'+
                                        '<option value="" selected disabled>Select One</option>'+
                                        '@foreach($suppliers as $supplier)'+
                                        '<option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                '</div>'+
                            '</div>');
                $('#supplier').remove();
                $('#person').remove();
            }
            else if(type==='Supplier'){
                $('#per_name').html('<div class="form-group">'+
                                '<div class="col-md-4">'+
                                    '<label class="control-label" for="person">Person Name<span class="text-danger">*</span></label>'+
                                '</div>'+
                                '<div class="col-md-6" >'+
                                    '<select class="form-control person" name="person" id="person" required>'+
                                        '<option value="" selected disabled>Select One</option>'+
                                        '@foreach($users as $user)'+
                                        '<option value="{{$user->id}}">{{$user->name}}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                    '<select class="form-control customer" name="person" id="customer" required>'+
                                        '<option value="" selected disabled>Select One</option>'+
                                        '@foreach($customers as $customer)'+
                                        '<option value="{{$customer->id}}">{{$customer->name}}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                    '<select class="form-control supplier" name="person" id="supplier" required>'+
                                        '<option value="" selected disabled>Select One</option>'+
                                        '@foreach($suppliers as $supplier)'+
                                        '<option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                '</div>'+
                            '</div>');
                $('#customer').remove();
                $('#person').remove();
            }
            else {
                $('#per_name').html('<div class="form-group">'+
                                '<div class="col-md-4">'+
                                    '<label class="control-label" for="person">Person Name<span class="text-danger">*</span></label>'+
                                '</div>'+
                                '<div class="col-md-6" >'+
                                    '<select class="form-control person" name="person" id="person" required>'+
                                        '<option value="" selected disabled>Select One</option>'+
                                        '@foreach($users as $user)'+
                                        '<option value="{{$user->id}}">{{$user->name}}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                    '<select class="form-control customer" name="person" id="customer" required>'+
                                        '<option value="" selected disabled>Select One</option>'+
                                        '@foreach($customers as $customer)'+
                                        '<option value="{{$customer->id}}">{{$customer->name}}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                    '<select class="form-control supplier" name="person" id="supplier" required>'+
                                        '<option value="" selected disabled>Select One</option>'+
                                        '@foreach($suppliers as $supplier)'+
                                        '<option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                '</div>'+
                            '</div>');
                $('#customer').remove();
                $('#supplier').remove();
            }

            $('.person_row').css('display','none');
            $("select option:selected").each(function () {
                $('.person_row').show();
            });
        });
    </script>

    <script>
        function person_id(id){
        $("#person_type_edit"+id).change(function () {
            $('.person_row_edit').css('display','none');
            $("select option:selected").each(function () {
                $('.person_row_edit').show();
            });
            let type = $(this).val();
            $('#per_select_edit'+id).remove();
            $('#per_edit'+id).html('<div class="col-md-4">'+
                '<label class="control-label" for="person_name">Person Name<span class="text-danger">*</span></label>'+
                '</div><div class="col-md-6" id="per_select_edit'+id+'">'+'</div>');
            c='<select class="form-control customer" name="person" id="customer_edit'+id+'" required>'+
                    '<option value="" selected disabled>Select One</option>'+
                    '@foreach($customers as $customer)'+
                    '<option value="{{$customer->id}}">{{$customer->name}}</option>'+
                    '@endforeach'+
                '</select>';
            s='<select class="form-control supplier" name="person" id="supplier_edit'+id+'" required>'+
                    '<option value="" selected disabled>Select One</option>'+
                    '@foreach($suppliers as $supplier)'+
                    '<option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>'+
                    '@endforeach'+
                '</select>';
            u='<select class="form-control person" name="person" id="person_edit'+id+'" required>'+
                    '<option value="" selected disabled>Select One</option>'+
                    '@foreach($users as $user)'+
                    '<option value="{{$user->id}}">{{$user->name}}</option>'+
                    '@endforeach'+
                '</select>';
            if(type=='Customer'){
                $('#per_select_edit'+id).empty().html(c);
            }
            if(type=='Supplier'){
                $('#per_select_edit'+id).empty().html(s);
            }
            if(type=='Investor' || type=='User'){
                $('#per_select_edit'+id).empty().html(u);
            }
            
        });}
    </script>

    <script>
        function e_reset(id){
            $("#reset").click(function () {
                $('#per_edit'+id).remove();
                $('$per_name_edit'+id).html('<div class="form-group" id="per_edit{{$person->id}}"><div class="col-md-4"><label class="control-label" for="person_name">Person Name<span class="text-danger">*</span></label></div><div class="col-md-6" id="per_select_edit{{$person->id}}">@if($person->type=="Customer")<select class="form-control customer" name="person" id="customer_edit{{$person->id}}" required><option value="" selected disabled>Select One C</option>@foreach($customers as $customer)<option value="{{$customer->id}}" {{$person->fk_id==$customer->id?"selected":""}}>{{$customer->name}}</option>@endforeach</select>@elseif($person->type=="Supplier")<select class="form-control supplier" name="person" id="supplier_edit{{$person->id}}" required><option value="" selected disabled>Select One S</option>@foreach($suppliers as $supplier)<option value="{{$supplier->id}}" {{$person->fk_id==$supplier->id?"selected":""}}>{{$supplier->supplier_name}}</option>@endforeach</select>@else<select class="form-control person" name="person" id="person_edit{{$person->id}}" required><option value="" selected disabled>Select One U</option>@foreach($users as $user)<option value="{{$user->id}}" {{$person->fk_id==$user->id?"selected":""}}>{{$user->name}}</option>@endforeach</select>@endif</div></div>');
                $('.person_row').css('display','none');
            });
        }
        $("#add_reset").click(function () {
            $('.person_row').css('display','none');
        });
    </script>
    
@endsection