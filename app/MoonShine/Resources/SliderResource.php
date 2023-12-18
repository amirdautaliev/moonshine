<?php

namespace App\MoonShine\Resources;

use App\Models\slider;

use MoonShine\Fields\ID;
use MoonShine\Fields\Url;
use MoonShine\Fields\Image;
use MoonShine\Fields\TinyMce;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class SliderResource extends Resource
{
	public static string $model = slider::class;

	public static string $title = 'Слайдер';

    public static int $itemsPerpage = 10;

	public function fields(): array
	{
		return [
            Grid::make([
                Column::make([
                    Block::make('',[
                        ID::make()->sortable(),
                        TinyMce::make('Текст_kz','text_kz')
                        ->required(),
                        TinyMce::make('Текст_ru','text_ru')
                        ->required()



                    ]),



                ])->columnSpan(6),


                    Column::make([
                        Block::make('',[
                            TinyMce::make('Текст_en','text_en')
                            ->required(),
                            Url::make('link','link')
                            ->copy()
                            ->required(),

                        ]),


                ])->columnSpan(6),

            Column::make([
                Block::make('',[

                Image::make('image')
                ->required()
            ]),

        ]),
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
