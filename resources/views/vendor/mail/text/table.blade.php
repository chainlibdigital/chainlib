{{ $slot }}

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
