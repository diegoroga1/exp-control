<?php

namespace  Modules\Admin\Tests;

use App\Models\User;
use Tests\TestCase;

class ModuleTestCase extends TestCase {

    protected $user;
    public function setUser(){
        $this->user = User::where('admin',1)->firstOrFail();
        $this->actingAs($this->user);
    }
}
