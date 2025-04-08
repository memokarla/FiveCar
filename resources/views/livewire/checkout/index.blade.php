<div>
    {{-- The best athlete wants his opponent at his best. --}}
    

    {{-- message --}}
    @if (session()->has('message'))
    <div class="fixed inset-0 backdrop-blur-sm bg-black/70 h-screen flex justify-center items-center z-50">
        <div class="sticky bg-white border border-4 border-green-500 text-white py-5 px-12 rounded-lg flex flex-col items-center shadow-[2px_2px_4px_rgba(0,0,0,0.5)]">
            
            {{-- icon --}}
            <i class="fa-solid fa-circle-check text-7xl text-green-500"></i>

            {{-- text --}}
            <p class="text-2xl text-green-500 font-semibold mt-4 text-center">{{ session('message') }}</p>
            <p class="text-base text-gray-500/90 text-center mt-1.5">Your payment has been processed successfully.</p>

            {{-- button --}}
            <div class="grid grid-cols-2 gap-4 mt-12 w-full">
                <a href="{{ route('product') }}" class="text-center text-green-700 border-2 border border-green-500 bg-transparent font-medium rounded-lg text-sm w-full py-2.5 hover:bg-green-800 hover:border-green-800 hover:text-white min-w-0">
                    Back to Product
                </a>
                <a href="{{ route('orderDetail', ['id' => $order->id]) }}" class="text-center text-white bg-green-500 font-medium rounded-lg text-sm w-full py-2.5 hover:bg-green-800 min-w-0">
                    View Order Details
                </a>
            </div>

        </div>  
    </div>
    @endif

    {{-- content --}}
    <div class="mt-32 mx-4 md:mx-32 mb-8">
        <div>
            <div class="font-bold text-3xl">Checkout</div>
        </div>

        <div class="flex flex-col md:flex-row gap-4 pt-4">

            {{-- kiri --}}
            <div class="w-full md:w-[65%] bg-gray-400 rounded-lg p-4">
                {{-- address --}}
                <div>
                    <p class="font-semibold text-xl">Shipping Address</p>
    
                    <div class="mt-3">
                        <form class="mt-3">
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                                <input wire:model='name' type="text" id="name" 
                                class="text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500
                                        @error('name') border-red-600 @enderror" 
                                required />
                                @error('name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="mb-5">
                                <label for="phone" class="block mb-2 text-sm font-medium text-white">Phone</label>
                                <input wire:model='phone' type="tel" id="phone" 
                                class="text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500
                                        @error('phone') border-red-600 @enderror" 
                                required />
                                @error('phone')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="mb-5">
                                <label for="address" class="block mb-2 text-sm font-medium text-white">Street Address</label>
                                <input wire:model='street_address' type="text" id="address" 
                                class="text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500 
                                        @error('street_address') border-red-600 @enderror" 
                                required />
                                @error('street_address')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="grid md:grid-cols-3 md:gap-4">
                                <div class="mb-5">
                                    <label for="state" class="block mb-2 text-sm font-medium text-white">State</label>
                                    <input wire:model='state' type="text" id="state" \
                                    class="text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500
                                            @error('state') border-red-600 @enderror" 
                                    required />
                                    @error('state')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
    
                                <div class="mb-5">
                                    <label for="city" class="block mb-2 text-sm font-medium text-white">City</label>
                                    <input wire:model='city' type="text" id="city" 
                                    class="text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500
                                            @error('city') border-red-600 @enderror" 
                                    required />
                                    @error('city')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
        
                                <div class="mb-5">
                                    <label for="zip_code" class="block mb-2 text-sm font-medium text-white">ZIP Code</label>
                                    <input wire:model='zip_code' type="text" id="zip_code" 
                                    class="text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500
                                            @error('zip_code') border-red-600 @enderror" 
                                    required />
                                    @error('zip_code')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="border-t border-red-300 mt-4"></div>

                {{-- payment --}}
                <div>
                    <p class="font-semibold text-xl mt-8">Select Payment Method</p>

                    <div class="mt-4">
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm font-medium text-white">Payment Method</label>
                                <select wire:model='payment_method' type="text" id="payment_method" class="text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500 @error('payment_method') border-red-600 @enderror">
                                    <option selected>Select Payment Method</option>
                                    <option value="cod">Cash on Delivery</option>
                                    <option value="stripe">Stripe</option>
                                </select>
                                @error('payment_method')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm font-medium text-white">Shipping Method</label>
                                <select wire:model.live='shipping_method' type="text" id="shipping_method" class="text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500 @error('shipping_method') border-red-600 @enderror">
                                    <option selected>Select Shipping Method</option>
                                    <option value="pickupAtDealer">Pickup at Dealer</option>
                                    <option value="homeDelivery">Home Delivery</option>
                                    <option value="carCarrier">Car Carrier</option>
                                    <option value="roRoShipping">Ro-Ro Shipping</option>
                                    <option value="driverDelivery">Driver Delivery</option>
                                </select>
                                @error('shipping_method')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- kanan --}}
            <div class="w-full md:w-[35%] flex flex-col gap-4">
                {{-- order --}}
                <div class="p-4 bg-gray-400 rounded-lg">
                    <p class="font-semibold text-xl">Order Summary</p>

                    <div class="grid grid-cols-2 gap-y-2 text-gray-800 text-sm md:text-base mt-3">
                        <div class="flex justify-between col-span-2">
                            <div>Subtotal</div>
                            <div>Rp {{ number_format($product->price, 2, ',', '.') }}</div>
                        </div>

                        <div class="flex justify-between col-span-2">
                            <div>Tax</div>
                            <div>{{ $tax }} %</div>
                        </div>                        

                        <div class="col-span-2 border-t border-gray-300 my-2"></div>

                        <div class="flex justify-between col-span-2 font-medium">
                            <div>Grand Total</div>
                            <div>Rp {{ number_format($grand_total, 2, ',', '.') }}</div>
                        </div>
                    </div>

                </div>

                {{-- button --}}
                <div class="block">
                    <button wire:click="placeOrder" class="block text-center text-white bg-red-700 font-medium rounded-lg text-sm w-full py-2.5 bg-red-600 hover:bg-red-700">
                        Checkout
                    </button>
                </div>
            </div>

        </div>
        
    </div>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.5.3/flowbite.min.js"></script>
    
</div>
