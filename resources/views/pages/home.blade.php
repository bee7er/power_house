<?php use App\Http\Helpers\TemplateHelper; ?>

@extends('layouts.app')
@section('title') home @parent @endsection

@section('content')

    <div id="home">&nbsp;</div>

    @if(count($resources)>0)
        <div class="row-container">
            <div class="row">
                @foreach($resources as $resource)
                    @if($resource->video)
                        <div {!! $resource->clickAction !!}>
                            <video class="work-image {!! $resource->clickActionClass !!} col-xs-12 col-sm-6 col-md-6
                             col-lg-4"
                                   autoplay
                                   muted loop
                                   preload="auto">
                                <source src="{!! $resource->video !!}" type="video/mp4">
                                Your browser does not support the video tag
                            </video>
                        </div>
                    @else
                        <div {!! $resource->clickAction !!}>
                            <img id="{!! $resource->id !!}" class="work-image {!! $resource->clickActionClass !!}
                                    col-xs-12 col-sm-6 col-md-6 col-lg-4"
                                 {!! $resource->hoverActions !!}
                                 src="{!! $resource->thumb !!}" title="" alt="{!! $resource->name !!}">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="go-top" onclick="scrollToAnchor('top');">
            <div id="goTopHand-work" class="bodymovin-hand" onmouseover="startBodymovinHand(WORK);"
                 onmouseout="stopBodymovinHand(WORK);">
            </div>
        </div>
    @endif

    @if(count($notices)>0)
        <div id="news" class="panel-title">news</div>
            <div class="row news-row-container news-adjust-div" style="max-width: 70%;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 news-text">
                    <ul class="news-adjust-ul">
                        @foreach($notices as $notice)
                            @if($notice->url)
                                <li><a href="{!! url($notice->url) !!}" class="">{!! $notice->notice !!}</a></li>
                            @else
                                <li>{!! $notice->notice !!}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        <div class="go-top" onclick="scrollToAnchor('top');">
            <div id="goTopHand-press" class="bodymovin-hand" onmouseover="startBodymovinHand(PRESS);"
                 onmouseout="stopBodymovinHand(PRESS);">
            </div>
        </div>
    @endif

    @if($aboutText)
        <div id="about" class="panel-title">about</div>
        <div id="about-row-container" class="row about-row-container" style="padding:0;">
            <div><img alt="" src="img/russ_headshot.jpg" class="headshot"></div>

            {!! $aboutText !!}

        </div>

        <div class="go-top" onclick="scrollToAnchor('top');">
            <div id="goTopHand-about" class="bodymovin-hand" onmouseover="startBodymovinHand(ABOUT);"
                 onmouseout="stopBodymovinHand(ABOUT);">
            </div>
        </div>
    @endif

    @if($logosText)
        <div id="about-row-container" class="row about-row-container" style="padding:0;">

            {!! $logosText !!}

        </div>
    @endif

    <div id="contact" class="panel-title">contact</div>
    <div class="row contact-row-container">

        {!! $contactText !!}

    </div>
    <div class="go-top" onclick="scrollToAnchor('top');">
        <div id="goTopHand-contact" class="bodymovin-hand" onmouseover="startBodymovinHand(CONTACT);"
             onmouseout="stopBodymovinHand(CONTACT);">
        </div>
    </div>

    @if(count($resources)>0)
        {{-- Preload images --}}
        <div style="visibility: hidden;">
            @foreach($resources as $resource)
                <img src="{!! $resource->thumb !!}" class="hidden-preload">
                <img src="{!! $resource->hover !!}" class="hidden-preload">
            @endforeach
        </div>
    @endif

@endsection

@section('page-scripts')
    <script type="text/javascript">
        var WORK = 0;
        var ABOUT  = 1;
        var CONTACT = 2;
        var PRESS = 3;
        $(document).ready( function()
        {
            // Setup the goto top hands and store them in an array
            handAnims[WORK] = createBodymovinHand(document.getElementById('goTopHand-work'));
            handAnims[ABOUT] = createBodymovinHand(document.getElementById('goTopHand-about'));
            handAnims[CONTACT] = createBodymovinHand(document.getElementById('goTopHand-contact'));
            handAnims[PRESS] = createBodymovinHand(document.getElementById('goTopHand-press'));
        });
    </script>
@endsection
