<x-mail::message>
# Registration Successful!

Dear {{ $registration->user->name }},

Thank you for registering for the **CAPEU 2026 International Mobility Program**. We are excited to have you join us!

**Your Registration Details:**
*   **Registration Number:** {{ $registration->registration_number }}
*   **Participant Type:** {{ ucfirst(str_replace('_', ' ', $registration->participant_type)) }}
*   **Status:** {{ ucfirst($registration->status) }}

<x-mail::button :url="route('dashboard')">
View My Dashboard
</x-mail::button>

Please log in to your dashboard to complete your payment (if applicable) and monitor your application status.

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>
