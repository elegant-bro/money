[![Build Status](https://travis-ci.com/elegant-bro/money.svg?branch=master)](https://travis-ci.com/elegant-bro/money)
[![Coverage Status](https://coveralls.io/repos/github/elegant-bro/money/badge.svg?branch=master)](https://coveralls.io/github/elegant-bro/money?branch=master)

# Tests

**Pass all tests locally before create pull request.**

Build test container and run all tests
```shell
make all
```

Other commands
```shell
# build the Dockerfile
make build 
# install composer requirements
make install
# enter to container shell
make shell
# style check
make style-check
# run unit tests
make unit
# ensure coverage is 100%
make coverage
```
