# [08] Forms — take input from the user

**Branch:** `feature/08-forms-and-superglobals`
**Estimated time:** 3h
**Prerequisites:** ticket 07

## Goal

Receive data from an HTML form with `$_POST` / `$_GET`, validate it, and display it
safely.

## Background

Data from a user is **never** trusted. Two rules you will keep for your whole career:
validate everything on arrival, and escape everything on the way out with
`htmlspecialchars()`. Skipping the second one is the XSS vulnerability.

## Tasks

1. Create `contact.php` with an HTML form: name, email, age, message. Method `POST`.
2. Post the form to itself (`action=""`) and handle it when
   `$_SERVER['REQUEST_METHOD'] === 'POST'`.
3. Validate: all fields filled, email valid (`filter_var(..., FILTER_VALIDATE_EMAIL)`),
   age is a number between 1 and 120.
4. Collect problems into an `$errors` array and list them above the form.
5. On success, print a summary of what was submitted.
6. Escape **every** value you print with `htmlspecialchars()`.
7. Keep the entered values in the inputs after a failed submit, so nothing is retyped.
8. Create `search.php` that reads `$_GET['q']` and greets the visitor —
   try `search.php?q=Bartek`.

## Example

```php
<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');

    if ($name === '') {
        $errors[] = 'Name is required.';
    }

    if ($errors === []) {
        echo 'Hello, ' . htmlspecialchars($name) . '!';
    }
}
```

## Acceptance criteria

- [ ] Submitting an empty form shows readable errors and does **not** crash.
- [ ] An invalid email is rejected.
- [ ] Every printed user value goes through `htmlspecialchars()`.
- [ ] Typing `<script>alert('xss')</script>` into the name field prints it as text,
      it does not run. **Test this.**

## Watch out for

- `$_POST['name']` on a first page load does not exist and produces a warning.
  Use the null coalescing operator: `$_POST['name'] ?? ''`.
- `$_GET` is visible in the URL, `$_POST` is not. Neither one is secure by itself.

## Learn more

- <https://www.php.net/manual/en/tutorial.forms.php>
- <https://www.php.net/manual/en/function.htmlspecialchars.php>
