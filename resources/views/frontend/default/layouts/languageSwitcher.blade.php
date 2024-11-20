<div class="flex flex-none justify-center">
    <div
        x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }
                this.$refs.button.focus()
                this.open = true
            },
            close(focusAfter) {
                if (! this.open) return
                this.open = false
                focusAfter && focusAfter.focus()
            }
        }"
        x-on:keydown.escape.prevent.stop="close($refs.button)"
        x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
        x-id="['dropdown-button']"
        {{--        class="relative flex-flow:column wrap py-0"--}}
        class="relative inline-block text-left"
    >
        {{-- Button --}}
        <button
            x-ref="button"
            x-on:click="toggle()"
            :aria-expanded="open"
            :aria-controls="$id('dropdown-button')"
            type="button"
            class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100"
        >
            {{ strtoupper(app()->getLocale()) }} <span class="font-light">({{ App\Models\Language::where('code', app()->getLocale())->first()->name }})</span>

            {{-- Heroicon: chevron-down --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        {{-- Panel --}}
        <div
            x-ref="panel"
            x-show="open"
            x-transition.origin.top.left
            x-on:click.outside="close($refs.button)"
            :id="$id('dropdown-button')"
            style="display: none;"
            class="absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        >
            @foreach(App\Models\Language::where('is_active', true)->get() as $locale)
                <a href="{{ route('locale', $locale->code) }}" class="group flex items-center px-4 py-2 text-sm text-gray-700">
                    {{ strtoupper($locale->code) }} ({{ $locale->name }})
                </a>
            @endforeach
        </div>
    </div>
</div>
