# [07] Functions — package your logic

**Branch:** `feature/07-functions`
**Estimated time:** 2–3h
**Prerequisites:** ticket 06

## Goal

Move repeated logic into named functions with parameters and return values, and
understand why a function should `return` rather than `echo`.

## Tasks

1. Create `functions.php`.
2. Write `calculateNet(float $gross, float $vatRate = 0.23): float` — returns the net price.
3. Write `formatPrice(float $price): string` — returns e.g. `1 234,56 zł`.
4. Write `isAdult(int $age): bool`.
5. Write `getLongestWord(array $words): string`.
6. Write `calculateTotal(array $products): float` reusing the array from ticket 06.
7. Call every function and display the results.
8. Give each function a typed signature and a short docblock explaining what it does.

## Example

```php
<?php
function calculateNet(float $gross, float $vatRate = 0.23): float
{
    return $gross / (1 + $vatRate);
}

echo calculateNet(123.00);      // 100.0
echo calculateNet(110.00, 0.10); // 100.0
```

## Acceptance criteria

- [ ] At least 5 functions, each with parameter types and a return type.
- [ ] Every function **returns** a value — none of them `echo` anything.
- [ ] At least one function has a default parameter value.
- [ ] Function names are verbs in `camelCase` and say what they do.

## Watch out for

- A variable created inside a function does not exist outside it, and vice versa.
  That isolation is the whole point — pass data in as parameters, get data back via `return`.
- `return` ends the function immediately; nothing after it runs.

## Learn more

- <https://www.php.net/manual/en/functions.user-defined.php>
- <https://www.php.net/manual/en/language.types.declarations.php>
