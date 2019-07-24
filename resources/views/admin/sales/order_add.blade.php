@extends('layouts.master')

@section('pageTitle', __('role Roles')) 

@section('head')
    
@endsection

@section('content')
<div class="page-content">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ route('home') }}"> Dashboard</a>
        </li>
        <li>
            <a href="{{ route('sales.index') }}">Sales</a>
        </li>
        <li>
            <a href="{{ route('sales.add_order') }}">Order List</a>
        </li>
        <li class="active">Add Order</li>
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
        <form action="{{route('sales.order.store')}}" method="POST">
            @csrf
            <div class="col-md-8">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <span class="caption-subject bold uppercase">Add Order</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label class="control-label" for="product_name">Product Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" id="product_name">
                                            <option id="op" disabled selected>Select One</option>
                                            @foreach($products as $product)
                                            <option id="op{{$product->id}}" value="{{$product->id}}">({{$product->product_code}})&nbsp;{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2" id="addProduct">
                                        <a href="#" id="addbutton" class="btn sbold red">Add</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- form-body --}}
                    </div>
                    <div class="portlet-body">
                        
                        <table class="table" id="productOrder">
                            <thead>
                                <tr>
                                    <th>Product&nbsp;Name</th>
                                    <th>Code</th>
                                    <th>Stock</th>
                                    <th>Qty</th>
                                    <th>Unit&nbsp;Price</th>
                                    <th>Dis(%)</th>
                                    <th>VAT(%)</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="add_table_row">
                                {{-- <tr>
                                    <td>xxx xxxxx</td>
                                    <td>P103994</td>
                                    <td>1010</td>
                                    <td><input type="text" id="" name="" class="form-control" min="1" required></td>
                                    <td><input type="text" id="" name="" class="form-control" min="1"></td>
                                    <td><input type="text" id="" name="" class="form-control" min="0"></td>
                                    <td><input type="text" id="" name="" class="form-control" min="0"></td>
                                    <td style="width:12%"><input type="text" id="" name="" class="form-control" min="1"></td>
                                    <td style="width:5%"><a href="#" class="btn red btn-xs" id="order_remove_btn"><i class="fas fa-times"></i></a></td>
                                </tr>   --}}
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style=""></td>
                                    <td style="">Grand Total</td>
                                    <td style="width:15%;" id="gt">
                                        <input type="text" id="grand_total" name="grand_total" value="0" class="form-control" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading" id="add-order-header">
                        <span id="due">(Due: 0.00 Tk.)</span>
                        <h4 id="h_total">Total 0.00 Tk.</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="customer">Customer Name<span class="text-danger">*</span></label>
                                        <select class="form-control" id="customer" name="customer" required>
                                            <option value="" selected disabled>Select One</option>
                                            @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="person">Sales Person <span class="text-danger">*</span></label>
                                        <select class="form-control" id="person" name="person" required>
                                            <option value="" selected disabled>Select One</option>
                                            @foreach($persons as $person) 
                                            <option value="{{$person->id}}">{{$person->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="payment">Payment <span class="text-danger">*</span></label>
                                        <input type="number" id="payment" onkeyup="due(this.value)" name="payment" class="form-control" placeholder="Payment">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="account">Payment Account<span class="text-danger">*</span></label>
                                        <select class="form-control" id="account" name="account" required>
                                            <option value="" selected disabled>Select One</option>
                                            @foreach($accounts as $account)
                                            <option value="{{$account->id}}">{{$account->branch}}-{{$account->banks->name}}-({{$account->number}})</option>
                                            @endforeach
                                            <option value="bank">DBBL</option>
                                            <option value="bank">Brac</option>
                                            <option value="bank">EBL</option>
                                            <option value="mobile">UCash</option>
                                            <option value="others">Primary Station</option>
                                            <option value="others">SA Paribahan</option>
                                            <option value="others">Cash Account</option>
                                            <option value="others">Manager</option>
                                            <option value="others">Due Account</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 payment_row" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label" for="payment_method">Payment Method</label>
                                        <select class="form-control" id="payment_method" name="payment_method">
                                            <option value="" selected>Select One</option>
                                            <option value="1">Card</option>
                                            <option value="0">Cheque</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 cheque" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label" for="bank">Bank Name</label>
                                        <select class="form-control" id="bank" name="cheque_bank">
                                            <option value="" selected disabled>Select One</option>
                                            @foreach($banks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 cheque" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label" for="acc_no">Account/Card No.</label>
                                        <input type="text" name="cheque_acc_no" class="form-control inputMethodCheque" id="acc_no">
                                    </div>
                                </div>

                                <div class="col-md-12 card" id="card" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label" for="card">Card</label>
                                        <select class="form-control inputMethodCard" id="card" name="card">
                                            <option selected disabled>Select One</option>
                                            @foreach($cards as $card)
                                            <option value="{{$card->id}}">{{$card->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 card" id="card" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label" for="acc_no">Account/Card No.</label>
                                        <input type="text" name="card_acc_no" class="form-control inputMethodCard" id="acc_no">
                                    </div>
                                </div>

                                <div class="col-md-12 card" id="card" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label" for="ref_no">Reff Transaction No</label>
                                        <input type="text" name="card_ref_no" class="form-control inputMethodCard" id="ref_no">
                                    </div>
                                </div>
                                {{-- ./card --}}

                                {{-- mobile --}}
                                <div class="col-md-12 mobile" id="mobile" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label" for="acc_no">Account/Card No.</label>
                                        <input type="text" name="mobile_acc_no" class="form-control inputMethodCard" id="acc_no">
                                    </div>
                                </div>

                                <div class="col-md-12 mobile" id="mobile" style="display:none">
                                    <div class="form-group">
                                        <label class="control-label" for="ref_no">Reff Transaction No</label>
                                        <input type="text" name="mobile_ref_no" class="form-control inputMethodCard" id="ref_no">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label" for="note">Note<span class="text-danger">*</span></label>
                                        <textarea name="note" id="note" rows="2" class="form-control" placeholder="Order Note Here.."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn red btn-outline pull-right">Add Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
 
    <script type="text/javascript"> 
    
        $("#product_name").change(function () {
            let id = this.value;
            $('#addbutton').remove();        
            $('#addProduct').append('<a id="addbutton" onclick="addProduct('+id+')" class="btn sbold red">Add</a>')

        });

        function addProduct(id){
            let pid = id;
            $('#op'+pid).hide();
            // $('#product_name').empty();
            $.ajax({
                type:'GET',
                url:"{{ url('order/add/product') }}/"+pid,
                data:{id:pid},

                success:function(result){
                    let product_id = result.product_id;
                    let product_name = result.product_name;
                    let product_code = result.product_code;
                    let stock = result.stock;
                    let price = result.price;
                    sum_grand_total(price);    
                    $("#add_table_row").append('<tr>'+
                        '<td>'+product_name+'</td>'+
                        '<td>'+product_code+'</td>'+
                        '<td>'+stock+'</td>'+
                        '<input type="hidden" value="'+product_id+'" name="id[]" class="form-control" required>'+
                        '<td><input type="text" id="qty'+product_id+'" onkeyup="sum_p('+product_id+')" value="1" name="qty[]" class="form-control" max="'+stock+'" min="1"></td>'+
                        '<td><input type="text" id="price'+product_id+'" onkeyup="sum_p('+product_id+')" value="'+price+'" name="price[]" class="form-control" min="1" required></td>'+
                        '<td><input type="text" id="dis'+product_id+'" onkeyup="sum_p('+product_id+')" name="dis[]" value="0" class="form-control" max="100" min="0"></td>'+
                        '<td><input type="text" id="vat'+product_id+'" onkeyup="sum_p('+product_id+')" name="vat[]" value="0" class="form-control" max="100" min="0"></td>'+
                        '<td style="width:15%"><input type="text" id="total'+product_id+'" name="total[]" value="'+price+'" class="form-control" readonly></td>'+
                        '<td style="width:5%"><a class="btn red btn-xs order_remove_btn" onclick="sub_grand_total('+id+')" id="order_remove_btn"><i class="fas fa-times"></i></a></td>'+
                    '</tr>');
                }
            });
        }

        function sum_p(id){
            let qty = $('#qty'+id).val();
            let price = $('#price'+id).val();
            let dis = $('#dis'+id).val();
            let vat = $('#vat'+id).val();
            let pre_total = $('#total'+id).val();

            let total = (qty*price);
            discount = ((total*dis)/100);
            discount = Math.round(discount);
            total = total-discount;
            vat_total=((total*vat)/100);
            vat_total = Math.round(vat_total);
            total=total+vat_total;
            $('#total'+id).attr('value',total);
            sum_grand_total(total-pre_total);
        }

        function sub_grand_total(id){
            let sub_total = $('#total'+id).val();
            let alpha = $('#grand_total').val();
            beta=parseInt(alpha)-parseInt(sub_total);
            $('#gt').html('<input type="text" id="grand_total" name="grand_total" value="'+beta+'" class="form-control" readonly>');
            $('#h_total').html('Total '+beta+' Tk.');
        }

        function sum_grand_total(total){
            let alpha = $('#grand_total').val();
            rounded = Math.floor(total);
            beta=parseInt(alpha)+parseInt(rounded);
            $('#gt').html('<input type="text" id="grand_total" name="grand_total" value="'+beta+'" class="form-control" readonly>');
            $('#h_total').html('Total '+beta+' Tk.');
        }

        function due(p_val){
            let total = $('#grand_total').val();
            let value = p_val;
            let due = parseInt(total)-parseInt(value);
            if(due==0)
            $('#due').html('(Payable: 0.00 Tk.)');
            if(due<0){
                let payable = parseInt(value)-parseInt(total);
                $('#due').html('(Payable: '+payable+' Tk.)');
            }
            if(due>0){
                $('#due').html('(Due: '+due+' Tk.)');
            }
        }
    
        $(document).on('click', '.order_remove_btn', function(){  
            $(this).parents('tr').remove();
        });  

        $('#account').change(function(){

        });
    </script>
    <script>
        $("#account").change(function () {
            $('.payment_row, .mobile').css('display','none');
            $('.inputMethodMobile').prop( "disabled", true );
            let pid = $(this).val();
            $.ajax({
                type:'GET',
                url:"{{ url('order/add/account/type') }}/"+pid,
                data:{id:pid},

                success:function(result){
                    if(result.type == 'Bank'){
                        $('.payment_row').toggle(500);
                        $('.mobile, .card, .cheque').css('display','none');
                    }else if(result.type == 'Mobile'){
                        $('.mobile').toggle(500);
                        $('.inputMobile').prop( "disabled", false);
                        $('.payment_row, .card, .cheque').css('display','none');
                    }

                }
            });
            // $("select option:selected").each(function () {
            //     if($(this).val() == "bank") {
            //         $('.payment_row').toggle(700);
            //         $('.mobile, .card, .cheque').css('display','none');
            //     }else if($(this).val() == "mobile") {
            //         $('.mobile').toggle(700);
            //         $('.inputMobile').prop( "disabled", false);
            //         $('.payment_row, .card, .cheque').css('display','none');
            //     }
            // });
        });
    </script>

    <script>
        $("#payment_method").change(function () {
            $('.cheque, .card, .mobile').css('display','none');
            $('.inputMethodCard, .inputMethodCheque, .inputMethodMobile').prop( "disabled", true );
            $("select option:selected").each(function () {
                if($(this).val() == "0") {
                    $('.cheque').css('display','block');
                    $('.inputMethodCheque').prop( "disabled", false );
                    $('.card, .mobile').css('display','none');
                } else if($(this).val() == "1") {
                    $('.card').css('display','block');
                    $('.inputMethodCard').prop( "disabled", false);
                    $('.cheque, .mobile').css('display','none');
                }
            });
        });
    </script>

@endsection