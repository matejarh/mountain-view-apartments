<?php

namespace Tests\Feature;

use App\Models\Notification;
use App\Notifications\InquiryReceivedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_auth_user_may_mark_as_read(): void
    {

        $this->withoutExceptionHandling();

        $notifications = Notification::factory(10)->create([
            'notifiable_id' => $this->admin,
        ]);

        $notification = $notifications[0]->fresh();

        $this->assertNull($notification->read_at);


        $response = $this->actingAs($this->admin)->put(route('admin.notifications.read', ['id' => $notification->id]))
        ->assertStatus(302);

        $this->assertNotNull($notification->fresh()->read_at);

    }

    public function test_auth_user_may_mark_all_as_read(): void
    {

        $this->withoutExceptionHandling();

        $notifications = Notification::factory(10)->create([
            'notifiable_id' => $this->admin,
        ]);

        $this->assertCount(10, $this->admin->fresh()->unreadNotifications);

        $notification = $notifications[0]->fresh();

        $this->assertNull($notification->read_at);


        $response = $this->actingAs($this->admin)->put(route('admin.notifications.read.all'))
        ->assertStatus(302);


        $this->assertEmpty($this->admin->fresh()->unreadNotifications);

    }

    public function test_auth_user_may_delete_all(): void
    {

        $this->withoutExceptionHandling();

        $notifications = Notification::factory(10)->create([
            'notifiable_id' => $this->admin,
        ]);


        $this->assertCount(10,$this->admin->fresh()->notifications);

        $response = $this->actingAs($this->admin)->delete(route('admin.notifications.destroy.all'))
        ->assertStatus(302);

        $this->assertCount(0,$this->admin->fresh()->notifications);

    }

    public function test_auth_user_may_delete_notification_with_given_id(): void
    {
        $this->withoutExceptionHandling();

        $notifications = Notification::factory(10)->create([
            'notifiable_id' => $this->admin,
        ]);

        $notification = $notifications[0]->fresh();

        $this->assertCount(10,$this->admin->fresh()->notifications);
        $this->assertCount(10,$this->admin->fresh()->unreadNotifications);

        $response = $this->actingAs($this->admin)->delete(route('admin.notifications.destroy', ['id' => $notification->id]))
        ->assertStatus(302);

        $this->assertCount(9,$this->admin->fresh()->notifications);
        $this->assertCount(9,$this->admin->fresh()->unreadNotifications);

    }
}
