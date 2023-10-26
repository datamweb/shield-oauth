<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Commands\\\\OAuthSetup\\:\\:copyAndReplace\\(\\) has parameter \\$replaces with no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Commands/OAuthSetup.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Datamweb\\\\ShieldOAuth\\\\Commands\\\\OAuthSetup\\:\\:\\$arguments type has no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Commands/OAuthSetup.php',
];
$ignoreErrors[] = [
	'message' => '#^Property Datamweb\\\\ShieldOAuth\\\\Commands\\\\OAuthSetup\\:\\:\\$distPath has no type specified\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Commands/OAuthSetup.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Config\\\\Registrar\\:\\:Generators\\(\\) return type has no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Config/Registrar.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to deprecated function random_string\\(\\)\\:
The type \'basic\', \'md5\', and \'sha1\' are deprecated\\. They are not cryptographically secure\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Controllers/OAuthController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Controllers\\\\OAuthController\\:\\:checkExistenceUser\\(\\) has parameter \\$find with no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Controllers/OAuthController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Controllers\\\\OAuthController\\:\\:syncingUserInfo\\(\\) has parameter \\$find with no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Controllers/OAuthController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Controllers\\\\OAuthController\\:\\:syncingUserInfo\\(\\) has parameter \\$updateFildes with no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Controllers/OAuthController.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Libraries\\\\Basic\\\\AbstractOAuth\\:\\:fetchAccessTokenWithAuthCode\\(\\) has parameter \\$allGet with no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/Basic/AbstractOAuth.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Libraries\\\\Basic\\\\AbstractOAuth\\:\\:getColumnsName\\(\\) return type has no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/Basic/AbstractOAuth.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Libraries\\\\Basic\\\\AbstractOAuth\\:\\:getUserInfo\\(\\) has parameter \\$allGet with no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/Basic/AbstractOAuth.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Libraries\\\\Basic\\\\AbstractOAuth\\:\\:setColumnsName\\(\\) return type has no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/Basic/AbstractOAuth.php',
];
$ignoreErrors[] = [
	'message' => '#^Call to deprecated function random_string\\(\\)\\:
The type \'basic\', \'md5\', and \'sha1\' are deprecated\\. They are not cryptographically secure\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/GithubOAuth.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Libraries\\\\GithubOAuth\\:\\:fetchAccessTokenWithAuthCode\\(\\) has parameter \\$allGet with no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/GithubOAuth.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Libraries\\\\GithubOAuth\\:\\:setColumnsName\\(\\) has parameter \\$userInfo with no type specified\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/GithubOAuth.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Libraries\\\\GithubOAuth\\:\\:setColumnsName\\(\\) return type has no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/GithubOAuth.php',
];
// $ignoreErrors[] = [
// 	'message' => '#^Property Datamweb\\\\ShieldOAuth\\\\Libraries\\\\GithubOAuth\\:\\:\\$client has no type specified\\.$#',
// 	'count' => 1,
// 	'path' => __DIR__ . '/src/Libraries/GithubOAuth.php',
// ];
// $ignoreErrors[] = [
// 	'message' => '#^Property Datamweb\\\\ShieldOAuth\\\\Libraries\\\\GithubOAuth\\:\\:\\$config has no type specified\\.$#',
// 	'count' => 1,
// 	'path' => __DIR__ . '/src/Libraries/GithubOAuth.php',
// ];
// $ignoreErrors[] = [
// 	'message' => '#^Variable \\$usersColumnsName might not be defined\\.$#',
// 	'count' => 1,
// 	'path' => __DIR__ . '/src/Libraries/GithubOAuth.php',
// ];
$ignoreErrors[] = [
	'message' => '#^Call to deprecated function random_string\\(\\)\\:
The type \'basic\', \'md5\', and \'sha1\' are deprecated\\. They are not cryptographically secure\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/GoogleOAuth.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Libraries\\\\GoogleOAuth\\:\\:fetchAccessTokenWithAuthCode\\(\\) has parameter \\$allGet with no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/GoogleOAuth.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Libraries\\\\GoogleOAuth\\:\\:setColumnsName\\(\\) has parameter \\$userInfo with no type specified\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/GoogleOAuth.php',
];
$ignoreErrors[] = [
	'message' => '#^Method Datamweb\\\\ShieldOAuth\\\\Libraries\\\\GoogleOAuth\\:\\:setColumnsName\\(\\) return type has no value type specified in iterable type array\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Libraries/GoogleOAuth.php',
];
// $ignoreErrors[] = [
// 	'message' => '#^Property Datamweb\\\\ShieldOAuth\\\\Libraries\\\\GoogleOAuth\\:\\:\\$client has no type specified\\.$#',
// 	'count' => 1,
// 	'path' => __DIR__ . '/src/Libraries/GoogleOAuth.php',
// ];
// $ignoreErrors[] = [
// 	'message' => '#^Property Datamweb\\\\ShieldOAuth\\\\Libraries\\\\GoogleOAuth\\:\\:\\$config has no type specified\\.$#',
// 	'count' => 1,
// 	'path' => __DIR__ . '/src/Libraries/GoogleOAuth.php',
// ];
// $ignoreErrors[] = [
// 	'message' => '#^Variable \\$usersColumnsName might not be defined\\.$#',
// 	'count' => 1,
// 	'path' => __DIR__ . '/src/Libraries/GoogleOAuth.php',
// ];

$ignoreErrors[] = [
	'message' => '#^Function auth not found\\.$#',
	'count' => 3,
	'path' => __DIR__ . '/src/Controllers/OAuthController.php',
];
$ignoreErrors[] = [
	'message' => '#^Function user_id not found\\.$#',
	'count' => 1,
	'path' => __DIR__ . '/src/Controllers/OAuthController.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];
