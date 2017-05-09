<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Model\User;

class MembersControllerTest extends TestCase
{
	use DatabaseMigrations;
	use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testLoginDashboard()
    {
    	$user = factory(\App\Model\User::class)->create();
    	$this->actingAs($user)->get('/dashboard')->assertStatus(200);
    }

    public function testGetListMember()
    {
    	$user = factory(\App\Model\User::class)->create();
    	$response = $this->actingAs($user)->get('dashboard/member/list');
    	$response->assertStatus(200);
    }

    public function testAddNewMember() {
    	$user = factory(\App\Model\User::class)->create();
    	$data = [
    		'name' => 'Testing',
    		'address' => 'localhost',
    		'age' => '23',
    		'gender' => '0',
    		// 'photo' => 'abcdef.png'
    	];
    	$response = $this->actingAs($user)->call('POST', 'dashboard/member/insert', $data);
    	dd($response->status());
    }
}
