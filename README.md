# resource_allocator
Project to allocate resource with minimal cost

## Technical stack
* PHP 7.1 or greater
* Composer

## Installation
```bash
git clone https://github.com/[USER-NAME]/resource_allocator.git

cd resource_allocator

composer install
```

## Test
Execute following command to run unit tests
```shell
./vendor/bin/phpunit
```

##Run
```shell
php index.php 1 1150
```

```browser
locate index.php
@params hours=1&capacity=1150

Example: http://locahost/resource_allocator/index.php?hours=1&capacity=1150
```

## References

### PHPUnit
https://phpunit.readthedocs.io/en/9.1/