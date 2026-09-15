# [11] OOP part 2 — inheritance, interfaces and a repository

**Branch:** `feature/11-oop-inheritance-and-interfaces`
**Estimated time:** 5h
**Prerequisites:** ticket 10

## Goal

Share behaviour between classes with inheritance, describe a contract with an
interface, and move your database code from ticket 09 behind a repository class.

## Background

Three ideas, in order of importance:

- **Inheritance** (`extends`) — a `DigitalProduct` *is a* `Product` with extras.
  Use it when the child genuinely is a kind of the parent, not to dodge typing.
- **Abstract class** — a blueprint too incomplete to instantiate. It can force
  children to implement a method.
- **Interface** — a pure contract: "whoever implements me has these methods."
  Any class can implement many interfaces, and code that depends on the interface
  does not care which implementation it gets. This is the idea the whole industry
  is built on.

## Tasks

1. Turn `Product` from ticket 10 into an `abstract class` with an abstract method
   `getShippingCost(): float`.
2. Create `PhysicalProduct extends Product` — has a `float $weightKg`, shipping costs
   `10.00 + 2.00 × weight`.
3. Create `DigitalProduct extends Product` — has a `int $fileSizeMb`, shipping is always `0.00`.
4. Add a `getLabel(): string` to the parent and **override** it in `DigitalProduct`
   to add `(download)`. Call `parent::getLabel()` inside the override.
5. Create an interface `Discountable` with `applyDiscount(float $percent): void`.
   Implement it in `PhysicalProduct` only.
6. In `shop.php`, loop over a mixed array of both product types and print each one's
   shipping cost. Notice you call the *same* method and get different behaviour —
   that is **polymorphism**.
7. Use `instanceof Discountable` to apply a discount only to products that support it.
8. Create `src/ProductRepository.php`:
   - constructor takes the `PDO` from ticket 09
   - `findAll(): array` returns an array of `Product` objects, not raw rows
   - `findById(int $id): ?Product`
   - `save(Product $product): void`
   - `delete(int $id): void`
9. Rewrite `products-list.php` to use the repository. No SQL anywhere except inside
   `ProductRepository`.

## Example

```php
<?php
abstract class Product
{
    public function __construct(
        protected string $name,
        protected float $price,
    ) {
    }

    abstract public function getShippingCost(): float;

    public function getLabel(): string
    {
        return $this->name;
    }
}

class DigitalProduct extends Product
{
    public function getShippingCost(): float
    {
        return 0.00;
    }

    public function getLabel(): string
    {
        return parent::getLabel() . ' (download)';
    }
}

// Polymorphism: one loop, two behaviours.
foreach ([$keyboard, $ebook] as $product) {
    echo $product->getLabel() . ': ' . $product->getShippingCost() . ' zł<br>';
}
```

## Acceptance criteria

- [ ] `Product` is abstract and `new Product(...)` is impossible — try it, read the error.
- [ ] Both child classes implement `getShippingCost()` and return different values.
- [ ] `DigitalProduct::getLabel()` calls `parent::getLabel()`.
- [ ] `PhysicalProduct` implements `Discountable`; `DigitalProduct` does not, and the
      `instanceof` check skips it without error.
- [ ] `ProductRepository::findAll()` returns `Product` objects — `products-list.php`
      contains no SQL and no `$row['name']`.
- [ ] Deleting a product through the repository removes it from the database.

## Watch out for

- `private` properties are **not** visible in child classes. If a child needs them,
  use `protected`. Keep `private` as the default and widen only when you must.
- A child must keep the parent's method signature compatible — same parameters,
  compatible return type.
- Type-hint against the **interface** (`Discountable`), not the concrete class,
  wherever you can. That is the habit this ticket exists to build.

## Things to try (optional)

- Add a second implementation of the repository that reads from an array instead of
  MySQL, extract an interface `ProductRepositoryInterface`, and swap them in
  `products-list.php` by changing one line. If the page still works, you have
  understood interfaces.

## Learn more

- <https://www.php.net/manual/en/language.oop5.inheritance.php>
- <https://www.php.net/manual/en/language.oop5.abstract.php>
- <https://www.php.net/manual/en/language.oop5.interfaces.php>
