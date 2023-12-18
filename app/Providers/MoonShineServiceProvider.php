<?php

namespace App\Providers;
use App\MoonShine\Resources\Application_formResource;
use App\MoonShine\Resources\Documents_formsResource;
use App\MoonShine\Resources\Faq_schoolResource;
use App\MoonShine\Resources\Investor_important_document_for_schoolResource;
use App\MoonShine\Resources\Investor_site_map_for_schoolResource;
use App\MoonShine\Resources\Investor_slider_for_schoolResource;
use App\MoonShine\Resources\List_of_schoolResource;
use App\MoonShine\Resources\Npa_schoolResource;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuItem;
use MoonShine\Menu\MenuGroup;
use Illuminate\Support\ServiceProvider;
use App\MoonShine\Resources\NpaResource;
use App\MoonShine\Resources\NewsResource;
use App\MoonShine\Resources\AboutResource;
use App\MoonShine\Resources\Application_documents_of_building_or_reconstructionResource;
use App\MoonShine\Resources\Application_documentsResource;
use App\MoonShine\Resources\RecordResource;
use App\MoonShine\Resources\ResultResource;
use App\MoonShine\Resources\HistoryResource;
use App\MoonShine\Resources\SubjectResource;
use App\MoonShine\Resources\VacancyResource;
use App\MoonShine\Resources\CategoryResource;
use App\MoonShine\Resources\DirectorResource;
use App\MoonShine\Resources\QuestionResource;
use App\MoonShine\Resources\TreatmentResource;
use MoonShine\Resources\MoonShineUserResource;
use App\MoonShine\Resources\CorruptionResource;
use App\MoonShine\Resources\GovernmentResource;
use App\MoonShine\Resources\AutobiographyResource;
use App\MoonShine\Resources\Investor_faq_for_schoolResource;
use App\MoonShine\Resources\Investor_map_for_schoolResource;
use App\MoonShine\Resources\Investor_regionResource;
use App\MoonShine\Resources\SliderResource;
use App\MoonShine\Resources\TreatmentCategoryResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('moonshine::ui.resource.system', [
                MenuItem::make('moonshine::ui.resource.admins_title', new MoonShineUserResource())
                    ->translatable()
                    ->icon('users'),
                MenuItem::make('moonshine::ui.resource.role_title', new MoonShineUserRoleResource())
                    ->translatable()
                    ->icon('bookmark'),
            ])->translatable(),

            MenuGroup::make('Новости', [
                MenuItem::make('Новости', new NewsResource())
                    ->translatable()
                    ])
            ->translatable(),

            MenuGroup::make('Слайдер',[
                MenuItem::make('Слайдер', new SliderResource())
                ->translatable()
            ])->translatable(),

<<<<<<< HEAD
        ])->translatable(),
        MenuGroup::make('moonshine::results.question',[
            MenuItem::make('moonshine::results.question',new QuestionResource())
            ->translatable(),
            MenuItem::make('moonshine::results.subject',new SubjectResource())
            ->translatable()
        ])
            ->translatable(),
            MenuGroup::make('Инвесторы',[
                MenuItem::make('Слайдер для школ',new Investor_slider_for_schoolResource())
                ->translatable(),
                MenuItem::make('Карта обьектов для школ',new Investor_site_map_for_schoolResource())
                ->translatable(),
                MenuItem::make('Добавление регионов общий',new Investor_regionResource())
                ->translatable(),
                MenuItem::make('Добавление на карту для школ',new Investor_map_for_schoolResource())
                ->translatable(),
                MenuItem::make('Важные документы для школ',new Investor_important_document_for_schoolResource())
                ->translatable(),
                MenuItem::make('Вопросы и ответы для школ',new Investor_faq_for_schoolResource())
                ->translatable(),

            ])
                ->translatable()
                
            ]);
 
=======
            MenuGroup::make('Результаты',[
                MenuItem::make('Результаты', new ResultResource())
                ->translatable(),
                MenuItem::make('Категории', new CategoryResource())
                ->translatable()
            ])->translatable(),

            MenuGroup::make('О нас',[
                MenuItem::make('О нас',new AboutResource())
                ->translatable(),
                MenuItem::make('Функционал, история', new HistoryResource())
                ->translatable(),
                MenuItem::make('Совет директоров', new DirectorResource())
                ->translatable(),
                MenuItem::make('Правление', new GovernmentResource())
                ->translatable(),
                MenuItem::make('Противодействие коррупции', new CorruptionResource())
                ->translatable(),
                MenuItem::make('НПА', new NpaResource())
                ->translatable(),
                MenuItem::make('Вакансии', new VacancyResource())
                ->translatable(),
                MenuItem::make('Автобиография',new AutobiographyResource())
                ->translatable(),
                MenuItem::make('Запись',new RecordResource())
                ->translatable(),
                MenuItem::make('Тема категории',new TreatmentCategoryResource())
                ->translatable(),
                MenuItem::make('Обработка обращения',new TreatmentResource())
                ->translatable()
            ])->translatable(),

            MenuGroup::make('Школа',[
                MenuItem::make('Перечень документов и форма заявления',new Documents_formsResource())
                ->translatable(),
                MenuItem::make('Форма заявления',new Application_formResource())
                ->translatable(),
                MenuItem::make('Перечень документов, предоставляемых с заявлением',new Application_documentsResource())
                ->translatable(),
                MenuItem::make('Перечень документов, предоставляемых с заявлением при строительстве/реконструкции',new Application_documents_of_building_or_reconstructionResource())
                ->translatable(),
                MenuItem::make('Перечень школ получающих госзаказ', new List_of_schoolResource())
                ->translatable(),
                MenuItem::make('НПА',new Npa_schoolResource())
                ->translatable(),
                MenuItem::make('FAQ', new Faq_schoolResource())
                ->translatable()
            ])->translatable(),

            MenuGroup::make('Форма подачи вопросов',[
                MenuItem::make('Форма подачи вопросов',new QuestionResource())
                ->translatable(),
                MenuItem::make('Темы',new SubjectResource())
                ->translatable()
            ])->translatable()
        ]);
>>>>>>> 7df38fcb95cd80854a00ca3df144cb8ed188a7e3
    }
}
