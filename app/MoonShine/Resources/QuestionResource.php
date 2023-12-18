<?php

namespace App\MoonShine\Resources;

use App\Models\Question;
use MoonShine\Fields\ID;

use MoonShine\Fields\Text;
use MoonShine\Fields\Phone;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\SwitchBoolean;

class QuestionResource extends Resource
{
	public static string $model = Question::class;

	public static string $title = 'Форма подачи вопросов';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Фио','name')
            ->required(),
            Phone::make('Телефон','phone')
            ->required()
            ->mask('+7 (999) 999-99-99'),
            BelongsTo::make('Тема','subject','subject_ru')
            ->required(),
            Text::make('Запросы','query')
            ->required(),
            SwitchBoolean::make('Cтатус','status')
            ->required()
            ->autoUpdate()
            ->Sortable()

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
