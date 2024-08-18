<?php
    
    namespace App\Shared\Enums;
    
    enum PromotionType: string
    {
        case DATE_RANGE_MULTIPLIER = 'date_range_multiplier';
        case FIXED_PRICE_VOUCHER = 'fixed_price_voucher';
        case EVEN_ITEMS_MULTIPLIER = 'even_items_multiplier';
    }
