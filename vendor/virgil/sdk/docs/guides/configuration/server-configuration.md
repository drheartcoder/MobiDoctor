# Server Configuration
[Developer Account](#head1) | [Install SDK](#head2) | [Initialize SDK](#head3) | [Create Access Token](#head4) | [Approve & Publish Cards](#head5)

This guide helps you to set up your server and implement required mechanisms using Virgil Infrastructure.

## <a name="head1"></a> Developer Account

To use the Virgil SDK package you need to sign up for a **Developer account** and create your first application. Make sure to save the **App ID**, the **App Key** and the **App Key Password**. If you did not create a Developer account yet, you can do so now by using this [link](https://developer.virgilsecurity.com/account/signup).

## <a name="head2"></a> Install SDK

The Virgil SDK is provided as a package named virgil/sdk. The package is distributed via composer package management system.

You need to install php virgil crypto extension ext-virgil_crypto_php as one of dependency otherwise you will get the requested PHP extension virgil_crypto_php is missing from your system error during composer install.

In general to install virgil crypto extension follow next steps:
- Download proper extension package for your platform from cdn like virgil-crypto-2.0.4-php-5.6-linux-x86_64.tgz.
- Type following command to unpack extension in terminal:
```php
$ tar -xvzf virgil-crypto-2.0.4-php-5.6-linux-x86_64.tgz
```
- Place unpacked virgil_crypto_php.so under php extension path.
- Add virgil extension to your php.ini configuration file like extension = virgil_crypto_php.so.
```php
$ echo "extension=virgil_crypto_php.so" >> \
  `php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"`
```

All necessary information about where php.ini or extension_dir are you can get from php_info() in case run php on server or call php -i | grep php.ini or php -i | grep extension_dir from CLI.

Prerequisites:
- PHP 5.6.*
- Composer
- virgil_crypto_php.so

Installing the package:
```php
$ composer require virgil/sdk
```


## <a name="head3"></a> Initialize SDK
To initialize the **Virgil SDK** on a server, you will need to sign up for a developer account and create your first application. Then, to initialize the SDK all you need are:

1. The **access token** for your application
2. The application **credentials** (the App ID, the App Key in a file, the App Key password).

```php
$virgilApiContext = VirgilApiContext::create(
    [
        VirgilApiContext::AccessToken => '[YOUR_ACCESS_TOKEN_HERE]',
        VirgilApiContext::Credentials => new AppCredentials(
            '[YOUR_APP_ID_HERE]',
            Buffer::fromBase64('[YOUR_APP_PRIVATE_KEY_HERE]'),
            '[YOUR_APP_PRIVATE_KEY_PASS_HERE]'
        ),
    ]
);

$virgilApi = new VirgilApi($virgilApiContext);
```


## <a name="head4"></a> Create an Access Token

When users want to start working with your Application in a browser or mobile device, Virgil can't trust them right away. Virgil needs the developer to vouch for his users, so we can trust them too. You need to give your users an Access Token that tells Virgil who they are and what they can do. Thus, you need a service that will be responsible for an access token creation in your Virgil Developer Dashboard for users in case of their successful registration on your server.

You must decide, based on the token request that was sent to you, who the user is and what they should be allowed to do and then you have to transfer a recently created special access token to the client side. To figure out who the user is, you might implement the users authentication mechanism by using the user's identity. Also, you can assign a temporary identity to the user if you don't care who he is.

```
// an example of an Access Token representation
AT.7652ee415726a1f43c7206e4b4bc67ac935b53781f5b43a92540e8aae5381b14
```


## <a name="head5"></a> Approve & Publish Cards

You have to transfer a recently created and signed users' Virgil Cards from the client side to your server for further approving. When you receive the users' Virgil Cards from the client side, import them, sign with your App Key using Virgil SDK and Publish to the **Virgil Services**. Thus, you need a service that will validate and sign the transferred users' Virgil Cards.

Use the following code to Import and Publish a Virgil Card to Virgil Services

```php
// import a Virgil Card from string
$importedCard = $virgilApi->Cards->import($exportedCard);

$virgilApi->Cards->publish($importedCard);
```

At the Virgil Services, the Virgil Card(s) will be also signed. Developers can verify the signature of the Virgil Card owner, the Virgil Services, and the Application Server at any time.

See our guide on [Validating Cards](/docs/guides/virgil-card/validating-card.md) to see more examples of Card Validation.
