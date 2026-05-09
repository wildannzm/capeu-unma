<?php

namespace Tests\Feature;

use App\Livewire\User\RegistrationWizard;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    // Create 'user' role if it doesn't exist
    if (! Role::where('name', 'user')->exists()) {
        Role::create(['name' => 'user']);
    }
});

it('can complete the full registration wizard flow', function () {
    Storage::fake('local');

    $passport = UploadedFile::fake()->create('passport.pdf', 500);
    $studentCard = UploadedFile::fake()->create('student_card.jpg', 500);
    $formalPhoto = UploadedFile::fake()->create('photo.png', 500);
    $paymentProof = UploadedFile::fake()->create('payment.jpg', 500);

    Livewire::test(RegistrationWizard::class)
        // Step 1: Personal Information
        ->set('personal_info.full_name', 'Test User')
        ->set('personal_info.gender', 'Male')
        ->set('personal_info.dob', '2000-01-01')
        ->set('personal_info.nationality', 'Indonesian')
        ->set('personal_info.passport_id', 'A1234567')
        ->set('personal_info.email', 'test@example.com')
        ->set('personal_info.whatsapp', '+628123456789')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('nextStep')
        ->assertSet('currentStep', 2)

        // Step 2: Academic Information
        ->set('academic_info.university_name', 'Universitas Majalengka')
        ->set('academic_info.country', 'Indonesia')
        ->set('academic_info.major', 'Informatics')
        ->set('academic_info.year_semester', '3rd Year')
        ->set('academic_info.student_id', '20210001')
        ->set('academic_info.gpa', 3.85)
        ->call('nextStep')
        ->assertSet('currentStep', 3)

        // Step 3: Participation Details
        ->set('participant_type', 'Non-CAPEU Member ($150 USD)')
        ->set('participation_details.motivation', str_repeat('Motivation string ', 10))
        ->call('nextStep')
        ->assertSet('currentStep', 4)

        // Step 4: Health & Emergency
        ->set('health_emergency.dietary_preference', 'Halal')
        ->set('health_emergency.emergency_contact', 'Emergency Contact')
        ->set('health_emergency.emergency_relationship', 'Parent')
        ->set('health_emergency.emergency_phone', '+628987654321')
        ->call('nextStep')
        ->assertSet('currentStep', 5)

        // Step 5: Document Upload
        ->set('passport_path', $passport)
        ->set('student_card_path', $studentCard)
        ->set('formal_photo_path', $formalPhoto)
        ->call('nextStep')
        ->assertSet('currentStep', 6)

        // Step 6: Payment Verification
        ->set('payment_info.payment_method', 'Bank Transfer')
        ->set('proof_of_payment_path', $paymentProof)
        ->call('nextStep')
        ->assertSet('currentStep', 7)

        // Step 7: Declaration
        ->set('declaration.accurate_info', true)
        ->set('declaration.follow_rules', true)
        ->set('declaration.use_media', true)
        ->call('nextStep')
        ->assertSet('currentStep', 8)

        // Step 8: Optional & Submit
        ->set('advanced_info.video_url', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ')
        ->call('submit')
        ->assertRedirect('/dashboard');

    // Assert database records
    $user = User::where('email', 'test@example.com')->first();
    expect($user)->not->toBeNull();
    expect($user->hasRole('user'))->toBeTrue();

    $registration = Registration::where('user_id', $user->id)->first();
    expect($registration)->not->toBeNull();
    expect($registration->status)->toBe('submitted');
    expect($registration->participant_type)->toBe('Non-CAPEU Member ($150 USD)');

    // Assert files are stored in private disk (which is 'local' in config)
    Storage::disk('local')->assertExists($registration->passport_path);
    Storage::disk('local')->assertExists($registration->student_card_path);
    Storage::disk('local')->assertExists($registration->formal_photo_path);

    $payment = $registration->payments()->first();
    expect($payment)->not->toBeNull();
    expect((float) $payment->amount)->toBe(150.0);
    Storage::disk('local')->assertExists($payment->payment_proof_path);
});
