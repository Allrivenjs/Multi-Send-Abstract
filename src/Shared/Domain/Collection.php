<?php

declare(strict_types=1);

namespace Core\Shared\Domain;

abstract class Collection implements CollectionInterface
{
    public function __construct(private array $items = [])
    {
    }

    public function all(): array
    {
        return $this->items;
    }

    // Implementación del método map
    public function map(callable $callback): static {
        $mappedItems = array_map($callback, $this->items);
        return new static($mappedItems); // Retorna una nueva instancia de la colección con los items mapeados
    }

    public function filter(callable $callback): static {
        $filteredItems = array_filter($this->items, $callback);
        return new static($filteredItems); // Retorna una nueva instancia con los items filtrados
    }

    public function count(): int {
        return count($this->items);
    }

    public function first(): mixed {
        return $this->items[0] ?? null; // Devuelve el primer elemento o null si la colección está vacía
    }
}
