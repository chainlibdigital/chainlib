[{{ $slot }}]({{ $url }})


        <div class="card card-body">
                                <p>{{ $child->translation->description }} </p>
                                <ul>
                                    @foreach ($child->accordions as $key => $accordion)
                                    <li>
                                        <a href="{{ $accordion->translation->link }}" target="_blank">
                                        {{ $accordion->translation->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@include('front.partials.footer')
@stop
