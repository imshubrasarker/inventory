<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
    <!--left-fixed -navigation-->
  <aside class="sidebar-left " style="overflow: scroll">
  <nav class="navbar navbar-inverse">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <h1><a class="navbar-brand" href="{{ url('/home') }}"><span class="fa fa-area-chart"></span> Admin<span class="dashboard_text">Panel dashboard</span></a></h1>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
          <li class="treeview">
            <a href="{{ url('/home') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
            <i class="fa fa-user"></i>
            <span>Invoices</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('invoices/create') }}"><i class="fa fa-angle-right"></i> Create New Invoice</a></li>
              @hasrole('Admin')
              <li><a href="{{ url('invoices') }}"><i class="fa fa-angle-right"></i> Manage Invoice</a></li>
              @endhasrole
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Customers</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @hasrole('Admin')
              <li><a href="{{ url('customers/create') }}"><i class="fa fa-angle-right"></i> Create New Customer</a></li>
              @endhasrole
              <li><a href="{{ url('customers') }}"><i class="fa fa-angle-right"></i> Manage Customer</a></li>
              {{-- <li><a href="{{ url('customer-ledger') }}"><i class="fa fa-angle-right"></i> Customer Ledger</a></li> --}}
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
            <i class="fa fa-user"></i>
            <span>Payments</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('payments/create') }}"><i class="fa fa-angle-right"></i> Receive Payment</a></li>
              @hasrole('Admin')
              <li><a href="{{ url('payments') }}"><i class="fa fa-angle-right"></i> Manage Payment</a></li>
                 @endhasrole
            </ul>
          </li>


          <li class="treeview">
            <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Stocks</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @hasrole('Admin|Rony')
              <li><a href="{{ url('stocks/create') }}"><i class="fa fa-angle-right"></i> Create New Stock</a></li>

              <li><a href="{{ url('stocks') }}"><i class="fa fa-angle-right"></i> Manage Stock</a></li>
               @endhasrole
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
            <i class="fa fa-product-hunt"></i>
            <span>Products</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('products/create') }}"><i class="fa fa-angle-right"></i> Create New Product</a></li>
              <li><a href="{{ url('products') }}"><i class="fa fa-angle-right"></i> Manage Product</a></li>
            </ul>
          </li>
          @hasrole('Admin')
          <li class="treeview">
            <a href="#">
            <i class="fa fa-user"></i>
            <span>Users</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('roles/create') }}"><i class="fa fa-angle-right"></i> Create Roll</a></li>
              <li><a href="{{ url('roles') }}"><i class="fa fa-angle-right"></i> Manage Roll</a></li>
              <li><a href="{{ url('/users') }}"><i class="fa fa-angle-right"></i> Manage User</a></li>
            </ul>
          </li>
          @endhasrole
          @hasrole('Admin')
          <li class="treeview">
            <a href="#">
              <i class="fa fa-usd" aria-hidden="true"></i>
              <span>Expenses</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('expenses-head') }}"><i class="fa fa-angle-right"></i>Expenses Head</a></li>
              <li><a href="{{ route('expenses.create') }}"><i class="fa fa-angle-right"></i>Expenses Create</a></li>
              <li><a href="{{ route('expenses.index') }}"><i class="fa fa-angle-right"></i>Manage Expenses</a></li>
            </ul>
          </li>
          @endhasrole

          @hasrole('Admin')
          <li class="treeview">
            <a href="#">
              <i class="fa fa-truck" aria-hidden="true"></i>
              <span>Supplier</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('supplier.create') }}"><i class="fa fa-angle-right"></i>Create Supplier</a></li>
              <li><a href="{{ route('supplier.index') }}"><i class="fa fa-angle-right"></i>Manage Supplier</a></li>
            </ul>
          </li>
          @endhasrole

            @hasrole('Admin')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <span>Purchase</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('purchase.create') }}"><i class="fa fa-angle-right"></i>Create Purchase</a></li>
                    <li><a href="{{ route('purchase.index') }}"><i class="fa fa-angle-right"></i>Manage Purchase</a></li>
                </ul>
            </li>
            @endhasrole
            @hasrole('Admin')
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-building-o" aria-hidden="true"></i>
                    <span>Godown 1</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('godown1.name') }}"><i class="fa fa-angle-right"></i>Raw Materials</a></li>
                </ul>
            </li>
            @endhasrole
            @hasrole('Admin')
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-building-o" aria-hidden="true"></i>
                    <span>Godown 2</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('godown2.index') }}"><i class="fa fa-angle-right"></i>Production</a></li>
                </ul>
            </li>
            @endhasrole
          @hasrole('Admin')
          <li class="treeview">
            <a href="{{ route('godown-3.index') }}">
              <i class="fa fa-building-o" aria-hidden="true"></i> <span>Godown 3</span>
            </a>
          </li>
            @endhasrole
          @hasrole('Admin')
          <li class="treeview">
            <a href="#">
            <i class="fa fa-anchor"></i>
            <span>Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('godown-unit.index') }}"><i class="fa fa-angle-right"></i> Manage Godown Unit</a></li>
              <li><a href="{{ url('units') }}"><i class="fa fa-angle-right"></i> Manage Unit</a></li>
              <li><a href="{{ url('categories') }}"><i class="fa fa-angle-right"></i> Manage Categories</a></li>
              <li><a href="{{ url('smses') }}"><i class="fa fa-angle-right"></i> Manage SMS</a></li>
              <li><a href="{{ url('companies') }}"><i class="fa fa-angle-right"></i> Manage Companies</a></li>
            </ul>
          </li>
          @endhasrole
        </ul>
      </div>
      <!-- /.navbar-collapse -->
  </nav>
</aside>
</div>
