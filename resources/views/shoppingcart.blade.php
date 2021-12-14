@extends('layout.main')

@section('content')
<div class="container mx-auto min-h-[90vh] px-4 sm:px-6 md:px-12 md:pb-20">
    <div class="pt-10">
        @if (count($games) > 0)
            <div class="mb-10 border-2 rounded-[4px] hidden relative px-5 py-3 md:flex-row flex-col md:flex gap-x-10 md:gap-x-40 items-center border-[#e9e9e9]">
                <div class="flex gap-x-3 items-center w-full">
                    <p class="border-2 border-[#111544] px-2 py-1 rounded-[100px]">01</p>
                    <h2 class="md:text-[16px] text-[10px]  font-thin">Shopping Cart</h2>
                </div>
                <span class="absolute top-[-0.3em] h-10 left-[3em] md:left-[6em] text-[3em] text-[#fff]">&#8250;</span>
                <div class="flex gap-x-3 w-full items-center ml-4 md:ml-8">
                    <p class="border-2 border-[#fff] px-2 py-1 rounded-[100px]">02</p>
                    <h2 class="md:text-[16px] text-[10px]  font-thin">Transaction Information</h2>
                </div>
                <span class="absolute top-[-0.3em] md:left-[18em] left-[8em] text-[3em] text-[#fff]">&#8250;</span>
                <div class="flex gap-x-3 w-full items-center ml-20 md:ml-32">
                    <p class="border-2 border-[#fff] md:px-2 md:py-1  rounded-[100px]">03</p>
                    <h2 class="md:text-[16px] text-[10px] font-thin">Transaction Receipt</h2>
                </div>
            </div>
            <h2 class="text-[#111827] capitalize text-[18px] mb-4 font-bold sm:text-[20px] md:text-[28px]">Shopping cart</h2>
            <div class="rounded-[8px] p-4 bg-[#fff]">
                @foreach ($games as $game)
                <div class="flex justify-between mb-4 border-b-2 md:flex-row flex-col items-start sm:items-center border-[#f3f3f3] md:items-center">
                    <div class="flex md:flex-row flex-col items-start md:items-center mb-4 gap-6">
                        <img src="/covers/{{ $game->cover }}" alt="cover img" class="md:w-[20em] w-full rounded-[4px]" />
                        <div class="flex flex-col">
                            <div class="flex items-center mb-3 gap-3">
                                <h3 class="font-semibold sm:text-[18px] text-[14px] md:text-[24px]">{{ $game->game_name }}</h3>
                                <p class="text-[#fff] text-[10px] font-semibold bg-navbarBg rounded-[20px] px-3 py-1">{{ $game->category->name }}</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"  viewBox="0 0 16 16">
                                    <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
                                    <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
                                </svg>
                                <p class="text-[#111545] font-medium">Rp. {{ number_format($game->price,  0, ".", ".") }}</p>
                            </div>
                        </div>
                    </div>
                    <div x-data="{ show: false }" class="flex items-center md:mb-0 mb-3 gap-3 text-[#111544] rounded-[8px] text-[14px] font-semibold px-4 py-3 bg-[#f1f1f1]">
                        <a @click="show = true" class="flex cursor-pointer items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        <p>Delete</p>                   
                        </a>
                        <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-[#000000] bg-opacity-25" x-show="show">
                            <!-- Modal inner -->
                            <div class="w-[300px] md:w-[500px] h-[220px] md:h-[250px] px-6 py-4 mx-auto text-left bg-[#fff] rounded shadow-lg" @click.away="show = false" x-transition:enter="motion-safe:ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                            <div class="flex items-center">
                                <div class="bg-[#ff6e6e] rounded-[100px] p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-[-4px]" width="18" height="18" fill="#a70202" viewBox="0 0 16 16">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                </div>
                                <h5 class="ml-3 text-black max-w-none">Delete Cart</h5>
                            </div>
                            <!-- content -->
                            <p class="text-[#666666] mt-3 px-4 md:px-8 text-[12px] md:text-[16px]">Are you sure you want to delete this game {{ $game->game_name }}? All of your data will be permanently removed from our servers forever. This action cannot be undone</p>
                                <div class="flex justify-end mb-6 items-end mt-4 gap-3">
                                <button type="button" class="text-[#111111] border-[1px] border-[#424040] px-4 py-2 rounded-[8px] text-[12px] md:text-[16px] text-center" @click="show = false">Cancel</button>
                                <form action="/shopping-cart/{{ $game->id }}" method="GET" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-[#f44336] text-[12px] md:text-[16px] text-[#fff] px-4 py-2 rounded-[8px] text-center">Delete</button>
                                </form>
                                </div>                       
                            </div>
                        </div>
                    </div>
                    </div>
                    @endforeach
                    <div class="my-8">
                        <div class="flex items-center gap-4">
                            <p class="text-[#111544] capitalize font-normal text-[12px] md:text-[16px]">Total Price</p>
                            <p class="text-[#111544] text-[14px] md:text-[16px] font-semibold">Rp.{{ number_format($total,  0, ".", ".") }}</p>
                        </div>
                    </div>
                    <button class="flex items-center md:mb-0 sm:mb-14 mb-[4.5em] gap-3 text-[#111544] rounded-[8px] text-[14px] font-semibold px-4 py-3 bg-[#f1f1f1]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg>
                        Checkout
                    </button>
                </div>
            </div>    
        @else
            <div class="flex flex-col justify-center items-center">
                <img src="/empty_cart.svg" class="md:w-[400px] w-[200px] md:h-[400px] h-[200px]" />
                <p class="font-semibold text-[14px] md:text-[16px]">Sorry, Your Cart not found</p>
            </div>
        @endif
    </div>    
</div>
@endsection