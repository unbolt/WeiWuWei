<tr id="post-{{ $post->sequenceNumber }}" class="post-bit {{ $post->trashed() ? 'deleted' : '' }}">
    <td class="character">
        <div class="character-profile" @if($post->author->character_name && $post->author->character_server) data-character-name="{!! $post->author->character_name !!}" data-character-server="{!! $post->author->character_server !!}" @endif>
            <div class="character-name">
                @if ($post->author->character_name)
                    <div class="character-class">{!! $post->author->character_name !!}</div>
                @else
                    {!! $post->author->name !!}
                @endif
            </div>

        </div>

    </td>
    <td class="post-content">
        @if (!is_null($post->parent))
            <p>
                <strong>
                    In response to
                    @if ($post->author->character_name)
                        {!! $post->author->character_name !!}
                    @else
                        {!! $post->author->name !!}
                    @endif
                    (<a href="{{ Forum::route('post.show', $post->parent) }}">{{ trans('forum::posts.view') }}</a>):
                </strong>
            </p>
            <blockquote>
                {!! str_limit(Forum::render($post->parent->content)) !!}
            </blockquote>
        @endif

        @if ($post->trashed())
            <span class="label label-danger">{{ trans('forum::general.deleted') }}</span>
        @else
            {% Forum::render($post->content) %}
        @endif
    </td>
</tr>
<tr>
    <td>
        @if (!$post->trashed())
            @can ('edit', $post)
                <a href="{{ Forum::route('post.edit', $post) }}">{{ trans('forum::general.edit') }}</a>
            @endcan
        @endif
    </td>
    <td class="text-muted">
        <abbr title="Posted by {{ $post->author->name }}">{{ trans('forum::general.posted') }} {{ $post->posted }}</abbr>
        @if ($post->hasBeenUpdated())
            | {{ trans('forum::general.last_updated') }} {{ $post->updated }}
        @endif

        @if ($post->legacy_post)
            &nbsp; &nbsp;<abbr title="This post was imported from our old forums. It might look weird."><i class="fa fa-bug" aria-hidden="true"></i> Legacy</abbr>
        @endif

        <span class="pull-right">
            <a href="{{ Forum::route('thread.show', $post) }}">#{{ $post->sequenceNumber }}</a>
            @if (!$post->trashed())
                @can ('reply', $post->thread)
                    - <a href="{{ Forum::route('post.create', $post) }}">{{ trans('forum::general.reply') }}</a>
                @endcan
            @endif
            @if (Request::fullUrl() != Forum::route('post.show', $post))
                - <a href="{{ Forum::route('post.show', $post) }}">{{ trans('forum::posts.view') }}</a>
            @endif
            @if (isset($thread))
                @can ('deletePosts', $thread)
                    @if (!$post->isFirst)
                        <input type="checkbox" name="items[]" value="{{ $post->id }}">
                    @endif
                @endcan
            @endif
        </span>
    </td>
</tr>
