# [06] Arrays — a list of products

**Branch:** `feature/06-arrays`
**Estimated time:** 2–3h
**Prerequisites:** ticket 05

## Goal

Keep many values in one variable using indexed and associative arrays, and walk
through them with `foreach`.

## Background

An **indexed** array is a numbered list: `$colors[0]`, `$colors[1]`.
An **associative** array uses names as keys: `$product['name']`, `$product['price']`.
Real data is almost always an array of associative arrays — a list of rows.

## Tasks

1. Create `products.php`.
2. Build an indexed array `$colors` with 5 colours and print them with `foreach`.
3. Build one associative array `$product` with keys `name`, `price`, `quantity`.
4. Build `$products` — an array of at least 5 such products.
5. Render `$products` as an HTML table: name, price, quantity, and price × quantity.
6. Below the table print the **total value** of all products (sum in a loop).
7. Print how many products there are with `count()`.
8. Find and print the most expensive product.

## Example

```php
<?php
$products = [
    ['name' => 'Keyboard', 'price' => 149.99, 'quantity' => 3],
    ['name' => 'Mouse',    'price' => 79.50,  'quantity' => 10],
];

foreach ($products as $product) {
    echo $product['name'] . ' - ' . $product['price'] . ' zł<br>';
}
```

## Acceptance criteria

- [ ] `products.php` renders a table of at least 5 products.
- [ ] The total is calculated in code, never typed in by hand.
- [ ] The most expensive product is found with a loop or a sort — not by eye.
- [ ] Prices are formatted sensibly, e.g. `number_format($price, 2)`.

## Watch out for

- Array keys are strings: `$product['name']` needs quotes. `$product[name]` is a bug.
- Use `foreach` for arrays. A `for` with `$i` works for indexed arrays only, and breaks
  the moment keys are not 0,1,2,…

## Things to try (optional)

- `array_sum()`, `array_column()`, `usort()` — can you replace your loops with them?

## Learn more

- <https://www.php.net/manual/en/language.types.array.php>
- <https://www.php.net/manual/en/control-structures.foreach.php>
