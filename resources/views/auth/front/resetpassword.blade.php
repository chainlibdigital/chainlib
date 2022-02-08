@extends('front.app')
@section('content')
@include('front.partials.header', ['className' => 'oneHeader'])
<div class="registration">
    <div class="container">
        <div class="row justify-content">
            <div class="col-lg-4 col-md-6 col-sm-8 col-12 aboutEstel">
                <h4>{{trans('front.ja.about')}} Julia Alert</h4>
                <ul>
                    <li><a href="{{url($lang->lang.'/about')}}">{{trans('front.ja.aboutUs')}}</a></li>
                    <li><a href="{{url($lang->lang.'/condition')}}">{{trans('front.ja.conditions')}}</a></li>
                    <li><a href="{{url($lang->lang.'/cookie')}}">{{trans('front.ja.cookie')}}</a></li>
                    <li><a href="{{url($lang->lang.'/privacy')}}">{{trans('front.ja.privacy')}}</a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-sm-8 col-12 regBoxBorder">
                <div class="regBox">
                    <div class="row">
                        <div class="col-12">
                            <h4><strong>{{trans('front.ja.signIn')}}</strong></h4>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-12">
                            {{trans('front.ja.dontHaveAccount')}} <a href="{{url($lang->lang.'/registration')}}"> {{trans('front.ja.signUp')}}</a>
                        </div>
                    </div>
                    <form action="{{ url()->current() }}" method="post">
                        {{ csrf_field() }}
                        @if (Session::has('success'))
                        <div class="row">
                            <div class="col-12">
                                <div class="errorPassword">
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="pwd">{{trans('front.register.pass')}}<b>*</b></label>
                            <input type="password" class="form-control" name="password" id="pwd" >
                            @if ($errors->has('password'))
                            <div class="invalid-feedback" style="display: block">
                                {!!$errors->first('password')!!}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="confpwd">{{trans('front.register.repeatPass')}}<b>*</b></label>
                            <input type="password" class="form-control" name="passwordRepeat" id="confpwd" >
                            @if ($errors->has('passwordRepeat'))
                            <div class="invalid-feedback" style="display: block">
                                {!!$errors->first('passwordRepeat')!!}
                            </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-sm-5 col-10">
                                <div class="btnGrey">
                                    <input type="submit" value="Recupereaza parola">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('front.partials.footer')
@stop

s_default_style ">
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
