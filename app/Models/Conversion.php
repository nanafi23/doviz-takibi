<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversion extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'from_currency_id',
        'to_currency_id',
        'converted_amount',
        'rate'
    ];

    protected $casts = [
        'amount' => 'decimal:4',
        'converted_amount' => 'decimal:4',
        'rate' => 'decimal:6',
        'created_at' => 'datetime:Y-m-d H:i:s'
    ];

    /**
     * علاقة مع المستخدم
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fromCurrency()
    {
        return $this->belongsTo(Currency::class, 'from_currency_id');
    }

    public function toCurrency()
    {
        return $this->belongsTo(Currency::class, 'to_currency_id');
    }
    /**
     * تنسيق عرض التحويل
     */
    public function getFormattedResultAttribute()
    {
        return number_format($this->converted_amount, 2) . ' ' . $this->toCurrency->code;
    }

    /**
     * تنسيق المبلغ المدخل
     */
    public function getFormattedAmountAttribute()
    {
        return number_format($this->amount, 2) . ' ' . $this->fromCurrency->code;
    }

    /**
     * نطاق الاستعلام للتحويلات الحديثة
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * إنشاء تحويل جديد
     */
    public static function createConversion($data)
    {
        return self::create([
            'user_id' => optional(Auth::user())->id,
            'from_currency_id' => $data['from_currency_id'],
            'to_currency_id' => $data['to_currency_id'],
            'amount' => $data['amount'],
            'converted_amount' => $data['converted_amount'],
            '_rate' => $data['_rate'],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }

    /**
     * الحصول على تاريخ التحويل بشكل منسق
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y - H:i');
    }
}