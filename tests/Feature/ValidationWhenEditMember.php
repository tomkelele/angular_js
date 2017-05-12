<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ValidationWhenEditMember extends TestCase
{
    use DatabaseMigrations;
    // use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    private $user;
    private $member;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(\App\Model\User::class)->create();
        $this->member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit member',
            'address' => 'localhost',
            'age' => 23,
            'gender' => 0,
        ]);
    }

    public function testLogin()
    {
        $this->actingAs($this->user)->get('/dashboard')->assertStatus(200);
    }

    public function testEditMemberWith99CharactersOnName()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
            'address' => 'localhost',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $reponse = $this->actingAs($this->user)->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseHas('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
        $reponse->assertStatus(200);
    }

    public function testEditMemberWith100CharactersOnName()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
            'address' => 'localhost',
            'age' => 23,
            'gender' => 0,
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

    public function testEditMemberWith101CharactersOnName()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901',
            'address' => 'localhost',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWithoutName()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => '',
            'address' => 'localhost',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWith1DigitOnAge()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => 'Test edit member',
            'address' => 'localhost',
            'age' => 1,
            'gender' => 0,
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

    public function testEditMemberWith2DigitsOnAge()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => 'Test edit member',
            'address' => 'localhost',
            'age' => 12,
            'gender' => 0,
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

    public function testEditMemberWith3DigitsOnAge()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => 'Test edit member',
            'address' => 'localhost',
            'age' => 123,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWithoutAge()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => 'Test edit member',
            'address' => 'localhost',
            'age' => '',
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWith299CharactersOnAddress()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => 'Test edit member',
            'address' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
            'age' => 23,
            'gender' => 0,
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

    public function testEditMemberWith300CharactersOnAddress()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => 'Test edit member',
            'address' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
            'age' => 23,
            'gender' => 0,
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

    public function testEditMemberWith301CharactersOnAddress()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => 'Test edit member',
            'address' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWithoutAddress()
    {
        $dataEdit = [
            'id' => $this->member->id,
            'name' => 'Test edit member',
            'address' => '',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }
}
