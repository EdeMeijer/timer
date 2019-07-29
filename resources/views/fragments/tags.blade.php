<div class="tags">
    @forelse ($tags as $tag)
        <span class="multiselect__tag">{{ $tag }}</span>
    @empty
        <em class="text-secondary">None</em>
    @endforelse
</div>
