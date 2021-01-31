<?php 

class AuthenticationCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function registerUser(ApiTester $I)
    {
        $I->sendPost('/api/v1/auth/register', ['name' => 'Ada', 'email' => 'ada@test.com', 'password' => 'Qwer1234', 'password_confirmation' => 'Qwer1234']);
        $I->seeResponseCodeIs(201);
        // $I->seeResponseCodeIs(HttpCode::Created); // 201
        $I->seeResponseIsJson();
        // $myname = $I->grabDataFromResponseByJsonPath('$.name');
        // $I->assertEquals($myname[0], 'Luke Skywalker');
        $I->seeResponseMatchesJsonType([
            'access_token' => 'string',
            'token_type' => 'string',
            'expires_in' => 'integer',
            'user_id' => 'integer',
        ]);
        $I->seeResponseContainsJson([
                'token_type' => 'bearer',
                'expires_in' => '3600',
                // 'user_id' => 
        ]);
    }

    public function registerUserWithEmptyValues(ApiTester $I)
    { 
        $I->sendPost('/api/v1/auth/register', ['name' => '', 'email' => '', 'password' => '', 'password_confirmation' => '']);
        $I->seeResponseCodeIs(422);
        // $I->seeResponseCodeIs(HttpCode::Created); // 201
        $I->seeResponseIsJson();
        // $myname = $I->grabDataFromResponseByJsonPath('$.name');
        // $I->assertEquals($myname[0], 'Luke Skywalker');
        $I->seeResponseMatchesJsonType([
            'message' => 'string',
            'errors' => [
                'name' => 'array',
                'email' => 'array',
                'password' => 'array',
            ],
        ]);
        $I->seeResponseContainsJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => ['The name field is required.'],
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ],
        ]);
    }

    public function reregisterUser(ApiTester $I)
    { 
        $I->sendPost('/api/v1/auth/register', ['name' => 'Maria', 'email' => 'maria@test.com', 'password' => 'Qwer1234', 'password_confirmation' => 'Qwer1234']);
        $I->seeResponseCodeIs(409);
        // $I->seeResponseCodeIs(HttpCode::Created); // 201
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'message' => 'string',
        ]);
        $I->seeResponseContainsJson([
                'message' => 'Sorry unable to perform operation.'
        ]);
    }

    public function registerUserWithInavlidName(ApiTester $I)
    { 
        $I->sendPost('/api/v1/auth/register', ['name' => 'Ada Lovelace', 'email' => 'adalovelace@test.com', 'password' => 'Qwer1234', 'password_confirmation' => 'Qwer1234']);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'message' => 'string',
            'errors' => [
                'name' => 'array'
            ],
        ]);
        $I->seeResponseContainsJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'name' => ['The name may only contain letters, numbers, dashes and underscores.'],
            ],
        ]);
    }

    public function registerUserWithInavlidaEmail(ApiTester $I)
    { 
        $I->sendPost('/api/v1/auth/register', ['name' => 'Ada', 'email' => 'ada lovelace@test.com', 'password' => 'Qwer1234', 'password_confirmation' => 'Qwer1234']);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'message' => 'string',
            'errors' => [
                'email' => 'array'
            ],
        ]);
        $I->seeResponseContainsJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => ['The email must be a valid email address.'],
            ],
        ]);
    }

    public function registerUserWithInvalidPassordInformation(ApiTester $I)
    { 
        $I->sendPost('/api/v1/auth/register', ['name' => 'Ada', 'email' => 'adalovelace@test.com', 'password' => 'Qw er1234', 'password_confirmation' => 'Qwer1234']);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'message' => 'string',
            'errors' => [
                'password' => 'array'
            ],
        ]);
        $I->seeResponseContainsJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'password' => ['The password confirmation does not match.'],
            ],
        ]);
    }

    public function registerUserWithInvalidPassordConfirmation(ApiTester $I)
    { 
        $I->sendPost('/api/v1/auth/register', ['name' => 'Ada', 'email' => 'adalovelace@test.com', 'password' => 'Qwer1234', 'password_confirmation' => 'Qwer 1234']);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'message' => 'string',
            'errors' => [
                'password' => 'array'
            ],
        ]);
        $I->seeResponseContainsJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'password' => ['The password confirmation does not match.'],
            ],
        ]);
    }
}
