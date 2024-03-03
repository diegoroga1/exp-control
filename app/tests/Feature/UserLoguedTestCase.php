<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserLoguedTestCase extends TestCase {

    protected $user;
    public function setUser(){
        $this->user = User::where('admin',1)->firstOrFail();
        $this->actingAs($this->user);
    }
}
