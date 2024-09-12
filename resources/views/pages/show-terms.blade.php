<x-filament-panels::page>
    <x-filament::section>
        @if($model)
            <x-slot name="heading">
                {{ $model->name }} - {{ $model->published_at->translatedFormat('l j F Y - H:i') }}
            </x-slot>

            {!! $model->terms !!}
        @endif
    </x-filament::section>
</x-filament-panels::page>
