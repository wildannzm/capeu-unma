<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends Controller
{
    /**
     * Handle the request to view or download a private document.
     */
    public function show(Registration $registration, string $field): Response
    {
        // Custom authorization logic
        $user = Auth::user();

        if (!$user) {
            abort(401);
        }

        // Authorization: User owns the registration OR is an admin/committee
        if ($user->id !== $registration->user_id && ! $user->hasRole(['admin', 'committee'])) {
            abort(403, 'Unauthorized access to document.');
        }

        $path = null;

        // Handle specific fields
        if (in_array($field, ['proof', 'payment_proof', 'proof_of_payment'])) {
            $payment = $registration->payments()->latest()->first();
            $path = $payment ? $payment->payment_proof_path : null;
        } else {
            // Mapping for other document fields
            $allowedFields = [
                'passport',
                'student_card',
                'formal_photo',
                'cv',
                'motivation_letter',
            ];

            // Normalize field name (remove _path if present)
            $cleanField = str_replace('_path', '', $field);

            if (in_array($cleanField, $allowedFields)) {
                $path = $registration->{$cleanField . '_path'};
            }
        }

        if (! $path || ! Storage::disk('local')->exists($path)) {
            abort(404, 'Document not found.');
        }

        $fullPath = Storage::disk('local')->path($path);
        
        // Ensure no output buffering issues
        if (ob_get_level()) {
            ob_end_clean();
        }

        return response()->file($fullPath, [
            'Cache-Control' => 'no-cache, must-revalidate',
        ]);
    }
}
