@extends('layout.main')

@section('content')
<div class="container mx-auto min-h-[90vh] px-4 sm:px-6 md:px-12 md:pb-20">
    {{-- Error Message --}}
    @if ($errors->any())
      <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  role="alert">
        <div class="bg-[#f8d7da] z-[99] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#f5c2c7] text-[#842029] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
          <span class="absolute left-0 top-0 px-4 py-3">
            <svg @click="open = !open" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
          </span>
          <div class="flex flex-col ml-4">
            <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">There were {{ count($errors) }} errors with your submission</strong>
            <ul class="mt-2">
              @foreach ($errors->all() as $error)
                <li class="text-[10px] sm:text-[12px] md:text-[16px]">{{ $error }}</li>
              @endforeach
            </ul> 
          </div> 
        </div>
      </div>
    @endif
    <div class="pt-10">
        <div class="mb-10 border-2 rounded-[4px] hidden relative px-5 py-3 md:flex-row flex-col md:flex gap-x-10 md:gap-x-40 items-center border-[#e9e9e9]">
            <div class="flex gap-x-3 items-center w-full">
                <img src="/img/icon_done.png" class="w-[38px] object-cover" />
                <h2 class="md:text-[16px] text-[10px]  font-thin">Shopping Cart</h2>
            </div>
            <span class="absolute top-[-0.3em] h-10 left-[3em] md:left-[6em] text-[3em] text-[#fff]">&#8250;</span>
            <div class="flex gap-x-3 w-full items-center ml-4 md:ml-8">
                <p class="border-2 border-[#111544] px-2 py-1 rounded-[100px]">02</p>
                <h2 class="md:text-[16px] text-[10px]  font-thin">Transaction Information</h2>
            </div>
            <span class="absolute top-[-0.3em] md:left-[18em] left-[8em] text-[3em] text-[#fff]">&#8250;</span>
            <div class="flex gap-x-3 w-full items-center ml-20 md:ml-32">
                <p class="border-2 border-[#fff] md:px-2 md:py-1  rounded-[100px]">03</p>
                <h2 class="md:text-[16px] text-[10px] font-thin">Transaction Receipt</h2>
            </div>
        </div>
        <h2 class="text-[#111827] capitalize text-[18px] mb-4 font-bold sm:text-[20px] md:text-[28px]">Transaction information</h2>
        <form action="/transaction" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <h3 class="capitalize font-OpenSans mb-2 font-medium md:text-[16px] sm:text-[14px] text-[12px] text-[#202020]">Card name</h3>
                <input type="text" name="card_name" class="border-[1px] border-[#4c4e68] px-4 py-2 focus:border-[#e7e7e7] focus:border-[0px] rounded-[5px] w-full" placeholder="Card Name" value="{{ old('card_name') }}" />
            </div>
            <div class="mb-4">
                <h3 class="capitalize font-OpenSans mb-2 font-medium md:text-[16px] sm:text-[14px] text-[12px] text-[#202020]">Card number</h3>
                <input type="text" placeholder="0000 0000 0000 0000" class="border-[1px] mb-2 border-[#4c4e68] px-4 py-2 focus:border-[#e7e7e7] focus:border-[0px] rounded-[5px] w-full" name="card_number" value="{{ old('card_number') }}" />
                <p class="text-[10px] md:text-[12px] text-[#808080]">VISA or Master Card.</p>
            </div>
            <div class="mb-4 flex w-full gap-4">
                <div class="flex w-[75%] flex-col">
                    <h3 class="capitalize font-OpenSans mb-2 font-medium md:text-[16px] sm:text-[14px] text-[12px] text-[#202020]">Expired Date</h3>
                    <div class="flex gap-3">
                        <input type="number" name="expired_month" class="border-[1px] border-[#4c4e68] px-4 py-2 focus:border-[#e7e7e7] focus:border-[0px] rounded-[5px] w-full" placeholder="MM"  value="{{ old('expired_month') }}" />
                        <input type="number" name="expired_year" class="border-[1px] border-[#4c4e68] px-4 py-2 focus:border-[#e7e7e7] focus:border-[0px] rounded-[5px] w-full" placeholder="YYYY" value="{{ old('expired_year') }}" />
                    </div>
                </div>
                <div class="w-[25%]">
                    <h3 class="capitalize font-OpenSans mb-2 font-medium md:text-[16px] sm:text-[14px] text-[12px] text-[#202020]">CVC / CVV</h3>
                    <input type="number" name="cvc_cvv" class="border-[1px] border-[#4c4e68] px-4 py-2 focus:border-[#e7e7e7] focus:border-[0px] rounded-[5px] w-full" placeholder="3 or 4 digit number" value="{{ old('cvc_cvv') }}" />
                </div>
            </div>
            <div class="mb-4 flex w-full gap-4">
                <?php
                    $countries = [
                        'Indonesia' => 'Indonesia',
                        'Malaysia' => 'Malaysia',
                        'Singapore' => 'Singapore',
                        'Thailand' => 'Thailand',
                        'Vietnam' => 'Vietnam',
                        'China' => 'China',
                        'Japan' => 'Japan',
                        'Korea' => 'Korea',
                        'Taiwan' => 'Taiwan',
                    ];
                ?>
                <div class="flex w-[75%] flex-col">
                    <h3 class="capitalize font-OpenSans mb-2 font-medium md:text-[16px] sm:text-[14px] text-[12px] text-[#202020]">Country</h3>
                    <div class="relative">
                        <select name="card_country" class="border-[1px] appearance-none border-[#4c4e68] px-4 py-2 focus:border-[#e7e7e7] focus:border-[0px] rounded-[5px] w-full">
                          @foreach ($countries as $country)
                            <option value="{{ $country }}">{{ $country }}</option>          
                          @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                          <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="w-[25%]">
                    <h3 class="capitalize font-OpenSans mb-2 font-medium md:text-[16px] sm:text-[14px] text-[12px] text-[#202020]">ZIP</h3>
                    <input type="number" name="postal_code" class="border-[1px] border-[#4c4e68] px-4 py-2 focus:border-[#e7e7e7] focus:border-[0px] rounded-[5px] w-full" placeholder="ZIP" value="{{ old('postal_code') }}" /> 
                </div>
            </div>
            <div class="my-8">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <p class="text-[#111544] capitalize font-normal text-[12px] md:text-[16px]">Total Price</p>
                        <p class="text-[#111544] text-[14px] md:text-[16px] font-semibold">Rp.{{ number_format($total,  0, ".", ".") }}</p>
                    </div>
                    <div class="flex gap-3 items-center">
                        {{-- Button Cancel --}}
                        <a href="/shopping-cart" class="md:py-[11px] py-2 px-5 bg-[#fff] rounded-[8px] hover:bg-[#f1f1f1]">Cancel</a>
                        <button class="flex items-center md:mb-0 w-[130px] sm:mb-14 mb-[4.5em] gap-3 text-[#111544] rounded-[8px] text-[14px] font-semibold px-4 py-3 hover:bg-[#fff] bg-[#f1f1f1]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16">
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg>
                            Checkout
                        </button>
                    </div>
                </div> 
            </div>
        </form>
    </div>
</div>
@endsection