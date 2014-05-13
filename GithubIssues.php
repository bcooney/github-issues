<?php
require 'vendor/autoload.php';
use \League\Csv\Writer as Writer;

$auth = [];
$repo = [];

echo 'Give us your GitHub username: ';
$handle = fopen('php://stdin', 'r');
$auth['username'] = trim(fgets($handle));

echo PHP_EOL;
echo 'Give us your GitHub password (we won\'t do anything evil, promise!): ';
$handle = fopen('php://stdin', 'r');
$auth['password'] = trim(fgets($handle));

echo PHP_EOL;
echo 'Now tell us what repo you want to get issues for (e.g. unikent/of-course): ';
$repo = fgets($handle);
$ex   = explode('/', $repo);

echo PHP_EOL;
if (count($ex) !== 2) {
    throw new Exception('Invalid repository name');
    exit;
}

// Convert the user's input to stdObjects so they're more fun
$repo = (object)['owner' => trim($ex[0]), 'name' => trim($ex[1])];
$auth = (object)$auth;

// Authenticate (so that we can see private repos)
$client    = new \Github\Client();
$paginator = new Github\ResultPager($client);
$client->authenticate(
    $auth->username,
    $auth->password,
    Github\Client::AUTH_HTTP_PASSWORD
);

$issueApi = $client->api('issue');
$issues   = [];

// Get the closed issues first - limited to 30
$issues['closed'] = $issueApi->all(
    $repo->owner,
    $repo->name,
    ['state' => 'closed']
);

// Get all the open issues
$issues['open']   = $paginator->fetchAll(
    $issueApi,
    'all',
    [
        $repo->owner,
        $repo->name,
        ['state' => 'open'],
    ]
);


// Set up the header rows for the CSV
$toWrite = [
    ['url', 'number', 'title', 'status', 'created_at', 'updated_at'],
];

// Set up the data rows for the CSV
foreach ($issues as $states) {
    foreach ($states as $issue) {
        $toWrite[] = [
            $issue['html_url'],
            $issue['number'],
            $issue['title'],
            $issue['state'],
            $issue['created_at'],
            $issue['updated_at'],
        ];
    }
}

echo 'Writing to CSV…' . PHP_EOL;

// Write the array to the CSV file
$writer = new Writer(sprintf('%s.csv', $repo->name), 'ab+');
$writer->setNullHandlingMode(Writer::NULL_AS_EMPTY);
$writer->insertAll($toWrite);

echo sprintf('Done! CSV file is %s.csv', $repo->name);
