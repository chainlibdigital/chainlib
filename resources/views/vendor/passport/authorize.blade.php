<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - Authorization</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <style>
        .passport-authorize .container {
            margin-top: 30px;
        }

        .passport-authorize .scopes {
            margin-top: 20px;
        }

        .passport-authorize .buttons {
            margin-top: 25px;
            text-align: center;
        }

        .passport-authorize .btn {
            width: 125px;
        }

        .passport-authorize .btn-approve {
            margin-right: 15px;
        }

        .passport-authorize form {
            display: inline;
        }
    </style>
</head>
<body class="passport-authorize">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">
                        Authorization Request
                    </div>
                    <div class="card-body">
                        <!-- Introduction -->
                        <p><strong>{{ $client->name }}</strong> is requesting permission to access your account.</p>

                        <!-- Scope List -->
                        @if (count($scopes) > 0)
                            <div class="scopes">
                                    <p><strong>This application will be able to:</strong></p>

                                    <ul>
                                        @foreach ($scopes as $scope)
                                            <li>{{ $scope->description }}</li>
                                        @endforeach
                                    </ul>
                            </div>
                        @endif

                        <div class="buttons">
                            <!-- Authorize Button -->
                            <form method="post" action="{{ route('passport.authorizations.approve') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button type="submit" class="btn btn-success btn-approve">Authorize</button>
                            </form>

                            <!-- Cancel Button -->
                            <form method="post" action="{{ route('passport.authorizations.deny') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <input type="hidden" name="state" value="{{ $request->state }}">
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button class="btn btn-danger">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

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
