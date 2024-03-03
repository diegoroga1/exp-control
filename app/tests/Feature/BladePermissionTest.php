<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BladePermissionTest extends UserLoguedTestCase
{


    /**
     * @test
     */
    public function permissionMenu()
    {
        $this->setUser();
        $req = $this->get('/dashboard');
        $req->assertSuccessful();
    }


}
