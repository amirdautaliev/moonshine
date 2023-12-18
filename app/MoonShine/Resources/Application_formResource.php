<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\File;

use MoonShine\Fields\Text;
use MoonShine\Decorations\Grid;
use App\Models\Application_form;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class Application_formResource extends Resource
{
	public static string $model = Application_form::class;

	public static string $title = 'Форма заявления';

	public function fields(): array
	{
		return [
        Grid::make([
            Column::make([
                Block::make('',[
                    ID::make()->sortable(),
                    Text::make('текст_kz','text_kz')
                    ->required(),
                    Text::make('текст_ru','text_kz')
                    ->required()
                ])
            ])
            ->columnSpan('6'),
            Column::make([
                Block::make('',[
                    Text::make('текст_en','text_en'),
                    File::make('Файл','file')
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
