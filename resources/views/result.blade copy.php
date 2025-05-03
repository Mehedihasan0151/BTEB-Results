<!DOCTYPE html>
<html>
<head>
  <title>Individual Result</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow space-y-6">
    <h2 class="text-xl font-bold">Result for Roll: {{ $data['roll'] ?? 'N/A' }}</h2>
    <h4 class="text-md font-semibold text-gray-600 mb-2">
      {{ $data['institute']['name'] ?? '' }} ({{ $data['roll'] ?? '' }})
    </h4>

    {{-- Failed Subjects --}}
    @if(isset($data['current_reffereds']) && count($data['current_reffereds']) > 0)
      <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded">
        <h3 class="font-bold text-red-700 mb-2">⚠️ Failed / Referred Subjects</h3>
        <ul class="list-disc pl-5">
          @foreach($data['current_reffereds'] as $fail)
            <li>
              {{ $fail['subject_name'] ?? 'Unknown Subject' }}
              (Semester: {{ $fail['subject_semester'] ?? '?' }}) —
              Type: {{ $fail['reffered_type'] ?? 'N/A' }},
              Passed: <span class="font-semibold">{{ $fail['passed'] ? 'Yes' : 'No' }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Semester Results --}}
    @if(isset($data['semester_results']))
      @foreach($data['semester_results'] as $semester)
        <div class="p-4 border rounded">
          <h3 class="font-bold text-lg text-blue-700 mb-2">
            Semester: {{ $semester['semester'] ?? 'N/A' }}
          </h3>
          <ul class="list-disc pl-5 text-gray-700">
            @foreach($semester['exam_results'] as $result)
              <li>Date: {{ \Carbon\Carbon::parse($result['date'])->format('d M Y') ?? 'N/A' }}</li>
              <li>CGPA: {{ $result['gpa'] ?? 'N/A' }}</li> 
            @endforeach
          </ul>
        </div>
      @endforeach
    @else
      <p class="text-red-600">No result found.</p>
    @endif

    <a href="{{ url('/') }}" class="block mt-6 text-blue-600 hover:underline">← Back</a>
  </div>
</body>

</html>
