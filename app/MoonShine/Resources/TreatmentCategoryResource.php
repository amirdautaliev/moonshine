<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Text;

use App\Models\TreatmentCategory;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class TreatmentCategoryResource extends Resource
{
	public static string $model = TreatmentCategory::class;

	public static string $title = 'Тема категории';

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
            Text::make('Тема_кз','title_kz')
            ->required(),
            Text::make('Тема_ru','title_ru')
            ->required(),
            Text::make('Тема_кз','title_en')
            ->required(),
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
