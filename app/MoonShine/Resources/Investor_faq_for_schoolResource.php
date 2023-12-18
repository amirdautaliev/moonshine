<?php

namespace App\MoonShine\Resources;

use MoonShine\Fields\ID;
use MoonShine\Fields\TinyMce;

use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;
use App\Models\Investor_faq_for_school;
use Illuminate\Database\Eloquent\Model;

class Investor_faq_for_schoolResource extends Resource
{
	public static string $model = Investor_faq_for_school::class;

	public static string $title = 'Вопросы и ответы для школ';

	public function fields(): array
	{
        return [
            Grid::make([
                Column::make([
                    Block::make('',[
                        ID::make()->sortable(),
                        TinyMce::make('Вопрос_kz','question_kz')
                        ->toolbar('undo redo h1 h2')
                        ->required(),
                        TinyMce::make('Ответ_kz','answer_kz')
                        ->toolbar('undo redo h1 h2')
                        ->required(),
                        
                    ])
                ])
                ->columnSpan('6'),
                Column::make(
                    [
                        Block::make('',[
                            TinyMce::make('Вопрос_ru','question_ru')
                            ->toolbar('undo redo h1 h2'),
                            TinyMce::make('Ответ_ru','answer_ru')
                            ->toolbar('undo redo h1 h2'),
                        ])
                    ])
                    ->columnSpan('6'),
                    Column::make(
                        [
                            Block::make('',[
                                TinyMce::make('Вопрос_en','question_en')
                                ->toolbar('undo redo h1 h2'),
                                TinyMce::make('Ответ_en','answer_en')
                                ->toolbar('undo redo h1 h2'),
                            ])
                        ])
                   
                            
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
