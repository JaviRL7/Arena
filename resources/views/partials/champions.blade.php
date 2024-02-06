@foreach ($championData as $championId => $champion)
    <div class="champion">
        <img src="{{ asset($champion['image']) }}" alt="{{ $champion['name'] }}">
        <h2>{{ $champion['name'] }}</h2>
        <div class="bar">
            <div class="win" style="width: {{ $champion['stats']['win_percentage'] }}%;">
                {{ round($champion['stats']['win_percentage']) }}% W
            </div>
            <div class="loss" style="width: {{ $champion['stats']['loss_percentage'] }}%;">
                {{ round($champion['stats']['loss_percentage']) }}% L
            </div>
        </div>
    </div>
@endforeach

