<tr>

    @if(!$category->threadsEnabled)
        <td colspan="5">
            <h3>{{ $category->title }}</h3>
        </td>
    @else
        <td>
            <p class="{{ isset($titleClass) ? $titleClass : '' }}"><a href="{{ Forum::route('category.show', $category) }}">{{ $category->title }}</a></p>
            <div class="hidden-sm hidden-xs">
                <span class="text-muted">{{ $category->description }}</span>
            </div>
            <div class="hidden-md hidden-lg">
                <span class="text-muted">Last Post:</span>
                <a href="{{ Forum::route('thread.show', $category->latestActiveThread->lastPost) }}">
                    {{ str_limit($category->latestActiveThread->title, 20, '...') }}
                </a>
                <span class="text-muted">({{ $category->latestActiveThread->lastPost->created_at->diffForHumans() }})</span>
            </div>
        </td>
        <td class="hidden-sm hidden-xs">{{ number_format($category->thread_count) }}</td>
        <td class="hidden-sm hidden-xs">{{ number_format($category->post_count) }}</td>
        <td class="hidden-sm hidden-xs">
            @if ($category->latestActiveThread)
                <a href="{{ Forum::route('thread.show', $category->latestActiveThread->lastPost) }}">
                    {{ str_limit($category->latestActiveThread->title, 20, '...') }}
                    @include ('frontend.user.partials.username', array('author' => $category->latestActiveThread->lastPost->author))
                    <div class="text-muted">({{ $category->latestActiveThread->lastPost->created_at->diffForHumans() }})</div>
                </a>
            @endif
        </td>
    @endif

</tr>
