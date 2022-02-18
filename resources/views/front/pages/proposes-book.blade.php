@extends('front.app')
@section('content')
    @include('front.partials.header')
    <main class="contact-content">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>Submit a Book Proposal</h3>
                        @if (Session::has('message'))
                            <p class="text-center alert alert-success">
                                {{ Session::get('message') }}
                            </p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <p>The service offers the facility to propose for purchase - the books, which are necessary for
                            your activity, found by you in the advertisements in the media, bookstores, etc. Your
                            request will be reviewed by us immediately for further completion of the library's holdings.
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 posrelative">
                        <form action="{{ url('/'.$lang->lang.'/proposes-book') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <p>Submit a Book Proposal</p>
                            <textarea cols="30" rows="20" required name="message"
                                      placeholder="Title and author of the book"></textarea>
                            <input type="text" name="name" required
                                   placeholder="Name"/>
                            <input type="email" name="email" required
                                   placeholder="Email"/>
                            <input type="submit" value="Submit"/>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('front.partials.footer')
@stop

