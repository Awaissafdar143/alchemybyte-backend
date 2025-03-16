<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    public function store(ContactRequest $request): JsonResponse
    {
        $contact = Contact::create($request->validated());

        return response()->json([
            'message' => 'Thank you for contacting us!',
            'contact' => $contact
        ], 201);
    }
}
