<tr>

    @if(!$category->threadsEnabled)
        <td colspan="5">
            <h3>{{ $category->title }}</h3>
        </td>
    @else
        <td>
            <p class="{{ isset($titleClass) ? $titleClass : '' }}"><a href="{{ Forum::route('category.show', $category) }}">{{ $category->title }}</a></p>
            <span class="text-muted">{{ $category->description }}</span>
        </td>
        <td class="hidden-sm hidden-xs">{{ number_format($category->thread_count) }}</td>
        <td class="hidden-sm hidden-xs">{{ number_format($category->post_count) }}</td>
        <td class="hidden-sm hidden-xs">
            @if ($category->latestActiveThread)
                <a href="{{ Forum::route('thread.show', $category->latestActiveThread->lastPost) }}">
                    {{ $category->latestActiveThread->title }}
                    <div class="character-name" @if($category->latestActiveThread->lastPost->author->character_name && $category->latestActiveThread->lastPost->author->character_server) data-character-name="{!! $category->latestActiveThread->lastPost->author->character_name !!}" data-character-server="{!! $category->latestActiveThread->lastPost->author->character_server !!}" @endif>
                        <div class="character-name">
                            @if ($category->latestActiveThread->lastPost->author->character_name)
                                <div class="character-class">{!! $category->latestActiveThread->lastPost->author->character_name !!}</div>
                            @else
                                {!! $category->latestActiveThread->lastPost->author->name !!}
                            @endif
                        </div>
                    </div>
                </a>
            @endif
        </td>
    @endif

</tr>
