# wp-oop-nonces
WordPress Plugin that serves the WordPress Nonces functionality (wp_nonce_*()) in an object orientated way.

## Installation

Install with [Composer](https://getcomposer.org):

```sh
$ composer require madaritech/wp-oop-nonces
```

## Usage

### Nonce Generation
In WordPress the nonce generation is achieved with the `wp_create_nonce()` specifying a string representing the action. 
Similarly, to proceed with nonce generation use the `Nonce_Generator` class with the proper `action_parameter` value:

```php
$generator = new Nonce_Generator( 'action_parameter' );
```

Then, to generate the nonce use `generate_nonce` method:

```php
$nonce = $generator->generate_nonce();
```

### Nonce Url Generation
To add a nonce to a URL, WordPress uses `wp_nonce_url()` specifying the bare URL and a string representing the action. Optionally is possible to specify a string for the paramenter name, otherwise it defaults to `_wpnonce`.

Similarly, to generate a url with a nonce query parameter use the `Nonce_Url_Generator` class with the proper `action_parameter` value and optionally with the name parameter.

```php
$url_generator = new Nonce_Url_Generator( 'action_parameter' );
```

So, use the `generate_nonce_url` method to generate the url with the nonce. 

```php
$url = $url_generator->generate_nonce_url( 'http://www.madaritech.com' );
```

The same class can also generate a nonce directly:

```php
$nonce = $url_generator->generate_nonce();
```

### Nonce Field Generation
To add a nonce to a form, WordPress uses `wp_nonce_field()` specifying a string representing the action. By default `wp_nonce_field()` generates two hidden fields, one whose value is the nonce and one whose value is the current URL (the referrer), and it echoes the result.

Similarly, to generate form fields with nonce use the `Nonce_Field_Generator` class:

```php
$field_generator = new Nonce_Field_Generator( 'action_parameter' );
```

So, use the `generate_nonce_field` method to generate the field/s with the nonce. 

```php
$field_generated = $field_generator->generate_nonce_field()
```

The same class can also generate a nonce directly:

```php
$nonce = $field_generator->generate_nonce();
```

### Nonce Validation
To verify a nonce WordPress uses `wp_verify_nonce()` specifying the nonce and the string representing the action. 
Similarly, validating funtionality is provided through the `Nonce_Validator` class:

```php
$validator = new Nonce_Validator( 'action_parameter' );
```

#### Nonce Straight Validation
To validate a nonce use the `validate_nonce` method:

```php
$validator->validate_nonce($nonce);
```

#### Nonce Request Validation
To validate a nonce received through request (GET or POST) use the `validate_request` method:

```php
$validator->validate_request();
```

## Run the tests
To run tests, executes commands below:

```sh
$ cd vendor/madaritech/wp-oop-nonces
$ composer install
$ vendor/bin/phpunit
```