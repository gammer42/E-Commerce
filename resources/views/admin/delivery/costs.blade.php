@extends('layouts.master')
@section('head')
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')

<div class="page-content">
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}">Home</a>
        </li>
        <li>
            <a href="#">Delivery</a>
        </li>
        <li>
            <span class="active">Costs</span>
        </li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        {{-- <i class="icon-user font-red"></i> --}}
                        <span class="caption-subject bold uppercase">Delivery Cost Lists</span>
                    </div>
                    <div class="btn-group pull-right">
                        <a data-toggle="modal" href="#add" class="btn sbold red" data-backdrop="static" data-keyboard="false"> Add Delivery Cost
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
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Delivery&nbsp;Person&nbsp;Name</th>
                                <th>Delivery&nbsp;Type</th>
                                <th>Agent&nbsp;Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($costs as $i=>$cost)
                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $cost->persons->contact_p_name }}</td>
                                <td>{{ $cost->persons->type}}</td>
                                <td>
                                    @if($cost->persons->agents)
                                        {{ $cost->persons->agents->name }}
                                    @else
                                        No Agent
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#view{{ $cost->id }}" class="btn btn-xs sbold green" data-toggle="modal"  data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#edit{{ $cost->id }}" class="btn btn-xs sbold blue" data-toggle="modal"  data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#delete{{ $cost->id }}" class="btn btn-xs sbold red" data-toggle="modal"  data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                                {{-- <table></table> --}}
                            </tr>
                            {{-- Modal View   --}}
                            <div class="modal fade bs-modal-md" id="view{{ $cost->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                <i class="fas fa-times font-red"></i>
                                            </button>
                                            <h4 class="modal-title">Delivery Cost Details</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <p><b>Delivery Person Name</b></p>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="colon">:</p>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <p>{{ $cost->persons->contact_p_name }}</p>
                                                                </div>
                                                            </div>
                                                            @if($cost->persons->staff_id)
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <p><b>Delivery Person Phone</b></p>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="colon">:</p>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <p>{{ $cost->persons->contact_p_phone }}</p>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <p><b>Delivery Cost Name</b></p>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="colon">:</p>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <p>{{ $cost->cost_name }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <p><b>Delivery Type</b></p>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="colon">:</p>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <p>{{ $cost->persons->type }}</p>
                                                                </div>
                                                            </div>
                                                            @if($cost->persons->agent_id)
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <p><b>Agent Name</b></p>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <p class="colon">:</p>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <p>{{ $cost->persons->agents->name }}</p>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <strong class="font-red"><b>Cost Configure for Weight</strong></h4>
                                                </div>
                                                <br>
                                                <div class="col-md-12">
                                                    <div class="rTable" id="editTable{{ $cost->id }}">
                                                        <div class="rTableRow">
                                                            <div class="rTableHead text-center"><strong>From(gm)</strong></div>
                                                            <div class="rTableHead text-center"><strong>To(gm)</strong></div>
                                                            <div class="rTableHead text-center"><strong>Price</strong></div>

                                                        </div>

                                                        @foreach($cost->rates as $cost_config)
                                                            <div class="rTableRow" id="rowTable">
                                                                <div class="rTableCell text-center">{{ $cost_config->from }}</div>
                                                                <div class="rTableCell text-center"> {{ $cost_config->to }}</div>
                                                                <div class="rTableCell text-center">{{ $cost_config->rate }}</div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn red btn-outline" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- /.Modal View --}}

                            {{-- Edit Modal   --}}
                            <div class="modal fade bs-modal-lg" id="edit{{ $cost->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('delivery.cost.update', $cost->id) }}" class="horizontal-form" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                                                    <i class="fas fa-times font-red"></i>
                                                </button>
                                                <h4 class="modal-title">Edit Delivery Cost</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    @if($cost->persons->type=='Agent')
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Person Type</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" class="form-control" name="person_type" value="Agent" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Agent Name</label>
                                                                <span class="text-danger">*</span>
                                                                <select class="form-control agent_name_edit" name="agent_name" id="agent_name" required>
                                                                    @foreach ($agents  as $agent)
                                                                    <option value="{{$agent->id}}"{{ $cost->delivery_person == $agent->id ?"selected":"" }}>{{$agent->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Agent Person Name</label>
                                                                <span class="text-danger">*</span>
                                                                <select class="form-control agent_person_edit" name="agent_person" id="agent_person_edit">
                                                                    @foreach ($agent_persons  as $agent)
                                                                        <option value="{{$agent->id}}"{{ $cost->delivery_person == $agent->id ? "selected":"" }}>{{$agent->contact_p_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Delivery Cost Name</label>
                                                                <span class="text-danger">*</span>
                                                                <input type="text" id="delivery_cost" name="delivery_cost" class="form-control" value="{{$cost->cost_name}}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <!--/row-->
                                                    @if($cost->persons->type=='Staff')
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Person Type</label>
                                                                    <span class="text-danger">*</span>
                                                                    <input type="text" class="form-control" name="person_type" value="Staff" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Select Staff Person Name</label>
                                                                    <span class="text-danger">*</span>
                                                                    <select class="form-control" name="agent_name" id="agent_name" required>
                                                                        <option value="" selected>Select One</option>
                                                                        @foreach ($staffs  as $staff)
                                                                        <option value="{{$staff->id}}" {{$cost->persons->staff_id == $staff->staff_id?'selected':''}}>{{$staff->contact_p_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Delivery Cost Name</label>
                                                                    <span class="text-danger">*</span>
                                                                    <input type="text" id="delivery_cost" name="delivery_cost" class="form-control" value="{{$cost->cost_name}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <strong class="font-red"><b>Cost Configure for Weight</strong></h4>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="rTable" id="editTable{{ $cost->id }}">
                                                                <div class="rTableRow">
                                                                    <div class="rTableHead text-center"><strong>From(gm)</strong></div>
                                                                    <div class="rTableHead text-center"><strong>To(gm)</strong></div>
                                                                    <div class="rTableHead text-center"><strong>Price</strong></div>
                                                                    <div class="rTableHead text-center"><button type="button"  value="{{ $cost->id }}" class="btn btn-success addRow"><i class="fas fa-plus"></i></button></div>
                                                                </div>

                                                                @foreach($cost->rates as $cost_config)
                                                                    <div class="rTableRow" id="rowTable">
                                                                        <div class="rTableCell text-center"><input type="text" name="from[]" value="{{$cost_config->from}}" class="form-control"></div>
                                                                        <div class="rTableCell text-center"><input type="text" name="to[]" value="{{$cost_config->to}}" class="form-control"></div>
                                                                        <div class="rTableCell text-center"><input type="text" name="rate[]" value="{{$cost_config->rate}}" class="form-control"></div>
                                                                        <div class="rTableCell text-center"><button type="button" id="romoveCell" class="btn btn-danger remove-cell"><i class="fas fa-times"></i></button></div>
                                                                    </div>
                                                                @endforeach

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
                            {{-- /.Modal Edit --}}

                            {{-- Delete Modal --}}
                            <div class="modal fade bs-modal-md" id="delete{{ $cost->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <form action="{{ route('delivery.cost.destroy', $cost->id) }}" class="horizontal-form" method="POST">
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
            <!-- /.table -->
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade bs-modal-lg" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('delivery.cost.store') }}" class="horizontal-form" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times font-red"></i>
                    </button>
                    <h4 class="modal-title">Add Delivery Cost</h4>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" for="person_type">Person Type</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control" name="person_type" id="person_type" required>
                                        <option value="" selected>Select One</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Agent">Agent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 optional agent" style="display:none">
                                <div class="form-group">
                                    <label class="control-label" for="agent_name">Agent Name</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control inputAgent add_agent_name" name="agent_name" id="agent_name" required>
                                        <option value="" selected>Select One</option>
                                        @foreach ($agents  as $agent)
                                            <option value="{{$agent->id}}">{{$agent->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 optional agent" style="display:none">
                                <div class="form-group">
                                    <label class="control-label" for="agent_person">Agent Person</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control inputAgent agent_person" name="agent_person" id="agent_person" required>
                                        <option value="" selected>Select Agent First</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 optional agent" style="display:none">
                                <div class="form-group">
                                    <label class="control-label" for="delivery_cost">Delivery Cost Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="delivery_cost" name="delivery_cost_name" class="form-control inputAgent" placeholder="Delivery Cost Name" required>
                                </div>
                            </div>

                            <div class="col-md-3 optional staff" style="display:none">
                                <div class="form-group">
                                    <label class="control-label" for="staff_name">Select Staff Person Name</label>
                                    <span class="text-danger">*</span>
                                    <select class="form-control inputStaff" name="staff_name" id="staff_name" required>
                                        <option value="" selected>Select One</option>
                                        @foreach ($staffs as $staff)
                                            <option value="{{$staff->id}}">{{ $staff->contact_p_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 optional staff" style="display:none">
                                <div class="form-group">
                                    <label class="control-label" for="delivery_cost_name">Delivery Cost Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="delivery_cost_name" name="delivery_cost_name" class="form-control inputStaff" placeholder="Delivery Cost Name" required>
                                </div>
                            </div>
                        </div>
                        <!--/row-->

                        <div class="row optional staff" style="display:none">
                            <div class="col-md-12">
                                <h4 class="font-red"><strong>Cost Configure for Weight (Staff)</strong></h4>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered" id="staffTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>From(gm)</th>
                                            <th>To(gm)</th>
                                            <th>Price</th>
                                            <th><button type="button" name="add" id="staff_add" class="btn btn-success"><i class="fas fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX text-center">
                                            <td><input type="text" name="from[]" class="form-control inputStaff"></td>
                                            <td><input type="text" name="to[]" class="form-control inputStaff"></td>
                                            <td><input type="text" name="rate[]" class="form-control inputStaff"></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/row-->

                        <div class="row optional agent" style="display:none">
                            <div class="col-md-12">
                                <h4 class="font-red"><strong>Cost Configure for Weight (Agent)</strong></h4>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered" id="agentTable">
                                    <thead>
                                        <tr class="text-center">
                                            <th>From(gm)</th>
                                            <th>To(gm)</th>
                                            <th>Price</th>
                                            <th><button type="button" name="add" id="agent_add" class="btn btn-success"><i class="fas fa-plus"></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX text-center">
                                            <td><input type="text" name="from[]" class="form-control inputAgent" required></td>
                                            <td><input type="text" name="to[]" class="form-control inputAgent" required></td>
                                            <td><input type="text" name="rate[]" class="form-control inputAgent" required></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
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

{{-- /.Modal Add --}}
@endsection

@section('script')
    <script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $("#agent_add").click(function(){
            $("#agentTable").append('<tr class="text-center"><td><input type="tel" name="from[]" class="form-control inputAgent" required></td><td><input type="tel" name="to[]" class="form-control inputAgent" required></td><td><input type="tel" name="rate[]" class="form-control inputAgent" required></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-times"></i></button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
    </script>

    <script type="text/javascript">
        $("#staff_add").click(function(){
            $("#staffTable").append('<tr class="text-center"><td><input type="tel" name="from[]" class="form-control inputStaff" required></td><td><input type="tel" name="to[]" class="form-control inputStaff" required></td><td><input type="tel" name="rate[]" class="form-control inputAgent" required></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-times"></i></button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
    </script>
    <script type="text/javascript">
        $("#agent_edit").click(function(){
            $("#agentEditTable").append('<tr class="text-center"><td><input type="tel" name="from[]" class="form-control inputAgent" required></td><td><input type="tel" name="to[]" class="form-control inputAgent" required></td><td><input type="tel" name="rate[]" class="form-control inputAgent" required></td><td><button type="button" class="btn btn-danger remove-tr"><i class="fas fa-times"></i></button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });
    </script>
    <script>
        $("#person_type").change(function () {
            $('.optional').css('display','none');
            $('.inputAgent').prop( "disabled", true );
            $('.inputStaff').prop( "disabled", true );
            $("select option:selected").each(function () {
                if($(this).val() == "Staff") {
                    $('.staff').toggle(1000);
                    $('.inputStaff').prop( "disabled", false );
                } else if($(this).val() == "Agent") {
                    $('.agent').toggle(1000);
                    $('.staff').css('display','none');
                    $('.inputAgent').prop( "disabled", false);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.add_agent_name').change(function() {
                $(".add_agent_name  option:selected").each(function (){
                    var item_id = $(this).val();
                    $('.agent_person').empty().append('<option selected disabled>Add Person</option>');
                    $.ajax({
                        type:'GET',
                        url:"{{ url('agent/person') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                        let options;
                        $.each( result.agent_person, function( key, value ) {
                            //console.log(value.id);
                            options =options +'<option value="'+value.id+'">'+value.contact_p_name+'</option>';
                            $(".agent_person").empty().append('<option selected disabled>Select Agent Person</option>'+options);
                        });
                        }
                    });
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.agent_name_edit').change(function() {
                $(".agent_name_edit  option:selected").each(function (){
                    var item_id = $(this).val();
                    $('#agent_person_edit').empty().append('<option selected disabled>Invalid</option>');
                    $.ajax({
                        type:'GET',
                        url:"{{ url('agent/person') }}/"+item_id,
                        data:{id:item_id},

                        success:function(result){
                        let options;
                        $.each( result.agent_person, function( key, value ) {
                            //console.log(value.id);
                            options =options +'<option value="'+value.id+'">'+value.contact_p_name+'</option>';
                            $("#agent_person_edit").empty().append('<option selected disabled>Select Agent Person</option>'+options);
                        });
                        }
                    });
                });
            });
        });
    </script>
@endsection
