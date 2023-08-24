# How To Get Keys
  
Obviously, receiving Keys is not directly related to `Shield OAuth`, however, to improve the documentation and convenience of our users, Therefore, we have provided helpful links on how to get keys from the three most important Google, GitHub and Yahoo. For other services, you can find the relevant steps by searching.
- [How To Get Keys](#how-to-get-keys)
- [Explanation About Callback](#explanation-about-callback)
- [Get GitHub Keys](#get-github-keys)
- [Get Google Keys](#get-google-keys)
- [Get Yahoo Keys](#get-yahoo-keys)


# Explanation About Callback
What is important in receiving the keys in each of the services is the **Callback (Redirect)** address. In this regard, you must register the address as below.
```
https://yourBaseUrl.com/oauth/call-back
```
`Shield OAuth` allows you to put another expression in the place of `call-back`, for this you need to make the necessary changes in the `app\Config\ShieldOAuthConfig.php` file.

```php
    public string $call_back_route = 'any-name-for-call-back';
```

Be careful that you must provide the same address for all services.

```
https://yourBaseUrl.com/oauth/any-name-for-call-back
```

# Get GitHub Keys
The guide to get the `client_id` & `client_secret` keys on GitHub is [here](https://docs.github.com/en/developers/apps/building-oauth-apps/creating-an-oauth-app) in full.

# Get Google Keys
The guide to get the `client_id` & `client_secret` keys on Google is [here](https://www.balbooa.com/gridbox-documentation/how-to-get-google-client-id-and-client-secret).

# Get Yahoo Keys
The guide to get the `client_id` & `client_secret` keys on Yahoo is [here](https://developer.yahoo.com/apps/create/).