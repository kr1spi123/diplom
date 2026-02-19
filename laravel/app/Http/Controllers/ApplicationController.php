<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Specialty;
use App\Services\RankingService;
use App\Jobs\GeneratePdfJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    protected $rankingService;

    public function __construct(RankingService $rankingService)
    {
        $this->rankingService = $rankingService;
    }

    public function index()
    {
        $applications = Auth::user()->applications()->with('specialty')->get();
        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        $specialties = Specialty::all();
        return view('applications.create', compact('specialties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'specialty' => 'required|array|min:1|max:3',
            'specialty.*' => 'exists:specialties,id',
            'name' => 'required|string|min:2|max:50',
            'surname' => 'required|string|min:2|max:50',
            'phone' => 'required|string',
            'email' => 'required|email',
            'birthdate' => 'required|date',
            'street' => 'required|string',
            'house' => 'required|string',
            'postal_code' => 'required|string',
            'school' => 'required|string',
            'graduation_year' => 'required|integer',
            'certificate_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'ege_score' => 'required|integer|min:0|max:300',
            'certificate_score' => 'required|numeric|min:3.0|max:5.0',
            'has_achievements' => 'boolean',
        ]);

        $user = Auth::user();

        // Check if already applied to any of the selected specialties
        foreach ($validated['specialty'] as $specialtyId) {
            $exists = Application::where('user_id', $user->id)
                ->where('specialty_id', $specialtyId)
                ->exists();
            
            if ($exists) {
                return back()->withErrors(['specialty' => 'Вы уже подали заявку на одну из выбранных специальностей.']);
            }
        }

        // Handle file upload
        $path = null;
        if ($request->hasFile('certificate_file')) {
            $path = $request->file('certificate_file')->store('certificates', 'public');
        }

        // Create applications
        foreach ($validated['specialty'] as $specialtyId) {
            $appData = [
                'user_id' => $user->id,
                'specialty_id' => $specialtyId,
                'full_name' => $validated['name'] . ' ' . $validated['surname'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'birthdate' => $validated['birthdate'],
                'street' => $validated['street'],
                'house' => $validated['house'],
                'postal_code' => $validated['postal_code'],
                'school' => $validated['school'],
                'graduation_year' => $validated['graduation_year'],
                'certificate_file' => $path,
                'ege_score' => $validated['ege_score'],
                'certificate_score' => $validated['certificate_score'],
                'has_achievements' => $request->has('has_achievements'),
                'status' => 'Требует подтверждения',
                'rating' => 0,
            ];

            $application = Application::create($appData);

            // 1. Calculate Ranking
            $this->rankingService->calculateRating($application);

            // 2. PDF Generation temporarily disabled
        }

        return redirect()->route('applications.index')
            ->with('success', 'Заявки успешно отправлены! Рейтинг рассчитан.');
    }

    public function show(Application $application)
    {
        // Check authorization
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }

        $position = $this->rankingService->getPosition($application);
        return view('applications.show', compact('application', 'position'));
    }

    public function verify($id)
    {
        $application = Application::with(['user', 'specialty'])->findOrFail($id);
        return view('applications.verify', compact('application'));
    }
    
    public function downloadCertificate(Application $application)
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($application->user_id !== $user->id && $user->role !== 'admin') {
                abort(403);
            }
        } else {
            abort(403);
        }

        if (!$application->certificate_file) {
            abort(404);
        }

        $path = \Illuminate\Support\Facades\Storage::disk('public')->path($application->certificate_file);
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}