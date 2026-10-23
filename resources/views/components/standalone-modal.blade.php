@props(['name', 'show' => false])
<div
    x-data="{ show: @js($show) }"
    x-on:open-modal.window="if ($event.detail === @js($name)) show = true"
    x-on:close-modal.window="if ($event.detail === @js($name)) show = false"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    role="dialog"
    aria-modal="true"
    aria-label="{{ __('Delete Account') }}"
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6"
    style="display: none"
>
    <div class="fixed inset-0 bg-gray-500 opacity-75" x-on:click="show = false"></div>
    <div class="relative mx-auto w-full max-w-2xl rounded-lg bg-white shadow-xl"
         x-trap.inert.noscroll="show">
        {{ $slot }}
    </div>
</div>
