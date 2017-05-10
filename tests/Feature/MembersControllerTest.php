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
 
    public function testAddNewMember()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => 'Testing',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '0',
        ];
        $this->actingAs($user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseHas('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testDeleteMember()
    {
        $user = factory(\App\Model\User::class)->create();
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test delete',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '1'
        ]);
        $memberId = $member->id;
        $this->actingAs($user)->call('POST', 'dashboard/member/destroy', ['id' => $memberId]);
        $this->assertDatabaseMissing('members', [
            'name' => $member->name,
            'address' => $member->address,
            'age' => $member->age,
            'gender' => $member->gender,
        ]);
    }

    public function testEditMember()
    {
        $user = factory(\App\Model\User::class)->create();
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test Edit',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '0'
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => 'New Edit',
            'address' => 'local near host',
            'age' => '24',
            'gender' => '1'
        ];
        $this->actingAs($user)->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseHas('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testGetDetailMember()
    {
        $user = factory(\App\Model\User::class)->create();
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test Detail',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '0'
        ]);
        $memberId = $member->id;
        $response = $this->actingAs($user)->call('POST', 'dashboard/member/detail', [
            'id' => $memberId,
        ]);
        $response->assertStatus(200);
    }
}
