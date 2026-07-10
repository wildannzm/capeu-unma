<?php

namespace App\Livewire\User;

use App\Models\Payment;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('CAPEU 2026 - Registration')]
#[Layout('layouts.guest', ['title' => 'Registration - CAPEU 2026', 'description' => 'Register for the CAPEU 2026 International Mobility Program. Complete the 8-step application process here.'])]
class RegistrationWizard extends Component
{
    use WithFileUploads;

    public $currentStep = 1;

    public $totalSteps = 10;

    // Native Columns
    public $participant_type = '';

    public $password = '';

    public $password_confirmation = '';

    // JSON Columns
    public $personal_info = [
        'full_name' => '', 'gender' => '', 'dob' => '',
        'nationality' => '', 'passport_id' => '', 'email' => '', 'whatsapp' => '',
    ];

    public $academic_info = [
        'university_name' => '', 'country' => '', 'major' => '',
        'year_semester' => '', 'student_id' => '', 'gpa' => '',
    ];

    public $participation_details = [
        'motivation' => '', 'relevant_experience' => [], 'experience_description' => '',
    ];

    public $health_emergency = [
        'medical_conditions' => '', 'allergies' => '', 'dietary_preference' => '',
        'emergency_contact' => '', 'emergency_relationship' => '', 'emergency_phone' => '',
    ];

    public $transportation = [
        'type' => '',
    ];

    public $payment_info = [
        'payment_method' => 'Bank Transfer',
    ];

    public $declaration = [
        'accurate_info' => false, 'follow_rules' => false, 'use_media' => false,
    ];

    public $advanced_info = [
        'video_url' => '', 'expectations' => '', 'cultural_talent' => '',
    ];

    // File Uploads
    public $passport_path;

    public $student_card_path;

    public $formal_photo_path;

    public $cv_path;

    public $motivation_letter_path;

    public $formal_photo_preview; // For showing the preview

    public $proof_of_payment_path;

    public function mount()
    {
        if (session()->has('registration_data')) {
            $data = session('registration_data');
            $this->fill($data);
        }
    }

