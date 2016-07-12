<div class="progress">
    <div class="progress-bar progress-bar-success" style="width: {{ $signPercent }}%">
        <span class="sr-only">{{ $signPercent }}% Filled</span>
        @if($signPercent >= 30)
            T: {{ $tanks }} / H: {{ $healers }} / D: {{ $dps }}
        @endif
    </div>
    <div class="pull-right">
        
    </div>
</div>
