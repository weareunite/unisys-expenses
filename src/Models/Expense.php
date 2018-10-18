<?php

namespace Unite\Expenses\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Unite\Tags\HasTags;
use Unite\Tags\HasTagsInterface;
use Unite\Transactions\Traits\HasTransactions;
use Unite\Contacts\Models\Contact;
use Unite\UnisysApi\Helpers\CustomProperty\HasCustomProperty;
use Unite\UnisysApi\Helpers\CustomProperty\HasCustomPropertyTrait;
use Unite\UnisysApi\Models\Model;

class Expense extends Model implements HasMedia, HasCustomProperty, HasTagsInterface
{
    use LogsActivity;
    use HasTransactions;
    use HasMediaTrait;
    use HasCustomPropertyTrait;
    use HasTags;

    protected $table = 'expenses';

    protected $fillable = [
        'type', 'name', 'number', 'supplier_id', 'purchaser_id', 'date_issue', 'date_supply', 'date_due',
        'variable_symbol', 'specific_symbol', 'description', 'custom_properties',
        'amount', 'amount_without_vat',
    ];

    protected $casts = [
        'custom_properties'         => 'array',
    ];

    const TYPE_DEFAULT = 'default';

    public static function getTypes(): array
    {
        return [
            self::TYPE_DEFAULT,
        ];
    }

    public static function getDefaultType(): string
    {
        return self::TYPE_DEFAULT;
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public function supplier()
    {
        return $this->belongsTo(Contact::class);
    }

    public function purchaser()
    {
        return $this->belongsTo(Contact::class);
    }
}