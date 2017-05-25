<?php

namespace Qbo\ConfigurableProduct\Helper;

/**
 * Class Data
 * Helper class for getting options
 */
class Options extends \Magento\ConfigurableProduct\Helper\Data
{

    /**
     * Magento\CatalogInventory\Api\StockRegistryInterface
     * 
     * @var type 
     */
    protected $_stockRegistry;

    public function __construct(Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry)
    {
        $this->_stockRegistry = $stockRegistry;
    }

    public function getOptions($currentProduct, $allowedProducts)
    {
        $options = [];

        foreach ($allowedProducts as $product)
        {
            $productId = $product->getId();
            $stockitem = $this->_stockRegistry->getStockItem($product->getId(), $product->getStore()->getWebsiteId());

            if ($stockitem->getQty() == 0) {
                continue;
            }
            $images = $this->getGalleryImages($product);

            if ($images) {
                foreach ($images as $image)
                {
                    $options['images'][$productId][] = [
                                'thumb' => $image->getData('small_image_url'),
                                'img' => $image->getData('medium_image_url'),
                                'full' => $image->getData('large_image_url'),
                                'caption' => $image->getLabel(),
                                'position' => $image->getPosition(),
                                'isMain' => $image->getFile() == $product->getImage(),
                    ];
                }
            }
            foreach ($this->getAllowAttributes($currentProduct) as $attribute)
            {
                $productAttribute = $attribute->getProductAttribute();
                $productAttributeId = $productAttribute->getId();
                $attributeValue = $product->getData($productAttribute->getAttributeCode());

                $options[$productAttributeId][$attributeValue][] = $productId;
                $options['index'][$productId][$productAttributeId] = $attributeValue;
            }
        }
        return $options;
    }

}
