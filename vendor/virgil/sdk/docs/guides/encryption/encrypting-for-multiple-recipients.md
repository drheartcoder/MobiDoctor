# Encrypting for multiple recipients

This guide is a short tutorial on how to **encrypt** data for multiple recipients with Virgil Security. You will encrypt data with a Public Key, which is saved in the user's **Virgil Card**. This means that only the owner of the related Private Key will be able to decrypt the encrypted data. Therefore, you need to search for the user's Virgil Cards at **Virgil Services** and then encrypt the data using appropriate Virgil Cards.

Encryption can be used to provide high levels of security to network communications, e-mails, files stored on the cloud, and other information that requires protection.

For original information about encryption, its syntax and parameters, follow the link [here](https://github.com/VirgilSecurity/virgil/blob/wiki/wiki/glossary.md#encryption).

Set up your project environment before you begin to encrypt data, with the [getting started](/docs/guides/configuration/client-configuration.md) guide.

The Data Encryption procedure is shown in the figure below.

![Virgil Encryption Intro](/docs/img/Encryption_introduction.png "Data encryption")


In order to encrypt a message, Alice has to have:
 - The participants' Virgil Cards, which should be published on Virgil Services.

Let's review data encryption for multiple recipients:

1. Developers need to initialize the **Virgil SDK**

```php
$virgilApi = VirgilApi::create('[YOUR_ACCESS_TOKEN_HERE]');
```

2. Then Alice:


  -  Searches for participants' Virgil Cards on Virgil Services
  -  Prepares the message
  -  Encrypts the message

  ```php
  // search for Bob's and Alice's Cards
  $bobAndAliceCards = $virgilApi->Cards->find(['bob', 'alice']);

  $message = "Hey Bob, how's it going?";

  // encrypt the message for multiple recipients
  $cipherText = $bobAndAliceCards->encrypt($message)->toBase64();
  ```

Alice can now send the encrypted message to the recipients.

In many cases you will need the receiver's Virgil Cards. See [Finding Cards](/docs/guides/virgil-card/finding-card.md) guide to find them.
