<!DOCTYPE html>
<html>
<head>
  <title>Group Result</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Group Results</h2>

    @if(is_array($data))
      @foreach($data as $student)
        <div class="mb-4 border-b pb-4">
          <h3 class="font-bold">{{ $student['roll'] ?? 'N/A' }} - {{ $student['name'] ?? '' }}</h3>
          <ul class="ml-4 mt-2 space-y-1">
            @foreach($student['results'] ?? [] as $subject)
              <li>{{ $subject['subject_name'] }}: {{ $subject['grade'] ?? 'N/A' }}</li>
            @endforeach
          </ul>
        </div>
      @endforeach
    @else
      <p class="text-red-600">Invalid or empty result data.</p>
    @endif

    <a href="{{ url('/') }}" class="block mt-4 text-blue-600">← Back</a>
  </div>
</body>
</html>
