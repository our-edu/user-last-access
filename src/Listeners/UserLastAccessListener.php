<?php
namespace Ouredu\UserLastAccess\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Ouredu\UserLastAccess\Models\UserLastAccess;


class UserLastAccessListener
{
    public function handle(): void
    {

        try {
            $user = auth()->user();
           UserLastAccess::updateOrCreate(
                ['user_uuid' => $user->uuid],
                ['last_login_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            );

        }catch (\Exception $exception){
            // Log error to the default log channel
            Log::error('can not send log to logging', [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]);
        }

    }
}
