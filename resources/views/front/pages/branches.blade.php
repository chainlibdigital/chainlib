@extends('front.app')
@section('content')
@include('front.partials.header')
<main class="home-content offices-content">
    @include('front.partials.search')
    <section class="offices">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>{{ trans('vars.Contacts.offices') }}</h3>
                </div>
                <div class="col-12">
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            {!! $page->translation->body !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row office-gallery">
                @foreach ($branches as $key => $branch)
                <div class="col-lg-4 col-md-6 office-item">
                    <a href="#" class="image-container">
                        @if ($branch->image)
                            <img src="/images/brands/{{ $branch->image }}" alt="" />
                        @else
                            <img src="img/dev/office1.jpg" alt="" />
                        @endif
                    </a>
                    <a href="#" class="name">
                        {{ $branch->translation->name }}
                    </a>
                    {!! $branch->translation->description !!}
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@include('front.partials.footer')
@stop

        {!! $page->body !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalShipping">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modalContent">
                    <div class="closeModal" data-dismiss="modal">
                        <img src="/fronts/img/icons/plusIconBlack.svg" alt="" />
                    </div>
                    <div class="closeModal" data-dismiss="modal"></div>
                    <div class="modalTitle">
                        <span>Shipping, payment and returns</span>
                    </div>
                    <div class="modalBody">
                        <div class="col-12 editorPage">
                            @php $page = getPage('livrare-achitare-retur', $lang->id); @endphp
                            @if (!is_null($page))
                                {!! $page->body !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
