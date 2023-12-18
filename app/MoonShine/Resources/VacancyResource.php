<?php

namespace App\MoonShine\Resources;

use App\Models\Vacancy;
use MoonShine\Fields\ID;
use MoonShine\Fields\Date;

use MoonShine\Fields\Enum;
use MoonShine\Fields\File;
use MoonShine\Fields\Text;
use App\Enums\VacancyStatus;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Filters\DateFilter;
use MoonShine\Resources\Resource;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Actions\FiltersAction;
use MoonShine\Filters\DateRangeFilter;
use Illuminate\Database\Eloquent\Model;

class VacancyResource extends Resource
{
	public static string $model = Vacancy::class;

	public static string $title = 'Вакансии';

	public function fields(): array
	{
		return [
            Grid::make([
                Column::make([
                    Block::make('',[
                        ID::make()->sortable(),
                        Text::make('Должность','post')
                        ->required(),
                        Date::make('От','from')
                        ->required()
                        ->format('d.m.Y'),
                        Date::make('По','to')
                        ->required()
                        ->format('d.m.Y'),
                        Enum::make('Status','status')->attach(VacancyStatus::class),
                        File::make('file','file')
                    ])
                ])
            ])

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
        return [
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
