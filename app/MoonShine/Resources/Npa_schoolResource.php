<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Url;

use App\Models\Npa_school;
use MoonShine\Fields\TinyMce;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class Npa_schoolResource extends Resource
{
	public static string $model = Npa_school::class;

	public static string $title = 'НПА';

	public function fields(): array
	{
		return [
            Grid::make([
                Column::make([
                    Block::make('',[
                        ID::make()->sortable(),
                        TinyMce::make('Текст_kz','title_kz')
                        ->toolbar('undo redo h1 h2')
                        ->required(),
                        TinyMce::make('Текст_ru','title_kz')
                        ->toolbar('undo redo h1 h2')
                        ->required(),

                    ])
                ])
                ->columnSpan('6'),
                Column::make(
                    [
                        Block::make('',[
                            TinyMce::make('Текст_en','title_kz')
                            ->toolbar('undo redo h1 h2'),
                            Url::make('Ссылка','link')
                            ->required()
                        ])
                    ])
                    ->columnSpan('6')
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
