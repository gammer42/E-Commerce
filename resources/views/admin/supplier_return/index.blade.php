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
        <li class="active">Supplier Return</li>
    </ul>
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
    </div>
    <div class="row">
        
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <form action="#" class="horizontal-form" method="get">
                        {{-- @csrf --}}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label" for="invoice_no">Invoice No </label>
                                        <input type="text" id="invoice_no" name="invoice_no" class="form-control" placeholder="Invoice No">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="from_date">From Date</label>
                                        <div class="input-group input-medium date date-picker" id="full_width_input" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" name="from_date" id="from_date" class="form-control" readonly="">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fas fa-calendar-alt font-red"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" for="to_date">To Date</label>
                                        <div class="input-group input-medium date date-picker" id="full_width_input" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                            <input type="text" name="to_date" id="to_date" class="form-control" readonly="">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button">
                                                    <i class="fas fa-calendar-alt font-blue"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn sbold red" id="search" style="margin-top:33px"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <span class="caption-subject bold uppercase">List of Supplier Returns</span>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('supplier_return.create') }}" class="btn sbold red"> Add Supplier Return
                        </a>
                    </div>
                </div>
                
                <div class="portlet-body">
                    <table class="table table-hover" id="">
                        <thead>
                            <tr>
                                <th>Serial</th>
                                <th>Code</th>
                                <th>Supplier Name</th>
                                <th>Contact Person</th>
                                <th>Store</th>
                                <th>Supplier Return</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                          @foreach ($supplier_returns as $i=>$supplier)
                            <tr class="odd gradeX">
                                <td>{{ $i+1 }}</td>
                                <td>{{ $supplier->suppliers->supplier_code }}</td>
                                <td>{{ $supplier->suppliers->supplier_name }}</td>
                                <td>{{ $supplier->suppliers->contact_person }}</td>
                                <td>{{ $supplier->suppliers->store_name }}</td>

                                @if ($supplier->supplier_returns ==1)
                                <td><a href="{{ route('supplier_return.edit',$supplier->id)}}" class="btn btn-xs sbold green">{{ $supplier->supplier_returns==1 ? "YES" : "Pending" }}</a></td>
                                @endif

                                @if ($supplier->supplier_returns==0)
                                <td><a href="{{ route('supplier_return.edit',$supplier->id)}}" class="btn btn-xs sbold yellow">{{ $supplier->supplier_returns==1 ? "YES" : "Pending" }}</a></td>
                                @endif
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route("customer.show",$customer->id) }}" class="btn btn-xs sbold green">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route("customer.edit",$customer->id) }}" class="btn btn-xs sbold blue">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{-- <a class="btn btn-xs sbold red" data-toggle="modal" href="#delete{{ $customer->id }}" data-backdrop="static" data-keyboard="false">
                                            <i class="fas fa-trash"></i>
                                        </a> --}}
                                    </div>
                                    <div class="btn-group">
                                        <form method="POST" action="{{ route('supplier_return.destroy', $supplier->id) }}">
                                          <a href="{{ route('supplier_return.show',$supplier->id)}}" class="btn btn-xs sbold green"><i class="fa fa-eye"></i>
                                          </a>
                                          {{ csrf_field() }}
                                          {{ method_field('DELETE') }}
                                          <button type="submit" class="btn btn-xs sbold red">
                                              <i class="fas fa-trash"></i>
                                          </button>
                                        </form>
                                    </div>
                                </td>
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
@endsection
@section('script')

@endsection
