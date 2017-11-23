# wp-oop-nonces
Package that serves the WordPress Nonces functionality (`wp_nonce_*()`) in an object orientated way.

## Requirements

- PHP 5.6+
- Composer
- WordPress 4.8.3+

## Installation

Install with [Composer](https://getcomposer.org):

```sh
$ composer require madaritech/wp-oop-nonces
```

## Usage
The code refers to the wordPress workflow for nonce creation and verification. For more info see [Codex](https://codex.wordpress.org/WordPress_Nonces).

### Nonce Generation
In WordPress the nonce generation is achieved with the `wp_create_nonce()` function specifying a string representing the action.

Similarly, to proceed with nonce generation use the `Nonce_Generator` class with the proper *action*:

```php
$generator = new Nonce_Generator( 'action_parameter' );
```

Then, to generate the nonce use the `generate_nonce()` method:

```php
$nonce = $generator->generate_nonce();
```

### Nonce Url Generation
To add a nonce to a URL, WordPress uses `wp_nonce_url()` specifying the bare *url* and a string representing the *action*. Optionally is possible to specify a string for the *name*, otherwise it defaults to *_wpnonce*.

Similarly, to generate a url with a nonce query parameter use the `Nonce_Url_Generator` class with the proper *action* value and optionally with the proper *name*, otherwise it defaults to `_wp_nonce`.

```php
$url_generator = new Nonce_Url_Generator( 'action_parameter' );
```

So, use the `generate_nonce_url()` method with the proper *url* to generate the url with the nonce. 

```php
$url = $url_generator->generate_nonce_url( 'http://www.madaritech.com' );
```

The same class can also generate a nonce directly:

```php
$nonce = $url_generator->generate_nonce();
```

### Nonce Field Generation
To add a nonce to a form, WordPress uses `wp_nonce_field()` specifying a string representing the *action*. By default `wp_nonce_field()` generates two hidden fields, one whose value is the nonce and one whose value is the current url (the referrer), and it echoes the result.

Similarly, to generate form fields with nonce use the `Nonce_Field_Generator` class with the proper *action* value:

```php
$field_generator = new Nonce_Field_Generator( 'action_parameter' );
```

Optionally, the constructor accepts other parameters that affects the nonce field generation result (`generate_nonce_field()` method):

1. *name*: the name of the nonce field. Defaults to *_wpnonce*.
1. *referer*: boolean value to add an hidden field with refer url value. Set it to *false* to not add the field. Defaults to *true*.
1. *echo*: boolean value to print the field/s. Set it to *false* to not print the fields, but return them as string. Defaults to *true*. 

So, use the `generate_nonce_field()` method to generate the field/s with the nonce. 

```php
$field_generated = $field_generator->generate_nonce_field()
```

The same class can also generate a nonce directly:

```php
$nonce = $field_generator->generate_nonce();
```

### Nonce Validation
To verify a nonce WordPress uses `wp_verify_nonce()` specifying the *nonce* and the string representing the *action*. 

Similarly, validating funtionality is provided through the `Nonce_Validator` class; the constructor accept an *action* parameter (the same used to generate the nonce we want to validate) to verify the nonce:

```php
$validator = new Nonce_Validator( 'action_parameter' );
```

#### Nonce Straight Validation
To validate a nonce use the `validate_nonce()` method with the *nonce* to verify as parameter:

```php
$is_valid = $validator->validate_nonce($nonce);
```

If the validation is successful the method returns *true*; *false* otherwise.

#### Nonce Request Validation
To validate a nonce received in a page through request (GET or POST) use the `validate_request()` method:

```php
$is_valid = $validator->validate_request();
```

If the validation is successful the method returns *true*; *false* otherwise.

## Run the tests
To run tests, executes commands below:

```sh
$ cd vendor/madaritech/wp-oop-nonces
$ composer install
$ vendor/bin/phpunit
```