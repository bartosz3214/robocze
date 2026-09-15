# [02] Hello World — your first PHP page

**Branch:** `feature/02-hello-world`
**Estimated time:** 1h
**Prerequisites:** ticket 01 (Docker environment) is running

## Goal

Get one PHP file to display something in the browser, and understand what actually
happens when you open a `.php` address.

## Background

PHP is a language that runs **on the server**, before anything reaches the browser.
When you open `http://localhost`, nginx hands the file to PHP, PHP executes it, and
the browser only ever sees the *result* — never your PHP code. That is the single
most important idea in this ticket.

## Tasks

1. Create `index.php` in the project root.
2. Inside it, open a PHP block with `<?php` and print a greeting with `echo`.
3. Below the PHP block, write ordinary HTML (a `<h1>` for example) — notice you can mix them.
4. Open `http://localhost` and confirm you see your page.
5. In the browser use "View page source" (Ctrl+U) and confirm **no PHP code is visible**.

## Example to get you moving

```php
<?php
echo "Hello, world!";
?>
<h1>My first PHP page</h1>
```

## Acceptance criteria

- [ ] `http://localhost` displays your greeting and the HTML heading.
- [ ] Page source in the browser contains no `<?php`.
- [ ] `index.php` is committed on branch `feature/02-hello-world`.

## Things to try (optional)

- Put `<?php echo date('Y-m-d H:i:s'); ?>` on the page and refresh a few times.
- Make PHP print a heading, e.g. `echo "<h1>Hi</h1>";`. Same result, different route.

## Watch out for

- Every PHP statement ends with a semicolon `;`. Forgetting it is the #1 beginner error.
- A blank page usually means an error. Check the logs: `docker compose logs -f php`.

## Learn more

- <https://www.php.net/manual/en/tutorial.firstpage.php>
