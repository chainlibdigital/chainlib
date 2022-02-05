@extends('front.app')
@section('content')
@include('front.partials.header')

<main class="projects-all-content">
       <div class="home-content">
           @include('front.partials.search')
       </div>
       <div class="container">
         <div class="row">

             @if ($children->count() > 0)
                 @foreach ($children as $key => $child)
                     <div class="col-lg-4 col-md-6">
                       <div class="item-project-one">
                         <a href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}" class="image-container">
                             @if ($child->banner_desktop)
                                 <img src="/images/categories/og/{{ $child->banner_desktop }}" alt="" />
                             @else
                                 <img src="/cover.png" alt="">
                             @endif
                         </a>
                         {{-- <a href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}"> --}}
                             <a class="title" href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}">
                                 {{ $child->translation->name }}
                             </a>
                         {{-- </a> --}}
                       </div>
                     </div>
                 @endforeach
             @endif

         </div>
       </div>
     </main>

@include('front.partials.footer')
@stop

}</div>
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
