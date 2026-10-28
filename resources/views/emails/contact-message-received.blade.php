{{-- Email body for a new contact form message; e() escapes the visitor's text so it cannot inject HTML --}}
<p><strong>Name:</strong> {{ $contactMessage->name }}</p>
<p><strong>Email:</strong> {{ $contactMessage->email }}</p>
<p><strong>Message:</strong></p>
<p>{!! nl2br(e($contactMessage->message)) !!}</p>
<p style="color: #64748b; font-size: 12px;">Sent from the portfolio contact form.</p>