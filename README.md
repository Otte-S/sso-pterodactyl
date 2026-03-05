# Laravel SSO

Laravel SSO is a package for implementing Single Sign-On (SSO) authorizations in your Laravel project. This package allows you to authorize users on a Laravel panel from another website.

> **Note:** This package is an adaptation of the abandoned [WemX SSO](https://github.com/WemXPro/sso-pterodactyl) package, updated for Laravel 10, 11, and 12 and maintained by BuiltByOtte.

## Requirements

- PHP 8.1 or higher
- Laravel 10 or higher

## Installation

To install the package, use Composer:

```bash
composer require builtbyotte/sso
```

## Configuration
1. Publish the configuration file by running the following command:
```bash
php artisan vendor:publish --tag=sso
```
This command will publish the config/sso.php file, where you can set the secret key for SSO authorization.

2. Generate new SSO key
```shell
php artisan sso:generate
```

Make sure to paste the SSO key in your environment configuration

## Usage

1. Generate a access token for using a GET request from your application
2. Redirect the user to the SSO redirect with their token

```php
public function loginPanel()
{
    $response = Http::get("https://panel.example.com/sso/", [
        'sso_secret' => "xxxxxxx",
        'user_id' => 1
    ]);

    if (!$response->successful()) {
        $message = $response['success'] && !$response['success']
            ? $response['message']
            : 'Something went wrong, please contact an administrator.';

        return redirect()->back()->withError($message);
    }

    return redirect()->intended($response['redirect']);
}
```
After being redirected to the /sso-login route, the user will be automatically authorized on the Laravel panel if their email address matches a record in the database.

## Support

If you have any questions or issues, please create a new issue in the project repository on GitHub.

## LicenseLICENSE) file for details.

This is an adaptation of the original WemX SSO package which was abandoned. Original author: GIGABAIT93

This project is licensed under the MIT License. See the [LICENSE](https://github.com/GIGABAIT93/LaravelSso/blob/main/LICENSE) file for details.
