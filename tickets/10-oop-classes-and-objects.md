# [10] OOP part 1 — classes, objects and encapsulation

**Branch:** `feature/10-oop-classes-and-objects`
**Estimated time:** 4h
**Prerequisites:** ticket 09

## Goal

Replace the loose associative arrays from earlier tickets with real classes.
Learn properties, methods, constructors, `$this`, and why `private` matters.

## Background

Until now a product was `['name' => 'Mouse', 'price' => 79.50]`. Nothing stopped you
from writing `$product['pirce']` or setting a negative price. A **class** is a
blueprint that defines both the data *and* the rules about that data; an **object**
is one thing built from that blueprint.

`private` means "only code inside this class may touch it". That is **encapsulation**,
and it is what lets a class guarantee it is never in a nonsense state.

## Tasks

1. Create `src/Product.php` with a `Product` class.
2. Give it `private` properties: `string $name`, `float $price`, `int $quantity`.
3. Write a constructor that accepts all three and **throws** an
   `InvalidArgumentException` if the name is empty, the price is negative, or the
   quantity is negative.
4. Add getters: `getName()`, `getPrice()`, `getQuantity()`.
5. Add behaviour — methods that *do* something, not just return fields:
   - `getTotalValue(): float` — price × quantity
   - `getPriceWithVat(float $vatRate = 0.23): float`
   - `addStock(int $amount): void` and `removeStock(int $amount): void`
     (removing more than you have must throw)
   - `isInStock(): bool`
6. Create `src/Cart.php` with a `Cart` class holding an array of `Product` objects:
   `addProduct(Product $product): void`, `getProducts(): array`,
   `getTotal(): float`, `count(): int`.
7. Create `shop.php` that builds several products, puts them in a cart and renders
   the table from ticket 06 — now from objects.
8. Prove the rules work: wrap `new Product('', -5, -1)` in `try { } catch { }` and
   display the error message.

## Example

```php
<?php
class Product
{
    public function __construct(
        private string $name,
        private float $price,
        private int $quantity,
    ) {
        if (trim($name) === '') {
            throw new InvalidArgumentException('Product name cannot be empty.');
        }

        if ($price < 0) {
            throw new InvalidArgumentException('Price cannot be negative.');
        }
    }

    public function getTotalValue(): float
    {
        return $this->price * $this->quantity;
    }
}

$mouse = new Product('Mouse', 79.50, 10);
echo $mouse->getTotalValue(); // 795
```

## Acceptance criteria

- [ ] Every property is `private` — nothing is `public`.
- [ ] `new Product('', -5, -1)` throws, and `shop.php` shows the message instead of crashing.
- [ ] `removeStock()` refuses to go below zero.
- [ ] `shop.php` renders a cart of `Product` objects with a correct total.
- [ ] One class per file, class name matches the file name.

## Watch out for

- Inside a class you reach your own data with `$this->price`, never `$price`.
- `->` is for objects, `::` is for the class itself. Mixing them up is the classic
  first-week error.
- A getter that just returns a field is fine, but a class that is *only* getters is
  still a glorified array. The behaviour methods are the point of this ticket.

## Learn more

- <https://www.php.net/manual/en/language.oop5.basic.php>
- <https://www.php.net/manual/en/language.oop5.visibility.php>
- <https://www.php.net/manual/en/language.oop5.decon.php>
