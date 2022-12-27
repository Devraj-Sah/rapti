@extends('admin.layout.master')
@section('content')
   @section('content')
<section class="content">
    <div class="box box-info">
        <div class="box-header with-border">
            <h2 class="text-center">Welcome to Dashboard</h2> <hr> 
            
            <!-- Total visitors -->
						<div class="col-lg-4 col-md-6">
							<a href="{{url('/admin/navigation-list/Main')}}">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<div class="row">
											<div class="text-center">
												<div class=""><h3>Total Menus</h3></div>
												<div class="badge">{{count($navigations)}}
												</div>
												
											</div>
										</div>
									</div>
									
									<div class="panel-footer">
										<span class="pull-left">View Details</span>
										<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
										<div class="clearfix"></div>
									</div>
									
								</div>
							</a>
						</div>
        </div>
    </div>
</section>

@endsection