<?php

namespace App\Http\Middleware;

use App\Exceptions\InvalidFirstAccessTokenException;
use App\Models\FirstAccess;
use App\Services\LayoutMessageService;
use Closure;
use Illuminate\Http\Request;

class EnsureFirstAccessTokenIsValid
{
    public function __construct(private LayoutMessageService $layoutMessageService)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->token;

            if (!$token) {
                throw new InvalidFirstAccessTokenException();
            }

            /** @var FirstAccess $firstAccess */
            $firstAccess = FirstAccess::with('user')
                ->where('token', $token)
                ->first();

            if (
                is_null($firstAccess)
                || !$firstAccess->user->is_first_access
                || $firstAccess->isExpired()) {
                throw new InvalidFirstAccessTokenException();
            }

            return $next($request);
        } catch (InvalidFirstAccessTokenException) {
            if ($request->expectsJson()) {
                abort(403, __('auth.invalid-first-access-token'));
            }

            $this->layoutMessageService->flashErrorMessage(__('auth.invalid-first-access-token'));
            return redirect(route('login'));
        }
    }
}
