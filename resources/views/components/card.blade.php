<div {{ $attributes->merge(['class' => 'card bg-white']) }}>
    <div class="card-body">
        <h4>{{ $title ?? 'Card Title' }}</h4>
        <hr>
        {{ $slot }}
    </div>
</div>