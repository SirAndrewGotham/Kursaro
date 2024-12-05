<x-frontend-layout>
    <section class="pt-6 pb-10 lg:pt-6 lg:pb-20 dark:bg-dark">
        <div class="container">

            @include('frontend.default.layouts.notifications')

            {{-- I am not sure I want this to be visible on the site --}}
            {{-- Maybe I will make it show once and disappear kind of thing later on --}}
{{--            @if($_ENV['APP_ENV'] == 'demo')--}}
{{--                <div class="p-3 mb-4 text-xs text-gray-400 dark:text-gray-500 bg-white dark:bg-gray-600 rounded-md font-light">--}}
{{--                    <p>Karaj samideanoj!</p>--}}
{{--                    <p>Se vi deziras vidi Administran parton de tiu ĉi demonstracia retejo, bonvolu uzi la <a href="/login" class="text-blue-300 dark:text-blue-500">/login</a> ligilon kaj la sekvajn akreditaĵojn:</p>--}}
{{--                    <ul class="pl-4">--}}
{{--                        <li>poŝtadreso - admin@admin.com</li>--}}
{{--                        <li>pasvorto - password</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}

            <div class="mb-4 text-xl text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">
{{--                We invite you to learn our language.--}}
                {!!  $content !!}
            </div>
{{--            <div class="flex flex-wrap -mx-4">--}}
{{--                <div class="w-full px-4 md:w-1/2 lg:w-1/3">--}}
{{--                    <div class="mb-10 wow fadeInUp group" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s;">--}}
{{--                        <div class="mb-8 overflow-hidden rounded-[5px]">--}}
{{--                            <a href="blog-details.html" class="block">--}}
{{--                                <img src="assets/images/blog/blog-01.jpg" alt="image" class="w-full transition group-hover:rotate-6 group-hover:scale-125">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--              <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">--}}
{{--                Dec 22, 2023--}}
{{--              </span>--}}
{{--                            <h3>--}}
{{--                                <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">--}}
{{--                                    Meet AutoManage, the best AI management tools--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="max-w-[370px] text-base text-body-color dark:text-dark-6">--}}
{{--                                Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                typesetting industry.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-full px-4 md:w-1/2 lg:w-1/3">--}}
{{--                    <div class="mb-10 wow fadeInUp group" data-wow-delay=".15s" style="visibility: visible; animation-delay: 0.15s;">--}}
{{--                        <div class="mb-8 overflow-hidden rounded-[5px]">--}}
{{--                            <a href="blog-details.html" class="block">--}}
{{--                                <img src="assets/images/blog/blog-02.jpg" alt="image" class="w-full transition group-hover:rotate-6 group-hover:scale-125">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--              <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">--}}
{{--                Mar 15, 2023--}}
{{--              </span>--}}
{{--                            <h3>--}}
{{--                                <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">--}}
{{--                                    How to earn more money as a wellness coach--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="max-w-[370px] text-base text-body-color dark:text-dark-6">--}}
{{--                                Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                typesetting industry.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-full px-4 md:w-1/2 lg:w-1/3">--}}
{{--                    <div class="mb-10 wow fadeInUp group" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s;">--}}
{{--                        <div class="mb-8 overflow-hidden rounded-[5px]">--}}
{{--                            <a href="blog-details.html" class="block">--}}
{{--                                <img src="assets/images/blog/blog-03.jpg" alt="image" class="w-full transition group-hover:rotate-6 group-hover:scale-125">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--              <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">--}}
{{--                Jan 05, 2023--}}
{{--              </span>--}}
{{--                            <h3>--}}
{{--                                <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">--}}
{{--                                    The no-fuss guide to upselling and cross selling--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="max-w-[370px] text-base text-body-color dark:text-dark-6">--}}
{{--                                Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                typesetting industry.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-full px-4 md:w-1/2 lg:w-1/3">--}}
{{--                    <div class="mb-10 wow fadeInUp group" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s;">--}}
{{--                        <div class="mb-8 overflow-hidden rounded-[5px]">--}}
{{--                            <a href="blog-details.html" class="block">--}}
{{--                                <img src="assets/images/blog/blog-02.jpg" alt="image" class="w-full transition group-hover:rotate-6 group-hover:scale-125">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--              <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">--}}
{{--                Mar 15, 2023--}}
{{--              </span>--}}
{{--                            <h3>--}}
{{--                                <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">--}}
{{--                                    How to earn more money as a wellness coach--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="max-w-[370px] text-base text-body-color dark:text-dark-6">--}}
{{--                                Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                typesetting industry.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-full px-4 md:w-1/2 lg:w-1/3">--}}
{{--                    <div class="mb-10 wow fadeInUp group" data-wow-delay=".15s" style="visibility: visible; animation-delay: 0.15s;">--}}
{{--                        <div class="mb-8 overflow-hidden rounded-[5px]">--}}
{{--                            <a href="blog-details.html" class="block">--}}
{{--                                <img src="assets/images/blog/blog-03.jpg" alt="image" class="w-full transition group-hover:rotate-6 group-hover:scale-125">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--              <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">--}}
{{--                Jan 05, 2023--}}
{{--              </span>--}}
{{--                            <h3>--}}
{{--                                <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">--}}
{{--                                    The no-fuss guide to upselling and cross selling--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="max-w-[370px] text-base text-body-color dark:text-dark-6">--}}
{{--                                Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                typesetting industry.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-full px-4 md:w-1/2 lg:w-1/3">--}}
{{--                    <div class="mb-10 wow fadeInUp group" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s;">--}}
{{--                        <div class="mb-8 overflow-hidden rounded-[5px]">--}}
{{--                            <a href="blog-details.html" class="block">--}}
{{--                                <img src="assets/images/blog/blog-01.jpg" alt="image" class="w-full transition group-hover:rotate-6 group-hover:scale-125">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--              <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">--}}
{{--                Dec 22, 2023--}}
{{--              </span>--}}
{{--                            <h3>--}}
{{--                                <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">--}}
{{--                                    Meet AutoManage, the best AI management tools--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="max-w-[370px] text-base text-body-color dark:text-dark-6">--}}
{{--                                Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                typesetting industry.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-full px-4 md:w-1/2 lg:w-1/3">--}}
{{--                    <div class="mb-10 wow fadeInUp group" data-wow-delay=".1s" style="visibility: hidden; animation-delay: 0.1s; animation-name: none;">--}}
{{--                        <div class="mb-8 overflow-hidden rounded-[5px]">--}}
{{--                            <a href="blog-details.html" class="block">--}}
{{--                                <img src="assets/images/blog/blog-01.jpg" alt="image" class="w-full transition group-hover:rotate-6 group-hover:scale-125">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--              <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">--}}
{{--                Dec 22, 2023--}}
{{--              </span>--}}
{{--                            <h3>--}}
{{--                                <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">--}}
{{--                                    Meet AutoManage, the best AI management tools--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="max-w-[370px] text-base text-body-color dark:text-dark-6">--}}
{{--                                Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                typesetting industry.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-full px-4 md:w-1/2 lg:w-1/3">--}}
{{--                    <div class="mb-10 wow fadeInUp group" data-wow-delay=".15s" style="visibility: hidden; animation-delay: 0.15s; animation-name: none;">--}}
{{--                        <div class="mb-8 overflow-hidden rounded-[5px]">--}}
{{--                            <a href="blog-details.html" class="block">--}}
{{--                                <img src="assets/images/blog/blog-02.jpg" alt="image" class="w-full transition group-hover:rotate-6 group-hover:scale-125">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--              <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">--}}
{{--                Mar 15, 2023--}}
{{--              </span>--}}
{{--                            <h3>--}}
{{--                                <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">--}}
{{--                                    How to earn more money as a wellness coach--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="max-w-[370px] text-base text-body-color dark:text-dark-6">--}}
{{--                                Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                typesetting industry.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-full px-4 md:w-1/2 lg:w-1/3">--}}
{{--                    <div class="mb-10 wow fadeInUp group" data-wow-delay=".2s" style="visibility: hidden; animation-delay: 0.2s; animation-name: none;">--}}
{{--                        <div class="mb-8 overflow-hidden rounded-[5px]">--}}
{{--                            <a href="blog-details.html" class="block">--}}
{{--                                <img src="assets/images/blog/blog-03.jpg" alt="image" class="w-full transition group-hover:rotate-6 group-hover:scale-125">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--              <span class="inline-block px-4 py-0.5 mb-6 text-xs font-medium leading-loose text-center text-white rounded-[5px] bg-primary">--}}
{{--                Jan 05, 2023--}}
{{--              </span>--}}
{{--                            <h3>--}}
{{--                                <a href="blog-details.html" class="inline-block mb-4 text-xl font-semibold text-dark dark:text-white hover:text-primary dark:hover:text-primary sm:text-2xl lg:text-xl xl:text-2xl">--}}
{{--                                    The no-fuss guide to upselling and cross selling--}}
{{--                                </a>--}}
{{--                            </h3>--}}
{{--                            <p class="max-w-[370px] text-base text-body-color dark:text-dark-6">--}}
{{--                                Lorem Ipsum is simply dummy text of the printing and--}}
{{--                                typesetting industry.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="mt-8 text-center wow fadeInUp" data-wow-delay=".2s" style="visibility: hidden; animation-delay: 0.2s; animation-name: none;">--}}
{{--                <div class="inline-flex p-3 bg-white dark:bg-dark-2 border rounded-[10px] border-stroke dark:border-dark-3">--}}
{{--                    <ul class="flex items-center -mx-1">--}}
{{--                        <li class="px-1">--}}
{{--                            <a href="javascript:void(0)" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">--}}
{{--                <span>--}}
{{--                  <svg width="8" height="15" viewBox="0 0 8 15" class="fill-current stroke-current">--}}
{{--                    <path d="M7.12979 1.91389L7.1299 1.914L7.1344 1.90875C7.31476 1.69833 7.31528 1.36878 7.1047 1.15819C7.01062 1.06412 6.86296 1.00488 6.73613 1.00488C6.57736 1.00488 6.4537 1.07206 6.34569 1.18007L6.34564 1.18001L6.34229 1.18358L0.830207 7.06752C0.830152 7.06757 0.830098 7.06763 0.830043 7.06769C0.402311 7.52078 0.406126 8.26524 0.827473 8.73615L0.827439 8.73618L0.829982 8.73889L6.34248 14.6014L6.34243 14.6014L6.34569 14.6047C6.546 14.805 6.88221 14.8491 7.1047 14.6266C7.30447 14.4268 7.34883 14.0918 7.12833 13.8693L1.62078 8.01209C1.55579 7.93114 1.56859 7.82519 1.61408 7.7797L1.61413 7.77975L1.61729 7.77639L7.12979 1.91389Z" stroke-width="0.3"></path>--}}
{{--                  </svg>--}}
{{--                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="px-1">--}}
{{--                            <a href="javascript:void(0)" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">--}}
{{--                                1--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="px-1">--}}
{{--                            <a href="javascript:void(0)" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">--}}
{{--                                2--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="px-1">--}}
{{--                            <a href="javascript:void(0)" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">--}}
{{--                                3--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="px-1">--}}
{{--                            <a href="javascript:void(0)" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">--}}
{{--                                4--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="px-1">--}}
{{--                            <a href="javascript:void(0)" class="flex items-center justify-center text-base bg-transparent border rounded-md hover:border-primary hover:bg-primary h-[34px] w-[34px] border-stroke dark:border-dark-3 text-body-color dark:text-dark-6 hover:text-white dark:hover:border-primary dark:hover:text-white">--}}
{{--                <span>--}}
{{--                  <svg width="8" height="15" viewBox="0 0 8 15" class="fill-current stroke-current">--}}
{{--                    <path d="M0.870212 13.0861L0.870097 13.086L0.865602 13.0912C0.685237 13.3017 0.684716 13.6312 0.895299 13.8418C0.989374 13.9359 1.13704 13.9951 1.26387 13.9951C1.42264 13.9951 1.5463 13.9279 1.65431 13.8199L1.65436 13.82L1.65771 13.8164L7.16979 7.93248C7.16985 7.93243 7.1699 7.93237 7.16996 7.93231C7.59769 7.47923 7.59387 6.73477 7.17253 6.26385L7.17256 6.26382L7.17002 6.26111L1.65752 0.398611L1.65757 0.398563L1.65431 0.395299C1.454 0.194997 1.11779 0.150934 0.895299 0.373424C0.695526 0.573197 0.651169 0.908167 0.871667 1.13067L6.37922 6.98791C6.4442 7.06886 6.43141 7.17481 6.38592 7.2203L6.38587 7.22025L6.38271 7.22361L0.870212 13.0861Z" stroke-width="0.3"></path>--}}
{{--                  </svg>--}}
{{--                </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>

</x-frontend-layout>
