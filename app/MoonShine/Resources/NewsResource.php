<?php

namespace App\MoonShine\Resources;

use App\Models\News;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class NewsResource extends Resource
{
	public static string $model = News::class;

	public static string $title = 'Новости';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Заголовок_kz','title_kz')
            ->required(),
            Text::make('Заголовок_ru','title_ru')
            ->required(),
            Text::make('Заголовок_ru','title_kz')
            ->required(),
            Text::make('Текст_kz','text_kz')
            ->required(),
            Text::make('Текст_ru','text_ru')
            ->required(),
            Image::make('Фото','image')
            ->dir('news')
            ->required()

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
