@extends('frontend.layouts.master')

@section('title')
    {{ app_name() }} - The Sha'tar
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="homepage-intro">
                <h2>Action without action.</h2>

                <p>
                    Wei Wu Wei roughly translated means "Action without action".
                    While we're not hardcore raiders anymore (although many of us have been in the past)
                    we still put in enough time and effort to let us stay at the top of the game while
                    maintaining a friendly and understanding atmosphere.
                </p>
                <p>
                    We're always interested in recruiting people of a similar mindset to us to expand and
                    shore up our raid team. If you're interested in joining us you can register on the
                    forums and throw up an application, or grab an officer in game for a chat.
                </p>

            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-sm-6 text-center raid-progress">

                    <div class="raid-progress-circle" data-kills="0" data-bosses="10"></div>

                    <h3>0/10</h3>
                    <h4>The Nighthold</h4>
                </div>
                <div class="col-sm-6 text-center raid-progress">

                    <div class="raid-progress-circle" data-kills="0" data-bosses="7"></div>

                    <h3>0/7</h3>
                    <h4>Emerald Nightmare</h4>
                </div>
            </div>
        </div>
    </div>
@stop

@section('homepage-news')

    <section class="homepage-news">
        @if( $latest_news )
            <div class="latest-news" style="background-image: url('/news/image/blur/{{ $latest_news->id }}');">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <h2>{{ $latest_news->title }}</h2>
                            <h4 class="text-muted">{{ $latest_news->created_at->format('jS F Y') }}</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="post-content">
                                {% Forum::render($latest_news->content) %}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($news)
            <div class="container">
                <div class="row news-articles">
                    @foreach ($news as $article)
                        <div class="col-md-4">
                            <div class="news-article">
                                <img src="/news/image/small/{{ $latest_news->id }}" class="img-responsive">

                                <h4>{{ $article->title }} <span class="small text-muted">{{ $article->created_at->format('jS F Y') }}</span></h4>

                                {% Forum::render($article->content) %}

                                <p class="read-more"><a href="#" class="btn btn-primary">Read More</a></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@stop

@section('after-scripts-end')
@stop
