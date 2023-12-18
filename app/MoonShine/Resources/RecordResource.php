<?php

namespace App\MoonShine\Resources;

use App\Models\Record;
use MoonShine\Fields\ID;

use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Fields\TinyMce;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class RecordResource extends Resource
{
	public static string $model = Record::class;

	public static string $title = 'Запись';

	public function fields(): array
	{
		return [
            Grid::make([
                Column::make([
                    Block::make('',[
                        ID::make()->sortable(),
                        Text::make('Заголовка_кз','title_kz')
                        ->required(),
                        TinyMce::make('Текст_кз','text_kz')
                        ->required(),
                        Text::make('Заголовка_ru','title_ru')
                        ->required(),
                        TinyMce::make('Текст_ru','text_ru')
                        ->required(),

                    ])
                ])
                ->columnSpan('6'),

                Column::make([
                    Block::make('',[
                        Text::make('Заголовка_en','title_en')
                        ->required(),
                        TinyMce::make('Текст_en','text_en')
                        ->required(),
                        Image::make('Фото','image')
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
