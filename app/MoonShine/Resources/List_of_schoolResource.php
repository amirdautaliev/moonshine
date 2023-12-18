<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\File;

use MoonShine\Fields\TinyMce;
use App\Models\List_of_school;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class List_of_schoolResource extends Resource
{
	public static string $model = List_of_school::class;

	public static string $title = 'Перечень школ получающих госзаказ';

	public function fields(): array
	{
		return [
        Grid::make([
            Column::make([
                Block::make('',[
                    ID::make()->sortable(),
                    TinyMce::make('Текст_kz','text_kz')
                    ->toolbar('undo redo h1 h2')
                    ->required(),
                    TinyMce::make('Текст_kz','text_kz')
                    ->toolbar('undo redo h1 h2')
                    ->required(),

                ])
            ])
            ->columnSpan('6'),
            Column::make(
                [
                    Block::make('',[
                        TinyMce::make('Текст_kz','text_kz')
                        ->toolbar('undo redo h1 h2'),
                        File::make('File','file')
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
