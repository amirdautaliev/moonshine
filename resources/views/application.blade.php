<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
</head>
<style>
    body {
        font-family: "DejaVu Sans";
        font-size: 14px;
    }
    .main {
        width: 80%;
        margin: 0 auto;
    }
    /* p {
        text-align: center;
    } */
    .sub-text {
        font-size: 10px;
    }
    .left-indent {
        text-indent: 45px;
    }
    .center {
        text-align: center;
    }
    td {
        text-align: center;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 12px;
    }
    ol {
        list-style-type: none; /* Убираем исходные маркеры */
        counter-reset:  item; /* Обнуляем счетчик списка */
        margin: 0;
    }
    li:before {
        content: counter(item) ') '; /* Добавляем к числам скобку */
        counter-increment: item; /* Задаём имя счетчика */
    }
    .boarding-school-table th, .boarding-school-table td {
        font-size: 10px;
    }
</style>
<body>
<div class="main">
    <div class="top-left">
        <br><br>
        <p style="text-align: right"><b>Форма</b></p>
        <p class="center"><b><i>(при наличии нескольких зданий - заполняется на каждый объект отдельно)</i></b></p>
        <br>
        <p style="text-align: right">
            АО "Финансовый центр"
            <br>
            <span class="sub-text" style="padding-right: 65px;">(наименование оператора)</span>
        </p>
    </div>

    <br><br>

    <p class="center">Заявление</p>
    <br>
    <p class="center">{{ $application->organization_name }}, {{ $application->official_number }}, {{ $application->official_address }}</p>
    <p class="sub-text center">(наименование частной организации образования, БИН, юридический адрес)</p>

    <br>

    <p>просит рассмотреть документы для размещения государственного образовательного заказа на среднее образование.</p>

    <p class="left-indent">Фактический контингент учащихся {{ $application->student_contingent }}</p>
    <p class="sub-text" style="margin-left: 350px;">(городская или сельская школа)</p>
    <p>по состоянию на дату подачи заявления:</p>
    <br>
    @if(json_decode($application->students_data_table))
        <table>
            <tr>
                <td rowspan="2">Классы</td>
                <td rowspan="2">Всего учащихся (человек)</td>
                <td colspan="4">в том числе</td>
            </tr>
            <tr>
                <td>учащиеся общеобразовательных классов</td>
                <td>лица (дети) с особыми образовательными потребностями, обучающиеся в общеобразовательных классах</td>
                <td>учащиеся специальных (коррекционных) классов</td>
                <td>обучающиеся на дому</td>
            </tr>
                @foreach(json_decode($application->students_data_table) as $el)
                    <tr>
                        @foreach($el as $key => $value)
                            @if ($key != 'id')
                                <td>{{ $value }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
        </table>
    @endif
    <br><br><br>
    <p class="left-indent">Прогнозный контингент учащихся на 1 сентября предстоящего учебного года:</p>
    <br>
    @if(json_decode($application->predictive_contingent_data_table))
        <table>
            <tr>
                <td rowspan="2">Классы</td>
                <td rowspan="2">Всего учащихся (человек)</td>
                <td colspan="4">в том числе</td>
            </tr>
            <tr>
                <td>учащиеся общеобразовательных классов</td>
                <td>лица (дети) с особыми образовательными потребностями, обучающиеся в общеобразовательных классах</td>
                <td>учащиеся специальных (коррекционных) классов</td>
                <td>обучающиеся на дому</td>
            </tr>
                @foreach(json_decode($application->predictive_contingent_data_table) as $el)
                    <tr>
                        @foreach($el as $key => $value)
                            @if ($key != 'id')
                                <td>{{ $value }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
        </table>
    @endif
    <br>
    <p class="left-indent">Настоящим сообщаю характеристики объекта организации образования:
        <br>
        <ol>
            <li>местонахождение (адрес) – {{ $application->official_address}};</li>
            <li>проектная мощность – {{ $application->place_count }};</li>
            <li>дата ввода в эксплуатацию – {{ $application->exploitation_year }}.</li>
        </ol>
    </p>
    <p class="left-indent">
        Настоящим подтверждаю следующее:
            <ol>
                <li>размер родительской платы за обучение в частной организации образования не превышает предельный размер родительской платы за обучение утвержденный уполномоченным органом в области образования и составляет {{ $application->tuition_fee }} тенге в год;</li>
                <li>наличие лицензии на занятие образовательной деятельностью по общеобразовательным учебным программам начального, основного среднего, общего среднего образования, выданной по форме, утвержденной приказом Министра национальной экономики Республики Казахстан от 6 января 2015 года № 3 «Об утверждении форм заявлений для получения и переоформления лицензии и (или) приложения к лицензии, форм лицензий и (или) приложений к лицензиям» (зарегистрирован в Реестре государственной регистрации нормативных правовых актов под № 10195);</li>
                <li>обучение осуществляется по (нужное подчеркнуть):</li>
                <p>общеобразовательным учебным программам
                    @if($application->elementary_education) <u>начального</u> @else начального @endif,
                    @if($application->basic_secondary_education) <u>основного среднего</u> @else основного среднего @endif
                    @if($application->basic_general_education) <u>общего среднего</u> @else и общего среднего @endif
                    образования;
                </p>
                <p>самостоятельно разработанным интегрированным образовательным программам, прошедшим авторизацию в Организации Международного Бакалавриата или международную институциональную аккредитацию;</p>
                <li>почтовый адрес: {{ $application->postcode }} и электронная почта {{ $application->email_address }} телефон {{ $application->phone_number }}(для направления уведомления о необходимости устранения несоответствий);</li>
                <li>регистрацию в Национальной образовательной базе данных (НОБД);</li>
                <li>регистрацию на веб-портале государственных закупок;</li>
                <li>{{ $application->boarding_school ? 'Наличие' : 'Отсутствие' }} интерната при школе.</li>
            </ol>
        </p>
        <p class="left-indent">Заполняется частной организацией образования с вновь введенными ученическими местами в объекте частной организации образования, введенными в эксплуатацию после 20 июля 2018 года:</p>
        <p class="left-indent">Количество вновь введенных ученических мест {{ $application->private_organization_place_count }} в объекте частной организации образования, введенном в эксплуатацию после20 июля 2018 года путем {{ $application->private_organization_exploitation_type }}</p>
        <p class="left-indent">Дата ввода в эксплуатацию объекта частной организации образования {{ $application->private_organization_exploitation_year }}.</p>
        <p class="left-indent">Ранее государственный образовательный заказ на вновь введенные ученические места в объекте частной организации образования, введенные в эксплуатацию после 20 июля 2018 года, {{ $application->private_organization_government_order ? 'Размещался' : 'Не размещался' }}.</p>
        <p class="left-indent">Приложение на ___ листах.</p>
        <p class="left-indent">Руководитель</p>
{{--        <p class="left-indent">{{$application->organization_name}}                             ________                        {{$organization->ceo_fullname}}</p>--}}
        <p class="left-indent">{{$application->organization_name}} ________ {{$application->signatory_name}}</p>
{{--        <p class="left-indent sub-text">(наименование частной организации образования)	         (подпись)                         (фамилия, имя, отчество (при наличии))</p>--}}

        <p>Дата {{ now()->format('d.m.Y') }}</p>
        <p>Место печати (при наличии)</p>

    @if($application->boarding_school == 'Есть')
        <br><br><br>
        <p class="center">Приложение к интернату</p>
        <br>
        <p class="left-indent">По состоянию на дату подачи заявления:</p>
        <br>
        <table class="boarding-school-table">
            <tr>
                <td colspan="2">Классы</td>
                <td colspan="2">Всего учащихся (человек)</td>
                <td colspan="4">Учащиеся общеобразовательных классов</td>
                <td colspan="2">Учащиеся специальных (коррекционных) классов</td>
                <td>Обучающиеся на дому</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2">Нормотипичные</td>
                <td colspan="2">Учащиеся с особыми образавательными потребностями</td>
                <td colspan="2">Учащиеся специальных (коррекционных) классов</td>
                <td>Обучающиеся на дому</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td>Дневные</td>
                <td>Интернат</td>
                <td>Дневные</td>
                <td>Интернат</td>
                <td>Дневные</td>
                <td>Интернат</td>
                <td>Дневные</td>
            </tr>
            @foreach(json_decode($application->boarding_school_students_data_table) as $el)
                <tr>
                    @foreach($el as $key => $value)
                        @if($key == 'classSchool' || $key == 'classSummStudents')
                            <td colspan="2">{{ $value }}</td>
                        @elseif ($key != 'id')
                            <td>{{ $value }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
        <br>
        <p class="left-indent">Прогнозный контингент учащихся на 1 сентября предстоящего учебного года:</p>
        <br>
        <table class="boarding-school-table">
            <tr>
                <td colspan="2">Классы</td>
                <td colspan="2">Всего учащихся (человек)</td>
                <td colspan="4">Учащиеся общеобразовательных классов</td>
                <td colspan="2">Учащиеся специальных (коррекционных) классов</td>
                <td>Обучающиеся на дому</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td colspan="2">Нормотипичные</td>
                <td colspan="2">Учащиеся с особыми образавательными потребностями</td>
                <td colspan="2">Учащиеся специальных (коррекционных) классов</td>
                <td>Обучающиеся на дому</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2"></td>
                <td>Дневные</td>
                <td>Интернат</td>
                <td>Дневные</td>
                <td>Интернат</td>
                <td>Дневные</td>
                <td>Интернат</td>
                <td>Дневные</td>
            </tr>
            @foreach(json_decode($application->boarding_school_predictive_contingent_data_table) as $el)
                <tr>
                    @foreach($el as $key => $value)
                        @if($key == 'classSchool' || $key == 'classSummStudents')
                            <td colspan="2">{{ $value }}</td>
                        @elseif ($key != 'id')
                            <td>{{ $value }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    @endif
</div>
</body>
</html>
