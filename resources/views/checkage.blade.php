@extends('layout.main')

@section('content')
    <div class="container mx-auto min-h-[90vh] px-4 pt-[7em] pb-8 sm:px-6 md:px-12 md:pb-20">
        {{-- Session Error --}}
        @if (session()->has('error'))
        <div x-data="{ open: true }" :class="{'flex': open, 'hidden': !open}"  role="alert">
          <div class="bg-[#f8d7da] z-[99] border-[2px] w:-[100px] sm:w-[350px] md:w-[600px] border-[#f5c2c7] text-[#842029] px-10 py-3 rounded absolute top-[7em] left-[50%] translate-x-[-50%]">
            <span class="absolute left-0 top-0 px-4 py-3">
              <svg @click="open = !open" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            <div class="flex flex-col ml-4">
              <strong class="font-bold text-[10px] sm:text-[12px] md:text-[16px] md:w-[400px] w-[300px]">{{ session('error') }}</strong>
            </div> 
          </div>
        </div> 
        @endif
        <div class="border-2 w-full h-full border-[#111854]">
            <img src="/covers/{{ $game->cover }}" class="absolute object-cover md:w-[240px] w-[200px] h-[110px] md:h-[150px] left-[50%] top-[6.8em] translate-x-[-50%]" alt="{{ $game->game_name }}" />
            <form action="/game/{{ $game->slug }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col justify-center items-center md:px-0 px-4">
                    <h3 class="md:mt-28 mt-20 mb-5 uppercase md:text-[16px] text-[12px] font-medium text-center max-w-[650px]">Content in this product may not be appropriate for all ages, or may not be appropriate for viewing at work.</h3>
                    <div class="md:max-w-[650px] w-full shadow-lg rounded-sm md:px-0 px-4 max-w-[400px] bg-[#f1f1f1] h-full flex flex-col justify-center items-center mb-8">
                        <p class="text-[12px] md:text-[14px] mt-8 mb-4">Please enter your birth date to continoue: </p>  
                        <div class="flex gap-4 mb-8">
                            <?php
                                $months = array(
                                    '01' => 'January',
                                    '02' => 'February',
                                    '03' => 'March',
                                    '04' => 'April',
                                    '05' => 'May',
                                    '06' => 'June',
                                    '07' => 'July',
                                    '08' => 'August',
                                    '09' => 'September',
                                    '10' => 'October',
                                    '11' => 'November',
                                    '12' => 'December'
                                );
                            ?>  
                            <div class="w-[60px]">
                                <label class="text-[12px] mb-2 md:text-[14px]">Day</label>
                                <select name="day" class="bg-[#f1f1f1] text-[10px] px-2 py-1 md:text-[12px] w-full border-2 border-[#111854] rounded">
                                    @for ($day = 1; $day <= 31; $day++)
                                        <option class="rounded" value="{{ $day }}" >{{ $day }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="w-[100px]">
                                <label class="text-[12px] md:text-[14px]">Month</label>
                                <select name="month" class="bg-[#f1f1f1] text-[10px] px-2 py-1 md:text-[12px] w-full border-2 border-[#111854] rounded">
                                    @foreach ($months as $idx => $month)
                                        <option class="rounded" value="{{ $idx }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-[80px]">
                                <label class="text-[12px] md:text-[14px]">Year</label>
                                <select name="year" class="bg-[#f1f1f1] text-[10px] px-2 py-1 md:text-[12px] w-full border-2 border-[#111854] rounded">
                                    @for ($year = date('Y'); $year >= 1900; $year--)
                                        <option class="rounded" value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>                   
                    </div> 
                    <div class="flex gap-2 mb-6">
                        <button class="bg-[#1b1b1b] rounded-md px-4 py-2 text-[#f1f1f1]">View Page</button>
                        <a href="/" class="bg-[#f1f1f1] rounded-md px-4 py-2 text-[#1b1b1b]">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection