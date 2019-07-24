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
            <a href="{{ route('account_settings.account') }}">Account Settings</a>
        </li>
        <li class="active">Expense Category</li>
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
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">Add New Category</span>
                    </div>
                </div>
                <div class="portlet-body">
                   <form id="submit_form" action="{{route('transaction.category.store') }}" class="form-horizontal" method="POST">
                    <span id="form_method"></span>
                        @csrf
                       <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <label class="control-label">Type<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="radio-group">
                                                <label class="radio-inline">
                                                    <input type="radio" name="type" id="expense_type_1" class="form-group cat_type" value="1" checked>
                                                    <label for="expense_type_1">Income</label>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="type" id="expense_type_0" class="form-group cat_type" value="0">
                                                    <label for="expense_type_0">Expense</label>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <label class="control-label" for="c_cat">Category<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-7" id="child_cat">
                                            <input type="text" name="c_cat" class="form-control" id="store_cat" placeholder="Category">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <label class="control-label" for="p_cat">Parent Category<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-md-7">
                                            <select name="p_cat" id="income" class="form-control">
                                                <option value="" selected disabled>Income Category</option>
                                                @foreach ($incomes as $item)
                                                <option id="option{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            <select name="p_cat" id="expense" class="form-control" style="display:none">
                                                <option value="" selected disabled>Expense Category</option>
                                                @foreach ($expenses as $item)
                                                <option id="option{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="pull-right">
                                        <span id="cancel"></span>
                                        <button type="reset" id="reset" class="btn red btn-outline">Reset</button>
                                        <button type="submit" id="submit" class="btn blue btn-outline">Submit</button>     
                                    </p>   
                                </div>    
                            </div>
                       </div>
                   </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List Of Expense Categories</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Category</th>
                                        <th>Child Category</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cats as $i=>$cat)
                                    <tr class="odd gradeX">
                                        <td style="width:5%">{{ $i+1 }}</td>
                                        <td style="width:25%">{{ $cat->parents->name }}</td>
                                        <td style="width:30%">{{ $cat->name }}</td>
                                        <td style="width:25%">{{ $cat->parents->type == 1?'Income':'Expense' }}</td>
                                        <td style="width:15%">
                                            <div class="btn-group" style="">
                                                <a class="btn green btn-xs" onclick="cat_edit({{$cat->id}})">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a data-toggle="modal" href="#delete{{$cat->id}}" class="btn red btn-xs" data-backdrop="static" data-keyboard="false">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                        {{-- Delete Modal   --}}
                                        <div class="modal fade bs-modal-md" id="delete{{$cat->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <form action="{{route('transaction.category.destroy', $cat->id)}}" class="horizontal-form" method="POST">
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
        function cat_edit(id){
            $('#store_cat').remove();
            $("#submit").html('Update');
            $("#reset").remove();
            $.ajax({
                type:'GET',
                url:"{{ url('transaction/categories/edit') }}/"+id,
                data:{id:id},
                success:function(result){
                    var cat = result.cat;
                    var par = result.par;
                    var type = result.type;
                    setType(type);
                    $('#option'+par).prop("selected",true);
                    $('#submit_form').attr('action', "{{ url('transaction/categories') }}/"+result.id);
                    $('#form_method').html('@method("PUT")');
                    $('#child_cat').empty().append('<input type="text" value="'+cat+'" name="c_cat" class="form-control">');
                    $('#cancel').html('<a href="{{url("account-settings/categories")}}" class="btn red btn-outline">Cancel</a>');
                }
            });
        }

        function setType(id){
            $('#cat_type').val(id);
            $("#expense_type_"+id).prop("checked", true).attr('checked', 'checked');
            setSelect(id);
        }
        $(".cat_type").change(function () {
            let id = $(this).val();
            setSelect(id);
        });
        function setSelect(id){
            if(id==0){
                $('#income').css('display','none');
                $('#income').prop('disabled', true);
                $('#expense').css('display', 'block');
                $('#expense').prop('disabled', false);
            }
            if(id==1){
                $('#expense').css('display','none');
                $('#expense').prop('disabled', true);
                $('#income').css('display', 'block');
                $('#income').prop('disabled', false);
            }
        }
    </script>
@endsection
