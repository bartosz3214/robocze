# [09] MySQL and PDO — talk to the database

**Branch:** `feature/09-mysql-with-pdo`
**Estimated time:** 3–4h
**Prerequisites:** ticket 08

## Goal

Connect to the MySQL container from PHP, create a table, and read and write rows
using **prepared statements**.

## Background

The database runs in its own container. From PHP the host is not `localhost` but
`mysql` — the service name from `compose.yaml`. Credentials live in `.env`
(defaults: database `app`, user `app`, password `app`).

## Tasks

1. Create `db.php` that returns a configured `PDO` connection.
   Set `PDO::ATTR_ERRMODE` to `PDO::ERRMODE_EXCEPTION` so mistakes are loud.
2. Create `schema.sql` with a `products` table: `id`, `name`, `price`, `quantity`, `created_at`.
3. Run it: `docker compose exec -T mysql mysql -uapp -papp app < schema.sql`.
4. Create `products-list.php` that `SELECT`s all products and renders the table from ticket 06 —
   this time with real data.
5. Create `product-add.php` with a form that `INSERT`s a new product.
6. Use a **prepared statement** with placeholders for the insert. Never glue user
   input into SQL with `.`.
7. Add a search box that filters by name using `WHERE name LIKE :name`.

## Example

```php
<?php
// db.php
$pdo = new PDO(
    'mysql:host=mysql;dbname=app;charset=utf8mb4',
    'app',
    'app',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// insert, safely
$statement = $pdo->prepare(
    'INSERT INTO products (name, price, quantity) VALUES (:name, :price, :quantity)'
);
$statement->execute([
    'name' => $name,
    'price' => $price,
    'quantity' => $quantity,
]);
```

## Acceptance criteria

- [ ] `products-list.php` shows rows that really come from MySQL.
- [ ] Adding a product through the form makes it appear in the list.
- [ ] Every query that uses user input is a prepared statement with placeholders.
- [ ] Entering a name like `O'Brien` works and does not break the SQL. **Test this.**

## Watch out for

- Host is `mysql`, not `localhost`. `localhost` inside the PHP container means the
  PHP container itself.
- If the connection is refused, the database may still be starting:
  `docker compose ps` should show `mysql` as `healthy`.
- Never put a password in a file you commit. Read it from the environment
  (`getenv('MYSQL_PASSWORD')`) — `.env` is gitignored for exactly this reason.

## Learn more

- <https://www.php.net/manual/en/book.pdo.php>
- <https://phpdelusions.net/pdo> — short, blunt, and correct
