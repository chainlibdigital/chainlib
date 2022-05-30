@extends('front.app')
@section('content')
    @include('front.partials.header')
    <main class="home-content questions-content">
        <section class="questions">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <h3>CHAINLIB STORY</h3>
                        <h4 class="subheader">
                            Digital "shelf space" for authors
                            with copyright protection ensured by blockchain technology
                        </h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <img src="/about-images/About-section-1-image-1.jpg" alt="">
                        </div>
                        <div class="col-md-6">
                            <img src="/about-images/About-section-1-image-2.jpg" alt="">
                        </div>
                    </div>


                    <div class="col-12"><br><br><br>
                        <h3>ABOUT THIS PROJECT</h3>
                        <p class="">
                            There are 2 big problems that authors face everywhere.
                            The first problem is copyright protection. Since the law on authorship differs from country
                            to country, a book written and registered in one country can be easily reprinted under
                            another name in another country - and have every right to do so.
                            The second problem is facing unknown authors from small countries. Usually, the publishing
                            houses refuse to publish their works.
                            This is why and how the ChainLib came to life - digital "shelf space" for authors all over
                            the world with copyright protection ensured by blockchain technology
                        </p>
                    </div>

                    <div class="col-12 text-center">
                        <br><br><br>
                        <h3>CHAINLIB AUTHORS</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <img src="/about-images/About-section-2-authors--image-1.png" class="res-height">
                        </div>
                        <div class="col-md-7">
                            <img src="/about-images/About-section-2-authors--image-2.png" class="res-height">
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <br><br><br>
                        <h3>EXAMPLES OF WORKS ON CHAINLIB</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <img src="/about-images/About-section-3-works-image-1.jpg" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="/about-images/About-section-3-works-image-2.jpg" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="/about-images/About-section-3-works-image-3.jpg" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="/about-images/About-section-3-works-image-4.jpg" alt="">
                        </div>
                    </div>
                    <br><br>

                    <div class="row">
                        <div class="col-md-3">
                            <img src="/about-images/About-section-3-works-image-5.jpg" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="/about-images/About-section-3-works-image-6.jpg" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="/about-images/About-section-3-works-image-7.jpg" alt="">
                        </div>
                        <div class="col-md-3">
                            <img src="/about-images/About-section-3-works-image-8.jpg" alt="">
                        </div>
                    </div>

            </div>
        </section>
    </main>
    @include('front.partials.footer')
@stop

<style>
    .text-center h3:after {
        display: none;
    }

    .subheader {
        margin: 0 auto;
        margin-bottom: 40px;
        text-transform: uppercase;
        max-width: 600px;
        line-height: 1.5;
    }

    img {
        max-width: 90%;
    }
    .res-height {
        max-width: 100%;
        height: 750px;
    }
</style>