#!/bin/sh
exec echo "updating composer and bower."
exec bower update
exec composer update
exec echo "bower and composer have been updated"