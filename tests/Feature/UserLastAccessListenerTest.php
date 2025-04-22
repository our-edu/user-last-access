<?php

namespace Ouredu\LastAccess\Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Ouredu\LastAccess\Listeners\UserLastAccessListener;
use Ouredu\LastAccess\Tests\TestCase;
use Ouredu\LastAccess\Models\UserLastAccess;
use Illuminate\Support\Facades\Schema;

class UserLastAccessListenerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Ensure the UserLastAccess table exists
        $this->loadMigrationsFrom(__DIR__.'/../../src/database/migrations');
    }

    public function test_user_last_access_record_is_created_or_updated()
    {
        // Fake a user
        $user = \User::factory()->create(); // You should publish or include a dummy User model factory

        // Authenticate the user
        $this->be($user);

        // Fire the event
        event(new RouteMatched(request(), app()->router->getRoutes()->getByName('api')));

        // Assert the last access was stored
        $this->assertDatabaseHas('user_last_accesses', [
            'user_uuid' => $user->uuid,
        ]);

        $lastAccess = UserLastAccess::where('user_uuid', $user->uuid)->first();
        $this->assertNotNull($lastAccess);
        $this->assertTrue(Carbon::parse($lastAccess->last_login_at)->isToday());
    }
}
