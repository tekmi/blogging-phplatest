<?php

var_dump([
    "Password Argon" => PASSWORD_ARGON2I,
    "Password default" => PASSWORD_DEFAULT,
    "Password Bcrypt" => PASSWORD_BCRYPT
]);

var_dump([
    "Argon memory cost" => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
    "Argon time cost" => PASSWORD_ARGON2_DEFAULT_TIME_COST,
    "Argon threads" => PASSWORD_ARGON2_DEFAULT_THREADS,
]);

$measurePasswordHashWithArgon2 = function(array $params = []): string {
    $default = ['memory_cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST, 'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST, 'threads' => PASSWORD_ARGON2_DEFAULT_THREADS];
    $params = array_merge($default, $params);

    $before = microtime(true);
    $hashed = password_hash("tekmi", PASSWORD_ARGON2I, $params);
    var_dump(["For params: " . json_encode($params) => microtime(true) - $before]);

    return $hashed;
};

$hashed = $measurePasswordHashWithArgon2();
$info = password_get_info($hashed);
var_dump($info);

$needsRehashing1 = password_needs_rehash($hashed, PASSWORD_ARGON2I);
$needsRehashing2 = password_needs_rehash($hashed, PASSWORD_ARGON2I, ['time_cost' => 3]);
var_dump([$needsRehashing1, $needsRehashing2]);

$verified = password_verify('tekmi', $hashed);
var_dump($verified);

// Playing with memory cost
//$measurePasswordHashWithArgon2();
//$measurePasswordHashWithArgon2(['memory_cost' => 2 ** 11]);
//$measurePasswordHashWithArgon2(['memory_cost' => 2 ** 15]);
//$measurePasswordHashWithArgon2(['memory_cost' => 4294967296]); // error

// Playing with time cost
//$measurePasswordHashWithArgon2();
//$measurePasswordHashWithArgon2(['time_cost' => 100]);
//$measurePasswordHashWithArgon2(['time_cost' => 1000]);
//$measurePasswordHashWithArgon2(['time_cost' => 900000000000]); // error

// Playing with threads
//$measurePasswordHashWithArgon2();
//$measurePasswordHashWithArgon2(['threads' => 4]);
//$measurePasswordHashWithArgon2(['threads' => 100]);
//$measurePasswordHashWithArgon2(['threads' => 30000000]); // error

// Playing with All options at once
//$measurePasswordHashWithArgon2();
//$measurePasswordHashWithArgon2(['memory_cost' => 2 ** 12, 'time_cost' => 10, 'threads' => 20]);
//$measurePasswordHashWithArgon2(['memory_cost' => 2 ** 16, 'time_cost' => 100, 'threads' => 50]);
