#!/bin/bash

./app/Console/cake Migrations.migration run all

if [ "$PHPCS" == 1 ]; then
    ARGS="-p --extensions=php --standard=CakePHP .";
    if [ -n "$PHPCS_IGNORE" ]; then
        ARGS="$ARGS --ignore='$PHPCS_IGNORE'"
    fi
    if [ -n "$PHPCS_ARGS" ]; then
        ARGS="$PHPCS_ARGS"
    fi
    eval "phpcs" $ARGS
    exit $?
fi
if [ "$COVERALLS" == 1 ]; then
    ./app/Console/cake test app AllTests --stderr --coverage-clover build/logs/clover.xml
    exit 1
else
    ./app/Console/cake test app AllTests --stderr
    exit 1
fi
exit 0
