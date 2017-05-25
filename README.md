## Installation:

### Step 1. Add module to the composer.json
```
composer require qbo/module-configurableproduct
```

### Step 2. Enable the module:
```
php bin/magento module:enable Qbo_ConfigurableProduct
```

### Step 4 Upgrade the Magento application
```
php bin/magento setup:upgrade
```

### Step 5. Generate DI configuration
```
php bin/magento setup:di:compile
```

### Step 6. Clear cache
```
php bin/magento cache:clean
```
