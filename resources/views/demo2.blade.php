<!DOCTYPE html>
<html lang="en" data-theme="light">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>demo</title>
    <!-- daisy ui cdn -->
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@5"
      rel="stylesheet"
      type="text/css"
    />
    <!-- tailwind cdn -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body>
    <section
      class="max-w-4xl mx-auto bg-gradient-to-br from-red-400 to-red-500 shadow-2xl rounded-2xl mt-20 py-10 px-8"
    >
      <div class="w-full">
        <h2 class="text-2xl font-bold text-center text-white mb-5">
          Individual Result Checker
        </h2>

        <div class="flex flex-col-reverse md:flex-row md:items-center gap-8">
          
          <form method="GET" action="{{ route('individual.result') }}" class="md:w-[50%] flex flex-col gap-5">
            @csrf
            <input
            name="roll"
            type="text"
            required
            min="6"
            max="7"
            placeholder="Roll Number"
            class="input input-bordered w-full bg-white bg-opacity-80 text-black"
          />
            <select name="exam" class="select min-w-full">
              <option selected>Diploma In Engineering</option>
              <option>Diploma In Engineering(Army)</option>
              <option>Diploma In Forestry</option>
            </select>
            <input
              type="text"
              name="regulation"
              value="2016"
              placeholder="Type here"
              class="input min-w-full"
            />
            <!-- submit btn -->
            <button
            type="submit"
            class="max-w-40 shadow-lg relative inline-flex items-center justify-start py-3 pl-4 pr-12 overflow-hidden font-semibold text-red-500 transition-all duration-150 ease-in-out rounded hover:cursor-pointer hover:pl-10 hover:pr-6 bg-gray-50 group"
          >
            <span class="absolute bottom-0 left-0 w-full h-1 transition-all duration-150 ease-in-out bg-gradient-to-r from-red-400 to-red-600 group-hover:h-full"></span>
            <span class="absolute right-0 pr-4 duration-200 ease-out group-hover:translate-x-12">
              <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </span>
            <span class="absolute left-0 pl-2.5 -translate-x-12 group-hover:translate-x-0 ease-out duration-200">
              <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M14 5l7 7m0 0l-7 7m7-7H3" />
              </svg>
            </span>
            <span class="relative w-full text-left transition-colors duration-200 ease-in-out group-hover:text-white">
              View Result
            </span>
          </button>
          </form>
          <div class="w-[50%] flex justify-center">
            <img src="{{ asset('img/Happy student-pana.png') }}" alt="Happy student" class="max-w-80" />
          </div>
        </div>
        @if (session('error'))
          <div class="mb-4 p-4 rounded bg-red-100 border border-red-300 text-red-700">
            {{ session('error') }}
          </div>
        @endif

      </div>
    </section>
  </body>
</html>
