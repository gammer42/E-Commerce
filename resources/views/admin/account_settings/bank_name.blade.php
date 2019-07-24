@extends('layouts.master')

@section('pageTitle', __('bank'))

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
            <a href="{{ route('account_settings.account') }}">Account Settings</a>
        </li>
        <li class="active">Bank Name</li>
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
        <div class="col-md-5">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        {{-- <i class="icon-settings font-red"></i> --}}
                        <span class="caption-subject bold uppercase">Add Bank</span>
                    </div>
                </div>
                <div class="portlet-body">
                   
                    <form id="submit_form" action="{{ route('bank.store') }}" class="form-horizontal" method="POST">
                       <span id="form_method"></span>
                       @csrf
                       <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label class="control-label" for="bank_name">Bank Name<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <span id="edit_bank_name"></span>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" name="bank_name" class="form-control" id="default_bank_name" placeholder="Bank Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label class="control-label" for="bank_name">Bank Type<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="radio-group">
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_type" id="bank_type_1" class="form-group" value="1" checked>
                                                    <label for="bank_type_1">General Bank</label>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="bank_type" id="bank_type_2" class="form-group" value="2">
                                                    <label for="bank_type_2">Mobile Bank</label>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="pull-right">
                                        <button type="reset" id="reset" class="btn red btn-outline">Reset</button>
                                        <button type="submit" id="submit" class="btn blue btn-outline">Submit</button>
                                    </p>
                                </div>
                            </div>
                       </div>
                   </form>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
        <div class="col-md-7">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List Of Banks</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#bank" id="active_btn_1" data-toggle="tab" onclick="setTabId(1)">General Bank</a></li>
                                <li><a href="#mobile" id="active_btn_2" data-toggle="tab" onclick="setTabId(2)">Mobile Bank</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="bank" class="tab-pane fade in active">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>General Bank Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($general_banks as $bank)
                                            <tr class="odd gradeX">
                                                <td style="width:15%">{{ $bank->id }}</td>
                                                <td style="width:70%">{{ $bank->name }}</td>
                                                <td style="width:15%">
                                                    <div class="btn-group" style="">
                                                        <a class="btn green btn-xs" id="general_edit" onclick="edit_bank({{ $bank->id }})">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a data-toggle="modal" href="#delete{{ $bank->id }}" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                {{-- Delete Modal   --}}
                                                <div class="modal fade bs-modal-md" id="delete{{ $bank->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <form action="{{route('bank.destroy', $bank->id)}}" class="horizontal-form" method="POST">
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
                                                </div>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="mobile" class="tab-pane fade">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Mobile Bank Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mobile_banks as $bank)
                                            <tr class="odd gradeX">
                                            <td style="width:15%">{{ $bank->id }}</td>
                                            <td style="width:70%">{{ $bank->name }}</td>
                                            <td style="width:15%">
                                                <div class="btn-group" style="">
                                                    <a class="btn green btn-xs" id="general_edit" onclick="edit_bank({{ $bank->id }})">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a data-toggle="modal" href="#delete{{ $bank->id }}" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            {{-- Delete Modal   --}}
                                            <div class="modal fade bs-modal-md" id="delete{{ $bank->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <form action="{{route('bank.destroy', $bank->id)}}" class="horizontal-form" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title"><b>Delete this entry</b></h4>
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function setTabId(id){
            $('[name=tid]').val(id);
            $("#bank_type_"+id).prop("checked", true).attr('checked', 'checked');
        }
    </script>

    <script type="text/javascript">
        function edit_bank(id){
            $("#submit").html('Update');
            $('#default_bank_name').hide();
            $('#default_bank_name').prop('disabled', true);
            
            $.ajax({
                type:'GET',
                url:"{{ url('banks/edit') }}/"+id,
                data:{id:id},
                success:function(result){
                    var name = result.bank_name;
                    $('#submit_form').attr('action', "{{ url('banks/update') }}/"+result.id);
                    $('#form_method').html('@method("PUT")');
                    $('#edit_bank_name').empty().append('<input type="text" value="'+name+'" name="bank_name" class="form-control" placeholder="Bank Name">');
                }
            });
        }
    </script>
   
@endsection