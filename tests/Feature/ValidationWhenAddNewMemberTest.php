<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ValidationWhenAddNewMemberTest extends TestCase
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

    public function testAddNewMemberWith99CharactersOnName()
    {
        $data = [
            'name' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
            'address' => 'localhost',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseHas('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith100CharactersOnName()
    {
        $data = [
            'name' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
            'address' => 'localhost',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseHas('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith101CharactersOnName()
    {
        $data = [
            'name' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901',
            'address' => 'localhost',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWithoutName()
    {
        $data = [
            'name' => '',
            'address' => 'localhost',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith1DigitOnAge()
    {
        $data = [
            'name' => 'Test age with 1 digit',
            'address' => 'localhost',
            'age' => 9,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseHas('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith2DigitsOnAge()
    {
        $data = [
            'name' => 'Test age with 2 digits',
            'address' => 'localhost',
            'age' => 19,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseHas('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith3DigitsOnAge()
    {
        $data = [
            'name' => 'Test age with 3 digits',
            'address' => 'localhost',
            'age' => 191,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWithoutAge()
    {
        $data = [
            'name' => 'Test without age',
            'address' => 'localhost',
            'age' => '',
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith299CharactersOnAddress()
    {
        $data = [
            'name' => 'Test address with 299 characters',
            'address' => '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseHas('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith300CharactersOnAddress()
    {
        $data = [
            'name' => 'Test address with 299 characters',
            'address' => '123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseHas('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWith301CharactersOnAddress()
    {
        $data = [
            'name' => 'Test address with 299 characters',
            'address' => '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }

    public function testAddNewMemberWithoutAddress()
    {
        $data = [
            'name' => 'Test address without address',
            'address' => '',
            'age' => 23,
            'gender' => 0,
            'photo' => null,
        ];
        $this->actingAs($this->user)->call('POST', 'dashboard/member/insert', $data);
        $this->assertDatabaseMissing('members', [
            'name' => $data['name'],
            'address' => $data['address'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);
    }
}
