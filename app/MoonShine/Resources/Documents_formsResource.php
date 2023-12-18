<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\Url;
use MoonShine\Fields\File;
use MoonShine\Fields\Image;
use MoonShine\Fields\TinyMce;
use App\Models\Documents_forms;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class Documents_formsResource extends Resource
{
	public static string $model = Documents_forms::class;

	public static string $title = 'Перечень документов и форма заявления';

	public function fields(): array
	{
		return [
		    Grid::make([
                Column::make([
                    Block::make('',[
                        ID::make('id')->sortable(),
                        TinyMce::make('Текст_кз','text_kz')
                        ->toolbar('undo redo h1 h2')
                        // Переопределить набор toolbar
                        ->required(),
                        TinyMce::make('Текст_ru','text_ru')
                        ->toolbar('undo redo h1 h2')
                        // Переопределить набор toolbar
                        ->required(),
                        Image::make('Фото','image')
                        ->required(),

                    ])
                ])
                ->columnSpan('6'),

                Column::make([
                    Block::make('',[
                        TinyMce::make('Текст_en','text_en')
                        ->toolbar('undo redo h1 h2')
                        // Переопределить набор toolbar
                        ->required(),
                        File::make('Файл_кз','file_kz')
                        ->required(),
                        File::make('Файл_ru','file_ru')
                        ->required(),
                        Url::make('Ссылка_кз','link_kz')
                        ->required(),
                        Url::make('Ссылка_ru','link_ru')
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
