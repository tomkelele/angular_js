<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ValidationWhenEditMember extends TestCase
{
	use DatabaseMigrations;
	use WithoutMiddleware;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEditMemberWith99CharactersOnName()
    {
    	$member = factory(\App\Model\Member::class)->create([
    		'name' => 'Test edit with 99 characters on name',
    		'address' => 'localhost',
    		'age' => '23',
    		'gender' => 0,
    	]);
    	$memberId = $member->id;
    	$dataEdit = [
    		'id' => $memberId,
    		'name' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
    		'address' => 'localhost',
    		'age' => '23',
    		'gender' => 0,
            'photo' => null,
    	];
    	$this->call('POST', 'dashboard/member/update', $dataEdit);
    	$this->assertDatabaseHas('members', [
    		'name' => $dataEdit['name'],
    		'address' => $dataEdit['address'],
    		'age' => $dataEdit['age'],
    		'gender' => $dataEdit['gender'],
    	]);
    }

    public function testEditMemberWith100CharactersOnName()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit with 100 characters on name',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseHas('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWith101CharactersOnName()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit with 101 characters on name',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWithoutName()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit without name',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => '',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWith1DigitOnAge()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit with 1 digit on age',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => 'Test edit with 1 digit on age',
            'address' => 'localhost',
            'age' => '1',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseHas('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWith2DigitsOnAge()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit with 2 digits on age',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => 'Test edit with 2 digits on age',
            'address' => 'localhost',
            'age' => '12',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseHas('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWith3DigitsOnAge()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit with 3 digits on age',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => 'Test edit with 3 digits on age',
            'address' => 'localhost',
            'age' => '123',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWithoutAge()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit without age',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => 'Test edit without age',
            'address' => 'localhost',
            'age' => '',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWith299CharactersOnAddress()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit with 299 characters on address',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => 'Test edit with 299 characters on address',
            'address' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
            'age' => '23',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseHas('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWith300CharactersOnAddress()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit with 300 characters on address',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => 'Test edit with 300 characters on address',
            'address' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
            'age' => '23',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseHas('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWith301CharactersOnAddress()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit with 301 characters on address',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => 'Test edit with 301 characters on address',
            'address' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901',
            'age' => '23',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }

    public function testEditMemberWithoutAddress()
    {
        $member = factory(\App\Model\Member::class)->create([
            'name' => 'Test edit without address',
            'address' => 'localhost',
            'age' => '23',
            'gender' => 0,
        ]);
        $memberId = $member->id;
        $dataEdit = [
            'id' => $memberId,
            'name' => 'Test edit without address',
            'address' => '',
            'age' => '23',
            'gender' => 0,
            'photo' => null,
        ];
        $this->call('POST', 'dashboard/member/update', $dataEdit);
        $this->assertDatabaseMissing('members', [
            'name' => $dataEdit['name'],
            'address' => $dataEdit['address'],
            'age' => $dataEdit['age'],
            'gender' => $dataEdit['gender'],
        ]);
    }
}
