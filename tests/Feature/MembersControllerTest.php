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
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(\App\Model\User::class)->create();
    }

    public function testLoginDashboard()
    {
        $this->actingAs($this->user)->get('/dashboard')->assertStatus(200);
    }

    public function testGetListMember()
    {
        $response = $this->actingAs($this->user)->get('dashboard/member/list');
        $response->assertStatus(200);
    }
 
    public function testAddNewMember()
    {
        $data = [
            'name' => 'Testing',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '0',
            'photo' => null,
        ];
        $response = $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseHas('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
        $response->assertStatus(200);
    }

    public function testDeleteMember()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test delete',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '1'
        ]);
        $memberId = $member->id;
        $response = $this->actingAs($this->user)->call('POST', 'dashboard/member/destroy', ['id' => $memberId]);
        $this->assertDatabaseMissing('members', [
            'name' => $member->name,
            'address' => $member->address,
            'age' => $member->age,
            'gender' => $member->gender,
        ]);
        $response->assertStatus(200);
    }

    public function testEditMember()
    {
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
            'gender' => '1',
            'photo' => null,
        ];
        $response = $this->actingAs($this->user)->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseHas('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
        $response->assertStatus(200);
    }

    public function testGetDetailMember()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test Detail',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '0'
        ]);
        $memberId = $member->id;
        $response = $this->actingAs($this->user)->call('POST', 'dashboard/member/detail', [
            'id' => $memberId,
        ]);
        $response->assertStatus(200);
    }
}
