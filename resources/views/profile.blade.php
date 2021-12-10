@extends('layout.main')

@section('content')
    <div class="px-8 py-8  w-full min-h-[85vh]">
      <div class="bg-[#fff] rounded-[4px] w-full flex justify-between">
        @include('partials.sidenav')
        <div class="border-l-2 border-[#f3f3f3]"></div>
        <div class="flex flex-1 px-5 py-4">
          <p class="">{{ $user->username }} Profile</p>
        </div>
      </div>
    </div>
@endsection