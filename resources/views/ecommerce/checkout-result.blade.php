@extends('layouts.ecommerce')

@section('content')
    {{-- <section class="bg-white py-16 antialiased md:py-16">

        <div class="mx-auto max-w-2xl px-4 2xl:px-0">

            <div class="mb-6 animate__animated animate__rubberBand">
                <div class="text-center mb-3">
                    <x-icon code="check" class="p-3 rounded-full bg-green-600 text-white shadow" />
                </div>

                <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl text-center">
                    ¡Gracias por tu compra!
                </h2>
            </div>

            <p class="text-gray-500 text-center mb-6 md:mb-8">
                Your order <span class="font-medium text-gray-900 hover:underline">#7564804</span>
                will be processed within 24 hours during working days. We will notify you by email once your order has been
                shipped.
            </p>

            <div
                class="space-y-4 sm:space-y-2 rounded-xl border border-gray-100 
        bg-gray-50 p-6 mb-6 md:mb-8 shadow-lg">
                @for ($i = 0; $i < 6; $i++)
                    <dl class="sm:flex items-center justify-between gap-4">
                        <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Referencia</dt>
                        <dd class="font-medium text-gray-900 sm:text-end">#ZFH-485</dd>
                    </dl>
                @endfor
            </div>

            <div class="flex items-center space-x-4">
                <x-button size="large" type="secondary">Ver en mis pedidos</x-button>
                <x-button :href="route('ecommerce.products')" size="large" type="secondary">Seguir comprando </x-button>
            </div>
        </div>
    </section> --}}

    <section class="relative py-16">

        <div class="w-full absolute bg-green-600 top-0 left-0 h-[410px] object-cover"></div>

        <div class="w-full max-w-7xl mx-auto px-6 md:px-8">

            <div class="animate__animated animate__fadeInDown flex items-center justify-center relative mb-6 w-max mx-auto">

                <div
                    class="h-16 w-16 p-3 flex items-center justify-center rounded-full 
                bg-green-600 border-2 text-white">
                    <x-icon code="check" />
                </div>

            </div>

            <div class="w-full relative bg-white py-8 px-6 sm:py-12 sm:px-8 max-w-6xl mx-auto shadow-lg rounded-lg">

                <div class="flex items-center flex-col gap-2 pb-6 lg:pb-10">

                    <span class="font-semibold text-gray-600">Pedido {{ $order->code }}</span>

                    <h3 class="text-center font-bold text-2xl sm:text-3xl text-gray-900">
                        {{ $order->status->customer_name }}
                    </h3>

                    <p class="font-normal text-base leading-7 text-gray-500">
                        {{ $order->payment->status->customer_helper }}
                    </p>
                </div>

                {{-- <section class="py-4 relative">
                    <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
                      <div class="w-full flex-col justify-start items-start lg:gap-11 gap-6 inline-flex mb-6">
                          <div class="flex-col justify-start items-start gap-3 flex">
                              <h4 class="text-black text-xl font-medium leading-loose">Order #46528952</h4>
                              <h5 class="text-gray-500 text-lg font-normal leading-8">Thank you for shipping with us!</h5>
                          </div>
                      </div>
                      <div class="w-full mb-6 flex lg:flex-nowrap flex-wrap justify-start items-start gap-8">
                          <div class="w-full p-6 rounded-xl border border-gray-200 flex-col justify-start items-start gap-6 inline-flex">
                              <div class="w-full justify-between items-center inline-flex">
                                  <h3 class="text-black text-xl font-semibold leading-loose">Customer</h3>
                                  <button class="p-1.5 rounded-full items-center flex justify-center border border-transparent transition-all duration-700 hover:bg-indigo-100">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                          <path d="M8.01997 12.2708L7.4509 11.7085L8.01997 12.2708ZM15.7742 4.42279L16.3433 4.98506L15.7742 4.42279ZM18.6216 4.38623L18.0672 4.96293V4.96293L18.6216 4.38623ZM19.5573 5.28588L20.1118 4.70918V4.70918L19.5573 5.28588ZM19.5934 8.0947L20.1625 8.65697L19.5934 8.0947ZM11.8392 15.9427L11.2701 15.3804L11.8392 15.9427ZM10.7383 16.5141L10.6044 15.7254L10.7383 16.5141ZM9.6421 16.7002L9.77598 17.4889H9.77598L9.6421 16.7002ZM7.30876 14.4568L6.51735 14.3399H6.51735L7.30876 14.4568ZM7.46918 13.3711L8.26058 13.4881V13.4881L7.46918 13.3711ZM7.40218 16.6648L6.84773 17.2414L7.40218 16.6648ZM20.5821 6.67736L21.382 6.66709V6.66709L20.5821 6.67736ZM17.1851 3.41144L17.1749 2.61151H17.1749L17.1851 3.41144ZM21 21.8001C21.4418 21.8001 21.8 21.4419 21.8 21.0001C21.8 20.5583 21.4418 20.2001 21 20.2001V21.8001ZM3 20.2001C2.55817 20.2001 2.2 20.5583 2.2 21.0001C2.2 21.4419 2.55817 21.8001 3 21.8001V20.2001ZM8.58905 12.8331L16.3433 4.98506L15.2051 3.86052L7.4509 11.7085L8.58905 12.8331ZM18.0672 4.96293L19.0029 5.86258L20.1118 4.70918L19.1761 3.80953L18.0672 4.96293ZM19.0243 7.53243L11.2701 15.3804L12.4083 16.505L20.1625 8.65697L19.0243 7.53243ZM10.6044 15.7254L9.50822 15.9115L9.77598 17.4889L10.8721 17.3028L10.6044 15.7254ZM8.10016 14.5738L8.26058 13.4881L6.67777 13.2542L6.51735 14.3399L8.10016 14.5738ZM9.50822 15.9115C8.85898 16.0217 8.45869 16.0876 8.17213 16.0946C7.90314 16.1013 7.91532 16.0483 7.95663 16.0881L6.84773 17.2414C7.25649 17.6344 7.76448 17.7052 8.21151 17.6942C8.64096 17.6836 9.17691 17.5906 9.77598 17.4889L9.50822 15.9115ZM6.51735 14.3399C6.42983 14.9322 6.34885 15.4659 6.34917 15.8926C6.3495 16.3398 6.43631 16.8459 6.84773 17.2414L7.95663 16.0881C8.0006 16.1303 7.94936 16.1507 7.94917 15.8914C7.94896 15.6115 8.005 15.2179 8.10016 14.5738L6.51735 14.3399ZM19.0029 5.86258C19.3591 6.20504 19.5669 6.40717 19.6961 6.56993C19.8113 6.71488 19.7827 6.73057 19.7822 6.68763L21.382 6.66709C21.3762 6.21282 21.1751 5.85947 20.9491 5.57487C20.7372 5.30808 20.4352 5.02015 20.1118 4.70918L19.0029 5.86258ZM20.1625 8.65697C20.4778 8.3378 20.7723 8.04221 20.9773 7.77007C21.1959 7.47976 21.3879 7.12137 21.382 6.66709L19.7822 6.68763C19.7816 6.6447 19.8105 6.65965 19.6992 6.8075C19.5741 6.97353 19.3716 7.18093 19.0243 7.53243L20.1625 8.65697ZM16.3433 4.98506C16.6904 4.63372 16.8956 4.42847 17.061 4.30059C17.2078 4.18717 17.2288 4.21095 17.1954 4.21138L17.1749 2.61151C16.7245 2.61729 16.3714 2.81141 16.0825 3.03466C15.8124 3.24345 15.5206 3.5412 15.2051 3.86052L16.3433 4.98506ZM19.1761 3.80953C18.8525 3.49842 18.5531 3.20826 18.2777 3.00648C17.9832 2.79071 17.6253 2.60573 17.1749 2.61151L17.1954 4.21138C17.162 4.2118 17.1825 4.1875 17.332 4.29711C17.5007 4.4207 17.7111 4.62062 18.0672 4.96293L19.1761 3.80953ZM7.4509 11.7085C7.26027 11.9015 7.03517 12.1163 6.89452 12.3973L8.32527 13.1135C8.32013 13.1238 8.32046 13.1166 8.35908 13.0724C8.4046 13.0203 8.46927 12.9543 8.58905 12.8331L7.4509 11.7085ZM8.26058 13.4881C8.28535 13.3204 8.29904 13.2302 8.31321 13.1634C8.32514 13.1071 8.33051 13.103 8.32527 13.1135L6.89452 12.3973C6.75345 12.6791 6.71713 12.9878 6.67777 13.2542L8.26058 13.4881ZM11.2701 15.3804C11.1504 15.5016 11.0852 15.5671 11.0334 15.6134C10.9896 15.6526 10.9816 15.6539 10.9901 15.6495L11.7272 17.0696C12.0059 16.925 12.2169 16.6987 12.4083 16.505L11.2701 15.3804ZM10.8721 17.3028C11.1425 17.2569 11.4493 17.2138 11.7272 17.0696L10.9901 15.6495C10.9985 15.6451 10.9923 15.6512 10.9339 15.6648C10.8654 15.6807 10.7733 15.6967 10.6044 15.7254L10.8721 17.3028ZM18.8977 8.65659L15.3422 5.10104L14.2108 6.23241L17.7663 9.78796L18.8977 8.65659ZM21 20.2001H3V21.8001H21V20.2001Z" fill="#4338CA"></path>
                                      </svg>
                                  </button>
                              </div>
                              <div class="w-full flex-col justify-start items-start gap-4 flex">
                                  <div class="flex-col justify-center items-start gap-1 flex">
                                      <h4 class="text-gray-500 text-lg font-normal leading-8">Name :</h4>
                                      <h5 class="text-black text-base font-medium leading-relaxed">John Smith</h5>
                                  </div>
                                  <div class="w-full lg:justify-start justify-between items-start gap-4 inline-flex">
                                      <div class="w-full flex-col justify-center items-start gap-1 inline-flex">
                                          <h4 class="text-gray-500 text-lg font-normal leading-8">Email</h4>
                                          <h5 class="text-black text-base font-medium leading-relaxed xl:whitespace-nowrap break-all">john.smith@gmail.com</h5>
                                      </div>
                                      <div class="w-full flex-col justify-center lg:items-start items-end gap-1 inline-flex">
                                          <h4 class="text-gray-500 text-lg font-normal leading-8">Phone number</h4>
                                          <h5 class="text-black text-base font-medium leading-relaxed">+91 76802 52136</h5>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="w-full p-6 rounded-xl border border-gray-200 flex-col justify-start items-start gap-6 inline-flex">
                              <div class="w-full justify-between items-center inline-flex">
                                  <h3 class="text-black text-xl font-semibold leading-loose">Address</h3>
                                  <button class="p-1.5 rounded-full items-center flex justify-center border border-transparent transition-all duration-700 hover:bg-indigo-100">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                          <path d="M8.01997 12.2708L7.4509 11.7085L8.01997 12.2708ZM15.7742 4.42279L16.3433 4.98506L15.7742 4.42279ZM18.6216 4.38623L18.0672 4.96293V4.96293L18.6216 4.38623ZM19.5573 5.28588L20.1118 4.70918V4.70918L19.5573 5.28588ZM19.5934 8.0947L20.1625 8.65697L19.5934 8.0947ZM11.8392 15.9427L11.2701 15.3804L11.8392 15.9427ZM10.7383 16.5141L10.6044 15.7254L10.7383 16.5141ZM9.6421 16.7002L9.77598 17.4889H9.77598L9.6421 16.7002ZM7.30876 14.4568L6.51735 14.3399H6.51735L7.30876 14.4568ZM7.46918 13.3711L8.26058 13.4881V13.4881L7.46918 13.3711ZM7.40218 16.6648L6.84773 17.2414L7.40218 16.6648ZM20.5821 6.67736L21.382 6.66709V6.66709L20.5821 6.67736ZM17.1851 3.41144L17.1749 2.61151H17.1749L17.1851 3.41144ZM21 21.8001C21.4418 21.8001 21.8 21.4419 21.8 21.0001C21.8 20.5583 21.4418 20.2001 21 20.2001V21.8001ZM3 20.2001C2.55817 20.2001 2.2 20.5583 2.2 21.0001C2.2 21.4419 2.55817 21.8001 3 21.8001V20.2001ZM8.58905 12.8331L16.3433 4.98506L15.2051 3.86052L7.4509 11.7085L8.58905 12.8331ZM18.0672 4.96293L19.0029 5.86258L20.1118 4.70918L19.1761 3.80953L18.0672 4.96293ZM19.0243 7.53243L11.2701 15.3804L12.4083 16.505L20.1625 8.65697L19.0243 7.53243ZM10.6044 15.7254L9.50822 15.9115L9.77598 17.4889L10.8721 17.3028L10.6044 15.7254ZM8.10016 14.5738L8.26058 13.4881L6.67777 13.2542L6.51735 14.3399L8.10016 14.5738ZM9.50822 15.9115C8.85898 16.0217 8.45869 16.0876 8.17213 16.0946C7.90314 16.1013 7.91532 16.0483 7.95663 16.0881L6.84773 17.2414C7.25649 17.6344 7.76448 17.7052 8.21151 17.6942C8.64096 17.6836 9.17691 17.5906 9.77598 17.4889L9.50822 15.9115ZM6.51735 14.3399C6.42983 14.9322 6.34885 15.4659 6.34917 15.8926C6.3495 16.3398 6.43631 16.8459 6.84773 17.2414L7.95663 16.0881C8.0006 16.1303 7.94936 16.1507 7.94917 15.8914C7.94896 15.6115 8.005 15.2179 8.10016 14.5738L6.51735 14.3399ZM19.0029 5.86258C19.3591 6.20504 19.5669 6.40717 19.6961 6.56993C19.8113 6.71488 19.7827 6.73057 19.7822 6.68763L21.382 6.66709C21.3762 6.21282 21.1751 5.85947 20.9491 5.57487C20.7372 5.30808 20.4352 5.02015 20.1118 4.70918L19.0029 5.86258ZM20.1625 8.65697C20.4778 8.3378 20.7723 8.04221 20.9773 7.77007C21.1959 7.47976 21.3879 7.12137 21.382 6.66709L19.7822 6.68763C19.7816 6.6447 19.8105 6.65965 19.6992 6.8075C19.5741 6.97353 19.3716 7.18093 19.0243 7.53243L20.1625 8.65697ZM16.3433 4.98506C16.6904 4.63372 16.8956 4.42847 17.061 4.30059C17.2078 4.18717 17.2288 4.21095 17.1954 4.21138L17.1749 2.61151C16.7245 2.61729 16.3714 2.81141 16.0825 3.03466C15.8124 3.24345 15.5206 3.5412 15.2051 3.86052L16.3433 4.98506ZM19.1761 3.80953C18.8525 3.49842 18.5531 3.20826 18.2777 3.00648C17.9832 2.79071 17.6253 2.60573 17.1749 2.61151L17.1954 4.21138C17.162 4.2118 17.1825 4.1875 17.332 4.29711C17.5007 4.4207 17.7111 4.62062 18.0672 4.96293L19.1761 3.80953ZM7.4509 11.7085C7.26027 11.9015 7.03517 12.1163 6.89452 12.3973L8.32527 13.1135C8.32013 13.1238 8.32046 13.1166 8.35908 13.0724C8.4046 13.0203 8.46927 12.9543 8.58905 12.8331L7.4509 11.7085ZM8.26058 13.4881C8.28535 13.3204 8.29904 13.2302 8.31321 13.1634C8.32514 13.1071 8.33051 13.103 8.32527 13.1135L6.89452 12.3973C6.75345 12.6791 6.71713 12.9878 6.67777 13.2542L8.26058 13.4881ZM11.2701 15.3804C11.1504 15.5016 11.0852 15.5671 11.0334 15.6134C10.9896 15.6526 10.9816 15.6539 10.9901 15.6495L11.7272 17.0696C12.0059 16.925 12.2169 16.6987 12.4083 16.505L11.2701 15.3804ZM10.8721 17.3028C11.1425 17.2569 11.4493 17.2138 11.7272 17.0696L10.9901 15.6495C10.9985 15.6451 10.9923 15.6512 10.9339 15.6648C10.8654 15.6807 10.7733 15.6967 10.6044 15.7254L10.8721 17.3028ZM18.8977 8.65659L15.3422 5.10104L14.2108 6.23241L17.7663 9.78796L18.8977 8.65659ZM21 20.2001H3V21.8001H21V20.2001Z" fill="#4338CA"></path>
                                      </svg>
                                  </button>
                              </div>
                              <div class="flex-col justify-start items-start gap-4 flex">
                                  <div class="flex-col justify-center items-start gap-1 flex">
                                      <h4 class="text-gray-500 text-lg font-normal leading-8">Shipping Address</h4>
                                      <h5 class="text-black text-base font-medium leading-relaxed">456 Gandhi Nagar Ahmedabad, Gujarat 380001 India</h5>
                                  </div>
                                  <div class="flex-col justify-center items-start gap-1 flex">
                                      <h4 class="text-gray-500 text-lg font-normal leading-8">Billing Address</h4>
                                      <h5 class="text-black text-base font-medium leading-relaxed">Same</h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="w-full p-6 rounded-xl border border-gray-200 flex-col justify-start items-start gap-6 inline-flex">
                          <div class="w-full pb-6 border-b border-gray-100 flex-col justify-start items-start gap-6 flex">
                              <div class="w-full justify-between items-start gap-6 inline-flex">
                                  <h4 class="text-gray-500 text-xl font-normal leading-loose">Subtotal</h4>
                                  <h4 class="text-right text-gray-900 text-xl font-semibold leading-loose">$1690.26</h4>
                              </div>
                              <div class="w-full justify-between items-start gap-6 inline-flex">
                                  <h4 class="text-gray-500 text-xl font-normal leading-loose">Shipping Charge</h4>
                                  <h4 class="text-right text-gray-900 text-xl font-semibold leading-loose">$60.00</h4>
                              </div>
                              <div class="w-full justify-between items-start gap-6 inline-flex">
                                  <h4 class="text-gray-500 text-xl font-normal leading-loose">Taxes</h4>
                                  <h4 class="text-right text-gray-900 text-xl font-semibold leading-loose">$80.00</h4>
                              </div>
                              <div class="w-full justify-between items-start gap-6 inline-flex">
                                  <h4 class="text-gray-500 text-xl font-normal leading-loose">Discount</h4>
                                  <h4 class="text-right text-gray-900 text-xl font-semibold leading-loose">$00.00</h4>
                              </div>
                          </div>
                          <div class="w-full justify-between items-start gap-6 inline-flex">
                              <h3 class="text-gray-900 text-2xl font-semibold font-manrope leading-9">Total</h3>
                              <h3 class="text-right text-gray-900 text-2xl font-bold font-manrope leading-9">$1830.26</h3>
                          </div>
                      </div>
                    </div>
                </section>    --}}

                <div class="flex items-center flex-wrap justify-center gap-4">

                    <div class="w-full sm:w-5/12 rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5 py-6 px-4">
                        <div class="pb-3 border-b">
                            <dt class="flex justify-between items-center text-sm/6 
                            font-semibold text-gray-900 mb-1.5">

                                <span>Cliente</span>

                                <span class="inline-flex cursor-pointer items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset text-gray-600 ring-gray-500/10 bg-white">
                                    Invitado
                                </span>
                            </dt>
                            <dd class="mt-1 text-base font-semibold text-gray-900">
                                Marcos Rivera
                            </dd>
                        </div>

                        <div class="w-full pt-3">
                            <div class="mb-3">
                                <dt class="text-xs text-gray-500">
                                    Email
                                </dt>
                                <dd class="text-sm/6 font-medium text-gray-700">
                                    marcosrivera@gmail.com
                                </dd>
                            </div>

                            <div class="flex flex-wrap gap-6">
                                <div class="flex flex-col">
                                    <dt class="text-xs text-gray-500">
                                        Teléfono
                                    </dt>
                                    <dd class="text-sm font-medium text-gray-700">
                                        1175489763
                                    </dd>
                                </div>

                                <div class="flex flex-col">
                                    <dt class="text-xs text-gray-500">
                                        DNI
                                    </dt>
                                    <dd class="text-sm font-medium text-gray-700">
                                        39485221
                                    </dd>
                                </div>
                            </div>

                        </div>
                        <div class="mt-3 pt-3 border-t border-gray-900/5">
                            <a href="#" class="text-sm/6 font-semibold text-gray-900">
                                Download receipt <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>

                    <div class="w-full sm:w-5/12 rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5 py-6 px-4">
                        <div class="pb-3 border-b">
                            <dt class="flex justify-between items-center text-sm/6 
                            font-semibold text-gray-900 mb-1.5">

                                <span>Cliente</span>

                                <span class="inline-flex cursor-pointer items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset text-gray-600 ring-gray-500/10 bg-white">
                                    Invitado
                                </span>
                            </dt>
                            <dd class="mt-1 text-base font-semibold text-gray-900">
                                Marcos Rivera
                            </dd>
                        </div>

                        <div class="w-full pt-3">
                            <div class="mb-3">
                                <dt class="text-xs text-gray-500">
                                    Email
                                </dt>
                                <dd class="text-sm/6 font-medium text-gray-700">
                                    marcosrivera@gmail.com
                                </dd>
                            </div>

                            <div class="flex flex-wrap gap-6">
                                <div class="flex flex-col">
                                    <dt class="text-xs text-gray-500">
                                        Teléfono
                                    </dt>
                                    <dd class="text-sm font-medium text-gray-700">
                                        1175489763
                                    </dd>
                                </div>

                                <div class="flex flex-col">
                                    <dt class="text-xs text-gray-500">
                                        DNI
                                    </dt>
                                    <dd class="text-sm font-medium text-gray-700">
                                        39485221
                                    </dd>
                                </div>
                            </div>

                        </div>
                        <div class="mt-3 pt-3 border-t border-gray-900/5">
                            <a href="#" class="text-sm/6 font-semibold text-gray-900">
                                Download receipt <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </div>

                <ul role="list"
                    class="mt-6 divide-y divide-gray-200
                text-sm font-medium text-gray-500 border-t border-gray-200">
                    <li
                        class="no-select flex space-x-6 py-6 items-center hover:bg-gray-50 
                            transition duration-200 cursor-pointer">

                        <img src="https://simplecom-ecommerce.s3.sa-east-1.amazonaws.com/andromeda/products/1/vxPS71OKPJKUukK5sp0GHtE9p8CPVfyiWQ2uaaXm.jpg"
                            alt="Imagen producto"
                            class="hidden sm:block h-10 w-10 flex-none rounded-md bg-gray-100 object-cover">

                        <div class="flex-auto space-y-1">

                            <h3 class="text-gray-900 line-clamp-2">
                                Zapatillas jordan rojas 3 talles
                            </h3>

                            <p class="text-xs text-gray-500">
                                Cantidad: 1
                            </p>

                            <p class="text-xs text-gray-500">
                                Calzado: 43
                            </p>
                        </div>

                        <p class="text-right font-medium text-gray-900">
                            $89.500
                        </p>
                    </li>
                </ul>

                <dl class="space-y-4 border-t border-gray-200 pt-4 text-sm font-medium text-gray-600">
                    <div class="flex justify-between">
                        <dt>Subtotal</dt>
                        <dd class="text-gray-900">
                            $179.000
                        </dd>
                    </div>

                    <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->

                    <div
                        class="flex items-center justify-between border-t 
                    border-gray-200 pt-6 text-gray-900 font-semibold">
                        <dt class="text-base">Total</dt>
                        <dd class="text-base">
                            $179.000
                        </dd>
                    </div>
                </dl>

                <p class="pt-6 lg:pt-10 max-w-3xl mx-auto text-center font-normal text-base leading-7 text-gray-500">

                    I'm Jane Cooper, a passionate enthusiast and . Join me on this journey as I
                    explore the beauty of specific interests or topics. I believe in
                    personal or professional philosophy,. Let's connect, share
                    experiences, and inspire each other!
                </p>
            </div>
        </div>
    </section>
@endsection
