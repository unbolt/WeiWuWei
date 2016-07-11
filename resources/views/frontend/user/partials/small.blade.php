<div class="character-profile character-profile-small" @if($user->character_name && $user->character_server) data-character-name="{!! $user->character_name !!}" data-character-server="{!! $user->character_server !!}" @endif data-character-twitch="{{ $user->twitch }}" data-character-twitter="{{ $user->twitter }}" data-character-youtube="{{ $user->youtube }}" data-character-server="{{ $user->character_server }}">
    <div class="character-name">
        @if ($user->character_name)
            <div class="character-class">{!! $user->character_name !!}</div>
        @else
            {!! $user->name !!}
        @endif
    </div>
</div>
