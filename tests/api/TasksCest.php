<?php 

class TasksCest
{
    public $token;
    public $taskId;

    public function _before(ApiTester $I)
    {
        $I->sendPost('/api/v1/auth/login', ['email' => 'ada@test.com', 'password' => 'Qwer1234']);
        $this->token = $I->grabDataFromResponseByJsonPath('$.access_token');
        $I->haveHttpHeader('Authorization', 'Bearer '. $this->token[0] );
    }

    // tests
    public function createNewTask(ApiTester $I)
    { 
        $I->sendPost('/api/v1/tasks', ['title' => 'A newly created task']);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'data' => [
                'id' => 'integer',
                'title' => 'string',
                'is_completed' => 'boolean',
                'author' => [
                'id' => 'integer',
                'name' => 'string',
                'email' => 'string',
              ],
        ]]);

        $I->seeResponseContainsJson([
            'data' => [
                'title' => 'A newly created task',
                'author' => [
                    'name' => 'Ada',
                    'email' => 'ada@test.com',
                ],
        ]]);
        $this->taskId = $I->grabDataFromResponseByJsonPath('$.data.id');
    }

     public function verifyAllTasks(ApiTester $I)
    { 
        $I->sendGet('/api/v1/tasks');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $tasks = $I->grabDataFromResponseByJsonPath('$.data');
        // print_r($tasks);
        $I->assertEquals(count($tasks),1);
    }

    public function updateTask(ApiTester $I)
    {
        $I->sendPut('/api/v1/tasks/' . $this->taskId[0], ['title' => 'This is an updated task']);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'data' => [
                'id' => 'integer',
                'title' => 'string',
                'is_completed' => 'boolean',
                'author' => [
                'id' => 'integer',
                'name' => 'string',
                'email' => 'string',
              ],
        ]]);

        $I->seeResponseContainsJson([
            'data' => [
                'title' => 'This is an updated task',
        ]]);
    }

    public function deleteTask(ApiTester $I)
    { 
        $I->sendDelete('/api/v1/tasks/' . $this->taskId[0]);
        $I->seeResponseCodeIs(204);
    }
}
