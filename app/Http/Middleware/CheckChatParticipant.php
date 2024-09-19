<?php

namespace App\Http\Middleware;

use App\Models\Chat;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckChatParticipant
{
    public function handle(Request $request, Closure $next): Response
    {

        // Retrieve the chat ID from the route
        $chat = $request->route('chat');

        // Check if the authenticated user is a participant in the chat
        if (!$chat->users()->where('user_id', Auth::id())->exists()) {
            // If the user is not a participant, return a 403 response
            abort(403, 'Unauthorized access');
        }

        // If the user is a participant, proceed with the request
        return $next($request);
    }
}
