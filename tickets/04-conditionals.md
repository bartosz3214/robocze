# [04] Conditionals — make the page react

**Branch:** `feature/04-conditionals`
**Estimated time:** 2h
**Prerequisites:** ticket 03

## Goal

Make your page show different things depending on the data, using `if`, `else`,
`elseif` and comparison operators.

## Tasks

1. Create `greeting.php`.
2. Set `$hour = (int) date('G');` (current hour, 0–23).
3. Print "Good morning" (before 12), "Good afternoon" (12–17) or "Good evening" (18+).
4. Add a `$temperature` variable and print advice: below 0 "take a coat", 0–20
   "a jacket is enough", above 20 "t-shirt weather".
5. Use a `switch` statement for a `$dayOfWeek` variable that prints the Polish name of the day.
6. Use the ternary operator once: `$label = $isStudent ? 'student' : 'not a student';`

## Example

```php
<?php
$hour = (int) date('G');

if ($hour < 12) {
    echo "Good morning!";
} elseif ($hour < 18) {
    echo "Good afternoon!";
} else {
    echo "Good evening!";
}
```

## Acceptance criteria

- [ ] `greeting.php` uses `if` / `elseif` / `else`, a `switch`, and one ternary.
- [ ] Changing a variable's value visibly changes the output.
- [ ] Every branch is reachable — test by temporarily hard-coding `$hour = 23;` etc.

## Watch out for

- `=` assigns, `==` compares, `===` compares **value and type**. Prefer `===`.
  `0 == "hello"` behaves surprisingly; `0 === "hello"` does not.
- Each `case` in a `switch` needs a `break;` or execution "falls through" to the next one.

## Learn more

- <https://www.php.net/manual/en/control-structures.if.php>
- <https://www.php.net/manual/en/language.operators.comparison.php>
