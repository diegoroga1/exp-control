<?php

namespace Modules\Admin\Tests\Unit;

use Modules\Admin\Services\UserService;
use Modules\Admin\Tests\ModuleTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends ModuleTestCase
{
    /**
     * @test
     */
    public function usersList()
    {
        $users = UserService::getUsers();
        $this->assertGreaterThan(0,$users->count());
    }
}
