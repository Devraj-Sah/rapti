  @include('admin.partials.header')
  
  @include('admin.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
       <ol class="breadcrumb">
                    <i class="fa fa-dashboard">&nbsp;</i>
                    @for($i = 1; $i <= count(Request::segments()); $i++)
                        <li>
                          <a href="">{{Request::segment($i)}}</a>                           
                        </li>
                     @endfor
            </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    @yield('content')

    </section>
    <!-- /.content -->
  </div>

@include('admin.partials.footer')