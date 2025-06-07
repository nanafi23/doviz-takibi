<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

        
    /**
     * الحقول التي يمكن تعبئتها جماعياً
     */
    protected $fillable = [
        'code',     
        'name',      
        'symbol',    
        'is_active',
        'rate',
        'sort_order'
    ];

    /**
     * القيم الافتراضية للنموذج
     */
    protected $attributes = [
        'is_active' => true,
        'rate' => 1.000000,
        'sort_order' => 0
    ];

    /**
     * علاقة مع التحويلات (العملة المصدر)
     */
    public function fromConversions()
    {
        return $this->hasMany(Conversion::class, 'from_currency_id');
    }

    /**
     * علاقة مع التحويلات (العملة الهدف)
     */
    public function toConversions()
    {
        return $this->hasMany(Conversion::class, 'to_currency_id');
    }

    /**
     * نطاق الاستعلام للعملات النشطة فقط
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * نطاق الاستعلام للترتيب حسب الأفضلية
     */
    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * الحصول على سعر الصرف المحدث
     */
    public static function getExchangeRate($from, $to)
    {
        $fromCurrency = self::where('code', $from)->firstOrFail();
        $toCurrency = self::where('code', $to)->firstOrFail();
        
        return $toCurrency->rate / $fromCurrency->rate;
    }

    /**
     * تنسيق عرض العملة
     */
    public function display($amount = null)
    {
        if ($amount === null) {
            return $this->symbol 
                ? $this->symbol . ' ' . $this->code
                : $this->code;
        }

        return $this->symbol
            ? $this->symbol . number_format($amount, 2)
            : number_format($amount, 2) . ' ' . $this->code;
    }
}