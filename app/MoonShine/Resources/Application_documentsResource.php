<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\TinyMce;

use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use App\Models\Application_documents;
use Illuminate\Database\Eloquent\Model;

class Application_documentsResource extends Resource
{
	public static string $model = Application_documents::class;

	public static string $title = 'Перечень документов, предоставляемых с заявлением';

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
                    TinyMce::make('Текст_ru','text_ru')
                    ->toolbar('undo redo h1 h2')
                    ->required(),
                ])
             ])
             ->columnSpan('6'),
              Column::make([
                Block::make('',[
                    TinyMce::make('Текст_en','text_en')
                    ->toolbar('undo redo h1 h2')
                    ->required(),
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
