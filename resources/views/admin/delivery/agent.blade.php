@extends('layouts.master')
@section('head')
    
@endsection

@section('content')

<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="disabled">Delivery</li>
        <li class="active">Agents</li>
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
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List of Delivery Agents </span>
                    </div>
                    <div class="btn-group pull-right">
                        <a data-toggle="modal" href="#add" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add New Agent
                        </a>
                    </div> 
                </div>
                <div class="portlet-body">
                   
                    <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Agent Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Cont.&nbsp;Person&nbsp;Name</th>
                                <th>Cont.&nbsp;Person&nbsp;Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agents as $i=>$agent)
                            <tr class="odd gradeX">
                                <td>{{$i+1}}</td>
                                <td style="min-width:150px;">{{ $agent->name }}</td>
                                <td>{{ $agent->email }}</td>
                                <td>{{ $agent->mobile }}</td>
                                <td>{{ $agent->contact_person_name }}</td>
                                <td>{{ $agent->contact_person_phone }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs sbold blue" data-toggle="modal" href="#view{{$agent->id}}" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a class="btn btn-xs sbold blue" data-toggle="modal" href="#edit{{$agent->id}}" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a class="btn btn-xs sbold red" data-toggle="modal" href="#delete{{ $agent->id }}" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                    </div>
                                </td>
                            </tr>
                            {{-- Modal View   --}}
                            <div class="modal fade bs-modal-md" id="view{{$agent->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <h4 class="modal-title">Agent Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group borderless">
                                                <li class="list-group-item"><b>Agent Name : </b> &nbsp; &nbsp; &nbsp; &nbsp; {{ $agent->name }}</li>
                                                <li class="list-group-item"><b>Agent Mobile :</b>  &nbsp; &nbsp; &nbsp; &nbsp;{{ $agent->mobile }}</li>
                                                <li class="list-group-item"><b>Agent Email :</b>   &nbsp; &nbsp; &nbsp; &nbsp;{{ $agent->email }}</li>
                                                <li class="list-group-item"><b>Agent Address :</b>   &nbsp; &nbsp; &nbsp; &nbsp;{{ $agent->address }}</li>
                                                <li class="list-group-item"><b>Agent's Contact Person :</b>   &nbsp; &nbsp; &nbsp; &nbsp;{{ $agent->contact_person_name }}</li>
                                                <li class="list-group-item"><b>Contact Person's Phone Number :</b>   &nbsp; &nbsp; &nbsp; &nbsp;{{ $agent->contact_person_phone }}</li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- /.Modal View --}}

                            {{-- Modal Edit   --}}
                            <div class="modal fade bs-modal-lg" id="edit{{$agent->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{route('delivery.agent.update', $agent->id)}}" class="horizontal-form" method="POST">
                                        @csrf 
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <h4 class="modal-title">Agent Edit</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Agent Name</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" id="name" name="name" class="form-control" value="{{ $agent->name }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Agent Mobile</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" id="mobile" name="mobile" class="form-control" value="{{ $agent->mobile }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                            
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Address</label>
                                                                <input type="text" id="address" name="address" class="form-control" value="{{ $agent->address }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Email</label>
                                                                <input type="email" id="email" name="email" class="form-control" value="{{ $agent->email }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                            
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Contact Person Name</label>
                                                                <input type="text" id="contact_person_name" name="contact_person_name" class="form-control" value="{{ $agent->contact_person_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Contact Person Mobile</label>
                                                                <input type="tel" id="contact_person_mobile" name="contact_person_mobile" class="form-control" value="{{ $agent->contact_person_phone }}">
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
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade bs-modal-md" id="delete{{$agent->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{route('delivery.agent.destroy', $agent->id)}}" class="horizontal-form" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times"></i>
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
            <!-- /.table -->
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade bs-modal-lg" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{route('delivery.agent.store')}}" class="horizontal-form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times"></i>
                    </button>
                    <h4 class="modal-title">Agent</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Agent Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Agent Mobile</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="mobile" name="mobile" class="form-control" placeholder="mobile" required>
                                </div>
                            </div>
                        </div>
                        <!--/row-->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" placeholder="address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                        </div>
                        <!--/row-->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Contact Person Name</label>
                                    <input type="text" id="contact_person_name" name="contact_person_name" class="form-control" placeholder="Contact Person Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Contact Person Mobile</label>
                                    <input type="tel" id="contact_person_mobile" name="contact_person_mobile" class="form-control" placeholder="Contact Person Phone">
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
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')

@endsection