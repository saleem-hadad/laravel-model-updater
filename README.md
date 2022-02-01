# Laravel Model Updater

- [Overview](#overview)
- [Installation & Usage](#installation--usage)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)


## Overview

ModelUpdater is a package helps you define the business logic and the validation needed to update an entire model's fields or just a few of them via a simple controller action and request handler.

Let's take a simple example to illustrate the purpose of this package:

Suppose you have a user model and you have an API endpoint to update a user's fields in the database where as **the API consumer can update any field individually or all at once and the problem is that each field has its own logic needed before you store the updated value to the database.**


Of course, there are a lot of different ways to handle this case, let's consider this simple  and common one:

> Old Way

As you can see the controller's method with two fields only becomes a big one, just imagine if you have 20+ fields!

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
use App\Updaters\UserUpdater;

class UserController extends Controller
{
    public function store(UserUpdater $updates)
    {
        auth()->user()->fillUpdates($updates);
    }
}

// App/Updaters
class UserUpdater extends Updater
{
    /**
     * Allowed fields to be updated.
     */
    protected $fields = ['name', 'email'];

    protected function name($value)
    {
        $this->request->validate(['name' => 'required|string|min:6']);

        $this->model->name = $value;
    }
    
    protected function email($value)
    {
        $this->request->validate(['email' => 'required|string|min:6']);

        $this->model->email = $value;
    }
}
```

## Installation & Usage

1. Install the package via composer:

> This package supports Laravel 5.5+ only

```bash
composer require laimoon/model-updater
```

2. Add `Updatable` trait to your desired model:

```php
use Laimoon\UpdatableModel\Traits\Updateable;

class User extends Authenticatable
{
    use Updateable;
}
```

3. Make a new model updater:

```bash
php artisan make:updater User
```

This command will generate a new directory under `app` with namespace of `Updaters` and a file inside it called (in this example) `UserUpdater.php`.

4. Make use in your controllers:

```php
use App\Updaters\UserUpdater;

class UserController extends Controller
{
    public function store(UserUpdater $updates)
    {
        auth()->user()->fillUpdates($updates);
        
        return response()->json();
    }
}
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Saleem Hadad](https://github.com/saleem-hadad)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
