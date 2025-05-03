<!DOCTYPE html>
<html>
<head>
  <title>Individual Result</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  @php
  function ordinal($number) {
      return $number . (
          ($number % 100 >= 11 && $number % 100 <= 13) ? 'th' : ['st', 'nd', 'rd', 'th'][$number % 10] ?? 'th'
      );
  }
@endphp

<div class="max-w-3xl mx-auto p-6 space-y-8">
  <!-- Header -->
  <div class="text-center">
      <h1 class="text-3xl font-bold text-blue-800">📘 Result for Roll: {{ $data['roll'] ?? 'N/A' }}</h1>
      <p class="text-gray-600 text-lg mt-1">🏫 {{ $data['institute']['name'] ?? '' }} ({{ $data['roll'] ?? '' }})</p>
  </div>

  {{-- Semester Results --}}
  @if(isset($data['semester_results']))
      @foreach($data['semester_results'] as $semester)
          <div class="bg-white shadow-md rounded-xl p-5 border-l-4 {{ ($semester['status'] ?? '') == 'Passed' ? 'border-green-400' : 'border-red-400' }}">
              <div class="flex justify-between items-center mb-4">
                  <h2 class="text-xl font-semibold text-indigo-700">
                      {{ $semester['semester'] }}@switch($semester['semester'] % 10)
                          @case(1){{ $semester['semester'] % 100 != 11 ? 'st' : 'th' }}@break
                          @case(2){{ $semester['semester'] % 100 != 12 ? 'nd' : 'th' }}@break
                          @case(3){{ $semester['semester'] % 100 != 13 ? 'rd' : 'th' }}@break
                          @default th
                      @endswitch Semester
                  </h2>
                  {{-- error --}}
                  <span class="text-sm {{ isset($semester['referred_subjects']) && count($semester['referred_subjects']) > 0 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }} px-3 py-1 rounded-full">
                    {{ isset($semester['referred_subjects']) && count($semester['referred_subjects']) > 0 ? 'Failed' : 'Passed' }}
                </span>
                
              </div>

              @foreach($semester['exam_results'] as $result)
                  <div class="flex items-center text-sm text-gray-500 gap-2 mb-2">
                      <span>📅</span>
                      <span>{{ \Carbon\Carbon::parse($result['date'])->format('d F, Y') ?? 'N/A' }}</span>
                      <span class="ml-auto italic">{{ \Carbon\Carbon::parse($result['date'])->diffForHumans() }}</span>
                  </div>
                  <div class="text-center mt-4 mb-6">
                      <p class="text-4xl font-bold text-{{ ($semester['status'] ?? '') == 'Passed' ? 'green' : 'yellow' }}-500">
                          {{ $result['gpa'] ?? 'N/A' }}
                      </p>
                  </div>
              @endforeach

              {{-- Referred Subjects (if any) --}}
              @if(isset($data['current_reffereds']) && count($data['current_reffereds']) > 0)
                  @php
                      $failedSubjects = collect($data['current_reffereds'])->where('subject_semester', $semester['semester']);
                  @endphp
                  @if($failedSubjects->count() > 0)
                      <div class="bg-red-50 border-l-4 text-red-800 p-4 rounded mt-4">
                          <h3 class="font-bold text-red-700 mb-2">⚠️ Failed / Referred Subjects</h3>
                          <ul class="list-disc pl-5 space-y-1">
                              @foreach($failedSubjects as $fail)
                                  <li>
                                      {{ $fail['subject_name'] ?? 'Unknown Subject' }}
                                      — Type: {{ $fail['reffered_type'] ?? 'N/A' }},
                                      Passed: <span class="font-semibold">{{ $fail['passed'] ? 'Yes' : 'No' }}</span>
                                  </li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
              @endif
          </div>
      @endforeach
  @else
      <p class="text-red-600">No result found.</p>
  @endif

  <!-- Back Link -->
  <div class="text-center mt-8">
      <a href="/" class="text-blue-600 hover:underline">← Back to Home</a>
  </div>
</div>


</body>

</html>
