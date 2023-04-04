<@php

declare(strict_types=1);

namespace {namespace};

use Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth;

class {class} extends AbstractOAuth
{
    /** @var string $API_CODE_URL The API URL to get the Auth Code. */
    private static $API_CODE_URL = '';

    /** @var string $API_TOKEN_URL The API URL to get the Auth token. */
    private static $API_TOKEN_URL = '';

    /** @var string $API_USER_INFO_URL The API URL to get the user info. */
    private static $API_USER_INFO_URL = '';

    /** @var string $APPLICATION_NAME The name of this application. */
    private static $APPLICATION_NAME = 'ShieldOAuth';

    protected string $token;
    protected string $client_id;
    protected string $client_secret;
    protected string $callback_url;

    /**
     * Class construct
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param string $token
     */
    public function __construct(string $token = '')
    {
        // your code here
    }

    /**
     * Create a link to transfer the user to the new provider.
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param string $state
     * @return string
     */
    public function makeGoLink(string $state): string
    {
        // your code here
        return '';
    }

    /**
     * Try to get the value of `access_token` according to the code
     * received from the `makeGoLink()` method.
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param array $allGet
     * @return mixed
     */
    public function fetchAccessTokenWithAuthCode(array $allGet): void
    {
        // your code here
    }

    /**
     * Try to receive user information (including first name,
     * last name, email, etc) according to the token code set
     * in the previous step.
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @return object
     */
    public function fetchUserInfoWithToken(): object
    {
        // your code here
        return json_decode('');
    }

    /**
     * Set the fields received from each service OAuth to be recorded
     * in each column of the table.
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param string $nameOfProcess
     * @param object $userInfo
     * @return array
     */
    public function setColumnsName(string $nameOfProcess, object $userInfo): array
    {
        // your code here
        return [];
    }
}