# PHP enumeration libraries comparison

This project provides an unified feature comparison between most popular PHP enumeration (enum) libraries.

## Process

Each vendor implementation defines an equivalent of two enumerations:

```php
final class FirstEnum
{
    public const VALID_A = 'valid-a';
    public const VALID_B = 'valid-b';

    public const PUBLIC_A = 'public-a';
    public const PUBLIC_B = 'public-b';
    protected const PROTECTED_A = 'protected-a';
    protected const PROTECTED_B = 'protected-b';
    private const PRIVATE_A = 'private-a';
    private const PRIVATE_B = 'private-b';
}

final class OtherEnum
{
    public const OTHER = 'other';
}
```

and an implementation of `VendorInterface` which provides all kinds of callbacks to verify the claims listed below. First two enum members (`VALID_A`, `VALID_B`) must be defined so that it's possible to create instances with these values, the rest must be provided as-is to verify other claims.

## Features

Features are divided into groups, based on the common use cases. Feature "passes" if the library allows to complete certain requirement with a simple call to its methods - dedicated manipulation of the returned value in order to match the expectations is not allowed. All tests are listed below:

* guarantee that...
    * **verify-unique**: only one instance of given member can exist in the runtime,
    * **verify-ctor**: re-calling `__construct()` does not break the instance,
    * **verify-base**: there is no generic typehint for all derived enums,
* create enum value with...
    * **create-key**: member name only,
    * **create-value**: member value only,
    * **create-constant**: `Enum::MEMBER()` syntax,
    * **create-enum**: other enum value,
* convert enum to...
    * **to-key**: member name,
    * **to-value**: member value,
    * **to-string**: member value by casting to string `(string)$enum`,
    * **to-json**: JSON by calling `json_encode($enum)` to get member value,
* compare with other enums using...
    * **equals-instanceof**: `instanceof` operator,
    * **equals-strict**: strict comparison operator `===`,
    * **equals-loose**: loose comparison operator `==`,
    * **equals-method**: dedicated `equals` method or equivalent,
* check whether given enum...
    * **check-key**: member name is valid,
    * **check-value**: member value is valid,
    * **has-key**: instance represents given member name,
    * **has-value**: instance represents given member value,
* fetch enum...
    * **key-to-value**: value using key,
    * **value-to-key**: key using value,
    * **list-keys**: member names,
    * **list-values**: member values,
    * **list-assoc**: members and values as an associative array,
* magic...
    * **magic-serialize**: `(un)serialize()` with `__sleep()` and `__wakeup()`,
    * **magic-clone**: block `__clone()`,
    * **magic-invoke**: block `__invoke()`,
    * **magic-call**: block `__call()`,
    * **magic-props**: block `__set()`, `__get()`, `__isset()`, and `__unset()`,

## Ideas

* **verify-unique**: enum should contain unique members with unique values,
* **magic-export**: call `var_export()` and restore instance during `__set_state()`,
* **magic-debug**: call `var_dump()` and see what is inside using `__debugInfo()`,
* **create-map**: dynamic enums using provided members and values,
* **create-ordinal**: enums without explicit values with assigned ordinals,
* **create-gen**: generating code for classes using members and values,
* **create-docblock**: take members from @method docblock.

## Links

* [Reddit: Why are there no proper enums in PHP?](https://www.reddit.com/r/PHP/comments/6it21f/why_are_there_no_proper_enums_in_php_are_they/)
* [Reddit: Thoughts on userland enum implementations.](https://www.reddit.com/r/PHP/comments/d45je0/some_thoughts_on_enum_implementations_in_userland/)
