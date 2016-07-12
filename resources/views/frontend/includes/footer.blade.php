<section class="footer hidden-sm hidden-xs">
    <div class="container">
        <div class="col-md-2 col-md-offset-2 text-center">
            <img src="/images/weiwu_notext.png" />
        </div>
        <div class="col-md-2">
            <ol>
                <li>{!! link_to_route('frontend.index', 'Home') !!}</li>
                <li>{!! link_to_route('frontend.roster', 'Roster') !!}</li>
                <li>{!! link_to('forums', 'Forums') !!}</li>
                @roles('Raider')
                    <li>{!! link_to('raids', 'Raids') !!}</li>
                @endauth
            </ol>
        </div>
        <div class="col-md-4 text-center">
            <a href="https://twitter.com/weiwuweiguild" target="_blank"><i class="fa fa-twitter fa-4x" aria-hidden="true"></i></a>
            &nbsp; &nbsp;
            <a href="https://www.youtube.com/playlist?list=PLmx_2Q_Isfg2pwUo5_BZmOoy8P1l1XZi8" target="_blank"><i class="fa fa-youtube-play fa-4x" aria-hidden="true"></i></a>

        </div>
    </div>
</section>
