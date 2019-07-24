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
        <li class="active">Account</li>
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
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List Of Accounts</span>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('account.create') }}" class="btn sbold red"> Add New Account
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills">
                                <li class="active"><a  data-toggle="tab" href="#bank">Bank Account</a></li>
                                <li><a data-toggle="tab" href="#cash">Cash Account</a></li>
                                <li><a data-toggle="tab" href="#mobile">Mobile Account</a></li>
                                {{-- <li><a data-toggle="tab" href="#station">Station Account</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div id="bank" class="tab-pane fade in active">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Bank</th>
                                                <th>Account No.</th>
                                                <th>Branch</th>
                                                <th>Account Uses</th>
                                                <th>Intial Balance</th>
                                                <th>Current Balance</th>
                                                <th>Store</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($banks as $i=>$bank)
                                            <tr class="odd gradeX">
                                                <td>{{$i+1}}</td>
                                                <td>{{$bank->banks->name}}</td>
                                                <td>{{$bank->number}}</td>
                                                <td>{{$bank->branch}}</td>
                                                <td>{{$bank->uses==1?'Office Account':($bank->uses==2?'Shop Account':($bank->uses==3?'Both':''))}}</td>
                                                <td>{{$bank->initial_bal}}</td>
                                                <td>{{$bank->current_bal}}</td>
                                                <td>@foreach($bank->stores as $store){{$store->name}},&nbsp;@endforeach</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn green btn-xs" id="">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('account.edit', $bank->id) }}" class="btn blue btn-xs" id="">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a data-toggle="modal" href="#delete" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                {{-- Delete Modal   --}}
                                                <div class="modal fade bs-modal-md" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <form action="#" class="horizontal-form" method="POST">
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div id="cash" class="tab-pane fade">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Account Name</th>
                                                <th>Account Uses</th>
                                                <th>Intial Balance</th>
                                                <th>Current Balance</th>
                                                <th>Store</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cashes as $i=>$cash)
                                            <tr class="odd gradeX">
                                                <td>{{$i+1}}</td>
                                                <td>{{$cash->name}}</td>
                                                <td>{{$cash->uses==1?'Office Account':($cash->uses==2?'Shop Account':($cash->uses==3?'Both':''))}}</td>
                                                <td>{{$cash->initial_bal}}</td>
                                                <td>{{$cash->current_bal}}</td>
                                                <td>@foreach($cash->stores as $store){{$store->name}},&nbsp;@endforeach</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn green btn-xs" id="">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('account.edit', $cash->id) }}" class="btn blue btn-xs" id="">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        <a data-toggle="modal" href="#delete" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                {{-- Delete Modal   --}}
                                                <div class="modal fade bs-modal-md" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <div id="mobile" class="tab-pane fade">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Mobile Bank</th>
                                                <th>Account No.</th>
                                                <th>Account Uses</th>
                                                <th>Intial Balance</th>
                                                <th>Current Balance</th>
                                                <th>Store</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mobiles as $mobile)
                                            <tr class="odd gradeX">
                                                <td>{{$i+1}}</td>
                                                <td>{{ $mobile->type }}</td>
                                                <td>{{ $mobile->number }}</td>
                                                <td>{{$mobile->uses==1?'Office Account':($mobile->uses==2?'Shop Account':($mobile->uses==3?'Both':''))}}</td>
                                                <td>{{ $mobile->initial_bal }}</td>
                                                <td>{{ $mobile->current_bal }}</td>
                                                <td>@foreach($mobile->stores as $store){{$store->name}},&nbsp;@endforeach</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn green btn-xs" id="">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('account.edit', $mobile->id) }}" class="btn blue btn-xs" id="">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        <a data-toggle="modal" href="#delete" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                {{-- Delete Modal   --}}
                                                <div class="modal fade bs-modal-md" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <div id="station" class="tab-pane fade">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                        <thead>
                                            <tr>
                                                <th>SL.</th>
                                                <th>Bank</th>
                                                <th>Account Uses</th>
                                                <th>Intial Balance</th>
                                                <th>Branch</th>
                                                <th>Current Balance</th>
                                                <th>Store</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td>120</td>
                                                <td>xxxxx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>xxxxx xx</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="#" class="btn green btn-xs" id="">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="#" class="btn blue btn-xs" id="">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        <a data-toggle="modal" href="#delete" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                {{-- Delete Modal   --}}
                                                <div class="modal fade bs-modal-md" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            {{-- Delete Modal   --}}
                                            <div class="modal fade bs-modal-md" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <form action="" class="horizontal-form" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title">Delete This Entry</h4>
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
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function setTabId(id){
            $('#bank_type').val(id);
            $("#bank_type_"+id).prop("checked", true).attr('checked', 'checked').prop("disabled", true);
        }
    </script>

    <script type="text/javascript">
        function edit_bank(id){
            $('#default_bank_name').hide();
            $.ajax({
                type:'GET',
                url:"{{ url('bank/edit') }}/"+id,
                data:{id:id},
                success:function(result){
                    var name = result.bank_name;
                    $('#edit_bank_name').empty().append('<input type="text" value="'+name+'" name="bank_name" class="form-control" placeholder="Bank Name" required">');
                }
            });
        }
    </script>
@endsection

