![image](https://pbs.twimg.com/media/D-k9Gg1WsAINxkt.jpg:large)

# Laravel Updatable Model

- [Overview](#overview)
- [Installation & Usage](#installation--usage)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)


## Overview

UpdatableModel is a package helps you defining the business logic and the validation needed to update an entire model's fields or just a few of them via a simple controller action and request handler.

Let's take a simple example to illustrate the purpose of this package:

Suppose you have a user model and you have an API endpoint to update a model's fields in the database and **the API consumer can update any field individually or all at once and the problem that each field has its own logic needed before you store the updated value to the database.**


Of course, there are a lot of different ways to handle this case, let's consider this simple  and common one:

> Old Way

As you can see the controller's method with two fields only becomes a huge one.

```php
class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        // now you check for every field you allowed to update and perform the needed logic.
        if($request->has('name')) {
            // needed logic and validation
            ...
            ..
            $user->name = $request->name
        }

        if($request->has('email')) {
            // needed logic and validation
            ...
            ..
            $user->email = $request->email
        }

        // update/save the model
        $user->save();

        // return a response
        return response()->json();
    }
}
```

> New Way (Simpler)

```php
//App/Http/Controllers
class UserController extends Controller
{
    public function update(UserUpdatableModel $updates)
    {
        auth()->user()->fillUpdate($updates);

        return response()->json([]);
    }
}

// App/UpdatableModels
class UserUpdatableModel extends UpdatableModel
{
    /**
     * Registered fields that allowed to be modified on the user model.
     */
    protected $fields = ['name'];

    protected function name($value)
    {
        $this->request->validate(['name' => 'required|string|min:6']);

        return $this->update(['name' => $value]);
    }
}
```

## Installation & Usage

1. Install the package via composer:

> This package supports Laravel 5.5+ only.

```bash
composer require binarytorch/updatable-model
```

2. Add `Updatable` trait to your desired model:

```php
class User extends Authenticatable
{
    use BinaryTorch\UpdatableModel\Traits\Updateable;
}
```

3. Make a new updatable model:

```bash
php artisan make:updatable User
```

This command will create a new directory under `app` dir named `UpdatableModels` and a file inside it called (in this example) `UserUpdatableModel.php`.

4. Make use in your controllers:

```php
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\UpdatableModels\UserUpdatableModel;

class UserController extends Controller
{
    public function update(UserUpdatableModel $updates)
    {
        auth()->user()->fillUpdate($updates);

        // return a response/redirect
    }
}
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email saleem@binarytorch.com.my instead of using the issue tracker.

## Credits

- [Saleem Hadad](https://github.com/saleem-hadad)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
