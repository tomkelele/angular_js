<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ValidationTest extends TestCase
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

    public function testAddNewMemberWith99CharactersOnName()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '0'
        ];
        $this->actingAs($user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseHas('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith100CharactersOnName()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '0'
        ];
        $this->actingAs($user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseHas('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith101CharactersOnName()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '0'
        ];
        $this->actingAs($user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWithoutName()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => '',
            'address' => 'localhost',
            'age' => '23',
            'gender' => '0'
        ];
        $this->actingAs($user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith1DigitOnAge()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => 'Test age with 1 digit',
            'address' => 'localhost',
            'age' => '9',
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

    public function testAddNewMemberWith2DigitsOnAge()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => 'Test age with 2 digits',
            'address' => 'localhost',
            'age' => '19',
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

    public function testAddNewMemberWith3DigitsOnAge()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => 'Test age with 3 digits',
            'address' => 'localhost',
            'age' => '191',
            'gender' => '0',
        ];
        $this->actingAs($user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith299CharactersOnAddress()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => 'Test address with 299 characters',
            'address' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
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

    public function testAddNewMemberWith300CharactersOnAddress()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => 'Test address with 299 characters',
            'address' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
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

    public function testAddNewMemberWith301CharactersOnAddress()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => 'Test address with 299 characters',
            'address' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901',
            'age' => '23',
            'gender' => '0',
        ];
        $this->actingAs($user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWithoutAddress()
    {
        $user = factory(\App\Model\User::class)->create();
        $data = [
            'name' => 'Test address without address',
            'address' => '',
            'age' => '23',
            'gender' => '0',
        ];
        $this->actingAs($user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }
}
