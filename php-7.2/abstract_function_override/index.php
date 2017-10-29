<?php

abstract class Animal
{
    abstract public function run(\stdClass $speed);
}

abstract class Mammal extends Animal
{
    abstract public function run($speed);
}

class Lion extends Mammal
{
    public function run($speed)
    {
        return "Runs $speed km/h";
    }
}

var_dump(
    (new Lion())->run("25")
);

#docker run -it --rm -v "$PWD":/usr/src/php-7.2 -w /usr/src/php-7.2 php:7.2.0RC5-cli-stretch php php-7.2/abstract_function_override/index.php
#docker run -it --rm -v "$PWD":/usr/src/php-7.2 -w /usr/src/php-7.2 php:7.1-cli php php-7.2/abstract_function_override/index.php
#docker run -it --rm -v "$PWD":/usr/src/php-7.2 -w /usr/src/php-7.2 php:7.0-cli php php-7.2/abstract_function_override/index.php