<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving.  --}}

    <div class="mt-32 mx-3 md:mx-32 mb-8 space-y-4">

        {{-- table --}}
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-400">
                <thead class="text-xs uppercase bg-gray-700 text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Order ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Product
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Order Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Payment Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Order Amount
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b bg-gray-800 border-gray-700 hover:bg-gray-600">
                            <th class="px-6 py-4">
                                {{ $order->id }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                @forelse ($order->orderItems as $item)
                                    {{ $item->product->merk->name }} {{ $item->product->name }} {{ $item->product->jenis->name }}
                                    <br>
                                @empty
                                    No Products Found
                                @endforelse
                            </th>
                            <td class="px-6 py-4">
                                {{ $order->created_at->format('d F Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @switch($order->status)
                                    @case('new')
                                        <label class="px-4 py-2 text-white bg-blue-600 rounded-lg">New</label>
                                        @break
                            
                                    @case('processing')
                                        <label class="px-4 py-2 text-white bg-yellow-600 rounded-lg">Processing</label>
                                        @break
                            
                                    @case('shipped')
                                        <label class="px-4 py-2 text-white bg-indigo-600 rounded-lg">Shipped</label>
                                        @break
                            
                                    @case('delivered')
                                        <label class="px-4 py-2 text-white bg-green-600 rounded-lg">Delivered</label>
                                        @break
                            
                                    @case('canceled')
                                        <label class="px-4 py-2 text-white bg-red-600 rounded-lg">Canceled</label>
                                        @break
                            
                                    @default
                                        <label class="px-4 py-2 text-white bg-gray-600 rounded-lg">Unknown</label>
                                @endswitch
                            </td>
                            <td class="px-6 py-4">
                                @switch($order->payment_status)
                                    @case('pending')
                                        <label class="px-4 py-2 text-white bg-yellow-600 rounded-lg">Pending</label>
                                        @break
                            
                                    @case('paid')
                                        <label class="px-4 py-2 text-white bg-green-600 rounded-lg">Paid</label>
                                        @break

                                    @case('failed')
                                        <label class="px-4 py-2 text-white bg-red-600 rounded-lg">Failed</label>
                                        @break
                            
                                    @default
                                        <label class="px-4 py-2 text-white bg-gray-600 rounded-lg">Unknown</label>
                                @endswitch
                            </td>
                            <td class="px-6 py-4">
                                {{ 'Rp ' . number_format($order->grand_total >= 1000000000 ? $order->grand_total / 1000000000 : $order->grand_total / 1000000, 2) }}
                                {{ $order->grand_total >= 1000000000 ? ' M' : ' Jt' }}
                            </td>
                            <td>
                                <div>
                                    <a href="{{ route('orderDetail', ['id' => $order->id]) }}" class="text-white font-sm rounded-lg text-sm py-1.5 px-3 bg-red-600 hover:bg-red-700">
                                        View Detals
                                    </a>
                                </div>
                            </td>
                        {{-- </tr> --}}
                    @empty
                        <p>No Orders Found</p>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
