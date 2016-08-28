## Installation:

### Step 1. Add module to the composer.json
```
"mjankiewicz/configurableproduct": "dev-master"
```

Example:
```
"require": {
    "magento/product-community-edition": "2.1.0",
    "composer/composer": "@alpha",
    "mjankiewicz/configurableproduct": "dev-master"
}
```

### Step 2. Update composer
```
composer update
```

### Step 3. Enable the module:
```
php bin/magento module:enable JanSoft_ConfigurableProduct
```

### Step 4. Generate DI configuration
```
php bin/magento setup:di:compile
```

### Step 5. Clear cache
```
php bin/magento cache:flush
```