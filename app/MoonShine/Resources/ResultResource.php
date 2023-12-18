<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Result;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Text;

class ResultResource extends Resource
{
	public static string $model = Result::class;

	public static string $title = 'Результаты';

    protected bool $createInModel = true;

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Количество','quantity')
            ->required(),
            BelongsTo::make('category','category','text_ru')
            ->required()

        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }


}
