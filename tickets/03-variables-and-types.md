# [03] Variables and types — a business card page

**Branch:** `feature/03-variables-and-types`
**Estimated time:** 1–2h
**Prerequisites:** ticket 02

## Goal

Store data in variables instead of hard-coding it into your output, and learn the
basic PHP types.

## Background

A variable in PHP always starts with `$`. You do not declare a type — PHP works it
out from the value you assign (`$age = 30;` is an int, `$age = "30";` is a string).
The types you need now: **string**, **int**, **float**, **bool**, and `null`.

## Tasks

1. Create `about.php`.
2. Define variables: `$firstName`, `$lastName`, `$age` (int), `$city`, `$isStudent` (bool).
3. Print a few sentences about yourself using those variables — never type the values
   directly into the text.
4. Use **double quotes** to interpolate: `"Hello, $firstName!"`.
5. Print one sentence built with the concatenation operator `.` instead, and compare.
6. Use `var_dump()` on each variable to see its type, then delete those lines when done.

## Example

```php
<?php
$firstName = "Bartek";
$age = 25;

echo "My name is $firstName and I am $age years old.";
echo '<br>';
echo 'Next year I will be ' . ($age + 1) . '.';
```

## Acceptance criteria

- [ ] `about.php` prints at least 4 sentences, all built from variables.
- [ ] Both string interpolation (`"$var"`) and concatenation (`.`) appear at least once.
- [ ] Variable names are `camelCase` and describe what they hold.

## Watch out for

- `'single quotes'` do **not** interpolate — `'Hello $name'` prints a literal `$name`.
- `$isStudent` printed with `echo` shows `1` for true and nothing at all for false.
  That is normal — booleans are for decisions (ticket 04), not for display.

## Learn more

- <https://www.php.net/manual/en/language.variables.basics.php>
- <https://www.php.net/manual/en/language.types.php>
