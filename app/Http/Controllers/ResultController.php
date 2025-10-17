<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResultController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function demo1()
    {
        return view('demo1');
    }

    public function fetchIndividual(Request $request)
    {
        $request->validate([
            'roll' => 'required',
            'exam' => 'required',
            'regulation' => 'required',
        ]);

        $roll = $request->input('roll');
        $exam = strtolower(str_replace(' ', '-', $request->input('exam')));
        $regulation = $request->input('regulation');

        $url = "https://btebresulthub-server.vercel.app/results/individual/{$roll}?exam={$exam}&regulation={$regulation}";

        $response = Http::get($url);

        // dd($url, $response->status(), $response->body());

        if ($response->successful()) {
            $raw = $response->json();
    
            // 🔄 Transform API data into the format Blade expects
            $data = [
                'roll' => $raw['roll'] ?? null,
                'exam' => $raw['exam'] ?? null,
                'regulation' => $raw['regulation'] ?? null,
                'institute' => [
                    'name' => $raw['instituteData']['name'] ?? 'Unknown Institute',
                    'code' => $raw['instituteData']['code'] ?? '',
                    'district' => trim($raw['instituteData']['district'] ?? ''),
                ],
                'semester_results' => [],
                'current_reffereds' => [],
            ];
    
            // 🧠 Loop through semesters
            foreach ($raw['resultData'] ?? [] as $r) {
                $semester = $r['semester'];
                $status = $r['passed'] ? 'Passed' : 'Failed';
    
                // Determine GPA or Failed Subjects
                $examResult = [
                    'date' => $r['publishedAt'],
                    'gpa' => is_string($r['result']) ? $r['result'] : 'Referred',
                ];
    
                $semesterData = [
                    'semester' => $semester,
                    'status' => $status,
                    'exam_results' => [$examResult],
                    'referred_subjects' => [],
                ];
    
                // 📘 If failed or result is an object, parse the failedList
                if (is_array($r['result'])) {
                    $failedList = $r['result']['failedList'] ?? [];
                    $passedList = $r['result']['passedList'] ?? [];
    
                    // Add failed subjects to semester’s referred_subjects
                    foreach ($failedList as $fail) {
                        $semesterData['referred_subjects'][] = [
                            'subject_name' => $fail['subjectName'] ?? 'Unknown',
                            'reffered_type' => $fail['failedType'] ?? 'N/A',
                        ];
    
                        // Also add to global "current_reffereds"
                        $data['current_reffereds'][] = [
                            'subject_name' => $fail['subjectName'] ?? 'Unknown',
                            'reffered_type' => $fail['failedType'] ?? 'N/A',
                            'subject_semester' => $semester,
                            'passed' => false,
                        ];
                    }
    
                    // Add passed subjects (if you want to display them later)
                    foreach ($passedList as $pass) {
                        $data['current_reffereds'][] = [
                            'subject_name' => $pass['subjectName'] ?? 'Unknown',
                            'reffered_type' => $pass['failedType'] ?? 'N/A',
                            'subject_semester' => $semester,
                            'passed' => true,
                        ];
                    }
                }
    
                $data['semester_results'][] = $semesterData;
            }
    
            return view('result', ['data' => $data]);
        } else {
            return back()->with('error', 'Unable to fetch result. Please try again.');
        }
    }

    public function fetchGroup(Request $request)
    {
        $response = Http::get('https://btebresultszone.com/api/results/group', [
            'semester' => $request->semester,
            'rollComb' => $request->rollComb,
            'exam' => $request->exam,
            'regulation' => $request->regulation
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return view('group', ['data' => $data]);
        } else {
            return back()->with('error', 'Unable to fetch group results.');
        }
    }
}
