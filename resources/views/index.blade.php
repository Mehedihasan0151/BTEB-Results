<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BTEB Result Checker</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Individual Result Checker</h2>
    <form method="GET" action="{{ route('individual.result') }}" class="space-y-4">
      @csrf
      <input name="roll" class="w-full border p-2 rounded" placeholder="Roll Number" required>
      <select name="exam" class="w-full border p-2 rounded">
        <option>DIPLOMA IN ENGINEERING</option>
        <option>DIPLOMA IN ENGINEERING (ARMY)</option>
        <option>DIPLOMA IN FORESTRY</option>
      </select>
      <input name="regulation" class="w-full border p-2 rounded" value="2016" required>
      <button class="bg-blue-600 text-white px-4 py-2 rounded">Check Result</button>
    </form>

    <hr class="my-8">

    <h2 class="text-2xl font-bold mb-4">Group Result Checker</h2>
    <form method="GET" action="{{ route('group.result') }}" class="space-y-4">
      <input name="rollComb" class="w-full border p-2 rounded" placeholder="Roll Range (e.g. 569164-569178)" required>
      <input type="number" name="semester" class="w-full border p-2 rounded" placeholder="Semester" required>
      <select name="exam" class="w-full border p-2 rounded">
        <option>DIPLOMA IN ENGINEERING</option>
        <option>DIPLOMA IN ENGINEERING (ARMY)</option>
        <option>DIPLOMA IN FORESTRY</option>
      </select>
      <input name="regulation" class="w-full border p-2 rounded" value="2016" required>
      <button class="bg-green-600 text-white px-4 py-2 rounded">Get Group Result</button>
    </form>
  </div>
</body>
</html>
