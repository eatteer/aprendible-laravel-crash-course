# Laravel

## Routing

### Methods

```php
Route::get($uri, $handler);
Route::view($uri, $view, $data);
```

The `$data` parameter corresponds to the data meant to be passed to the view

The `$handler` parameter can be a closure, a controller class with only the `__invoke` method or an array of a controller class reference and a method name

```php
// With closure
Route::get('/posts', function(){
    return 'Hello world';
});

// With controller class reference (__invoke method)
Route::get('/posts', PostsController::class);

// Array of controller class reference and method name
Route::get('/posts', [PostsController::class, 'index']);
```

# Controllers

Most used commands

```bash
php artisan make:controller {controller_name}
php artisan make:controller {controller_name} -r
php artisan make:controller {controller_name} --api
```

**php artisan make:controller**

Generates an empty controller

**php artisan make:controller -r**

Generates a controller with the four CRUD methods and three methods for returning create, show and edit views

**php artisan make:controller —api**

Generates a controller with the four CRUD methods

## Retrieving request object

Thanks to Laravel dependency injection, a request object can be injected into the controller by declaring it as a parameter

```php
use Illuminate\Http\Request
public function store(Request $request){}
```

## Validations

Validation logic allows validating user input to decide whether to execute a method controller or not. The rules array keys are symmetrical to the form input fields. If some validation fails, the method controller execution is interrupted and a redirection response to the view where the request come from is sent to the client with a `ViewErrorBag $errors` global variable or the `@error($errorName)` directive for managing errors

### On Controller

Validation logic is available through `Request $request->validate(array $rules)`

```php
public function store(Request $request){
    $request-validate([
        'title' => 'required|min:3',
        'body' => 'required|min:10'
    ]);
}
```

### On FormRequest

Validation logic is available through `$request->rules()`

The `rules` method requires returning an array of rules. This array can depend on request method

```php
class SavePostRequest extends FormRequest {
    public function rules({
        // When PATH, or POST and etc.
        if ($this->isMethod('PATCH')) {
        return [
            'title' => 'required|min:3',
           'body' => 'required|min:5'
      ];
    }
        return [
        'title' => 'required|min:3',
            'body' => 'required|min:10'
    ];
  }
}
```

If some validation fails, the controller `store` method is not executed

```php
public function store(SavePostRequest $request){
    // Controller logic below
}
```

### Show errors on View

```html
<input name="title">
<!-- small tag is rendered only when there is a title error -->
@error('title')
    <!-- $message value is relative to the error in 'title' -->
    <small>$message</small> 
@enderror
```

## Retrieving input data

All input data that come from a form can be retrieved through the `all` method or individually through the `input($inputName)` method of the `Request` object

```php
public function store(Request $request){
    // Validation logic here
    // Array with all form values
    $input = $request->all();
    // Individual values
    $title = $request->input('title');
    $body = $request->input('body');
}
```

## Session flash messages

A session flash message consists of a message that can be used in a view with a lifetime of one render

### Session

Using `session()->flash($msgKey, $msgValue)`

```php
public function store(Request $request){
    // Validation logic
    // Retrieving input data logic
    // Database insertion logic
    session()->flash('storePostMessageStatus', 'Post created');
}
```

### With

Using `redirect()->route($routeName)->with($msgKey, $msgValue)`

```php
public function store(Request $request){
    // Validation logic
    // Retrieving input data logic
    // Database insertion logic
    return redirect()
            ->route('posts.index')
            ->with('storePostMessageState, 'Post created');
}
```

The message can be accessed in a view by using the global `session($msgKey, $msgValue)`

```html
@if(session('storePostMessageStatus'))
    <div>
        {{session('storePostMessageStatus')}}
    </div>
@endif
```

## Redirections

```php
redirect('/posts'); // Redirect to uri route
redirect()->route('/posts.index'); // Redirect to named route
```

# Components

Components allow reusing HTML structures

Components require to be created inside `resources/views/components/*` path

```php
// resources/views/components/layouts/app.blade.php
<!doctype html>
<html lang="en">
    <head>
        <title>{{$title}}</title>
    </head>
    <body>
        // Component in resources/views/components/layouts/navigation.blade.php
        <x-layouts.navigation/>
        {{$slot}}
    </body>
</html>
```

The `$slot` property acts as the component HTML child and the rest of properties act like tag attributes, for example the `$title` property

```jsx
// resources/views/components/layouts/app.blade.php
<x-layouts.app title="Home"> //$title
    <h1>Home</h1> //$slot
</x-layouts.app>
```

A React analogy would be

```jsx
const App = ({title, children}) => {
    return (
    <html lang="en">
        <head>
            <title>{title}</title> //$title
        </head>
        <body>
            <Navigation/>
            {children} //$slot
        </body>
    </html>
    )
}
```

# Database

Create the model and the migration with one command

```bash
php artisan make:model {model_name} -m
```

## Migrations

Most used commands

```bash
php artisan migrate
php artisan migrate:fresh
php artisan migrate:rollback
php artisan make:migration {migration_name}
```

**php artisan migrate**

Run the migrations that are not saved in the `migrations` table

**php artisan migrate:fresh**

Rollback all the migrations no matter if they are in the `migrations` table and run the command `migrate`

**php artisan migrate:rollback**

Rollback the last migration saved in the `migration` table

**php artisan make:migration**

Create a new migration. To follow the standard, name the migrations as follows

- Create table: `create_{table_name]_table`
- Alter table:  `add_{column_name}_to_{table_name}`

## Eloquent Models

Most used commands

```bash
php artisan make:model {model_name}
```

### Individual assignment

Retrieve input fields data individually and assign them to a model instance

```php
public function store(Request $request){
    // ...Validation logic...

    // Retrieve input fields data as array
    $input = $request->all();

    // $input = $request->validated();

    $post = new Post;
    $post->title = $input['title'];
    $post->save();

    // ...Redirection logic...
}
```

### Massive assignment

By default, massive assignment is disabled, but can be enable peer model or for all models. 

To enable massive assignment peer model, just the `$fillable` array needs to be set with allowed fields.

```php
class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'body'];
}
```

Or to deny fields, set the `$guarded` array with the denied fields. If `$guarded` is empty, the protection against massive assignment is disabled.

```php
class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
```

To enable massive assignment for all models, `Model::unguard()` need to be called in `AppServiceProvider`.

```php
use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Model::unguard();
    }
}
```

Massive assignment example.

```php
public function store(Request $request){
    // ...Validation logic...

    // Do not do this. The all method returns all input fields
    // sent by the client, so malicious data is not filtered
    // $input = $request->all();

    // Retrieve input fields data as array    
    $input = $request->validated();

    Post::create($input);

    // ...Redirection logic...
}
```
