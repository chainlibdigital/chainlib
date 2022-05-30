@extends('front.app')
@section('content')
@include('front.partials.header')

    <main class="notFoundContent text-center">
    <div class="container">
      <div class="row justify-content-center align-items-center flex-column">
          <br> <br> <br>
        <div class="title">
          <h4>404</h4>
        </div>
        <div>
          <p>Ups. ceva nu a mers bine.</p>
          <p>Incercati inca o data sau alegeti o optiune din meniul de sus.</p>
        </div>
        <div class="buttons">
          <a href="{{ url('/'.$lang->lang) }}">Acasa</a>
        </div>
        <br> <br> <br>
      </div>
    </div>
    </main>

@include('front.partials.footer')
@stop
