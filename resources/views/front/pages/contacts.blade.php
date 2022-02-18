@extends('front.app')
@section('content')
@include('front.partials.header')
<main class="contact-content">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Contacts</h3>
                    @if (Session::has('message'))
                        <p class="text-center alert alert-success">
                            {{ Session::get('message') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-6">
                    <ul>
                        <li>
                            <h4><b>Website:</b> www.chainlib.xyz</h4>
                        </li>
                        <li>
                           <h4> <b>Email:</b> chainlibdigital@gmail.com</h4>
                        </li>
                    </ul>
                    <div class="contact-about">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 posrelative">
                    <form action="{{ url('/'.$lang->lang.'/contact-feed-back') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <p>Send a Message</p>
                        <input type="text" name="name" required placeholder="Name" />
                        <input type="number" name="phone" required placeholder="Phone" />
                        <input type="email" name="email" required placeholder="Email" />
                        <textarea cols="30" rows="20" required name="message" placeholder="Message"></textarea>
                        <input type="submit" value="Send" />
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@include('front.partials.footer')
@stop

