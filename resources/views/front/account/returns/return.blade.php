@extends('front.app')
@section('content')
    <div class="fullWidthHeader">
        @include('front.partials.header')
    </div>
    <main>
        <div class="cabinet" id="bodyScroll">
            <ul class="crumbs">
                <li>
                    <a href="{{ url('/'.$lang->lang) }}">Home</a>
                </li>
                <li><a href="#">{{ trans('vars.Cabinet.returns') }}</a></li>
            </ul>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h5>{{ trans('vars.Cabinet.returns') }}</h5>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="cabinetNavBloc">
                            <div class="cabNavTitle">
                                {{ trans('vars.General.hello') }}, {{ $userdata->name }}
                            </div>
                            
                            @include('front.account.accountMenu')
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-7">
                        <div>
                            <a href="{{ url('/'.$lang->lang.'/account/returns/create') }}" class="butt">Add new return</a>
                        </div>
                        @if ($returns->count() > 0)
                            @foreach ($returns as $key => $return)
                            <div class="row align-items-center justify-content-between historyItem">
                                <div class="col-md-8">
                                    <div>
                                        Return din {{ trans('vars.Cabinet.order') }} <small>Nr. {{ $return->order->order_hash }}</small>
                                    </div>
                                    <div>{{ trans('vars.Cabinet.atDate') }}: {{ date('d-m-Y', strtotime($return->datetime)) }}</div>
                                </div>
                                <div class="col-md-4 buttGroup">
                                    <a href="{{ url('/'.$lang->lang.'/account/returns/'.$return->id) }}" class="butt">{{ trans('vars.Cabinet.returnDetails') }}</a>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('front.partials.footer')
@stop

                   <li class="nav-item">
                                        <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="pill" href="#menu{{ $child->id }}">
                                        {{ $child->translation->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="col-md category-one-items tab-content">
                        <div class="sharing_block">
                            <div class="addthis_toolbox addthis_default_style ">
                              <a class="addthis_button_preferred_1"></a>
                              <a class="addthis_button_preferred_2"></a>
                              <a class="addthis_button_preferred_3"></a>
                              <a class="addthis_button_preferred_4"></a>
                              <a class="addthis_button_compact"></a>
                              <a class="addthis_counter addthis_bubble_style"></a>
                            </div>
                            <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-507bec157716424a"></script>
                        </div>
                        @if ($resource->children()->count() > 0)
                        @foreach ($resource->children as $key => $child)
                        <div id="menu{{ $child->id }}" class="tab-section tab-pane fade {{ $key == 0 ? 'active in show' : '' }} ">
                            @if ($child->blogs()->count() > 0)
                            @foreach ($child->blogs as $key => $blog)
                                <div class="item-project-one">
                                    <div class="book-description">
                                        <div>
                                            <a class="title" href="{{ $blog->translation->seo_text }}">{{ $blog->translation->name }}</a>
                                        </div>
                                        <p class="description">
                                            {{ $blog->translation->description }}
                                        </p>
                                        @if ($blog->translation->body)
                                            <button type="button" name="button" class="view-more">Vezi mai mult</button>
                                            <section class="body" style="display: none">
                                                {!! $blog->translation->body !!}
                                            </section>
                                        @endif
                                    </div>
                                    <a href="{{ $blog->translation->seo_text }}" target="_blank" class="image-container">
                                        <img src="/images/blogs/{{ $blog->translation->banner }}" alt="" />
                                    </a>
                                </div>
                            @endforeach
                            @endif
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('front.partials.footer')
@stop
