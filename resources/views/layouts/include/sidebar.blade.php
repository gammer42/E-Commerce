<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" >
            {{-- <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                    <span></span>
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li> --}}

            <li class="nav-item start active">
                <a href="{{route('home')}}" class="nav-link "><i class="fas fa-tachometer-alt font-red"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="far fa-user font-red"></i>
                    <span class="title">User</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{route('user.index')}}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('role.index')}}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Role</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-users-cog font-red"></i>
                    <span class="title">Customer Settings</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{route('customer.index')}}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Customer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('customertype.index') }}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Customer Type</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('customerpoint') }}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Customer Points</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-shopping-bag font-red"></i>
                    <span class="title">Product Management</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{route('products.index')}}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Products</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('brands.index')}}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Brands</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('categories.index')}}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Categories</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('unit.index') }}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Units</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('barcode')}}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Barcode</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-tools font-red"></i>
                    <span class="title">Store Settings</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('store.index') }}" class="nav-link ">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Stores</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-people-carry font-red"></i>
                    <span class="title"> Suppliers</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('supplier.index') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Supplier</span>
                        </a>
                    </li>
                    <li class="nav-item">
                    <li class="nav-item">
                        <a href="{{ route('supplier_payment_alert.index') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Supplier Payment Alert</span>
                        </a>
                    </li>
                    <li class="nav-item">
                    <li class="nav-item">
                        <a href="{{ route('supplier_return.index') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Supplier Return</span>
                        </a>
                    </li>
                    <li class="nav-item">
                </ul>
            </li>

            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-layer-group font-red"></i>
                    <span class="title"> Stocks</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('stocks.index') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Stocks</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('stock_in') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Stock In</span>
                        </a>
                    </li>
                    <li class="nav-item">
                    <li class="nav-item">
                        <a href="{{ route('stock_out') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Stock Out</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('requisition.index') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Requisitions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('purchase_item') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Purchase Item</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('purchases') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Purchases</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-shopping-cart font-red"></i>
                    <span class="title">Purchase Management</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('purchases') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Purchase Details</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('purchase_item') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Purchase Item</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-wrench font-red"></i>
                    <span class="title">Account Settings</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('account_settings.account') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Accounts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bank.index') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Bank Name</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('account_settings.card_type') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Card Type</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('account_settings.categories') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Expense Categories</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-file-invoice-dollar font-red"></i>
                    <span class="title">Account Management</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('account_management.transactions') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Transactions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('account_management.fund_transfer') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Fund Transfer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('account_management.transaction_invoices') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Transaction Invoices</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-truck font-red"></i>
                    <span class="title">Delivery</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('delivery.agent') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Agent</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('delivery.persons') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Delivery Persons</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('delivery.costs') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Delivery Costs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('delivery.orders') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Delivery Orders</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('delivery.cod') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">COD Charge</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-gifts font-red"></i>
                    <span class="title">Promotion</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('promotion.index') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Promotion Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('customerpoint') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Points</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fas fa-money-check-alt font-red"></i>
                    <span class="title">Sales</span>
                    <i class="fas fa-angle-right font-red rotate"></i>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('sales.index') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Sales</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sales.sale_returns') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Sale Return</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sales.print_chalan') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Print Chalan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('person.index') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Sales Person</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sales.sales_commission') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Sales Commission</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sales.add_order') }}" class="nav-link">
                            <i class="far fa-dot-circle font-red"></i>
                            <span class="title">Add Order</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
