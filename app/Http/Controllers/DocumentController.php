<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    /**
     * Show the specified document.
     */
    public function show(Registration $registration, string $field): StreamedResponse
    {
        $user = Auth::user();

        // Ensure the authenticated user owns this registration OR is an admin
        if ($user->id !== $registration->user_id && ! $user->hasRole('admin')) {
            abort(403, 'Unauthorized access to this document.');
        }

        $path = null;

        if ($field === 'proof') {
            // Handle payment proof from the latest payment record
            $payment = $registration->payments()->latest()->first();
            $path = $payment?->payment_proof_path;
        } else {
            // Map the field name to the actual column name for registration
            $column = $field.'_path';
            $path = $registration->$column;
        }

        // Check if the path exists and has a value
        if (empty($path)) {
            abort(404, 'Document record not found.');
        }

        // Check if the file actually exists in storage
        if (! Storage::disk('local')->exists($path)) {
            abort(404, 'Document file not found on server.');
        }

        return Storage::disk('local')->response($path);
    }
}
