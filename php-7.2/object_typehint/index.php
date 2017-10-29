<?php

class Car
{
}

class Person
{
}

/**
 * @param object $obj
 * @return string
 */
function moves(object $obj): string
{
    return get_class($obj);
}

/**
 * @param array $person
 * @return object
 */
function converts(array $person): object {
    return (object) $person;
}

var_dump(
    moves(new Car()),
    moves(new Person()),
    moves(new \DateTime()),
    moves(json_decode('{}')),
    moves(new class() {}),
    moves(new \stdClass())
);

var_dump(converts([
    "name" => "Adam",
    "surname" => "Geg",
    "city" => "Amsterdam"
]));