<x-layouts.app :title="__('Teams')">
    <flux:heading>Teams</flux:heading>
    @foreach($teams as $team)
        <flux:text>{{ $team->name }}</flux:text>
    @endforeach
</x-layouts.app>
