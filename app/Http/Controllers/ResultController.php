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
    public function index1()
    {
        return view('demo1');
    }
    public function index2()
    {
        return view('demo2');
    }

    public function fetchIndividual(Request $request)
    {
        $response = Http::get('https://btebresultszone.com/api/results/individual', [
            'roll' => $request->roll,
            'exam' => $request->exam,
            'regulation' => $request->regulation
        ]);

        if ($response->successful()) {
            $data = $response->json();
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
