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
        // Ensure the authenticated user owns this registration
        if (Auth::user()->id !== $registration->user_id) {
            abort(403, 'Unauthorized access to this document.');
        }

        // Map the field name to the actual column name
        $column = $field.'_path';

        // Check if the attribute exists and has a value
        if (! isset($registration->$column) || empty($registration->$column)) {
            abort(404, 'Document record not found.');
        }

        $path = $registration->$column;

        // Check if the file actually exists in storage
        if (! Storage::disk('local')->exists($path)) {
            abort(404, 'Document file not found on server.');
        }

        return Storage::disk('local')->response($path);
    }
}
