@extends('layouts.ecommerce')

@section('content')
    {{-- <div class="relative isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <svg class="absolute inset-0 -z-10 h-full w-full stroke-gray-200 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
            aria-hidden="true">
            <defs>
                <pattern id="83fd4e5a-9d52-42fc-97b6-718e5d7ee527" width="200" height="200" x="50%" y="-64"
                    patternUnits="userSpaceOnUse">
                    <path d="M100 200V.5M.5 .5H200" fill="none" />
                </pattern>
            </defs>
            <svg x="50%" y="-64" class="overflow-visible fill-gray-50">
                <path d="M-100.5 0h201v201h-201Z M699.5 0h201v201h-201Z M499.5 400h201v201h-201Z M299.5 800h201v201h-201Z"
                    stroke-width="0" />
            </svg>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#83fd4e5a-9d52-42fc-97b6-718e5d7ee527)" />
        </svg>
        <div class="mx-auto max-w-xl lg:max-w-4xl">
            <h2 class="text-4xl font-bold tracking-tight text-gray-900">Let’s talk about your project</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">We help companies and individuals build out their brand
                guidelines.</p>
            <div class="mt-16 flex flex-col gap-16 sm:gap-y-20 lg:flex-row">
                <form action="#" class="lg:flex-auto">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div>
                            <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">First
                                name</label>
                            <div class="mt-2.5">
                                <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900">Last
                                name</label>
                            <div class="mt-2.5">
                                <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label for="budget" class="block text-sm font-semibold leading-6 text-gray-900">Budget</label>
                            <div class="mt-2.5">
                                <input id="budget" name="budget" type="text"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div>
                            <label for="website"
                                class="block text-sm font-semibold leading-6 text-gray-900">Website</label>
                            <div class="mt-2.5">
                                <input type="url" name="website" id="website"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="message"
                                class="block text-sm font-semibold leading-6 text-gray-900">Message</label>
                            <div class="mt-2.5">
                                <textarea id="message" name="message" rows="4"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <x-button submit size="big" class="w-full">Enviar consulta</x-button>
                    </div>
                    <p class="mt-4 text-sm leading-6 text-gray-500">By submitting this form, I agree to the <a
                            href="#" class="font-semibold text-blue-600">privacy&nbsp;policy</a>.</p>
                </form>
                <div class="lg:mt-6 lg:w-80 lg:flex-none">
                    <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workcation-logo-indigo-600.svg"
                        alt="">
                    <figure class="mt-10">
                        <blockquote class="text-lg font-semibold leading-8 text-gray-900">
                            <p>“Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo expedita voluptas culpa
                                sapiente alias molestiae. Numquam corrupti in laborum sed rerum et corporis.”</p>
                        </blockquote>
                        <figcaption class="mt-10 flex gap-x-6">
                            <img src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=96&h=96&q=80"
                                alt="" class="h-12 w-12 flex-none rounded-full bg-gray-50">
                            <div>
                                <div class="text-base font-semibold text-gray-900">Brenna Goyette</div>
                                <div class="text-sm leading-6 text-gray-600">CEO of Workcation</div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </div> --}}

    <section class="py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-4 mb-14">
                <h2 class="text-gray-900 text-center text-4xl font-manrope font-bold leading-snug">Contact Us!</h2>
                <p class="text-gray-500 text-center text-base font-normal">The promise to "get back to you as soon as possible" assures prompt attention to inquiries.</p>
            </div>
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-8">
                <div class="flex flex-col gap-8">
                    <div class="w-full justify-start items-start gap-1 flex">
                        <div class="w-full justify-start items-start gap-1.5 flex flex-col">
                            <div class="justify-start items-center gap-1 inline-flex">
                                <span class="text-gray-600 text-base font-medium leading-7">Your Name</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                                    <path d="M2.55682 6.90909L2.66477 4.51136L0.642045 5.8125L0.0227273 4.73295L2.17045 3.63636L0.0227273 2.53977L0.642045 1.46023L2.66477 2.76136L2.55682 0.363636H3.78977L3.68182 2.76136L5.70455 1.46023L6.32386 2.53977L4.17614 3.63636L6.32386 4.73295L5.70455 5.8125L3.68182 4.51136L3.78977 6.90909H2.55682Z" fill="#EF4444"></path>
                                </svg>
                            </div>
                            <input type="text" class="w-full px-5 py-3 rounded-lg focus:outline-none border border-gray-200 shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] placeholder-gray-400 text-gray-900 text-lg font-normal leading-relaxed" placeholder="Name">
                        </div>
                    </div>
                    <div class="w-full justify-start items-start gap-1 flex">
                        <div class="w-full justify-start items-start gap-1.5 flex flex-col">
                            <div class="justify-start items-center gap-1 inline-flex">
                                <span class="text-gray-600 text-base font-medium leading-7">Email</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                                    <path d="M2.55682 6.90909L2.66477 4.51136L0.642045 5.8125L0.0227273 4.73295L2.17045 3.63636L0.0227273 2.53977L0.642045 1.46023L2.66477 2.76136L2.55682 0.363636H3.78977L3.68182 2.76136L5.70455 1.46023L6.32386 2.53977L4.17614 3.63636L6.32386 4.73295L5.70455 5.8125L3.68182 4.51136L3.78977 6.90909H2.55682Z" fill="#EF4444"></path>
                                </svg>
                            </div>
                            <input type="text" class="w-full px-5 py-3 rounded-lg focus:outline-none border border-gray-200 shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] placeholder-gray-400 text-gray-900 text-lg font-normal leading-relaxed" placeholder="Email">
                        </div>
                    </div>
                    <div class="w-full justify-start items-start gap-1 flex">
                        <div class="w-full justify-start items-start gap-1.5 flex flex-col">
                            <div class="justify-start items-center gap-1 inline-flex">
                                <span class="text-gray-600 text-base font-medium leading-7">Phone Number</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                                    <path d="M2.55682 6.90909L2.66477 4.51136L0.642045 5.8125L0.0227273 4.73295L2.17045 3.63636L0.0227273 2.53977L0.642045 1.46023L2.66477 2.76136L2.55682 0.363636H3.78977L3.68182 2.76136L5.70455 1.46023L6.32386 2.53977L4.17614 3.63636L6.32386 4.73295L5.70455 5.8125L3.68182 4.51136L3.78977 6.90909H2.55682Z" fill="#EF4444"></path>
                                </svg>
                            </div>
                            <input type="text" class="w-full px-5 py-3 rounded-lg focus:outline-none border border-gray-200 shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] placeholder-gray-400 text-gray-900 text-lg font-normal leading-relaxed" placeholder="Phone">
                        </div>
                    </div>
                    <div class="w-full justify-start items-start gap-1 flex">
                        <div class="w-full justify-start items-start gap-1.5 flex flex-col">
                            <div class="justify-start items-center gap-1 inline-flex">
                                <span class="text-gray-600 text-base font-medium leading-7">Description</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                                    <path d="M2.55682 6.90909L2.66477 4.51136L0.642045 5.8125L0.0227273 4.73295L2.17045 3.63636L0.0227273 2.53977L0.642045 1.46023L2.66477 2.76136L2.55682 0.363636H3.78977L3.68182 2.76136L5.70455 1.46023L6.32386 2.53977L4.17614 3.63636L6.32386 4.73295L5.70455 5.8125L3.68182 4.51136L3.78977 6.90909H2.55682Z" fill="#EF4444"></path>
                                </svg>
                            </div>
                            <input type="text" class="w-full px-5 py-3 rounded-lg focus:outline-none border border-gray-200 shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] placeholder-gray-400 text-gray-900 text-lg font-normal leading-relaxed" placeholder="Message">
                        </div>
                    </div>
                    <button class="px-5 py-2.5 rounded-xl bg-orange-500 hover:bg-orange-600 transition-all duration-700 ease-in-out shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)]">
                        <span class="px-2 text-white text-base font-semibold leading-7">Send</span>
                    </button>
                </div>
                <div class="flex flex-col gap-8">
                    <div class="flex flex-col gap-6 border-b border-gray-100 pb-6">
                        <a href="" class="flex gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path d="M5.56676 13.2488L16.7512 24.4332C19.1735 26.8556 23.1009 26.8556 25.5233 24.4332C26.4922 23.4643 26.4922 21.8933 25.5233 20.9244L22.4165 17.8176C21.71 17.1111 20.5645 17.1111 19.858 17.8176C19.1515 18.5241 18.006 18.5241 17.2994 17.8176L11.6707 12.1888C10.9642 11.4823 10.9642 10.3368 11.6707 9.63031C12.3772 8.9238 12.3772 7.7783 11.6707 7.07179L9.07561 4.47671C8.10667 3.50777 6.5357 3.50776 5.56676 4.4767C3.14441 6.89905 3.14441 10.8265 5.56676 13.2488Z" stroke="#F97316" stroke-width="1.6"></path>
                            </svg>  
                            <h6 class="text-gray-800 text-base font-normal flex items-center">470-601-1911</h6>
                        </a>
                        <a href="" class="flex gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path d="M4.43609 8.41657L9.70922 11.7027C12.2824 13.3063 13.569 14.108 14.9999 14.1078C16.4307 14.1076 17.7171 13.3054 20.2897 11.701L25.5763 8.40416M13.75 25H16.25C20.964 25 23.3211 25 24.7855 23.5355C26.25 22.0711 26.25 19.714 26.25 15C26.25 10.286 26.25 7.92893 24.7855 6.46447C23.3211 5 20.964 5 16.25 5H13.75C9.03595 5 6.67893 5 5.21447 6.46447C3.75 7.92893 3.75 10.286 3.75 15C3.75 19.714 3.75 22.0711 5.21447 23.5355C6.67893 25 9.03595 25 13.75 25Z" stroke="#F97316" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <h6 class="text-gray-800 text-base font-normal flex items-center">Pagedone1234@gmail.com</h6>
                        </a>
                        <a href="" class="flex gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                <path d="M7.40743 7.12408C11.3984 2.62531 18.6016 2.62531 22.5926 7.12408C25.8025 10.7424 25.8025 16.0817 22.5926 19.7001L16.5779 26.48C16.1504 26.9619 15.9367 27.2028 15.7015 27.3269C15.2643 27.5577 14.7357 27.5577 14.2985 27.3269C14.0633 27.2028 13.8496 26.9619 13.4221 26.48L7.40743 19.7001C4.19752 16.0817 4.19752 10.7424 7.40743 7.12408Z" stroke="#F97316" stroke-width="1.6"></path>
                                <path d="M17.9268 12.7051C17.9268 14.2669 16.6164 15.533 15 15.533C13.3836 15.533 12.0732 14.2669 12.0732 12.7051C12.0732 11.1433 13.3836 9.87715 15 9.87715C16.6164 9.87715 17.9268 11.1433 17.9268 12.7051Z" stroke="#F97316" stroke-width="1.6"></path>
                            </svg>
                            <h6 class="text-gray-800 text-base font-normal flex items-center">789 Oak Lane, Lakeside, TX 54321</h6>
                        </a>
                    </div>
                    <div class="lg:h-full h-[336px] rounded-2xl">
                        <iframe class="rounded-2xl" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21471.767410203043!2d-122.34488923248774!3d47.723813389539266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54901148850afde9%3A0x5558d4a85abfcf0c!2sHaller%20Lake!5e0!3m2!1sen!2sin!4v1714604154627!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                </div>
            </div>
        </div>
    </section>
                                                        
                                                      
@endsection
