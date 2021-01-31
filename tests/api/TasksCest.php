<?php 

class TasksCest
{
    public $token;

    public function _before(ApiTester $I)
    {
        $I->sendPost('/api/v1/auth/login', ['email' => 'ada@test.com', 'password' => 'Qwer1234']);
        $this->token = $I->grabDataFromResponseByJsonPath('$.access_token');
        // $I->sendPost('/api/v1/auth/login', ['email' => 'ada@test.com', 'password' => 'Qwer1234']);
        // $token = $I->grabDataFromResponseByJsonPath('$.access_token');
        // print_r($token);
        $I->haveHttpHeader('Authorization', 'Bearer '. $this->token[0] );
    }

    // tests
    public function createNewTask(ApiTester $I)
    { 
        $I->sendPost('/api/v1/tasks', ['title' => 'A newly created task']);
        $I->seeResponseCodeIs(201);
        // $I->seeResponseCodeIs(HttpCode::Created); // 201
        $I->seeResponseIsJson();

        // $I->assertEquals($myname[0], 'Luke Skywalker');
        // $I->seeResponseMatchesJsonType([
        //     'access_token' => 'string',
        //     'token_type' => 'string',
        //     'expires_in' => 'integer',
        //     'user_id' => 'integer',
        // ]);
        // $I->seeResponseContainsJson([
        //         'token_type' => 'bearer',
        //         'expires_in' => '3600',
        //         // 'user_id' => 
        // ]);
    }

    public function createNewTaskWithExpiredSession(ApiTester $I)
    { 
    }

    public function updateTask(ApiTester $I)
    { 
    }

    public function updateNonExistentTask(ApiTester $I)
    { 
    }

    public function updateTaskInvalidInformation(ApiTester $I)
    { 
    }

    public function deleteTask(ApiTester $I)
    { 
    }

    public function deleteNonExistentTask(ApiTester $I)
    { 
    }
}
