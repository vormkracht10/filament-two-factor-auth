<x-filament-panels::page.simple>
    <h2 class="mt-5 text-lg font-semibold text-gray-900 text-center dark:text-gray-100">
        {{ __('Authenticate with your code') }}
    </h2>
    @if ($twoFactorType === 'email' || $twoFactorType === 'phone')
    <div wire:poll.5s>
        {{ $this->resend }}
    </div>
    @endif
    <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-8">

        @csrf
        {{ $this->form }}

        <div style="display: none">
            <input type="text" id="recovery_code" wire:model="recovery_code" name="recovery_code" value="">
        </div>

        <div class="flex items-center justify-between mt-6">
            <x-filament::button type="submit" class="w-full" color="primary">
                {{ __('Login') }}
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page.simple>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('resent', () => {
            // Immediately disable the button
            Livewire.dispatch('$refresh');
        });
    });
</script>