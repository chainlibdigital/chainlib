<footer>
    <div class="container">
        <div class="row footer-inner">
            <div class="col-md-4 col-12">
                <a href="index.html" class="logo">
                    <img src="/CL-horizontal_on_transparent.png" alt=""/>
                </a>
                <p>
                    ChainLib - digital space created for authors that provides a "shelf space" and visibility to their
                    readers, with copyright protection ensured by blockchain technology
                </p>
                <div class="networksFooter">
                    <a href="https://www.facebook.com/annaamita17" class="networksFooter-container">
                        <img src="/fronts/img/svg/facebook-f-brands.svg" alt="">
                    </a>
                    <a href="https://www.instagram.com/anna_amita/" class="networksFooter-container">
                        <img src="/instagram-1.svg" alt="">
                    </a>
                    <a href="https://www.youtube.com/watch?v=7fbCOdWE2T4" class="networksFooter-container">
                        <img src="/fronts/img/svg/youtube-brands.svg" alt="">
                    </a>
                </div>
            </div>
            <div class="col-md col-12">
                <ul>
                    @php
                        $i = 0;
                    @endphp
                    <li class="title">Catalog</li>
                    @foreach ($categoriesMenu as $key => $category)
                        @if ($category->children->count() > 0)
                            @foreach ($category->children as $key => $child)
                                @if($i <= 3)
                                    @php
                                        $i++;
                                    @endphp
                                    <li>
                                        <a href="{{ url('/'.$lang->lang.'/catalog/'. $child->alias) }}">
                                            {{ $child->translation->name }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-md col-12">
                <ul>
                    <li class="title">About</li>
                    <li><a href="{{ url('/'.$lang->lang.'/about') }}">About</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/faq') }}">FAQ</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/contacts') }}">Contacts</a></li>
                    <li><a href="{{ url('/'.$lang->lang.'/propose-book') }}">Submit a Book Proposal</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="search-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close" data-dismiss="modal"></div>
                <div class="title-modal">Search</div>
                <search></search>
            </div>
        </div>
    </div>

</footer>

<div class="modal fade" id="settings-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close" data-dismiss="modal"></div>
            <div class="title-modal">settings</div>
            <form action="">
                <div class="select-container">
                    <span>Language</span>
                    @php
                        $url = '';
                        if (request()->path()) {
                            $url = substr(request()->path(), 2);
                        }
                    @endphp
                    <select name="" id="" onchange="if (this.value) window.location.href=this.value">
                        <option {{ $lang->lang == 'en' ? 'selected' : '' }} value="{{ url('/en'.$url) }}">EN</option>
                        <option {{ $lang->lang == 'ro' ? 'selected' : '' }}  value="{{ url('/ro'.$url) }}">RO</option>
                        <option {{ $lang->lang == 'ru' ? 'selected' : '' }} value="{{ url('/ru'.$url) }}">RU</option>
                    </select>
                </div>
                {{-- <input type="submit" value="Save" data-dismiss="modal" /> --}}
            </form>
        </div>
    </div>
</div>
