@extends('layouts.master')
@section('head')
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Delivery</a>
        </li>
        <li>
            <span class="active">Persons</span>
        </li>
    </ul>
    
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        {{-- <i class="fa fa-truck"></i> --}}
                        <span class="caption-subject bold uppercase">Delivery Persons Lists</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a data-toggle="modal" href="#add" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add Delivery Person
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
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
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Delivery Person Name</th>
                                <th>Mobile Number</th>
                                <th>Person Type</th>
                                <th>Agents</th>
                                <th>Added By</th>
                                <th>Added Date</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($persons as $person)
                            <tr class="odd gradeX">
                                <td>{{ $person->contact_p_name }}</td>
                                <td>{{ $person->contact_p_phone }}</td>
                                <td>{{ $person->type }}</td>
                                @if($person->type=='Agent')
                                <td>{{ $person->agents->name }}</td>
                                @else
                                <td>No Agent</td>
                                @endif
                                <td>{{ $person->adds->name }}</td>
                                <td>{{ $person->created_at }}</td>
                                <td class="text-center">
                                    <a class="btn btn-xs sbold blue" data-toggle="modal" href="#edit{{ $person->id}}" data-backdrop="static" data-keyboard="false">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a data-toggle="modal" href="#delete{{$person->id}}" data-backdrop="static" data-keyboard="false" class="btn btn-xs sbold red">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            {{-- Modal Edit   --}}
                            <div class="modal fade bs-modal-lg" id="edit{{$person->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{route('delivery.persons.update',$person->id)}}" class="horizontal-form" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Edit Delivery Person</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    @if ($person->person_type ="Staff")
                                                    @if($person->staff_id)
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Person Type</label>
                                                                <input type="text" id="person_type" class="form-control" value="Staff" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden"name="person_type" class="form-control" value="Staff">
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Delivery Person Name</label>
                                                                <select class="form-control" name="staff" id="name" required>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}"  {{ $person->staffs->id == $user->id ? "selected" : "" }} >{{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Contact Number</label>
                                                                <input type="tel" id="contact_number" name="staff_contact_number" class="form-control" value="{{ $person->contact_p_phone}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                        @endif
                                                    @endif
                                                    @if ($person->person_type ="Agent")
                                                    @if ($person->agent_id)
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Person Type</label>
                                                                <input type="text" id="person_type" class="form-control" value="Agent" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden"name="person_type" class="form-control" value="Agent">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Agent Name</label>
                                                                <select class="form-control" name="agent" id="agent_name">
                                                                    @foreach ($agents as $agent)
                                                                        <option value="{{ $agent->id }}" {{ $person->agents->id == $agent->id ? "selected" : "" }}>{{ $agent->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Delivery Person's Name</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" id="name" name="agent_name" class="form-control" value="{{ $person->contact_p_name }}">
                                                            </div>
                                                        </div>
                            
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Delivery Person's Ph. Number</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="tel" id="number" name="agent_contact_number" class="form-control" value="{{ $person->contact_p_phone }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn blue btn-outline">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- /.Modal Edit --}}

                            {{-- Delete Modal   --}}
                            <div class="modal fade bs-modal-md" id="delete{{$person->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{route('delivery.persons.destroy', $person->id)}}" class="horizontal-form" method="POST">
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
                                                    <strong>Warning!</strong> Are you sure you want to delete this Delivery Person?
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

{{-- Modal Add --}}
<div class="modal fade bs-modal-lg" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('delivery.persons.store')}}" class="horizontal-form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times font-red"></i>
                    </button>
                    <h4 class="modal-title">Add Delivery Person</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Person Type</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control person_type" name="person_type" id="person_type" required>
                                        <option selected disabled>Select One</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Agent">Agent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row optional staff" style="display:none">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Delivery Person Name</label>
                                    <select class="form-control inputStaff" name="staff" id="name" required>
                                        <option value="" selected>Select One</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Contact Number</label>
                                    <input type="tel" id="contact_number" name="staff_contact_number" class="form-control inputStaff" placeholder="01*********">
                                </div>
                            </div>
                        </div>
                        <!--/row-->

                        <div class="row optional agent" style="display:none">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Agent Name</label>
                                    <select class="form-control inputAgent" name="agent" id="agent_name">
                                        <option value="" disabled selected>Select One</option>
                                    @foreach ($agents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Delivery Person's Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="name" name="agent_name" class="form-control inputAgent" placeholder="xxxx">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Delivery Person's Ph. Number</label>
                                    <span class="text-danger">*</span>
                                    <input type="tel" id="number" name="agent_contact_number" class="form-control inputAgent" placeholder="01611425480">
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn blue btn-outline">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- /.Modal Add --}}
@endsection

@section('script')
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script>
        $(".person_type").change(function () {
            $('.optional').css('display','none');
            $('.inputAgent').prop('disabled', true );
            $('.inputStaff').prop('disabled', true );
            $("select option:selected").each(function () {
                if($(this).val() == "Staff") {
                    $('.staff').toggle(500);
                    $('.inputStaff').prop('disabled', false );
                } else if($(this).val() == "Agent") {
                    $('.agent').toggle(500);
                    $('.inputAgent').prop('disabled', false);
                }
            });
        });
    </script>
@endsection