<div x-data="{
    async submit () {
        const validated = await $wire.validates()
        if (! validated) {
            return
        }

        this.$wire.$parent.dispatchFormEvent(
            'filament-architect::editedBlock',
            '{{ $statePath }}',
            {
                row: '{{ $arguments['row'] }}',
                uuid: '{{ $arguments['uuid'] }}',
                form: await $wire.getFormData(),
            }
        )

        this.close()
    }
}">
    {{ $this->form }}

    <div class="fi-modal-footer w-full pt-6">
        <div class="fi-modal-footer-actions gap-3 flex flex-wrap items-center">
            <x-filament::button x-on:click.prevent="submit">
                {{ __('filament-architect::admin.submit') }}
            </x-filament::button>

            <x-filament::button x-on:click.prevent="close" color="gray">
                {{ __('filament-architect::admin.cancel') }}
            </x-filament::button>
        </div>
    </div>

    <x-filament-actions::modals />
</div>
