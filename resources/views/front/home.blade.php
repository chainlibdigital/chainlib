@extends('../front.app')
@section('content')
    @include('front.partials.header')

    <main class="home-content">

        @include('front.partials.search')

        @php
            $setting = getSettings();
        @endphp

        @if ($setting['promotions'] == 'active')
            <section class="text-sub">
                <div class="container">
                    <p>
                        {{ trans('vars.General.hpNotificareAlarm') }}
                    </p>
                </div>
            </section>
        @endif

        @foreach ($categoriesMenu as $key => $category)
            @if ($category->children->count() > 0)
                @foreach ($category->children as $key => $child)

                    <section class="slider-section blog-section">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-auto col-12">
                                    <h3>{{ $child->translation->name }}</h3>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="slider-standard slider-events">
                                                @foreach($child->products as $product)
                                                    <a target="_blank"
                                                       href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias.'/'.$product->alias) }}"
                                                       class="blog-item">
                                                        <div class="image-container">
                                                            @if($product->hoverImage)
                                                                <img src="{{ asset('images/products/og/'. $product->hoverImage->src) }}"
                                                                     alt=""/>
                                                            @else
                                                                <img src="/cover.png" alt=""/>
                                                            @endif
                                                        </div>
                                                        <div class="blog-description">
                                                            <div>
                                                                <p class="blog-title">{{ $product->translation->name }}</p>
                                                                <p>{{  $product->translation->description }}</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endforeach
            @endif
        @endforeach

        {{--        <section class="slider-section blog-section section-gray title-white">--}}
        {{--            <div class="container">--}}
        {{--                <div class="row justify-content-center">--}}
        {{--                    <div class="col-md-auto col-12">--}}
        {{--                        <h3>Bloguri </h3>--}}
        {{--                    </div>--}}
        {{--                    <div class="col-12">--}}
        {{--                        <div class="row">--}}
        {{--                            --}}{{--                        @if (!is_null($slider2->first()))--}}
        {{--                            --}}{{--                            <a target="_blank" href="{{ $slider2->first()->link }}" class="col-md-4 blog-item static-item">--}}
        {{--                            --}}{{--                                <div class="image-container">--}}
        {{--                            --}}{{--                                  <img src="{{ $slider2->first()->src }}" alt="" />--}}
        {{--                            --}}{{--                                </div>--}}
        {{--                            --}}{{--                                <div class="blog-description">--}}
        {{--                            --}}{{--                                    <div>--}}
        {{--                            --}}{{--                                        <p class="blog-title">--}}
        {{--                            --}}{{--                                            {{ $slider2->first()->title }}--}}
        {{--                            --}}{{--                                        </p>--}}
        {{--                            --}}{{--                                        <p>--}}
        {{--                            --}}{{--                                            {{ $slider2->first()->text }}--}}
        {{--                            --}}{{--                                        </p>--}}
        {{--                            --}}{{--                                    </div>--}}
        {{--                            --}}{{--                                </div>--}}
        {{--                            --}}{{--                            </a>--}}
        {{--                            --}}{{--                        @endif--}}

        {{--                            <div class="col-md-8 slider-standard slider-blog">--}}
        {{--                                --}}{{--                            @foreach ($slider2 as $key => $image)--}}
        {{--                                --}}{{--                                @if ($key !== 0)--}}
        {{--                                --}}{{--                                    <a target="_blank" href="{{ $image->link }}" class="blog-item">--}}
        {{--                                --}}{{--                                        <div class="image-container">--}}
        {{--                                --}}{{--                                            <img src="{{ $image->src }}" alt="" />--}}
        {{--                                --}}{{--                                        </div>--}}
        {{--                                --}}{{--                                        <div class="blog-description">--}}
        {{--                                --}}{{--                                            <div>--}}
        {{--                                --}}{{--                                                <p class="blog-title">{{ $image->title }}</p>--}}
        {{--                                --}}{{--                                                <p>{{ $image->text }}</p>--}}
        {{--                                --}}{{--                                            </div>--}}
        {{--                                --}}{{--                                        </div>--}}
        {{--                                --}}{{--                                    </a>--}}
        {{--                                --}}{{--                                @endif--}}
        {{--                                --}}{{--                            @endforeach--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}

    </main>
    @include('front.partials.footer')
@stop
