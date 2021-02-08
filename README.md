# Dependencies
[Codeception](https://hub.docker.com/r/codeception/codeception)


# Tests Usage

Run tests
```
codecept run api
```

To print all tests execute list-tests script pointing to directory with tests:
```
php vendor/bin/list-tests tests/
```


# Tests

#### 📎 [api/AuthenticationCest.php](git@github.com:xsery/codeception.git/api/AuthenticationCest.php)
  - ✔️  [Register user](git@github.com:xsery/codeception.git/api/AuthenticationCest.php#L10) 
  - ✔️  [Register user with empty values](git@github.com:xsery/codeception.git/api/AuthenticationCest.php#L31) 
  - ✔️  [Reregister user](git@github.com:xsery/codeception.git/api/AuthenticationCest.php#L57) 
  - ✔️  [Register user with inavlid name](git@github.com:xsery/codeception.git/api/AuthenticationCest.php#L71) 
  - ✔️  [Register user with inavlid email](git@github.com:xsery/codeception.git/api/AuthenticationCest.php#L90) 
  - ✔️  [Register user with invalid passord information](git@github.com:xsery/codeception.git/api/AuthenticationCest.php#L109) 
  - ✔️  [Register user with invalid passord confirmation](git@github.com:xsery/codeception.git/api/AuthenticationCest.php#L128) 

#### 📎 [api/TasksCest.php](git@github.com:xsery/codeception.git/api/TasksCest.php)
  - ✔️  [Create new task](git@github.com:xsery/codeception.git/api/TasksCest.php#L16) 
  - ✔️  [Verify all tasks](git@github.com:xsery/codeception.git/api/TasksCest.php#L44) 
  - ✔️  [Update task](git@github.com:xsery/codeception.git/api/TasksCest.php#L54) 
  - ✔️  [Delete task](git@github.com:xsery/codeception.git/api/TasksCest.php#L77) 

# Test Run
[Test Run](https://app.testomat.io/projects/luna-ae954/runs/2bfa682d/report)

# Reports
[Report](https://app.testomat.io/projects/luna-ae954/runs/2bfa682d/report)

# Docker Image
[fception](https://hub.docker.com/r/xsery/fception)

# Enable Test Run Report
Open a project with tests.
Install the npm package "composer require testomatio/reporter --dev"
```
composer require testomatio/reporter --dev
```

OR
```
codecept testomatio/reporter --dev
```

Run the following command from your project folder: 

```
TESTOMATIO=<API Key> php vendor/bin/codecept run --ext "Testomatio\Reporter\Codeception"
```

OR
```
TESTOMATIO=<API Key> codecept run --ext "Testomatio\Reporter\Codeception"
``` 
