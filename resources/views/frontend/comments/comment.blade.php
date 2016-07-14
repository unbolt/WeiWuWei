<div class="row comment">
    <div class="col-md-2 text-right">
        @include('frontend.user.partials.username', ['author' => $comment->user])
    </div>
    <div class="col-md-10">
        <div class="text-muted">
            {{ $comment->created_at->format('d/m/y H:i') }}:
        </div>
        {!! Markdown::parse($comment->body) !!}
    </div>
</div>
<hr />
