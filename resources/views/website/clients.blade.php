@php $sellers = $frontend_helper->getPagesByPageType('authorized-seller','Photo Gallery') @endphp
<div class="client-logo">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="position: relative">
                <h2 class="section-title">Authorized Seller Of</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="distributor">
                    @if(isset($sellers->navigationitems)  && count($sellers->navigationitems) > 0)
                        @foreach($sellers->navigationitems as $keyslider=>$seller)
                            <div class="border-client">
                                <figure>
                                    <img src="{{asset('uploads/photo_gallery/'.$seller->file)}}" alt=""/>
                                </figure>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>