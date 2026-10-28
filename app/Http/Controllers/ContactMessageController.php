<?php

// Receives the contact form (sent with fetch), saves the message and emails me a notification.

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactMessageController extends Controller
{
    public function store(StoreContactMessageRequest $request): JsonResponse
    {
        // Bots fill the hidden "website" field. Pretend it worked so they do not retry.
        if ($request->filled('website')) {
            return $this->successResponse();
        }

        $contactMessage = ContactMessage::create([
            ...$request->safe()->only(['name', 'email', 'message']),
            'ip_address' => $request->ip(),
        ]);

        $this->sendContactNotification($contactMessage);

        return $this->successResponse();
    }

    private function sendContactNotification(ContactMessage $contactMessage): void
    {
        // The message is already saved, so an email problem must not make the visitor think it failed
        try {
            Mail::to(config('portfolio.contact_recipient'))
                ->send(new ContactMessageReceived($contactMessage));
        } catch (Throwable $mailException) {
            report($mailException);
        }
    }

    private function successResponse(): JsonResponse
    {
        return response()->json(['message' => 'Thanks! Your message was sent.']);
    }
}
