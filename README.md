# Laravel Updatable Model

- [Overview](#overview)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)


## Overview

UpdatableModel is a package helps you defining the business logic and the validation needed to update an entire model's fields or just few of them via a simple controller action and request handler.

Let's take a simple example to illustrate the purpose of this package:

Suppose you have a user model and you have setup an API endpoint to update the model's fields in the database and **the API consumer can update any field individually or all at once and the problem that each field has its own logic needed before you store the updated value to the database as illustrated in the picture.**


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

//App/Http/Controllers
class UserController extends Controller
{
    public function update(UserUpdatableModel $updates)
    {
        auth()->user()->fillUpdate($updates);

        return response()->json([]);
    }
}
```

## Installation

You can install the package via composer:

```bash
composer require binarytorch/updatable-model
```

## Usage

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email saleem@binarytorch.com.my instead of using the issue tracker.

## Credits

- [Saleem Hadad](https://github.com/binarytorch)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
