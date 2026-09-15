# [05] Loops — stop repeating yourself

**Branch:** `feature/05-loops`
**Estimated time:** 2h
**Prerequisites:** ticket 04

## Goal

Repeat work with `for`, `while` and `foreach` instead of copying lines.

## Tasks

1. Create `loops.php`.
2. With a `for` loop, print the numbers 1 to 10.
3. With a `for` loop, print the multiplication table for 5 (`5 x 1 = 5` … `5 x 10 = 50`).
4. With a `while` loop, count down from 10 to 1.
5. Build an HTML `<table>` with a nested loop: the full 10x10 multiplication table.
6. In the 1–10 loop, use `continue` to skip 5 and `break` to stop at 8. Observe the difference.

## Example

```php
<?php
for ($i = 1; $i <= 10; $i++) {
    echo "5 x $i = " . (5 * $i) . "<br>";
}
```

## Acceptance criteria

- [ ] `loops.php` contains a `for`, a `while` and a nested loop.
- [ ] The 10x10 table renders as a real HTML table with rows and cells.
- [ ] You can explain out loud what `continue` and `break` each did.

## Watch out for

- Forgetting `$i++` gives an infinite loop. If the page hangs, that is why —
  the container will cut it off after 60 seconds (`PHP_MAX_EXECUTION_TIME`).
- Inside a nested loop use different variable names (`$i`, `$j`), never the same one twice.

## Learn more

- <https://www.php.net/manual/en/control-structures.for.php>
- <https://www.php.net/manual/en/control-structures.while.php>
