<?php

namespace Unite\Expenses\Models;

use Illuminate\Database\Eloquent\Model;
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

class Expense extends AbstractExpense
{
}