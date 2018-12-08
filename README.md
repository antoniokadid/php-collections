# php-collections
A PHP library that defines collections of objects.

*Project under development.*

## Installation

composer require antoniokadid/php-collections

## Requirements
* PHP 7.1
* JSON Extension

## Features

Collections are created with method chaining in mind.

#### Collections
* ArrayList
  * Sorting
  * Grouping
* Map
* Queue
* Stack

### Examples

```php
class User
{
    public $name;
    public $age;
    public $city;

    public function __construct($name, $age, $city)
    {
        $this->name = $name;
        $this->age = $age;
        $this->city = $city;
    }
}
```

#### Grouping

```php
$user1 = new User('Robert E. Doss', 25, 'Washington');
$user2 = new User('Micah L. Janik', 25, 'Washington');
$user3 = new User('Brent L. Tallent', 25, 'New York');
$user4 = new User('Victor A. Stevens', 26, 'New York');

$array = [$user1, $user2, $user3, $user4];

$list = new ArrayList($array);

echo $list->groupBy(
                function(User $user) { return $user->city; },
                function(User $user) { return $user->age; })
          ->serialize();
```
Serialize converts to JSON
```json
{
    "Washington": {
        "25": [
            {
                "name": "Robert E. Doss",
                "age": 25,
                "city": "Washington"
            },
            {
                "name": "Micah L. Janik",
                "age": 25,
                "city": "Washington"
            }
        ]
    },
    "New York": {
        "25": [
            {
                "name": "Brent L. Tallent",
                "age": 25,
                "city": "New York"
            }
        ],
        "26": [
            {
                "name": "Victor A. Stevens",
                "age": 26,
                "city": "New York"
            }
        ]
    }
}
```

#### Sorting
```php
$list = new ArrayList();

$list->add(new User('Natural1', 27, 'Phoenix'));
$list->add(new User('Natural13', 27, 'Phoenix'));
$list->add(new User('Natural14', 27, 'Phoenix'));
$list->add(new User('Natural2', 27, 'Phoenix'));
```

##### Usual sorting

```php
echo $list->sort()
          ->asc(function(User $user) { return $user->age; })
          ->asc(function(User $user) { return $user->name; })
          ->toList()
          ->serialize();
```
Serialize converts to JSON
```json
[
    {
        "name": "Natural1",
        "age": 27,
        "city": "Phoenix"
    },
    {
        "name": "Natural13",
        "age": 27,
        "city": "Phoenix"
    },
    {
        "name": "Natural14",
        "age": 27,
        "city": "Phoenix"
    },
    {
        "name": "Natural2",
        "age": 27,
        "city": "Phoenix"
    }
]
```

##### Natural sorting

```php
echo $list->sort()
          ->asc(function(User $user) { return $user->age; })
          ->asc(function(User $user) { return $user->name; }, TRUE) // <-- TRUE is for natural sorting
          ->toList()
          ->serialize();
```
Serialize converts to JSON
```json
[
    {
        "name": "Natural1",
        "age": 27,
        "city": "Phoenix"
    },
    {
        "name": "Natural2",
        "age": 27,
        "city": "Phoenix"
    },
    {
        "name": "Natural13",
        "age": 27,
        "city": "Phoenix"
    },
    {
        "name": "Natural14",
        "age": 27,
        "city": "Phoenix"
    }
]
```

## LICENSE

php-collections is released under MIT license.