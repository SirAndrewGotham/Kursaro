@php use Illuminate\Support\Facades\Session; @endphp
@if(Session::has('success'))
    <div class="mb-14 pb-4 text-xl text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl border-b-4 border-gray-700 dark:border-b-4 dark:border-gray-700">
        {{ Session::get('success') }}
        @php
            Session::forget('success');
        @endphp
    </div>
@endif
@if(Session::has('error'))
        <div class="mb-14 pb-4 text-xl text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl border-b-4 border-gray-700 dark:border-b-4 dark:border-gray-700">
        {{ Session::get('error') }}
        @php
            Session::forget('error');
        @endphp
    </div>
@endif
