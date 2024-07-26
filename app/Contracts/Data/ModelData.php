<?php

namespace App\Contracts\Data;

use Illuminate\Contracts\Support\Responsable;
use Spatie\LaravelData\Contracts\AppendableData as AppendableDataContract;
use Spatie\LaravelData\Contracts\BaseData as BaseDataContract;
use Spatie\LaravelData\Contracts\EmptyData as EmptyDataContract;
use Spatie\LaravelData\Contracts\IncludeableData as IncludeableDataContract;
use Spatie\LaravelData\Contracts\ResponsableData as ResponsableDataContract;
use Spatie\LaravelData\Contracts\TransformableData as TransformableDataContract;
use Spatie\LaravelData\Contracts\ValidateableData as ValidateableDataContract;
use Spatie\LaravelData\Contracts\WrappableData as WrappableDataContract;

interface ModelData extends Responsable, AppendableDataContract, BaseDataContract, TransformableDataContract, IncludeableDataContract, ResponsableDataContract, ValidateableDataContract, WrappableDataContract, EmptyDataContract
{

}
