[![Latest Version on Packagist](https://img.shields.io/packagist/v/masoudi/nova-textlist-field.svg?style=flat)](https://packagist.org/packages/masoudi/nova-textlist-field)
[![Total Downloads](https://img.shields.io/packagist/dt/masoudi/nova-textlist-field.svg?style=flat)](https://packagist.org/packages/masoudi/nova-textlist-field)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg?style=flat)](https://opensource.org/licenses/MIT)

# Laravel Nova Text List Field
Create JSON text list as simple

![textlist](https://user-images.githubusercontent.com/109284641/183659934-e419a144-850e-4f50-8827-06ac1dc89628.gif)


## How to use

Install package via Composer
```bash
composer require masoudi/nova-textlist-field
```

Cast field to array in model `in version ^0.2`
```php
class Post extends Model {

    protected $casts = [
        'labels' => 'array'
    ];

}
```

Add the `TextList` field at nova resource
```php
    public function fields(NovaRequest $request)
    {
        return [
            ...

            TextList::make('Labels')->placeholder("Press enter to add"),
        ];
    }
```
