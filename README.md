# benchmark-php-dto-validators
Benchmark for PHP DTO Validors

## Benchmark

Simple test:
- add date field
- add boolean field
- add email field

```text
+--------------------+-------------------------------+-----+------+-----+----------+-----------+--------+
| benchmark          | subject                       | set | revs | its | mem_peak | mode      | rstdev |
+--------------------+-------------------------------+-----+------+-----+----------+-----------+--------+
| DTOValidationBench | benchSymphonyValidatorValid   | 0   | 1000 | 5   | 22.248mb | 97.629μs  | ±2.52% |
| DTOValidationBench | benchLaravelValidatorValid    | 0   | 1000 | 5   | 3.775mb  | 159.823μs | ±0.74% |
| DTOValidationBench | benchYii2ValidatorValid       | 0   | 1000 | 5   | 3.385mb  | 89.310μs  | ±1.66% |

| DTOValidationBench | benchSymphonyValidatorInvalid | 0   | 1000 | 5   | 28.052mb | 111.650μs | ±1.62% |
| DTOValidationBench | benchLaravelValidatorInvalid  | 0   | 1000 | 5   | 3.803mb  | 595.212μs | ±2.78% |
| DTOValidationBench | benchYii2ValidatorInvalid     | 0   | 1000 | 5   | 3.786mb  | 128.657μs | ±2.48% |

| DTOValidationBench | benchSymphonyValidatorSnippet | 0   | 1000 | 5   | 28.052mb | 110.914μs | ±2.62% |
| DTOValidationBench | benchLaravelValidatorSnippet  | 0   | 1000 | 5   | 3.803mb  | 561.933μs | ±1.42% |
| DTOValidationBench | benchYii2ValidatorSnippet     | 0   | 1000 | 5   | 3.786mb  | 125.171μs | ±0.79% |
+--------------------+-------------------------------+-----+------+-----+----------+-----------+--------+
```

Extended test:
- add custom rule
- add atLeastOneOf rule
- add field depends on rule

## Overview

- [Валидация в PHP. Красота или лапша?](https://habr.com/ru/post/521292/)
- https://habr.com/ru/post/560068/

## Laravel

- https://stackoverflow.com/questions/28573889/illuminate-validator-in-stand-alone-non-laravel-application

## Phalcon\Validation

- https://docs.phalcon.io/3.4/ru-ru/validation

## Respect\Validation

- https://github.com/Respect/Validation

## Valitron\Validator

- https://github.com/vlucas/valitron

## Sirius Validation

- https://github.com/siriusphp/validation

## Webmozart Assert

- https://github.com/webmozarts/assert

## beberlei Assert

- https://github.com/beberlei/assert

## Rakit Validation

- https://github.com/rakit/validation
