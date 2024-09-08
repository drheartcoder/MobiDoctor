# Loading Key

This guide shows how to load a private Virgil Key, which is stored on the device. The key must be loaded when Alice wants to **sign** some data, **decrypt** any encrypted content, and perform cryptographic operations.

Set up your project environment before you begin to load a Virgil Key, with the [getting started](/docs/guides/configuration/client-configuration.md) guide.

In order to load the Virgil Key from the default storage:

- Initialize the **Virgil SDK**

```php
$virgilApi = VirgilApi::create('[YOUR_ACCESS_TOKEN_HERE]');
```

- Alice has to load her Virgil Key from the protected storage and enter the Virgil Key password

```php
// load Alice's Key from storage.
$aliceKey = $virgilApi->Keys->load('[KEY_NAME]', '[KEY_PASSWORD]');
```

To load a Virgil Key from a specific storage, developers need to change the storage path during Virgil SDK initialization.
