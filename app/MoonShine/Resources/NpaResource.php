<?php

namespace App\MoonShine\Resources;

use App\Models\Npa;
use MoonShine\Fields\ID;

use MoonShine\Fields\File;
use MoonShine\Fields\TinyMce;
use MoonShine\Decorations\Grid;
use MoonShine\Trix\Fields\Trix;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Quill\Fields\Quill;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class NpaResource extends Resource
{
	public static string $model = Npa::class;

	public static string $title = 'НПА';

	public function fields(): array
	{
		return [
            Grid::make([
                Column::make([
                    Block::make('',[
                        ID::make()->sortable(),
                        Trix::make('текст_кз','text_kz')
                        ->required(),
                        Trix::make('текст_ru','text_ru')
                        ->required()

                    ])

                ])
                ->columnspan('6'),
                Column::make([
                    Block::make('',[
                        Trix::make('текст_en','text_en')
                        ->required(),
                        File::make('Файл','file')
                        ->required()

                    ])
                ])
                ->columnspan('6')
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
