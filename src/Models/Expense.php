<?php

namespace Unite\Expenses\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Unite\Tags\HasTags;
use Unite\Transactions\Traits\HasTransactions;
use Unite\Contacts\Models\Contact;
use Unite\UnisysApi\Helpers\CustomProperty\HasCustomProperty;
use Unite\UnisysApi\Helpers\CustomProperty\HasCustomPropertyTrait;

class Expense extends Model implements HasMedia, HasCustomProperty
{
    use LogsActivity;
    use HasTransactions;
    use HasMediaTrait;
    use HasCustomPropertyTrait;
    use HasTags;

    protected $table = 'expenses';

    protected $fillable = [
        'type', 'name', 'number', 'supplier_id', 'purchaser_id', 'date_issue', 'date_supply', 'date_due',
        'variable_symbol', 'specific_symbol', 'description', 'custom_properties'
    ];

    protected $casts = [
        'custom_properties' => 'array',
    ];

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

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
