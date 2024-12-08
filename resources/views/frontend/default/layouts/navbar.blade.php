{{-- ====== Navbar Section Start --}}
<div class="top-0 left-0 z-40 flex items-center w-full bg-transparent ud-header sticky">
    <div class="container">
        <div class="relative flex items-center justify-between -mx-4">
            {{-- Logo --}}
            <div class="max-w-full px-4 w-60">
                <a href="{{ route('home') }}" class="block w-full py-5 navbar-logo">
                    <svg width="64px" height="64px">
                        {!! file_get_contents(public_path('assets/images/site_logo.svg')) !!}
                    </svg>
                </a>
            </div>
            {{--// Logo --}}
            <div class="flex items-center justify-end w-full px-4">
                {{-- Middle Section --}}
{{--                <div>--}}
{{--                    <button id="navbarToggler"--}}
{{--                            class="absolute right-4 top-1/2 block -translate-y-1/2 rounded-lg px-3 py-[6px] ring-primary focus:ring-2 lg:hidden">--}}
{{--                        <span class="relative my-[6px] block h-[2px] w-[30px] bg-dark dark:bg-white"></span>--}}
{{--                        <span class="relative my-[6px] block h-[2px] w-[30px] bg-dark dark:bg-white"></span>--}}
{{--                        <span class="relative my-[6px] block h-[2px] w-[30px] bg-dark dark:bg-white"></span>--}}
{{--                    </button>--}}
{{--                    <nav id="navbarCollapse"--}}
{{--                         class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white dark:bg-dark-2 py-5 shadow-lg lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent dark:lg:bg-transparent lg:py-0 lg:px-4 lg:shadow-none xl:px-6">--}}
{{--                        --}}{{-- middle content --}}
{{--                    </nav>--}}
{{--                </div>--}}
                {{--// Middle Section --}}
                {{-- Right Part --}}
                <div class="flex items-center justify-end pr-16 lg:pr-0">
                    <x-dark-mode />

                    @if(count(App\Models\Language::where('is_active', true)->get()) > 1)
                        <div class="sm:flex px-4">
                            <x-language-switcher />
                        </div>
                    @endif
                </div>
            </div>
            {{--// Right Part --}}
        </div>
    </div>
</div>
{{-- ====== Navbar Section End --}}
