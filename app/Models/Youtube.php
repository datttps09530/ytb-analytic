<?php

namespace App\Models;

use App\Traits\HasCompany;
use App\Traits\CustomFieldsTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Purchase\Entities\PurchaseStockAdjustment;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Product
 *
 */
class Youtube extends BaseModel
{

    use HasCompany;
    use HasFactory, CustomFieldsTrait;

    protected $table = 'youtubes';
    const FILE_PATH = 'youtubes';

    protected $fillable = ['name','url','channel_code','region','language','description','email_host_main','email_host','email_management','email_network','profit_sharing_percent','service_account','status','department_id','channel_manager','created_by','network'];

    protected $casts = ['service_account' => 'array'];

    const CUSTOM_FIELD_MODEL = 'App\Models\Youtube';

}
