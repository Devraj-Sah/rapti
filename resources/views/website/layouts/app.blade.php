<!doctype html>
<html>
<head>
    <title>@yield('page_title',$settings->page_title)</title>
    <meta name="keywords" content="@yield('page_keyword',$settings->page_keyword)">
    <meta name="description" content="@yield('page_description',$settings->page_description)">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="icon" type="image/png" href="{{asset('assets/img/fav.png')}}" sizes="16x16">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('website/css/style.min.css')}}"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <style>
        /*.select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 38px;
            user-select: none;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 40px;
        }
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: none;
            border-radius: 0px;
        }
         */
        .twitter-typeahead {
            width: 100%;
        }

        .search-input {
            padding: 19px 8px;
            font-size: 16px;
        }

        .tt-dataset {
            background: #FFF;
            padding: 3px 5px;
            border: 1px solid #000;
        }

        .tt-suggestion {
            border-bottom: 1px solid #cbcaca;
            padding: 6px 0;
        }

        #magazine {
            width: 980px;
            height: 640px;
            margin-bottom: 20px;
        }

        #magazine .turn-page {
            background-color: #ccc;
        }
    </style>
</head>

<body style="position: relative">


@include('website.partials.header')
<div style="position: relative">
    @if(\Illuminate\Support\Facades\Auth::guard('web')->check())
        @else
        <div id="checkLogin" class="transparent_overlay"
             style="position: absolute;height: 100%;width:100%;z-index:99 "></div>
        @endif


    @if($message = Session::get('error'))
        <div class="alert alert-danger" style="background: #f71b1b">
            <p>{{$message}}</p>
        </div>
    @endif

    @yield('content')

    @include('website.partials.footer')
</div>


<script src="{{asset('website/js/vendor/jquery-ui.js')}}"></script>
<script src="{{asset('website/js/vendor/lightslider.js')}}"></script>
<script src="{{asset('website/js/vendor/owl.carousel.js')}}"></script>
<script src="{{asset('website/js/vendor/tilt.jquery.js')}}"></script>
<script src="{{asset('website/js/vendor/bootstrap.js')}}"></script>
<script src="{{asset('website/turn/turn.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

<script src="{{asset('website/js/vendor/jquery.elevatezoom.js')}}"></script>
<script src="{{asset('website/js/custom.js')}}"></script>
<script>
    $('.alert-item-added .close').click(function () {
        $('.alert-item-added').hide();
    });
    $(document).ready(function () {
        $("#checkLogin").click(function () {
            $('#loginModal').modal('show');

        });
    });
    $(document).ready(function () {
        $("#signupModal").click(function () {
            $('#signupModal').modal('show');

        });
    });
    $('#magazine').turn({gradients: true, acceleration: true});
</script>
<script type="text/javascript">

    var substringMatcher = function (strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function (i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    var states = <?php echo $names ?>

    $('.search-input').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'q',
            source: substringMatcher(states)
        });

    /*$('.livesearch').select2({
     placeholder: 'Search Products',
     ajax: {
     url: '/search/ajax-autocomplete-search',
     dataType: 'json',
     delay: 250,
     processResults: function (data) {
     return {
     results: $.map(data, function (item) {
     return {
     text: item.name,
     id: item.name
     }
     })
     };
     },
     cache: true
     }
     });*/


    var html5Slider = document.getElementById('html5');

    noUiSlider.create(html5Slider, {
        start: [0, 500],
        connect: true,
        range: {
            'min': 0,
            'max': 1000
        }
    });

    var limitFieldMin = document.getElementById('input-number-min');
    var limitFieldMax = document.getElementById('input-number-max');

    html5Slider.noUiSlider.on('update', function (values, handle) {

        var value = values[handle];

        if (handle) {
            limitFieldMax.value = Math.round(value);
        } else {
            limitFieldMin.value = Math.round(value);
        }
    });

    limitFieldMin.addEventListener('change', function () {
        html5Slider.noUiSlider.set([this.value, null]);
    });

    limitFieldMax.addEventListener('change', function () {
        html5Slider.noUiSlider.set([null, this.value]);
    });
</script>

@yield('script')

</body>
</html>

