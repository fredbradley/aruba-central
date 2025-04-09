# PHP SDK for Aruba Central API
## For Laravel Applications

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fredbradley/aruba-central.svg?style=flat-square)](https://packagist.org/packages/fredbradley/aruba-central)
[![Total Downloads](https://img.shields.io/packagist/dt/fredbradley/aruba-central.svg?style=flat-square)](https://packagist.org/packages/fredbradley/aruba-central)
![GitHub Actions](https://github.com/fredbradley/aruba-central/actions/workflows/main.yml/badge.svg)

## Installation & Requirements

This package requires PHP 8.3 and above.

You can install the package via composer:

```bash
composer require fredbradley/aruba-central
```

## Usage
You will need to add the following to your `.env` file:
```dotenv
ARUBA_CLIENT_ID=""
ARUBA_CLIENT_SECRET=""
ARUBA_BASE_URL="" #EG: https://apigw-eucentral2.central.arubanetworks.com/
ARUBA_ACCESS_TOKEN=""
ARUBA_CREDENTIAL_ID=""
ARUBA_REFRESH_TOKEN=""

```
The config file is publishable, but you shouldn't need to change anything.
#### Dependency Injection
The package will automatically register the `ArubaCentralConnector` class as a singleton. You can then use the `ArubaCentralConnector` class as a dependency in your classes.

### Usage
```php
use FredBradley\ArubaCentral\ArubaCentral;

ArubaCentral::accessPoints()->all(); // Gets all access points
ArubaCentral::accessPoints()->findByMacAddress($mac); // Gets a specific access point by MAC address

ArubaCentral::wirelessClients()->all(); // Gets all wireless clients
ArubaCentral::wirelessClients()->findUser($username); // Gets all wireless client by username
```

This package uses the Saloon API package to make the HTTP requests. You can read more about that package [here](https://docs.saloon.dev/).


### Testing
_Not written yet_
```bash
composer pest
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please either [report here](https://github.com/fredbradley/aruba-central/security) or if you don't have a Github account, email code@fredbradley.co.uk instead of using the issue tracker.

## Credits

- [Fred Bradley](https://github.com/fredbradley)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
