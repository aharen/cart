# Cart
Simple Session based cart for shopping websites in Laravel

## Installation

	composer require aharen/cart

## Configuration

1. Add `CartServiceProvider` to `providers` in `config/app.php`

	aharen\Cart\CartServiceProvider::class,

2. Add `Cart` Facade to `aliases` in `config/app.php`

	'Cart' => aharen\Cart\CartFacade::class,

3. Publish the config file to `config` folder
	
	php artisan vendor:publish

If so some reason it doesn't create the config file you have to create a file named `cart.php` inside the `config` folder with the contents below

	<?php
	return [
		'name' => 'yourcartnamehere',
	];

## Usage

### Get items currently in cart

Get the current contents of the cart. Will return `false` if the cart is empty

	Cart::get();

### Count items currently in cart

	Cart::count();

### Add item to cart

The first parameter is your item. It can either be an ID or item name. The second parameter has to be numeric which is the Quantity.

	Cart::add('Pizza Slice', 2);

### Remove Item from cart

Accepts only 1 parameter, which is your item ID or item name

	Cart::remove('Pizza Slice');

### Reset the cart

Empties your current cart

	Cart::reset();
