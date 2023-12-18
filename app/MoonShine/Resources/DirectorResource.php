<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Phone;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use App\Models\Board_of_Directors;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\Image;

class DirectorResource extends Resource
{
	public static string $model = Board_of_Directors::class;

	public static string $title = 'Совет директоров';

	public function fields(): array
	{
		return [
            Grid::make([
                Column::make([
                    Block::make('',[
                        ID::make()->sortable(),
                        Text::make('ФИО','name')
                        ->required(),
                        Text::make('Должность','post')
                        ->required(),

                    ])

                ])->columnSpan('6'),
                Column::make([
                    Block::make('',[
                    Phone::make('Телефон','phone')
                    ->mask('+7 (999) 999-99-99')
                    ->required(),
                    Image::make('Фото','image')
                    ->required(),

                    ]),

                    ])->columnSpan('6'),
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
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
