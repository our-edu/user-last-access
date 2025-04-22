<?php
namespace Ouredu\LaravelUserLastAccess\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use LastLoginTracker\Listeners\Log;
use function Sodium\crypto_auth;

class UserLastAccessListener
{
    public function handle(): void
    {

        try {
            $user = auth()->user();
           U->updateOrInsert(
                ['user_uuid' => $user->uuid],
                ['last_login_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            );

        }catch (\Exception $exception){
            Log::channel->error('can not send log to logging', [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]);
        }

    }
}
