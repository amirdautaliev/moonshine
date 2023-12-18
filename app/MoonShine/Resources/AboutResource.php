<?php

namespace App\MoonShine\Resources;

use App\Models\About;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;

class AboutResource extends Resource
{
	public static string $model = About::class;

	public static string $title = 'О нас';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Заголовка_кз','text_kz')
            ->required(),
            Text::make('Заголовка_ru','text_ru')
            ->required(),
            Text::make('Заголовка_en','text_en')
            ->required(),
            Image::make('image','image')
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
