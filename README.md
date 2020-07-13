# WAPPKit Core - Collections
A PHP library to define collections of objects.

Part of Web Application Kit (WAPPKit) Core which powers WAPPKit, a privately owned CMS.

*Project under development and may be subject to a lot of changes. Use at your own risk.*

## Installation

composer require antoniokadid/wappkit-core-collections:dev-master

## Requirements
* PHP 7.1
* JSON Extension

## Features

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
[
    {
        "key": "Washington",
        "group": [
            {
                "key": 25,
                "group": [
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
            }
        ]
    },
    {
        "key": "New York",
        "group": [
            {
                "key": 25,
                "group": [
                    {
                        "name": "Brent L. Tallent",
                        "age": 25,
                        "city": "New York"
                    }
                ]
            },
            {
                "key": 26,
                "group": [
                    {
                        "name": "Victor A. Stevens",
                        "age": 26,
                        "city": "New York"
                    }
                ]
            }
        ]
    }
]
```

#### Sorting
```php
$list = new ArrayList();

$list->add(new User('Natural1', 27, 'Phoenix'));
$list->add(new User('Natural13', 27, 'Phoenix'));
$list->add(new User('Natural21', 28, 'Phoenix'));
$list->add(new User('Natural14', 27, 'Phoenix'));
$list->add(new User('Natural2', 27, 'Phoenix'));
```

##### Usual sorting

```php
echo $list->sort()
          ->desc(function(User $user) { return $user->age; })
          ->asc(function(User $user) { return $user->name; })
          ->toList()
          ->serialize();
```
Serialize converts to JSON
```json
[
    {
        "name": "Natural21",
        "age": 28,
        "city": "Phoenix"
    },
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
          ->desc(function(User $user) { return $user->age; })
          ->asc(function(User $user) { return $user->name; }, TRUE) // <-- TRUE is for natural sorting
          ->toList()
          ->serialize();
```
Serialize converts to JSON
```json
[
    {
        "name": "Natural21",
        "age": 28,
        "city": "Phoenix"
    },
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

#### Sorting and Grouping together

```php
$user1 = new User('Robert E. Doss', 25, 'Washington');
$user2 = new User('Micah L. Janik', 25, 'Washington');
$user3 = new User('Brent L. Tallent', 25, 'New York');
$user4 = new User('Victor A. Stevens', 26, 'New York');
$user5 = new User('Natural1', 27, 'Phoenix');
$user6 = new User('Natural13', 27, 'Phoenix');
$user7 = new User('Natural21', 28, 'Phoenix');
$user8 = new User('Natural14', 27, 'Phoenix');
$user9 = new User('Natural2', 27, 'Phoenix');

$array = [$user1, $user2, $user3, $user4, $user5, $user6, $user7, $user8, $user9];

$list = new ArrayList($array);

echo $list->sort()
          ->asc(function(User $user) { return $user->city; })
          ->desc(function(User $user) { return $user->age; })
          ->asc(function(User $user) { return $user->name; }, TRUE) // <-- TRUE is for natural sorting
          ->toList()
          ->groupBy(
              function(User $user) { return $user->city; },
              function(User $user) { return $user->age; })
          ->serialize();
```
Serialize converts to JSON
```json
[
    {
        "key": "New York",
        "group": [
            {
                "key": 26,
                "group": [
                    {
                        "name": "Victor A. Stevens",
                        "age": 26,
                        "city": "New York"
                    }
                ]
            },
            {
                "key": 25,
                "group": [
                    {
                        "name": "Brent L. Tallent",
                        "age": 25,
                        "city": "New York"
                    }
                ]
            }
        ]
    },
    {
        "key": "Phoenix",
        "group": [
            {
                "key": 28,
                "group": [
                    {
                        "name": "Natural21",
                        "age": 28,
                        "city": "Phoenix"
                    }
                ]
            },
            {
                "key": 27,
                "group": [
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
            }
        ]
    },
    {
        "key": "Washington",
        "group": [
            {
                "key": 25,
                "group": [
                    {
                        "name": "Micah L. Janik",
                        "age": 25,
                        "city": "Washington"
                    },
                    {
                        "name": "Robert E. Doss",
                        "age": 25,
                        "city": "Washington"
                    }
                ]
            }
        ]
    }
]
```
## LICENSE

MIT license.