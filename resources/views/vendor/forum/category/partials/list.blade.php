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
        <td class="hidden-sm hidden-xs">{{ number_format($category->threadCount) }}</td>
        <td class="hidden-sm hidden-xs">{{ number_format($category->postCount) }}</td>
        <td class="hidden-sm hidden-xs">
            @if ($category->latestActiveThread)
                <a href="{{ Forum::route('thread.show', $category->latestActiveThread->lastPost) }}">
                    {{ $category->latestActiveThread->title }}
                    ({{ $category->latestActiveThread->lastPost->authorName }})
                </a>
            @endif
        </td>
    @endif

</tr>
