<x-filament-panels::page.simple>
    {!! $actual_terms->terms !!}
    <x-filament-panels::form wire:submit="accept">
        {{ $this->form }}
        <x-filament-panels::form.actions
                :actions="$this->getFormActions()" :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>
</x-filament-panels::page.simple>
