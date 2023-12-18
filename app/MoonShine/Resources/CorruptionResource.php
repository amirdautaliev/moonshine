<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use App\Models\Corruption;

use MoonShine\Fields\TinyMce;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class CorruptionResource extends Resource
{
	public static string $model = Corruption::class;

	public static string $title = 'Противодействие коррупции';

	public function fields(): array
	{
		return [
            Grid::make([
                Column::make([
                    Block::make('',[
                        ID::make()->sortable(),
                        TinyMce::make('Текст_кз','text_kz')
                        ->required(),

                    ]),
                    ])->columnSpan('6'),

                    Column::make([
                        Block::make('',[
                            ID::make()->sortable(),
                            TinyMce::make('Текст_ru','text_ru')
                            ->required(),


                        ]),
                        ])->columnSpan('6'),
                        Column::make([
                            Block::make('',[
                                ID::make()->sortable(),
                                TinyMce::make('Текст_en','text_en')
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
