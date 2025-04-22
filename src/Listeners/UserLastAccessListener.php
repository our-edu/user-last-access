<?php
namespace Ouredu\LastAccess\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Ouredu\LastAccess\Models\UserLastAccess;


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
            Log::channel->error('can not send log to logging', [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]);
        }

    }
}
