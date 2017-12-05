@extends("app")

@section('head_title', $category->name .' | '.getcong('sitename') )
@section('head_description', $category->description )



@section("content")

@if(!empty($lastFeaturestop))

    <div class="content shay">

        <div class="container shay">

            <div class="row homefeatures clearfix">
                <h1 style="margin-left: 5px;"><span style="font-weight: 700;">{{ $category->name }}</span>  <small style="color:#f1f1f1">|</small>

                        @foreach(\App\Categories::where('type', $category->id)->orderBy('name')->groupBy('name')->get() as $cat)

                                <a style="font-size:16px;margin-left:10px;color:#999;" data-type="{{ $cat->name_slug }}" href="/{{ $cat->name_slug }}"> {{ $cat->name }}</a>

                        @endforeach

                </h1>
                <div class="pull-l">
                    @foreach($lastFeaturestop->slice(0,1) as $item)
                        <div class="tile tile-2">
                            @include('._particles._lists.features_list', ['descof' => 'on','metaon' => 'on'])

                        </div>
                    @endforeach

                </div>
                <div class="pull-l">
                    @foreach($lastFeaturestop->slice(1,1) as $item)
                        <div class="tile tile-1">
                            @include('._particles._lists.features_list', ['descof' => 'on','metaon' => 'on'])

                        </div>
                    @endforeach

                </div>

                <div class="pull-l tway">
                    @foreach($lastFeaturestop->slice(2,2) as $item)
                        <div class="tile tile-3">
                            @include('._particles._lists.features_list', ['metaon' => 'on'])

                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endif

    <div class="content">

        <div class="container">

            <div class="mainside cat">
                <div class="external-sign-in rss" style="margin:0;padding:0;width:auto;float:right">
                    <a class="Rss mini"  target=_blank style="width:24px;height:24px;margin:6px 0 0 0" href="{{ $category->name_slug }}.xml"></a></div>
                <style>.external-sign-in.rss a:after{ font-size:14px!important;  top: 5px!important;left:-7px}</style>
                <div class="colheader   none ">
                    @if(isset($search))
                            <h1>{{ $search }}</h1>
                    @elseif(isset($category->name))
                        <h1>{{ trans('index.latest', ['type' => $category->name ]) }}</h1>
                    @endif

                </div>


                @if($lastItems->total() > 0)
                    <div class="jscroll" data-auto="{!!  getcong('AutoLoadLists') ?: 'false' !!}">
                    @include('pages.catpostloadpage')
                    </div>
                    @else
                    @include('errors.emptycontent')

                @endif

            </div>
            <div class="sidebar">

                @foreach(\App\Widgets::where('type', 'CatSide')->where('display', 'on')->get() as $widget)
                    {!! $widget->text !!}
                @endforeach
                    @if($lastNews)

                    <div class="colheader" style="border:0;text-transform: uppercase">
                        <h1>{{ trans('index.weekly') }} {!! trans('index.top', ['type' => '<span style="color:#d92b2b">'.$category->name.'</span>' ]) !!}</h1>
                    </div>
                @include("_widgets.trendlist_sidebar")
                    @endif
                @include("_widgets/facebooklike")

            </div>
        </div>

    </div>
