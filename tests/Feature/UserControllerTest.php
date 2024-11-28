<?php

namespace Tests\Feature;

use App\Constants\Response as ConstantsResponse;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function testAbleCreateUser()
    {
        $request = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'phone' => '011-1122113',
            'password' => "123456"
        ];

        $response = $this->post(route('user.add'), $request);

        // get success response
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'errCode' => ConstantsResponse::ERR_CODE_SUCCESS,
                'errMsg' => ""
            ]);

        // Check db, make sure only one data since only create one
        $user = User::first();
        $actualData = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => decrypt($user->password),
        ];
        $this->assertEquals($request, $actualData);
    }

    public function testAbleGetAllUser()
    {
        User::factory()->count(2)->create();
        $response = $this->postJson(route('user.all'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'errCode',
                'errMsg',
                'Data' => [
                    '*' => ['id', 'name', 'email', 'phone', 'password']
                ]
            ]);

        $users = User::all();
        $this->assertCount(2, $users);
    }

    public function testAbleUpdateUser()
    {
        $request = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'phone' => '011-1122113',
            'password' => "123456"
        ];

        $response = $this->post(route('user.add'), $request);

        // get success response
        $response->assertStatus(Response::HTTP_OK);

        $user = User::first();

        $updatedRequest = $request;
        $updatedRequest['id'] = $user->id;
        $updatedRequest['phone'] = '011-1111111111';
        unset($updatedRequest['password']);

        $response = $this->post(route('user.edit'), $updatedRequest);
        // get success response
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'errCode' => ConstantsResponse::ERR_CODE_SUCCESS,
                'errMsg' => ""
            ]);

        // Check db, make sure only one data since only create one
        $user = User::first();
        $actualData = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
        ];
        $this->assertEquals($updatedRequest, $actualData);
    }

    public function testAbleDeleteUser()
    {
        User::factory()->count(1)->create();

        // Check db, make sure only one data since only create one
        $user = User::first();

        $request = [
            'id' => $user->id
        ];

        $response = $this->post(route('user.delete'), $request);

        // get success response
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'errCode' => ConstantsResponse::ERR_CODE_SUCCESS,
                'errMsg' => ""
            ]);

        $users = User::all();
        $this->assertCount(0, $users);
    }
}
