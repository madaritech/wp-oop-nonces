# wp-oop-nonces
WordPress Plugin that serves the WordPress Nonces functionality (wp_nonce_*()) in an object orientated way.

## Installation

Install with [Composer](https://getcomposer.org):

```sh
$ composer require madaritech/wp-oop-nonces
```

## Usage

### Nonce Straight Generation
To proceed with straight nonce generation use the class `Nonce_Generator`:

```php
$generator = new Nonce_Generator( 'action_parameter' );
```

To generate a nonce:

```php
$nonce = $generator->generate_nonce();
```

### Nonce Url Generation
To generate a url with a nonce query parameter use the `Nonce_Url_Generator` class:

```php
$url_generator = new Nonce_Url_Generator( 'action_parameter' );
$url = $url_generator->generate_nonce_url( 'http://www.madaritech.com' );
```

The same class can also generate a nonce directly:

```php
$nonce = $url_generator->generate_nonce();
```

### Nonce Field Generation
To generate form fields with nonce use the `Nonce_Field_Generator` class:

```php
$field_generator = new Nonce_Field_Generator( 'action_parameter' );
$field_generated = $field_generator->generate_nonce_field()
```

The same class can also generate a nonce directly:

```php
$nonce = $field_generator->generate_nonce();
```

### Nonce Validation
Validating funtionality is provided through the `Nonce_Validator` class:

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