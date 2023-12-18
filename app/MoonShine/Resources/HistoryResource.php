<?php

namespace App\MoonShine\Resources;

use App\Models\History;
use MoonShine\Fields\ID;

use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\TinyMce;

class HistoryResource extends Resource
{
	public static string $model = History::class;

	public static string $title = 'Функционал, история';



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