    public function updated($propertyName)
    {
        // Don't save files or passwords to session for security/performance
        $data = $this->all();
        $excludedKeys = ['passport_path', 'student_card_path', 'formal_photo_path', 'cv_path', 'motivation_letter_path', 'proof_of_payment_path', 'password', 'password_confirmation'];
        
        foreach ($excludedKeys as $key) {
            unset($data[$key]);
        }
        
        session(['registration_data' => $data]);
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->currentStep++;
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    protected function validateStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'personal_info.full_name' => 'required|string|max:255',
                'personal_info.gender' => 'required|in:Male,Female,Prefer not to say',
                'personal_info.dob' => 'required|date',
                'personal_info.nationality' => 'required|string|max:255',
                'personal_info.passport_id' => 'required|string|max:255',
                'personal_info.email' => 'required|email|max:255',
                'personal_info.whatsapp' => 'required|string|max:20',
                'password' => 'required|string|min:8|confirmed',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'academic_info.university_name' => 'required|string|max:255',
                'academic_info.country' => 'required|string|max:255',
                'academic_info.major' => 'required|string|max:255',
                'academic_info.year_semester' => 'required|string|in:1st Year,2nd Year,3rd Year,4th Year,Others',
                'academic_info.student_id' => 'required|string|max:255',
                'academic_info.gpa' => 'required|numeric|min:0|max:4',
            ]);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'participant_type' => 'required|string|in:CAPEU Member ($130 USD),Non-CAPEU Member ($150 USD)',
                'participation_details.motivation' => 'required|string|min:100', // Enforcing length visually usually, backend length validation
                'participation_details.relevant_experience' => 'nullable|array',
                'participation_details.experience_description' => 'nullable|string',
            ]);
        } elseif ($this->currentStep == 4) {
            $this->validate([
                'health_emergency.medical_conditions' => 'nullable|string',
                'health_emergency.allergies' => 'nullable|string',
                'health_emergency.dietary_preference' => 'required|string|in:Halal,Vegetarian,Vegan,No restriction',
                'health_emergency.emergency_contact' => 'required|string|max:255',
                'health_emergency.emergency_relationship' => 'required|string|max:255',
                'health_emergency.emergency_phone' => 'required|string|max:255',
            ]);
        } elseif ($this->currentStep == 5) {
            $this->validate([
                'transportation.type' => 'required|string|in:Plane,Train,Bus,Personal Vehicle,Other',
            ]);
        } elseif ($this->currentStep == 6) {
            $this->validate([
                'passport_path' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'student_card_path' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'formal_photo_path' => 'required|file|mimes:pdf,jpg,png|max:2048',
                'cv_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
                'motivation_letter_path' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            ]);
        } elseif ($this->currentStep == 7) {
            $this->validate([
                'payment_info.payment_method' => 'required|string|in:Bank Transfer',
                'proof_of_payment_path' => 'required|file|mimes:pdf,jpg,png|max:2048',
            ]);
        } elseif ($this->currentStep == 8) {
            $this->validate([
                'declaration.accurate_info' => 'accepted',
                'declaration.follow_rules' => 'accepted',
                'declaration.use_media' => 'accepted',
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'advanced_info.video_url.regex' => 'Please provide a valid YouTube URL (e.g., https://www.youtube.com/watch?v=... or https://youtu.be/...).',
        ];
    }

    public function submit()
    {
        $this->validateStep(); // Validate Step 8

        $this->validate([
            'advanced_info.video_url' => ['nullable', 'regex:/^(https?\:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+$/'],
            'advanced_info.expectations' => 'nullable|string',
            'advanced_info.cultural_talent' => 'nullable|string',
        ]);

        if (! $this->passport_path || ! $this->student_card_path || ! $this->formal_photo_path || ! $this->proof_of_payment_path) {
            $this->currentStep = 6;
            $this->dispatch('swal:alert', [
                'type' => 'warning',
                'title' => 'Files Missing',
                'text' => 'It looks like your session was interrupted or you refreshed the page. Please re-upload your files to continue.',
            ]);
            return;
        }

        try {
            // Create User Account
            $user = User::create([
                'name' => $this->personal_info['full_name'],
                'email' => $this->personal_info['email'],
                'password' => Hash::make($this->password),
            ]);

            $user->assignRole('user');

            Auth::login($user);

            $registration = new Registration;
            $registration->user_id = $user->id;
            $nextNumber = (Registration::max('id') ?? 0) + 1;
            $registration->registration_number = 'CAPEU-UNMA-'.str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            $registration->participant_type = $this->participant_type;
            $registration->status = 'submitted';

            $registration->personal_info = $this->personal_info;
            $registration->academic_info = $this->academic_info;

            $participation = $this->participation_details;
            $participation['payment_method'] = $this->payment_info['payment_method'];
            $registration->participation_details = $participation;

            $registration->health_emergency = $this->health_emergency;
            $registration->transportation = $this->transportation;
            $registration->declaration = $this->declaration;
            $registration->advanced_info = $this->advanced_info;

            // Store Files
            $registration->passport_path = $this->passport_path->store('documents/passports', 'local');
            $registration->student_card_path = $this->student_card_path->store('documents/student_cards', 'local');
            $registration->formal_photo_path = $this->formal_photo_path->store('documents/photos', 'local');

            if ($this->cv_path) {
                $registration->cv_path = $this->cv_path->store('documents/cvs', 'local');
            }
            if ($this->motivation_letter_path) {
                $registration->motivation_letter_path = $this->motivation_letter_path->store('documents/motivation_letters', 'local');
            }

            $registration->save();

            // Create Payment Record
            $paymentProofPath = null;
            if ($this->proof_of_payment_path) {
                $paymentProofPath = $this->proof_of_payment_path->store('documents/payments', 'local');
            }

            $amount = str_contains($this->participant_type, '130') ? 130 : 150;

            Payment::create([
                'registration_id' => $registration->id,
                'amount' => $amount,
                'currency' => 'USD',
                'payment_method' => $this->payment_info['payment_method'],
                'payment_proof_path' => $paymentProofPath,
                'status' => 'pending',
            ]);

            session()->forget('registration_data');

            $this->dispatch('swal:alert', [
                'type' => 'success',
                'title' => 'Registration Successful!',
                'text' => 'Your account has been created and your application submitted.',
            ]);

            $this->currentStep = 10;
        } catch (\Exception $e) {
            $this->dispatch('swal:alert', [
                'type' => 'error',
                'title' => 'Registration Failed',
                'text' => 'We encountered an issue while saving your application. Please ensure all files are under 2MB and your email is unique, then try again.',
            ]);
            return;
        }
    }

    public function finishRegistration()
    {
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.user.registration-wizard');
    }
}
