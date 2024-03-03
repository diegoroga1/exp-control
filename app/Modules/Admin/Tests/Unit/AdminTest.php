<?php

namespace Modules\Admin\Tests\Unit;

use Modules\Admin\Tests\ModuleTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends ModuleTestCase
{
    /**
     * @test
     */
    public function adminSection()
    {
        $this->setUser();
        $this->get('/admin/users')->assertSuccessful();
    }
}
