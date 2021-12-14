@extends('layout.main')

@section('content')
<div class="container mx-auto min-h-[90vh] px-4 sm:px-6 md:px-12 md:pb-20">
  @if (session()->has('success'))
    <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  role="alert">
        <div class="bg-[#d1e7dd] z-[99] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#badbcc] text-[#0f5132] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
            <span class="absolute left-0 top-0 px-4 py-3">
            <svg @click="open = !open" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">{{ session('success') }}</strong>     
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
        <img src="/img/icon_done.png" class="w-[38px] object-cover" />
          <h2 class="md:text-[16px] text-[10px]  font-thin">Transaction Information</h2>
      </div>
      <span class="absolute top-[-0.3em] md:left-[18em] left-[8em] text-[3em] text-[#fff]">&#8250;</span>
      <div class="flex gap-x-3 w-full items-center ml-20 md:ml-32">
          <p class="border-2 border-[#fff] md:px-2 md:py-1  rounded-[100px]">03</p>
          <h2 class="md:text-[16px] text-[10px] font-thin">Transaction Receipt</h2>
      </div>
    </div>
    <h2 class="text-[#111827] capitalize text-[18px] mb-4 font-bold sm:text-[20px] md:text-[28px]">Transaction Receipt</h2>
    <div class="rounded-[8px] p-4 bg-[#fff]">
      <h4 class="md:text-[16px] mb-1 text-[14px] font-medium">Transaction ID: {{ $transactions->uuid_transaction }}</h4>
      <h4 class="md:text-[16px] mb-4 text-[14px] font-medium">Purchased Date: {{ $transactions->created_at }}</h4>
      <div class="border-b-[1px] mb-4 border-[#dbdbdb]"></div>
      @foreach ($transactionDetails as $transactionDetail)
        <div class="flex flex-row gap-6 items-center">
          <img src="/covers/{{ $transactionDetail->game->cover }}" class="w-[20em] h-[18em] object-cover rounded-md" />
            <div>
              <h3 class="md:text-[18px] sm:text-[16px] text-[14px] font-bold">{{ $transactionDetail->game->game_name }}</h3>
              <div class="flex flex-row gap-3 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"  viewBox="0 0 16 16">
                  <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
                  <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
                </svg>
                <h3 class="md:text-[16px] sm:text-[14px] text-[12px]  font-medium">Rp.{{ number_format($transactionDetail->game->price,  0, ".", ".")  }}</h3>
              </div>
            </div>
        </div>
        <div class="border-b-[1px] my-4 border-[#dbdbdb]"></div>
      @endforeach
      <div class="flex flex-row my-2 justify-between items-center">
        <div class="flex flex-row gap-6 my-2 items-center">
          <h4 class="text-[16px]">Total Price: </h4>
          <h4 class="font-medium md:text-[18px] sm:text-[16px] text-[14px] " >Rp.{{ number_format($total,  0, ".", ".")  }}</h4>
        </div>
        <a href="/" class="bg-[#111544] px-3 py-2 text-[#f1f1f1] text-[14px] rounded-lg" >Back to home</a>
      </div>
    </div>
  </div>
</div>
@endsection