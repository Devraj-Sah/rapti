<section class="breadcrumb">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 breadcrumb_wrapper">
                <h2 class="entry-title">Category Page</h2>
                <nav id="breadcrumb" class="fitness-park-breadcrumb">
                    <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs"
                         itemprop="breadcrumb">
                        <ul class="trail-items" itemscope="" itemtype="http://schema.org/BreadcrumbList">

                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"
                                class="trail-item trail-begin"><a href="{{url('/')}}" rel="home" itemprop="item"><span
                                            itemprop="name">Home</span></a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"
                                class="trail-item trail-end"><span itemprop="item"><span
                                            itemprop="name">{{$model->name}}</span></span>
                                <meta itemprop="position" content="2">
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>