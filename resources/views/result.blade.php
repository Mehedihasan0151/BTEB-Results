<!DOCTYPE html>
<html>
<head>
  <title>Individual Result</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 px-0 sm:px-4 sm:p-6">
    @php
    function ordinal($number) {
        return $number . (
            ($number % 100 >= 11 && $number % 100 <= 13) ? 'th' : ['st', 'nd', 'rd', 'th'][$number % 10] ?? 'th'
        );
    }
    @endphp
  
    <div class="max-w-3xl mx-auto px-2 sm:px-6 space-y-4 sm:space-y-8">
      <!-- Header -->
      <div class="text-center">
          <h1 class="text-xl sm:text-3xl font-bold text-blue-800">📘 Result for Roll: {{ $data['roll'] ?? 'N/A' }}</h1>
          <p class="text-gray-600 text-sm sm:text-lg mt-1">{{ $data['institute']['name'] ?? '' }} ({{ $data['roll'] ?? '' }})</p>
      </div>
  
      {{-- Semester Results --}}
      @if(isset($data['semester_results']))
          @foreach($data['semester_results'] as $semester)
              <div class="bg-white shadow-md rounded-lg sm:rounded-xl p-3 sm:p-5 border-l-4 {{ ($semester['status'] ?? '') == 'Passed' ? 'border-green-400' : 'border-red-400' }}">
                  <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-3 space-y-1 sm:space-y-0">
                      <h2 class="text-base sm:text-xl font-semibold text-indigo-700">
                          {{ ordinal($semester['semester']) }} Semester
                      </h2>
                      <span class="text-xs sm:text-sm w-fit {{ isset($semester['referred_subjects']) && count($semester['referred_subjects']) > 0 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }} px-2 sm:px-3 py-1 rounded-full">
                        {{ isset($semester['referred_subjects']) && count($semester['referred_subjects']) > 0 ? 'Failed' : 'Passed' }}
                    </span>
                  </div>
  
                  @foreach($semester['exam_results'] as $result)
                      <div class="flex flex-wrap items-center text-xs sm:text-sm text-gray-500 gap-1 mb-1">
                          <span>📅</span>
                          <span class="flex-1">{{ \Carbon\Carbon::parse($result['date'])->format('d M, Y') ?? 'N/A' }}</span>
                          <span class="text-gray-400 italic">{{ \Carbon\Carbon::parse($result['date'])->diffForHumans() }}</span>
                      </div>
                      <div class="text-center mt-2 sm:mt-4 mb-3 sm:mb-6">
                          <p class="text-2xl sm:text-4xl font-bold {{ ($semester['status'] ?? '') == 'Passed' ? 'text-green-500' : 'text-yellow-500' }}">
                              {{ $result['gpa'] ?? 'Reffered' }}
                          </p>
                      </div>
                  @endforeach
  
                  {{-- Referred Subjects (if any) --}}
                  @if(isset($data['current_reffereds']) && count($data['current_reffereds']) > 0)
                      @php
                          $failedSubjects = collect($data['current_reffereds'])->where('subject_semester', $semester['semester']);
                      @endphp
                      @if($failedSubjects->count() > 0)
                          <div class="bg-red-50 border-l-4 text-red-800 p-2 sm:p-4 rounded mt-2 sm:mt-4">
                              <h3 class="font-bold text-red-700 mb-1 text-sm sm:text-lg">⚠️ Failed Subjects</h3>
                              <ul class="list-disc pl-4 space-y-1 text-xs sm:text-base">
                                  @foreach($failedSubjects as $fail)
                                      <li class="break-words">
                                          {{ $fail['subject_name'] ?? 'Unknown Subject' }}
                                          <span class="block sm:inline">— Type: {{ $fail['reffered_type'] ?? 'N/A' }},</span>
                                          <span class="block sm:inline">Passed: <span class="font-semibold">{{ $fail['passed'] ? 'Yes' : 'No' }}</span></span>
                                      </li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                  @endif
              </div>
          @endforeach
      @else
          <p class="text-red-600 text-center p-4">No result found.</p>
      @endif
  
      <!-- Back Link -->
      <div class="text-center mt-4 sm:mt-8 px-2">
          <a href="/" class="inline-block text-blue-600 hover:underline text-sm sm:text-base px-4 py-2 bg-white rounded-lg shadow-sm">← Back to Home</a>
      </div>
    </div>
  </body>

</html>
