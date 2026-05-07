<?php

namespace App\Livewire\User;

use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.sidebar', ['header' => 'User Profile'])]
#[Title('CAPEU 2026 - User Profile')]
class Profile extends Component
{
    /**
     * The component's state.
     *
     * @var array<string, mixed>
     */
    public array $state = [];

    /**
     * The state for updating the password.
     *
     * @var array<string, mixed>
     */
    public array $passwordState = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    /**
     * Whether or not the verification link has been sent.
     */
    public bool $verificationLinkSent = false;

    /**
     * Whether or not the two-factor authentication is being enabled.
     */
    public bool $showingQrCode = false;

    /**
     * Whether or not the recovery codes are being shown.
     */
    public bool $showingRecoveryCodes = false;

    /**
     * Whether or not the confirmation of 2FA is being shown.
     */
    public bool $showingConfirmation = false;

    /**
     * The 2FA confirmation code.
     */
    public string $code = '';

    /**
     * Prepare the component.
     */
    public function mount(): void
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfileInformation(UpdateUserProfileInformation $updater): void
    {
        $this->resetErrorBag();

        $updater->update(Auth::user(), $this->state);

        $this->dispatch('saved');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(UpdateUserPassword $updater): void
    {
        $this->resetErrorBag();

        try {
            $updater->update(Auth::user(), $this->passwordState);
        } catch (ValidationException $e) {
            foreach ($e->errors() as $key => $messages) {
                foreach ($messages as $message) {
                    $this->addError($key, $message);
                }
            }

            return;
        }

        $this->passwordState = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->dispatch('saved');
    }

    /**
     * Send an email verification notification.
     */
    public function sendEmailVerification(): void
    {
        Auth::user()->sendEmailVerificationNotification();

        $this->verificationLinkSent = true;

        $this->dispatch('verification-link-sent');
    }

    /**
     * Enable two-factor authentication for the user.
     */
    public function enableTwoFactorAuthentication(EnableTwoFactorAuthentication $enable): void
    {
        $enable(Auth::user());

        $this->showingQrCode = true;

        if (config('fortify.features.two-factor-authentication.confirm')) {
            $this->showingConfirmation = true;
        } else {
            $this->showingRecoveryCodes = true;
        }

        $this->dispatch('two-factor-enabled');
    }

    /**
     * Confirm two-factor authentication for the user.
     */
    public function confirmTwoFactorAuthentication(TwoFactorAuthenticationProvider $provider): void
    {
        $this->resetErrorBag();

        if (empty($this->code)) {
            $this->addError('code', 'The confirmation code is required.');

            return;
        }

        $verified = $provider->verify(
            decrypt(Auth::user()->two_factor_secret),
            $this->code
        );

        if (! $verified) {
            $this->addError('code', 'The provided two-factor authentication code was invalid.');

            return;
        }

        Auth::user()->forceFill([
            'two_factor_confirmed_at' => now(),
        ])->save();

        $this->showingQrCode = false;
        $this->showingConfirmation = false;
        $this->showingRecoveryCodes = true;
        $this->code = '';
    }

    /**
     * Disable two-factor authentication for the user.
     */
    public function disableTwoFactorAuthentication(DisableTwoFactorAuthentication $disable): void
    {
        $disable(Auth::user());

        $this->showingQrCode = false;
        $this->showingConfirmation = false;
        $this->showingRecoveryCodes = false;

        $this->dispatch('two-factor-disabled');
    }

    /**
     * Display the user's recovery codes.
     */
    public function showRecoveryCodes(): void
    {
        $this->showingRecoveryCodes = true;
    }

    /**
     * Regenerate the user's recovery codes.
     */
    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generate): void
    {
        $generate(Auth::user());

        $this->showingRecoveryCodes = true;
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.user.profile', [
            'user' => Auth::user(),
        ]);
    }
}
