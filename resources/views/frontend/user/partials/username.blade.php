<div class="character-name" @if($author->character_name && $author->character_server) data-character-name="{!! $author->character_name !!}" data-character-server="{!! $author->character_server !!}" @endif>
    <div class="character-name">
        @if ($author->character_name)
            <div class="character-class">{!! $author->character_name !!}</div>
        @else
            {!! $author->name !!}
        @endif
    </div>
</div>
