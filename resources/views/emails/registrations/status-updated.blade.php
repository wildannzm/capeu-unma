<x-mail::message>
# Registration Status Updated

Dear {{ $registration->user->name }},

There has been an update to your **CAPEU 2026** registration status.

**New Status:** {{ strtoupper(str_replace('_', ' ', $registration->status)) }}

<x-mail::panel>
@if($registration->status === 'accepted')
**Congratulations!** Your application has been accepted. Please check your dashboard for further instructions regarding your participation.
@elseif($registration->status === 'rejected')
We regret to inform you that your application has been rejected at this time. You can view more details in your dashboard.
@elseif($registration->status === 'under_review')
Your documents/payment are currently being reviewed by our administrative team.
@elseif($registration->status === 'pending_payment')
Your registration is pending payment verification. Please ensure you have uploaded your payment proof.
@endif
</x-mail::panel>

<x-mail::button :url="route('dashboard')">
Go to Dashboard
</x-mail::button>

If you have any questions, please reply to this email or contact our support team.

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>
