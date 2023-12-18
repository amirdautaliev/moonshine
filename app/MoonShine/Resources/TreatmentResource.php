<?php

namespace App\MoonShine\Resources;

use DateTime;
use MoonShine\Fields\ID;
use App\Models\Treatment;

use MoonShine\Fields\Text;
use MoonShine\Fields\BelongsTo;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use Illuminate\Database\Eloquent\Model;
use MoonShine\ItemActions\ItemAction;

class TreatmentResource extends Resource
{
	public static string $model = Treatment::class;

	public static string $title = 'Обработка обращения';
    public static array $activeActions = ['show', 'edit', 'delete'];
    protected bool $showInModal = true;
    protected bool $itemAction = true;


	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            BelongsTo::make('Категория обращения','treatment_category_id','title_ru'),
            Text::make('Описание','description'),
            Text::make('Фамилия','first_name'),
            Text::make('Имя','middle_name'),
            Text::make('Отчество','last_name')
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


