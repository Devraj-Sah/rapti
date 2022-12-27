<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left">
            <!-- <img src="{{ asset('assets/img/logo.jpg') }}" class="img img-thumbnails"  alt="User Image" style="width: 100%;height: 150px;"> -->
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{Request::is('admin/dashboard')?'active':''}} treeview"><a
                        href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="{{Request::is('admin/navigation-list/Main')?'active':''}} treeview"><a
                        href="{{url('/admin/navigation-list/Main')}}"><i class="fa fa-list"></i>
                    <span>Main Navigation</span></a></li>
            <li class="{{Request::is('admin/navigation-list/Home')?'active':''}} treeview"><a
                        href="{{url('/admin/navigation-list/Home')}}"><i class="fa fa-list"></i>
                    <span>Home Navigation</span></a></li>
            <li><a href="{{route('product-categories.index')}}"><i class="fa fa-list"></i> Product Categories</a></li>
            <li><a href="{{route('products.index')}}"><i class="fa fa-circle-o"></i> Products</a></li>
            <li><a href="{{route('order.index')}}"><i class="fa fa-circle-o"></i> Orders  <div class="badge">{{count(auth()->user()->unreadNotifications )}}</div></a>
                @forelse(auth()->user()->unreadNotifications as $notification)
                    @include('admin.notification.'.snake_case(class_basename($notification->type)))


                @empty
                @endforelse</li>
            {{--<li><a href="{{route('catalogues.index')}}"><i class="fa fa-list"></i> Catalogue</a></li>--}}
            <li class="{{Request::is('admin/global-setting')?'active':''}}  treeview"><a
                        href="{{url('/admin/global-setting')}}"><i class="fa fa-cog"></i> <span>Global Setup</span></a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

  