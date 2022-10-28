# Our concepts

We love __type safety__ and __tests__. Our main goal when we write tests is to be certain that the code
_not only works correctly_ now, but also _continues to work correctly_ in the future even though we are constantly
changing and refactoring.

## Controllers

Our controllers rely heavily on "models" or [Data Transfer Objects](https://en.wikipedia.org/wiki/Data_transfer_object).
These models are plain PHP objects which give us very good type safety and request validation. We utilize the
[Symfony Serializer component](https://symfony.com/doc/current/components/serializer.html) to easily and safely parse a
request body into a model.

Controllers are tested with "Functional tests", which load database fixtures and execute an HTTP request. We then assert
that the database has been modified as expected. Functional tests are, by far, the most common tests we have. They make
it easy to know that they entire endpoint is working correctly.

## Functional core

We utilize a [functional core, imperative shell](https://www.kennethlange.com/functional-core-imperative-shell/)
pattern. Any hairy business logic (e.g. financial calculations, permission checks, etc.) belongs in the "functional
core",
meaning that it follows functional programming principals, namely __pure functions__.

Pure functions take parameters and return a result with
no [side effects](https://softwareengineering.stackexchange.com/q/15269/271775).

This allows us to very heavily unit test the functional core since it has a small scope and does not require mocking. By
combining heavy unit tests on the hairy logic and a couple of functional tests on the endpoint, you can be very sure
that everything is working as expected.

## Static analysis

While we have many CI tools and coding standard checks, one of our favourites is [Psalm by Vimeo](https://psalm.dev).
Psalm (and static analysis in general) allows us to __prevent almost all type related runtime errors__ and, paired with
a solid test suite, enables us to complete __large scale refactors without introducing any bugs__.

If you're interested in static analysis and safety (or if you're unconvinced of their benefits), take a look at the
following articles:

1. [PHP or Type Safety: Pick any two](https://psalm.dev/articles/php-or-type-safety-pick-any-two): A quick overview of
   the benefits of type safety and how it applies to PHP.
2. [Fixing code that ain't broken](https://psalm.dev/articles/fixing-code-that-aint-broken): How (and why) Vimeo created
   and introduced Psalm into their legacy PHP codebase.

## Storing currency

All currency figures are stored as __integers, not floats__. This means we are actually storing the whole number of
__cents__ as opposed to the __dollar figure__. For example, we store `$1,000.00` as `100000` (or `1_000_00` as PHP
allows us to [use underscores in integers](https://www.php.net/manual/en/language.types.integer.php) for readability).
