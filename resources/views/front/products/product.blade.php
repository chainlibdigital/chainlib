@extends('front.app')
@section('content')
@include('front.partials.header')

<main class="home-content">
        @include('front.partials.search')

        <section class="book-one">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 col-md-5">
                <div class="image-container">
                    @if($product->hoverImage)
                        <img src="{{ asset('/images/products/og/'. $product->hoverImage->src) }}"
                             alt=""/>
                    @else
                        <img src="/cover.png" alt=""/>
                    @endif
                </div>
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
              </div>
              <div class="col-lg-7 col-md-7">
                <div class="title">{{ $product->translation->name }}</div>
                <div class="book-descr">
                    @if ($product->translation->author)
                        <div class="item">
                          <span>Author:</span>
                          <span>{{ $product->translation->author }}</span>
                        </div>
                    @endif
                    @if ($product->translation->co_author)
                        <div class="item">
                          <span>Second Author:</span>
                          <span>{{ $product->translation->co_author }}</span>
                        </div>
                    @endif
                    @if ($product->translation->subject)
                        <div class="item">
                          <span>Subject:</span>
                          <span>{{ $product->translation->subject }}</span>
                        </div>
                    @endif
                    @if ($product->translation->publication)
                        <div class="item">
                          <span>Publication:</span>
                          <span>{{ $product->translation->publication }}</span>
                        </div>
                    @endif
                    @if ($product->translation->language)
                        <div class="item">
                          <span>Language:</span>
                          <span>{{ $product->translation->language }}</span>
                        </div>
                    @endif
                    @if ($product->translation->country)
                        <div class="item">
                          <span>Country:</span>
                          <span>{{ $product->translation->country }}</span>
                        </div>
                    @endif
                    @if ($product->issn)
                        <div class="item">
                          <span>ISBN:</span>
                          <span>{{ $product->translation->issn }}</span>
                        </div>
                    @endif
                </div>
              </div>
              @if ($product->translation->description)
                  <div class="col-12 book-one-description">
                    <h3>Description</h3>
                        {!! $product->translation->description !!}
                  </div>
              @endif
            </div>
          </div>
        </section>
        <section class="slider-section">
          <div class="container">
            @if ($similarProducts->count() > 0)

                <div class="row justify-content-center">
                <div class="col-12">
                <h3>Relevants Books</h3>
                <div class="slider-standard slider-fixed-width">
                    @foreach ($similarProducts as $key => $similarProduct)
                        <div class="item-slider-standard book-item ">
                            <a href="{{ url('/'.$lang->lang.'/catalog/'.$similarProduct->category->alias.'/'.$similarProduct->alias) }}" class="image-container">
                                @if($product->hoverImage)
                                    <img src="{{ asset('/images/products/og/'. $similarProduct->hoverImage->src) }}"
                                         alt=""/>
                                @else
                                    <img src="/cover.png" alt=""/>
                                @endif
                            </a>
                            <a href="{{ url('/'.$lang->lang.'/catalog/'.$similarProduct->category->alias.'/'.$similarProduct->alias) }}" class="product-name">{{ $similarProduct->translation->name }}</a>
                        </div>
                    @endforeach
                </div>
                </div>
                </div>
            @endif

          </div>
        </section>
      </main>

@include('front.partials.footer')
@stop

