<?php

declare(strict_types=1);

/**
 * This file is part of Shield OAuth.
 *
 * (c) Datamweb <pooya_parsa_dadashi@yahoo.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Datamweb\ShieldOAuth\Libraries\Basic;

abstract class AbstractOAuth
{
    public ?string $token = null;

    abstract protected function makeGoLink(string $state): string;

    abstract protected function fetchAccessTokenWithAuthCode(array $allGet): void;

    abstract protected function fetchUserInfoWithToken(): object;

    abstract protected function setColumnsName(string $nameOfProcess, object $userInfo): array;

    protected function setToken(string $token): void
    {
        $this->token = $token;
    }

    protected function getToken(): string
    {
        return $this->token;
    }

    public function getUserInfo(array $allGet): object
    {
        $this->fetchAccessTokenWithAuthCode($allGet);

        return $this->fetchUserInfoWithToken();
    }

    public function getColumnsName(string $nameOfProcess, object $userInfo): array
    {
        return $this->setColumnsName($nameOfProcess, $userInfo);
    }
}
