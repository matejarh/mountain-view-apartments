<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public $admin;
    public $user;

    public function setUp() :void
    {
        parent::setUp();
        $this->admin = User::factory(['is_admin' => true])->create();
        $this->user = User::factory(['is_admin' => false])->create();
    }
}
