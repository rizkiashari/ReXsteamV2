<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,500&family=Oswald:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <title>ReXsteam | {{ $title }}</title>

  <style>
    input[type='number']::-webkit-inner-spin-button,
    input[type='number']::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    input[type="date"]::-webkit-calendar-picker-indicator {
      width: 20px;
      padding: 5px 10px;
    }
  </style>

</head>
<body class="font-OpenSans" >
  <div>
    @include('partials.navbar')
    
    <div class="max-h-full w-full bg-[#D1D5DB]">
      @yield('content')
    </div>
    @auth
        @if (Auth::user()->role_id == 1)
          <div class="fixed bottom-4 z-[90] right-[3em]">
            <button class="relative inline-block h-12 w-12 ml-4 md:my-0 my-4 bg-[#4F46E5] rounded-full">
              <a href="/add-game">
                <svg class="ml-[14px]" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                  <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
                  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                </svg>
              </a>
            </button>    
          </div>           
        @endif
    @endauth
  </div>
  @include('partials.footer')
  <script>

    const imagePreview = () => {
      let file;
      let reader;
      return {
        imgSrc: '',

        fileURL(e, call) {
          if (!e.target.files.length) {
            return
          } 
          else { 
            file = e.target.files[0], readURL = new FileReader();
            readURL.readAsDataURL(file)
            readURL.onload = e => call(e.target.result)
          }
        },

        change(e) {
          this.fileURL(e, src => this.imgSrc = src)
        },
      }
    }

  </script>
</body>
</html>