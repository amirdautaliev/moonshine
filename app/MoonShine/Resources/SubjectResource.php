<?php

namespace App\MoonShine\Resources;

use App\Models\Subject;
use MoonShine\Fields\ID;

use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class SubjectResource extends Resource
{
	public static string $model = Subject::class;

	public static string $title = 'Темы';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Тема_kz','subject_kz')
            ->required(),
            Text::make('Тема_ru','subject_ru')
            ->required(),
            Text::make('Тема_en','subject_en')
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
