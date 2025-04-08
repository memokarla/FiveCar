<div>
    {{-- Stop trying to control. --}}

    <div class="mt-32 mx-3 md:mx-32 mb-8 space-y-4">
        {{-- status --}}
        <div class="px-4 rounded-lg flex flex-wrap gap-2 grid grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- id --}}
            <div class="flex items-center p-4 sm:p-6 lg:p-6.5 gap-4 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)]">
                <div class="items-center justify-center">
                    <i class="fas fa-hashtag text-2xl lg:text-4xl text-red-600"></i> 
                </div>
                <div class="items-center justify-center">
                    <h1 class="text-sm sm:text-lg lg:text-lg">Order ID</h1>
                    <p class="text-sm sm:text-lg lg:text-lg text-red-700">
                        {{ $order->code_order }}
                    </p>
                </div>
            </div>

            {{-- user --}}
            <div class="flex items-center p-4 sm:p-6 lg:p-8 gap-4 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)]">
                <div class="items-center justify-center">
                    <i class="fas fa-user text-2xl lg:text-4xl text-red-600"></i> 
                </div>
                <div class="items-center justify-center">
                    <h1 class="text-sm sm:text-lg lg:text-lg">Customer</h1>
                    <p class="text-sm sm:text-lg lg:text-lg text-red-700 capitalize">
                        {{ $order->user->name }}
                    </p>
                </div>
            </div>

            {{-- date --}}
            <div class="flex items-center p-4 sm:p-6 lg:p-8 gap-4 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)]">
                <div class="items-center justify-center">
                    <i class="fas fa-calendar-days text-2xl lg:text-4xl text-red-600"></i> 
                </div>
                <div class="items-center justify-center">
                    <h1 class="text-sm sm:text-lg lg:text-lg">Ordered Date</h1>
                    <p class="text-sm sm:text-lg lg:text-lg text-red-700 capitalize">
                        {{ $order->created_at->format('d F Y') }}
                    </p>
                </div>
            </div>

            {{-- order status --}}
            <div class="flex items-center p-4 sm:p-6 lg:p-8 gap-4 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)]">
                <div class="items-center justify-center">
                    <i class="fas fa-list-check text-2xl lg:text-4xl text-red-600"></i> 
                </div>
                <div class="items-center justify-center">
                    <h1 class="text-sm sm:text-lg lg:text-lg">Order Status</h1>
                    <p class="text-sm sm:text-lg lg:text-lg text-red-700 capitalize">
                        {{ $order->status }}
                    </p>
                </div>
            </div>
        </div>

        {{-- method --}}
        <div class="rounded-lg p-4 flex flex-wrap justify-around shadow-[2px_2px_4px_rgba(0,0,0,0.5)]">
            {{-- payment method --}}
            <div class="flex items-center gap-2">
                <div class="items-center justify-center">
                    <i class="fas fa-credit-card text-lg lg:text-lg text-red-600"></i> 
                </div>
                <div class="items-center justify-center">
                    <h1 class="text-sm sm:text-sm lg:text-sm">Payment Method</h1>
                    <p class="text-sm sm:text-sm lg:text-sm text-red-700">
                        {{ $this->getPaymentMethodLabel() }}
                    </p>
                </div>
            </div>

            <div class="border-l border-red-300"></div>

            {{-- payment status --}}
            <div class="flex items-center gap-2">
                <div class="items-center justify-center">
                    <i class="fas fa-money-check text-lg lg:text-lg text-red-600"></i> 
                </div>
                <div class="items-center justify-center">
                    <h1 class="text-sm sm:text-sm lg:text-sm">Payment Status</h1>
                    <p class="text-sm sm:text-sm lg:text-sm text-red-700 capitalize">
                        {{ $order->payment_status }}
                    </p>
                </div>
            </div>

            <div class="border-l border-red-300"></div>

            {{-- shipping method --}}
            <div class="flex items-center gap-2">
                <div class="items-center justify-center">
                    <i class="fas fa-truck text-lg lg:text-lg text-red-600"></i> 
                </div>
                <div class="items-center justify-center">
                    <h1 class="text-sm sm:text-sm lg:text-sm">Shipping Method</h1>
                    <p class="text-sm sm:text-sm lg:text-sm text-red-700">
                        {{ $this->getShippingMethodLabel() }}
                    </p>
                </div>
            </div>
        </div>

        {{-- detail --}}
        <div class="flex flex-col md:flex-row gap-4">
            {{-- product detal --}}
            <div class="rounded-lg space-y-4 w-full lg:w-[70%]">
                <div class="p-4 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)]">
                    <p class="font-semibold text-lg">Product</p>

                    <div class="flex pt-4 gap-4">
                        <div>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-24 md:h-32 lg:h-32 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)]" />
                        </div>
                        
                        <div>
                            <div>{{ $product->merk->name }} {{ $product->name }} {{ $product->jenis->name }}</div>
                            <div>
                                {{ 'Rp ' . number_format($product->price >= 1000000000 ? $product->price / 1000000000 : $product->price / 1000000, 2) }}
                                {{ $product->price >= 1000000000 ? ' M' : ' Jt' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-lg shadow-[2px_2px_4px_rgba(0,0,0,0.5)]">
                    <p class="font-semibold text-lg">Shipping Address</p>

                    <div class="pt-2 flex justify-between">
                        <div class="capitalize">
                            {{ $address->street_address }}, {{ $address->city }}, {{ $address->state }}, {{ $address->zip_code }}
                        </div>

                        <div>
                            {{ $address->phone }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- order summary --}}
            <div class="rounded-lg w-full lg:w-[30%] p-4 shadow-[2px_2px_4px_rgba(0,0,0,0.5)] flex flex-col gap-2 self-start">
                <p class="font-semibold text-lg">Order Summary</p>

                <div class="grid grid-cols-2 gap-y-2 text-gray-800 text-sm md:text-base">
                    <div class="flex justify-between col-span-2">
                        <div>Subtotal</div>
                        <div>Rp {{ number_format($product->price, 2, ',', '.') }}</div>
                    </div>

                    <div class="flex justify-between col-span-2">
                        <div>Tax</div>
                        <div>{{ $order->tax }} %</div>
                    </div>                        

                    <div class="col-span-2 border-t border-gray-300 my-2"></div>

                    <div class="flex justify-between col-span-2 font-medium">
                        <div>Grand Total</div>
                        <div>Rp {{ number_format($order->grand_total, 2, ',', '.') }}</div>
                    </div>
                </div>

            </div>
        </div>

        {{-- button --}}
        <div>
            <a href="{{ route('order') }}" class="text-white bg-red-700 font-medium rounded-lg text-sm py-2.5 px-4 bg-red-600 hover:bg-red-700">
                Back to My Order
            </a>
        </div>
    </div>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</div>