<div class="main-content--section pbottom--30">
    <div class="container">
        <div class="main--content">
            <div class="post--items post--items-1 pd--30-0">
                <div class="row gutter--15">
                    <div class="col-md-3">
                        <div class="row gutter--15">
                            <div class="col-md-12 col-xs-6 col-xxs-12">
                                <div class="post--item post--layout-1 post--title-large">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/banner-01.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Drone</a> <a href="#" class="icon"><i class="fa fa-flash"></i></a>
                                        <div class="post--info">
                                            <ul class="nav meta">
                                                <li><a href="#">Corey I. Dean</a></li>
                                                <li><a href="#">20 April 2017</a></li>
                                            </ul>
                                            <div class="title">
                                                <h2 class="h4"><a href="news-single-v1.html" class="btn-link">Lorem Ipsum is simply dummy text of the printing</a></h2> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-6 hidden-xxs">
                                <div class="post--item post--layout-1 post--title-large">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/banner-02.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Gadget</a> <a href="#" class="icon"><i class="fa fa-support"></i></a>
                                        <div class="post--info">
                                            <ul class="nav meta">
                                                <li><a href="#">Corey I. Dean</a></li>
                                                <li><a href="#">20 April 2017</a></li>
                                            </ul>
                                            <div class="title">
                                                <h2 class="h4"><a href="news-single-v1.html" class="btn-link">Lorem Ipsum is simply dummy text of the printing</a></h2> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="post--item post--layout-1 post--title-larger">
                            <div class="post--img">
                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/banner-03.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Computer</a> <a href="#" class="icon"><i class="fa fa-star-o"></i></a>
                                <div class="post--info">
                                    <ul class="nav meta">
                                        <li><a href="#">Norma R. Hogan</a></li>
                                        <li><a href="#">20 April 2017</a></li>
                                    </ul>
                                    <div class="title">
                                        <h2 class="h4"><a href="news-single-v1.html" class="btn-link">Siriyan civil war getting righteous indignation and dislike men who are so beguiled and demoralized by the sure.</a></h2> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row gutter--15">
                            <div class="col-md-12 col-xs-6 col-xxs-12">
                                <div class="post--item post--layout-1 post--title-large">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/banner-04.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Gadget</a> <a href="#" class="icon"><i class="fa fa-flash"></i></a>
                                        <div class="post--info">
                                            <ul class="nav meta">
                                                <li><a href="#">Leraje</a></li>
                                                <li><a href="#">20 April 2017</a></li>
                                            </ul>
                                            <div class="title">
                                                <h2 class="h4"><a href="news-single-v1.html" class="btn-link">Lorem Ipsum is simply dummy text of the printing</a></h2> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-6 hidden-xxs">
                                <div class="post--item post--layout-1 post--title-large">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/banner-05.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Magazine</a> <a href="#" class="icon"><i class="fa fa-book"></i></a>
                                        <div class="post--info">
                                            <ul class="nav meta">
                                                <li><a href="#">Balam</a></li>
                                                <li><a href="#">20 April 2017</a></li>
                                            </ul>
                                            <div class="title">
                                                <h2 class="h4"><a href="news-single-v1.html" class="btn-link">On the other hand, we denounce with righteous and deby</a></h2> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="transform: none;">
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                <div class="sticky-content-inner" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                    <div class="row">
                        <div class="col-md-6 ptop--30 pbottom--30">
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Online</h2>
                                <div class="nav">
                                    <a href="#" class="prev btn-link" data-ajax-action="load_prev_online_posts"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                    <a href="#" class="next btn-link" data-ajax-action="load_next_online_posts"> <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                            <div class="post--items post--items-2" data-ajax-content="outer">
                                <ul class="nav" data-ajax-content="inner">
                                    <li>
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/online-01.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Online</a> <a href="#" class="icon"><i class="fa fa-flash"></i></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">On the other hand, we denounce with righteous indignation and dislike demoralized</a></h3> </div>
                                                </div>
                                            </div>
                                            <div class="post--content">
                                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos mollitia animi, id est laborum et dolorum fuga.</p>
                                            </div>
                                            <div class="post--action"> <a href="news-single-v1.html">Continue Reading... </a> </div>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="divider"> </li>
                                    <li>
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/online-02.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Online</a> <a href="#" class="icon"><i class="fa fa-flash"></i></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">On the other hand, we denounce with righteous indignation and dislike demoralized</a></h3> </div>
                                                </div>
                                            </div>
                                            <div class="post--content">
                                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos mollitia animi, id est laborum et dolorum fuga.</p>
                                            </div>
                                            <div class="post--action"> <a href="news-single-v1.html">Continue Reading... </a> </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ptop--30 pbottom--30">
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Gadgets</h2>
                                <div class="nav">
                                    <a href="#" class="prev btn-link" data-ajax-action="load_prev_gadgets_posts"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                    <a href="#" class="next btn-link" data-ajax-action="load_next_gadgets_posts"> <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                            <div class="post--items post--items-3" data-ajax-content="outer">
                                <ul class="nav" data-ajax-content="inner">
                                    <li>
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/gadgets-01.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Gadget</a> <a href="#" class="icon"><i class="fa fa-heart-o"></i></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Bathin</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/gadgets-02.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Bune</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted by the readable</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/gadgets-03.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Bune</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted by the readable</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/gadgets-04.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Bune</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted by the readable</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/gadgets-05.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Bune</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted by the readable</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <div class="ad--space">
                                <a href="#"> <img src="img/ads-img/ad-728x90-02.jpg" alt="" class="center-block" data-rjs="2"> </a>
                            </div>
                        </div>
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Multimedia</h2>
                                <div class="nav">
                                    <a href="#" class="prev btn-link" data-ajax-action="load_prev_multimedia_posts"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                    <a href="#" class="next btn-link" data-ajax-action="load_next_multimedia_posts"> <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                            <div class="post--items post--items-2" data-ajax-content="outer">
                                <ul class="nav row" data-ajax-content="inner">
                                    <li class="col-md-12">
                                        <div class="post--item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="post--img">
                                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/multimedia-01.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Computer</a> <a href="#" class="icon"><i class="fa fa-star-o"></i></a> </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#">Vassago</a></li>
                                                            <li><a href="#">Today 03:30 am</a></li>
                                                        </ul>
                                                        <div class="title">
                                                            <h3 class="h4"><a href="news-single-v1.html" class="btn-link">At vero eos et accusamus et iusto odio dignissimos uniti atque corrupti quos dolores et quas.</a></h3> </div>
                                                    </div>
                                                    <div class="post--content">
                                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos mollitia animi, id est laborum et dolorum fuga.</p>
                                                    </div>
                                                    <div class="post--action"> <a href="news-single-v1.html">Continue Reading...</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <hr class="divider"> </li>
                                    <li class="col-md-6">
                                        <div class="post--item post--layout-4">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/multimedia-02.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Demiurge</a></li>
                                                        <li><a href="#">Today 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-12 hidden-md hidden-lg">
                                        <hr class="divider"> </li>
                                    <li class="col-md-6">
                                        <div class="post--item post--layout-4">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/multimedia-03.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Demiurge</a></li>
                                                        <li><a href="#">Today 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <hr class="divider"> </li>
                                    <li class="col-md-6">
                                        <div class="post--item post--layout-4">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/multimedia-04.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Demiurge</a></li>
                                                        <li><a href="#">Today 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-12 hidden-md hidden-lg">
                                        <hr class="divider"> </li>
                                    <li class="col-md-6">
                                        <div class="post--item post--layout-4">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/multimedia-05.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Demiurge</a></li>
                                                        <li><a href="#">Today 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ptop--30 pbottom--30">
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Science</h2>
                                <div class="nav">
                                    <a href="#" class="prev btn-link" data-ajax-action="load_prev_science_posts"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                    <a href="#" class="next btn-link" data-ajax-action="load_next_science_posts"> <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                            <div class="post--items post--items-2" data-ajax-content="outer">
                                <ul class="nav" data-ajax-content="inner">
                                    <li>
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/science-01.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Satellite</a> <a href="#" class="icon"><i class="fa fa-flash"></i></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">On the other hand, we denounce with righteous indignation and dislike demoralized</a></h3> </div>
                                                </div>
                                            </div>
                                            <div class="post--content">
                                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos mollitia animi, id est laborum et dolorum fuga.</p>
                                            </div>
                                            <div class="post--action"> <a href="news-single-v1.html">Continue Reading... </a> </div>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="divider"> </li>
                                    <li>
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/science-02.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Satellite</a> <a href="#" class="icon"><i class="fa fa-flash"></i></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">On the other hand, we denounce with righteous indignation and dislike demoralized</a></h3> </div>
                                                </div>
                                            </div>
                                            <div class="post--content">
                                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos mollitia animi, id est laborum et dolorum fuga.</p>
                                            </div>
                                            <div class="post--action"> <a href="news-single-v1.html">Continue Reading... </a> </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ptop--30 pbottom--30">
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Research</h2>
                                <div class="nav">
                                    <a href="#" class="prev btn-link" data-ajax-action="load_prev_research_posts"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                    <a href="#" class="next btn-link" data-ajax-action="load_next_research_posts"> <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                            <div class="post--items post--items-2" data-ajax-content="outer">
                                <ul class="nav" data-ajax-content="inner">
                                    <li>
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/research-01.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Chemist</a> <a href="#" class="icon"><i class="fa fa-flash"></i></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">On the other hand, we denounce with righteous indignation and dislike demoralized</a></h3> </div>
                                                </div>
                                            </div>
                                            <div class="post--content">
                                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos mollitia animi, id est laborum et dolorum fuga.</p>
                                            </div>
                                            <div class="post--action"> <a href="news-single-v1.html">Continue Reading... </a> </div>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="divider"> </li>
                                    <li>
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/research-02.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Chemist</a> <a href="#" class="icon"><i class="fa fa-flash"></i></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Famous</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">On the other hand, we denounce with righteous indignation and dislike demoralized</a></h3> </div>
                                                </div>
                                            </div>
                                            <div class="post--content">
                                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos mollitia animi, id est laborum et dolorum fuga.</p>
                                            </div>
                                            <div class="post--action"> <a href="news-single-v1.html">Continue Reading... </a> </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resize-sensor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                        <div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div style="position: absolute; left: 0px; top: 0px; transition: 0s; width: 790px; height: 2198px;"></div>
                        </div>
                        <div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 2186.5px;">
                <div class="sticky-content-inner" style="padding-top: 0px; padding-bottom: 1px; position: absolute; transform: translateY(142.5px); width: 360px; top: 0px;">
                    <div class="widget">
                        <div class="ad--widget">
                            <a href="#"> <img src="img/ads-img/ad-300x250-1.jpg" alt="" data-rjs="2"> </a>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Stay Connected</h2> <i class="icon fa fa-share-alt"></i> </div>
                        <div class="social--widget style--1">
                            <ul class="nav">
                                <li class="facebook">
                                    <a href="#"> <span class="icon"><i class="fa fa-facebook-f"></i></span> <span class="count">521</span> <span class="title">Likes</span> </a>
                                </li>
                                <li class="twitter">
                                    <a href="#"> <span class="icon"><i class="fa fa-twitter"></i></span> <span class="count">3297</span> <span class="title">Followers</span> </a>
                                </li>
                                <li class="google-plus">
                                    <a href="#"> <span class="icon"><i class="fa fa-google-plus"></i></span> <span class="count">596282</span> <span class="title">Followers</span> </a>
                                </li>
                                <li class="rss">
                                    <a href="#"> <span class="icon"><i class="fa fa-rss"></i></span> <span class="count">521</span> <span class="title">Subscriber</span> </a>
                                </li>
                                <li class="vimeo">
                                    <a href="#"> <span class="icon"><i class="fa fa-vimeo"></i></span> <span class="count">3297</span> <span class="title">Followers</span> </a>
                                </li>
                                <li class="youtube">
                                    <a href="#"> <span class="icon"><i class="fa fa-youtube-square"></i></span> <span class="count">596282</span> <span class="title">Subscriber</span> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Get Newsletter</h2> <i class="icon fa fa-envelope-open-o"></i> </div>
                        <div class="subscribe--widget">
                            <div class="content">
                                <p>Subscribe to our newsletter to get latest news, popular news and exclusive updates.</p>
                            </div>
                            <form action="../../../../external.html?link=https://themelooks.us13.list-manage.com/subscribe/post?u=79f0b132ec25ee223bb41835f&amp;id=f4e0e93d1d" method="post" name="mc-embedded-subscribe-form" target="_blank" data-form="mailchimpAjax" novalidate="novalidate">
                                <div class="input-group">
                                    <input type="email" name="EMAIL" placeholder="E-mail address" class="form-control" autocomplete="off" required="" aria-required="true">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-lg btn-default active"><i class="fa fa-paper-plane-o"></i></button>
                                    </div>
                                </div>
                                <div class="status"></div>
                            </form>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Featured News</h2> <i class="icon fa fa-newspaper-o"></i> </div>
                        <div class="list--widget list--widget-1">
                            <div class="list--widget-nav" data-ajax="tab">
                                <ul class="nav nav-justified">
                                    <li> <a href="#" data-ajax-action="load_widget_hot_news">Hot News</a> </li>
                                    <li class="active"> <a href="#" data-ajax-action="load_widget_trendy_news">Trendy News</a> </li>
                                    <li> <a href="#" data-ajax-action="load_widget_most_watched">Most Watched</a> </li>
                                </ul>
                            </div>
                            <div class="post--items post--items-3" data-ajax-content="outer">
                                <ul class="nav" data-ajax-content="inner">
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/widgets-img/news-widget-01.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Ninurta</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/widgets-img/news-widget-02.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Orcus</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/widgets-img/news-widget-03.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Rahab</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/widgets-img/news-widget-04.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Tannin</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget--title">
                            <h2 class="h4">Advertisement</h2> <i class="icon fa fa-bullhorn"></i> </div>
                        <div class="ad--widget">
                            <a href="#"> <img src="img/ads-img/ad-300x250-2.jpg" alt="" data-rjs="2"> </a>
                        </div>
                    </div>
                    <div class="resize-sensor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                        <div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div style="position: absolute; left: 0px; top: 0px; transition: 0s; width: 370px; height: 2024px;"></div>
                        </div>
                        <div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main--content pd--30-0">
            <div class="post--items-title" data-ajax="tab">
                <h2 class="h4">Audio &amp; Videos</h2>
                <div class="nav">
                    <a href="#" class="prev btn-link" data-ajax-action="load_prev_audio_video_posts"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                    <a href="#" class="next btn-link" data-ajax-action="load_next_audio_video_posts"> <i class="fa fa-long-arrow-right"></i> </a>
                </div>
            </div>
            <div class="post--items post--items-4" data-ajax-content="outer">
                <ul class="nav row" data-ajax-content="inner">
                    <li class="col-md-8">
                        <div class="post--item post--layout-1 post--type-video post--title-large">
                            <div class="post--img">
                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/audio-video-01.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Computer</a> <a href="#" class="icon"><i class="fa fa-eye"></i></a>
                                <div class="post--info">
                                    <ul class="nav meta">
                                        <li><a href="#">Succubus</a></li>
                                        <li><a href="#">Today 03:52 pm</a></li>
                                    </ul>
                                    <div class="title">
                                        <h2 class="h4"><a href="news-single-v1.html" class="btn-link">Standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum</a></h2> </div>
                                </div>
                            </div>
                        </div>
                        <hr class="divider hidden-md hidden-lg"> </li>
                    <li class="col-md-4">
                        <ul class="nav">
                            <li>
                                <div class="post--item post--type-audio post--layout-3">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/audio-video-02.jpg" alt="" data-rjs="2"></a>
                                        <div class="post--info">
                                            <ul class="nav meta">
                                                <li><a href="#">Maclaan John</a></li>
                                                <li><a href="#">16 April 2017</a></li>
                                            </ul>
                                            <div class="title">
                                                <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted by the readable</a></h3> </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post--item post--type-video post--layout-3">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/audio-video-03.jpg" alt="" data-rjs="2"></a>
                                        <div class="post--info">
                                            <ul class="nav meta">
                                                <li><a href="#">Maclaan John</a></li>
                                                <li><a href="#">16 April 2017</a></li>
                                            </ul>
                                            <div class="title">
                                                <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted by the readable</a></h3> </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post--item post--type-audio post--layout-3">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/audio-video-04.jpg" alt="" data-rjs="2"></a>
                                        <div class="post--info">
                                            <ul class="nav meta">
                                                <li><a href="#">Maclaan John</a></li>
                                                <li><a href="#">16 April 2017</a></li>
                                            </ul>
                                            <div class="title">
                                                <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted by the readable</a></h3> </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post--item post--type-video post--layout-3">
                                    <div class="post--img">
                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/audio-video-05.jpg" alt="" data-rjs="2"></a>
                                        <div class="post--info">
                                            <ul class="nav meta">
                                                <li><a href="#">Maclaan John</a></li>
                                                <li><a href="#">16 April 2017</a></li>
                                            </ul>
                                            <div class="title">
                                                <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted by the readable</a></h3> </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="preloader bg--color-0--b" data-preloader="1">
                    <div class="preloader--inner"></div>
                </div>
            </div>
        </div>
        <div class="ad--space pd--30-0">
            <a href="#"> <img src="img/ads-img/ad-970x90.jpg" alt="" class="center-block" data-rjs="2"> </a>
        </div>
        <div class="row" style="transform: none;">
            <div class="main--content col-md-8 col-sm-7" data-sticky-content="true" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 2001px;">
                <div class="sticky-content-inner" style="padding-top: 0px; padding-bottom: 1px; position: absolute; transform: translateY(234.14px); width: 750px; top: 0px;">
                    <div class="row">
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Games</h2>
                                <div class="nav">
                                    <a href="#" class="prev btn-link" data-ajax-action="load_prev_games_posts"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                    <a href="#" class="next btn-link" data-ajax-action="load_next_games_posts"> <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                            <div class="post--items" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    <li class="col-md-4 col-xs-6 col-xxs-12">
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/games-01.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-xs-12 hidden shown-xxs">
                                        <hr class="divider"> </li>
                                    <li class="col-md-4 col-xs-6 col-xxs-12">
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/games-02.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-4 hidden-sm hidden-xs">
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/games-03.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Yeasterday 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Automobile</h2>
                                <div class="nav">
                                    <a href="#" class="prev btn-link" data-ajax-action="load_prev_automobile_posts"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                    <a href="#" class="next btn-link" data-ajax-action="load_next_automobile_posts"> <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                            <div class="post--items post--items-2" data-ajax-content="outer">
                                <ul class="nav" data-ajax-content="inner">
                                    <li>
                                        <div class="post--item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="post--img">
                                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/automobile-01.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Automobile</a> <a href="#" class="icon"><i class="fa fa-star-o"></i></a> </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#">Vassago</a></li>
                                                            <li><a href="#">Today 03:30 am</a></li>
                                                        </ul>
                                                        <div class="title">
                                                            <h3 class="h4"><a href="news-single-v1.html" class="btn-link">At vero eos et accusamus et iusto odio dignissimos uniti atque corrupti quos dolores et quas.</a></h3> </div>
                                                    </div>
                                                    <div class="post--content">
                                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos mollitia animi, id est laborum et dolorum fuga.</p>
                                                    </div>
                                                    <div class="post--action"> <a href="news-single-v1.html">Continue Reading...</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="divider"> </li>
                                    <li>
                                        <div class="post--item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="post--img">
                                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/automobile-02.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Automobile</a> <a href="#" class="icon"><i class="fa fa-flash"></i></a> </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#">Vassago</a></li>
                                                            <li><a href="#">Today 03:30 am</a></li>
                                                        </ul>
                                                        <div class="title">
                                                            <h3 class="h4"><a href="news-single-v1.html" class="btn-link">At vero eos et accusamus et iusto odio dignissimos uniti atque corrupti quos dolores et quas.</a></h3> </div>
                                                    </div>
                                                    <div class="post--content">
                                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos mollitia animi, id est laborum et dolorum fuga.</p>
                                                    </div>
                                                    <div class="post--action"> <a href="news-single-v1.html">Continue Reading...</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="divider"> </li>
                                    <li>
                                        <div class="post--item">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="post--img">
                                                        <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/automobile-03.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Automobile</a> <a href="#" class="icon"><i class="fa fa-heart-o"></i></a> </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="post--info">
                                                        <ul class="nav meta">
                                                            <li><a href="#">Vassago</a></li>
                                                            <li><a href="#">Today 03:30 am</a></li>
                                                        </ul>
                                                        <div class="title">
                                                            <h3 class="h4"><a href="news-single-v1.html" class="btn-link">At vero eos et accusamus et iusto odio dignissimos uniti atque corrupti quos dolores et quas.</a></h3> </div>
                                                    </div>
                                                    <div class="post--content">
                                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos mollitia animi, id est laborum et dolorum fuga.</p>
                                                    </div>
                                                    <div class="post--action"> <a href="news-single-v1.html">Continue Reading...</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ptop--30 pbottom--30">
                            <div class="post--items-title" data-ajax="tab">
                                <h2 class="h4">Photo Gallery</h2>
                                <div class="nav">
                                    <a href="#" class="prev btn-link" data-ajax-action="load_prev_photo_gallery_posts"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                    <a href="#" class="next btn-link" data-ajax-action="load_next_photo_gallery_posts"> <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                            <div class="post--items post--items-1" data-ajax-content="outer">
                                <ul class="nav row gutter--15" data-ajax-content="inner">
                                    <li class="col-md-12">
                                        <div class="post--item post--layout-1 post--title-large">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/photo-gallery-01.jpg" alt="" data-rjs="2"></a> <a href="#" class="cat">Chemist</a> <a href="#" class="icon"><i class="fa fa-eye"></i></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Today 05:52 pm</a></li>
                                                    </ul>
                                                    <div class="title text-xxs-ellipsis">
                                                        <h2 class="h4"><a href="news-single-v1.html" class="btn-link">Standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum</a></h2> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-4 col-xs-6 col-xxs-12">
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/photo-gallery-02.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Today 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h2 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h2> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-4 col-xs-6 col-xxs-12">
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/photo-gallery-03.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Today 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h2 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h2> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-md-4 hidden-sm hidden-xs">
                                        <div class="post--item post--layout-1">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/technology-img/photo-gallery-04.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Astaroth</a></li>
                                                        <li><a href="#">Today 03:52 pm</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h2 class="h4"><a href="news-single-v1.html" class="btn-link">It is a long established fact that a reader will be distracted by</a></h2> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pagination--wrapper ptop--30 pbottom--30 clearfix">
                                <p class="pagination-hint float--left">Page 02 of 03</p>
                                <ul class="pagination float--right">
                                    <li><a href="#"><i class="fa fa-long-arrow-left"></i></a></li>
                                    <li><a href="#">01</a></li>
                                    <li class="active"><span>02</span></li>
                                    <li><a href="#">03</a></li>
                                    <li><a href="#"><i class="fa fa-long-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="resize-sensor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                        <div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div style="position: absolute; left: 0px; top: 0px; transition: 0s; width: 760px; height: 1777px;"></div>
                        </div>
                        <div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main--sidebar col-md-4 col-sm-5 ptop--30 pbottom--30" data-sticky-content="true" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                <div class="sticky-content-inner" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                    <div class="widget">
                        <div class="widget--title" data-ajax="tab">
                            <h2 class="h4">Voting Poll (Checkbox)</h2>
                            <div class="nav">
                                <a href="#" class="prev btn-link" data-ajax-action="load_prev_poll_widget"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                <a href="#" class="next btn-link" data-ajax-action="load_next_poll_widget"> <i class="fa fa-long-arrow-right"></i> </a>
                            </div>
                        </div>
                        <div class="poll--widget" data-ajax-content="outer">
                            <ul class="nav" data-ajax-content="inner">
                                <li class="title">
                                    <h3 class="h4">Which was the best Football World Cup ever in your opinion?</h3> </li>
                                <li class="options">
                                    <form action="#">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="option-1"> <span>Brazil 2014</span> </label>
                                            <p>65%<span style="width: 65%;"></span></p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="option-2"> <span>South Africa 2010</span> </label>
                                            <p>28%<span style="width: 28%;"></span></p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="option-2"> <span>Germany 2006</span> </label>
                                            <p>07%<span style="width: 07%;"></span></p>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Vote Now</button>
                                    </form>
                                </li>
                            </ul>
                            <div class="preloader bg--color-0--b" data-preloader="1">
                                <div class="preloader--inner"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget--title" data-ajax="tab">
                            <h2 class="h4">Voting Poll (Radio)</h2>
                            <div class="nav">
                                <a href="#" class="prev btn-link" data-ajax-action="load_prev_poll_widget"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                <a href="#" class="next btn-link" data-ajax-action="load_next_poll_widget"> <i class="fa fa-long-arrow-right"></i> </a>
                            </div>
                        </div>
                        <div class="poll--widget" data-ajax-content="outer">
                            <ul class="nav" data-ajax-content="inner">
                                <li class="title">
                                    <h3 class="h4">Do you think the cost of sending money to mobile phone should be reduced?</h3> </li>
                                <li class="options">
                                    <form action="#">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="option-1"> <span>Yes</span> </label>
                                            <p>65%<span style="width: 65%;"></span></p>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="option-1"> <span>No</span> </label>
                                            <p>28%<span style="width: 28%;"></span></p>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="option-1"> <span>Average</span> </label>
                                            <p>07%<span style="width: 07%;"></span></p>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Vote Now</button>
                                    </form>
                                </li>
                            </ul>
                            <div class="preloader bg--color-0--b" data-preloader="1">
                                <div class="preloader--inner"></div>
                            </div>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="ad--widget">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#"> <img src="img/ads-img/ad-150x150-1.jpg" alt="" data-rjs="2"> </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#"> <img src="img/ads-img/ad-150x150-2.jpg" alt="" data-rjs="2"> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget--title" data-ajax="tab">
                            <h2 class="h4">Readers Opinion</h2>
                            <div class="nav">
                                <a href="#" class="prev btn-link" data-ajax-action="load_prev_readers_opinion_widget"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                <a href="#" class="next btn-link" data-ajax-action="load_next_readers_opinion_widget"> <i class="fa fa-long-arrow-right"></i> </a>
                            </div>
                        </div>
                        <div class="list--widget list--widget-2" data-ajax-content="outer">
                            <div class="post--items post--items-3">
                                <ul class="nav" data-ajax-content="inner">
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img"> <span class="thumb"> <img src="img/widgets-img/readers-opinion-01.png" alt="" data-rjs="2"> </span>
                                                <div class="post--info">
                                                    <div class="title">
                                                        <h3 class="h4">Long established fact that a reader will be distracted</h3> </div>
                                                    <ul class="nav meta">
                                                        <li><span>by Ninurta</span></li>
                                                        <li><span>16 April 2017</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img"> <span class="thumb"> <img src="img/widgets-img/readers-opinion-02.png" alt="" data-rjs="2"> </span>
                                                <div class="post--info">
                                                    <div class="title">
                                                        <h3 class="h4">Long established fact that a reader will be distracted</h3> </div>
                                                    <ul class="nav meta">
                                                        <li><span>by Ninurta</span></li>
                                                        <li><span>16 April 2017</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img"> <span class="thumb"> <img src="img/widgets-img/readers-opinion-03.png" alt="" data-rjs="2"> </span>
                                                <div class="post--info">
                                                    <div class="title">
                                                        <h3 class="h4">Long established fact that a reader will be distracted</h3> </div>
                                                    <ul class="nav meta">
                                                        <li><span>by Ninurta</span></li>
                                                        <li><span>16 April 2017</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget">
                        <div class="widget--title" data-ajax="tab">
                            <h2 class="h4">Editors Choice</h2>
                            <div class="nav">
                                <a href="#" class="prev btn-link" data-ajax-action="load_prev_editors_choice_widget"> <i class="fa fa-long-arrow-left"></i> </a> <span class="divider">/</span>
                                <a href="#" class="next btn-link" data-ajax-action="load_next_editors_choice_widget"> <i class="fa fa-long-arrow-right"></i> </a>
                            </div>
                        </div>
                        <div class="list--widget list--widget-1" data-ajax-content="outer">
                            <div class="post--items post--items-3">
                                <ul class="nav" data-ajax-content="inner">
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/widgets-img/editors-choice-01.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Ninurta</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/widgets-img/editors-choice-02.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Orcus</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/widgets-img/editors-choice-03.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Rahab</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="post--item post--layout-3">
                                            <div class="post--img">
                                                <a href="news-single-v1.html" class="thumb"><img src="img/widgets-img/editors-choice-04.jpg" alt="" data-rjs="2"></a>
                                                <div class="post--info">
                                                    <ul class="nav meta">
                                                        <li><a href="#">Tannin</a></li>
                                                        <li><a href="#">16 April 2017</a></li>
                                                    </ul>
                                                    <div class="title">
                                                        <h3 class="h4"><a href="news-single-v1.html" class="btn-link">Long established fact that a reader will be distracted</a></h3> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="preloader bg--color-0--b" data-preloader="1">
                                    <div class="preloader--inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="resize-sensor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                        <div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div style="position: absolute; left: 0px; top: 0px; transition: 0s; width: 400px; height: 2012px;"></div>
                        </div>
                        <div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection