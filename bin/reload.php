#!/usr/bin/env php
<?php

function show_run($text, $command, $canFail = false)
{
    echo "\n* $text\n$command\n";
    passthru($command, $return);
    if (0 !== $return && !$canFail) {
        echo "\n/!\\ The command returned $return\n";
        exit(1);
    }
}

show_run("database:drop", "php app/console doctrine:database:drop --force", true);
show_run("database:create", "php app/console doctrine:database:create");
show_run("schema:create", "php app/console doctrine:schema:create");

show_run("Destroying cache dir manually", "rm -rf app/cache/*");

show_run("Creating directories for app kernel", "mkdir -p app/cache/dev app/cache/test app/logs");

show_run("Warming up dev cache", "php app/console --env=dev cache:clear");

show_run("Changing permissions", "chmod -R 777 app/cache app/logs");
show_run("fixtures:load", "php app/console doctrine:fixtures:load --no-interaction");

show_run("assets:install", "php app/console assets:install --symlink");
show_run("Changing permissions", "chmod -R 777 app/cache app/logs");

exit(0);