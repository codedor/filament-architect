<div x-data="{
    async submit () {
        const validated = await $wire.validates()
        if (! validated) {
            return
        }
            
        this.$wire.$parent.callSchemaComponentMethod(
            @js($formKey),
            'editedBlock',
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
                Submit
            </x-filament::button>

            <x-filament::button x-on:click.prevent="close" color="gray">
                Cancel
            </x-filament::button>
        </div>
    </div>

    <x-filament-actions::modals />
</div>
