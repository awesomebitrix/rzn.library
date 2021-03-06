<?php
 /**
  * ----------------------------------------------------
  * | Автор: Андрей Рыжов (Dune) <info@rznw.ru>         |
  * | Сайт: www.rznw.ru                                 |
  * | Телефон: +7 (4912) 51-10-23                       |
  * | Дата: 01.11.14
  * ----------------------------------------------------
  *
  */
return array(
    'waterfall' => [
        'streams' => [
            'auto_test' => [
                'drops' => [

                    'main' => [
                        'invokable' => 'Rzn\Library\Test\Waterfall\DropMain',
                        'injector' => [
                            'setParams' => [
                                'handler' => 'setter',
                                'options' => [
                                    'set' => 'params',
                                    'params' => ['v1', 'v2'],
                                    'method' => 'setTwoParams'
                                ]
                            ],
                            'setParam' => [
                                'handler' => 'setter',
                                'options' => [
                                    'set' => 'params',
                                    'param' => ['vv1', 'vv2'],
                                    'method' => 'setOneParam'
                                ]
                            ],

                            'interface' => [
                                'handler' => 'initializer',
                            ],

                        ],
                        'stop' => 0, // true для остановки из конфига
                    ],

                    'true'  => ['invokable' => 'Rzn\Library\Test\Waterfall\SetParamsTrue'],
                    'false' => ['invokable' => 'Rzn\Library\Test\Waterfall\SetParamsFalse'],
                    'trueSkip'  => [
                        'invokable' => 'Rzn\Library\Test\Waterfall\SetParamsTrue',
                        'skip' => true
                    ],
                ],
                'route_select' => ['invokable' => 'Rzn\Library\Test\Waterfall\RouteSelect'],
                'routes' => [
                    'no_true' => ['main', 'false']
                ],

                // Включает разделение данных между дропами
                'result_shared' => false,
                // Разделяемые парамтеры и их значения по-умолчанию
                'shared_params' => [
                    'shared1', // Значение по-умолчанию: null
                    'shared2' => 'all' // Значение по-умолчанию: all
                ],

                // Входные параметры по умолчанию.
                'params' => [
                    'input' => 'default'
                ]
            ]
        ]
    ],
    'mediator' => [
        'channels' => [
            // Выборка списка вариантов свойства инфоблока
            'getIBlockPropertyEnum' =>
                [
                    // Подробное описание в классе
                    'invokable' => 'Rzn\Library\BitrixTrial\Iblock\EnumVariantsPropertyHolder',
                    'injector' => [
                        'init' => [
                            'handler' => 'initializer',
                        ],
                    ]
                ],
            /*
             * Установка текущего маркера времени выполнения
             * Возвращает накопленный массив
             * Если в параметрах передать ключ print - возврат отформатированных данных для печати.
             */
            'setTimeMarker' =>
                [
                    // Подробное описание в классе
                    'invokable' => 'Rzn\Library\System\WorkflowTimeMarkersHolder',
                    'injector' => [
                        'init' => [
                            'handler' => 'setter',
                            'options' => [
                                'set' => 'params',
                                'params' => true,
                                'method' => 'setPrint'
                            ]
                        ],
                    ]

                ],

        ]
    ],

    'service_manager' => array(
        'factories' => array(
            'Rzn\Library\Component\HelperManager' => 'Rzn\Library\Component\HelperManagerFactory',
        ),
        'invokables' => array(
            'session'  => 'Rzn\Library\Session',
            'response' => 'Rzn\Library\Response',
            'request'  => 'Rzn\Library\Request',

            'Rzn\Library\EventManager\EventManager' => 'Rzn\Library\EventManager\EventManager',

            'IncludeComponentWithTemplate' => 'Rzn\Library\Component\IncludeWithTemplate',

            'array_container' => 'Rzn\Library\ArrayContainer',
            'test_data'       => 'Rzn\Library\Directory\AsArray'
            ,'cookie'         => 'Rzn\Library\Cookie'
            ,'completion_tasks' => 'Rzn\Library\CompletionTasks'
            ,'mediator'         => 'Rzn\Library\Mediator\Mediator'
            ,'waterfall'        => 'Rzn\Library\Waterfall\WaterfallCollection'
            ,'waterfall_check'  => ['name' => 'Rzn\Library\Waterfall\Check',
                'injector' => [
                    'injectCheck' => [
                        'handler' => 'setter',
                        'options' => [
                            'set' => 'service',
                            'service' => 'injector_check',
                            'method' => 'setInjectorCheck'
                        ]
                    ]
                ]
            ]
            ,'injector'        => 'Rzn\Library\Injector\Injector'
            ,'injector_check'        => 'Rzn\Library\Injector\Check'
            ,'custom_service_managers'  => 'Rzn\Library\ServiceManager\AbstractFactory'
            // Хранилище данных для передачи между участками кода, есил повляется ткая необходомость
            // Первое применение: передача параметогм фильтра от умного фильтра к компоненту списка товаров.
            ,'storage'  => 'Rzn\Library\Storage'
            ,'inner_messages'  => 'Rzn\Library\InnerMessage\Manager'
            ,'iblock_info'     => 'Rzn\Library\BitrixTrial\Iblock\Info'

        ),

        'aliases' => array(
            'helper_manager' => 'Rzn\Library\Component\HelperManager',
            'plugin_manager' => 'Rzn\Library\Component\HelperManager',
            'ComponentIncludeWithTemplate' => 'IncludeComponentWithTemplate',
            'event_manager' => 'Rzn\Library\EventManager\EventManager',
            'inner_message' => 'inner_messages'
        ),

        'initializers' => [
            'Rzn\Library\ServiceManager\InterfaceInitializer'
            , 'Rzn\Library\EventManager\Initializer'
            , 'Rzn\Library\ServiceManager\Initializer\CookieService'
            , 'Rzn\Library\ServiceManager\Initializer\ConfigService'
            , 'Rzn\Library\ServiceManager\Initializer\EventManager'
            , 'Rzn\Library\ServiceManager\Initializer\CompletionTasks'
            , 'Rzn\Library\Injector\Initializer'
            , 'Rzn\Library\Waterfall\Initializer'
            , 'Rzn\Library\Mediator\Initializer'
            , 'Rzn\Library\InnerMessage\Initializer'
        ]
    ),
    'view_helpers' => array (
        'invokables' => array(

            'ajaxbehavior'                 => 'Rzn\Library\Component\Helper\AjaxBehavior',
            'arrayextractvalueswithprefix' => 'Rzn\Library\Component\Helper\ArrayExtractValuesWithPrefix',
            'drawimage'                    => 'Rzn\Library\Component\Helper\DrawImage',
            'drawmaxdimensionforimage'     => 'Rzn\Library\Component\Helper\DrawMaxDimensionForImage',
            'firstexistvalueinarray'       => 'Rzn\Library\Component\Helper\FirstExistValueInArray',
            'getiblockelementpropertyvaluewithcode' => 'Rzn\Library\Component\Helper\GetIblockElementPropertyValueWithCode',
            'getorderpropertywithcode'              => 'Rzn\Library\Component\Helper\GetOrderPropertyWithCode',
            'insertimages'         => 'Rzn\Library\Component\Helper\InsertImages',
            'pluralform'           => 'Rzn\Library\Component\Helper\PluralForm',
            'pr'                   => 'Rzn\Library\Component\Helper\Pr',
            'showerror'            => 'Rzn\Library\Component\Helper\ShowError',
            'shownote'             => 'Rzn\Library\Component\Helper\ShowNote',
            'stringwithwhitespace' => 'Rzn\Library\Component\Helper\StringWithWhiteSpace',

            'url' => 'Rzn\Library\Component\Helper\Url',
            'isAjax' => 'Rzn\Library\Component\Helper\IsAjax',
            'getFileArray' => 'Rzn\Library\Component\Helper\GetFileArray',
            'printOuterLink' => 'Rzn\Library\Component\Helper\PrintOuterLink',
            'truncateHtml' => 'Rzn\Library\Component\Helper\TruncateHtml',
            //'translate' => 'Rzn\Library\Component\Helper\Translate', // todo удалить  - отменил сей хелпер
            'placeholder' => 'Rzn\Library\Component\Helper\Placeholder',
            'config' => 'Rzn\Library\Component\Helper\Config',
            'isPathBeginWith' => 'Rzn\Library\Component\Helper\IsPathBeginWith'
            , 'addCss'        => 'Rzn\Library\Component\Helper\AddCss'
            , 'addJs'        => 'Rzn\Library\Component\Helper\AddJs'
            , 'phoneNumberFormat' => 'Rzn\Library\Component\Helper\PhoneNumberFormat'
            , 'showWithRename' => 'Rzn\Library\Component\Helper\ShowWithRename'
            , 'deleteZerosAfterDotInNumber' => 'Rzn\Library\Component\Helper\DeleteZerosAfterDotInNumber'
        ),
        'aliases' => array(
            'viewFilePath' => 'viewFilesPath'
        ),
        'initializers' => array(
            'Rzn\Library\ServiceManager\InterfaceInitializer'
            , 'Rzn\Library\ServiceManager\Initializer\CookieService'
            , 'Rzn\Library\ServiceManager\Initializer\ConfigService'
        )
    ),

    'injector' => [
        'handlers' => [
            'setter' => ['invokable' => 'Rzn\Library\Injector\Handler\Setter', 'config' => 'injector.setters'],
            'initializer' => ['invokable' => 'Rzn\Library\Injector\Handler\Initializer', 'config' => 'injector.initializers'],
        ],
        'initializers' => [
            'Rzn\Library\ServiceManager\InterfaceInitializer'
            , 'Rzn\Library\EventManager\Initializer'
            , 'Rzn\Library\ServiceManager\Initializer\CookieService'
            , 'Rzn\Library\ServiceManager\Initializer\ConfigService'
            , 'Rzn\Library\ServiceManager\Initializer\EventManager'
            , 'Rzn\Library\ServiceManager\Initializer\CompletionTasks'
            , 'Rzn\Library\Mediator\Initializer'
            , 'Rzn\Library\Waterfall\Initializer'
        ],
        'setters' => [
            'config' => 'Rzn\Library\Injector\Handler\SetterHandler\Config',
            'invokable' => 'Rzn\Library\Injector\Handler\SetterHandler\Invokable',
            'service' => 'Rzn\Library\Injector\Handler\SetterHandler\Service',
            'params' => 'Rzn\Library\Injector\Handler\SetterHandler\Params',
            'custom_service' => 'Rzn\Library\Injector\Handler\SetterHandler\CustomService'
        ]

    ],

    'configurable_event_manager' => [
        'listeners' => [
            'init.post' => array(
                'invokables' => [
                    // Прикрепляет к событиям битрикса конфигурируемые
                    'Rzn\Library\EventListener\BitrixEventsDrive' => 'Rzn\Library\EventListener\BitrixEventsDrive',
                    // Присоединение слушателей событий полностью по правилам битрикса
                    'BitrixDirectEventsDrive' => [
                        'name' => 'Rzn\Library\EventListener\BitrixDirectEventsDrive',
                        'injector' => [
                            'injectConfig' => [
                                'handler' => 'setter',
                                'options' => [
                                    'set' => 'service',
                                    'service' => 'config',
                                    'method' => 'setConfigService'
                                ]
                            ],
                            'injectInjector' => [
                                'handler' => 'setter',
                                'options' => [
                                    'set' => 'service',
                                    'service' => 'injector',
                                    'method' => 'setInjector'
                                ]
                            ]

                        ]
                    ]
                ],
            ),
        ],
        'initializers' => [
            'Rzn\Library\ServiceManager\Initializer\CookieService'
            , 'Rzn\Library\ServiceManager\Initializer\ConfigService'
            , 'Rzn\Library\ServiceManager\InterfaceInitializer'
            , 'Rzn\Library\ServiceManager\Initializer\CompletionTasks'
            , 'Rzn\Library\Mediator\Initializer'
            , 'Rzn\Library\Waterfall\Initializer'
        ]

    ],

    'bitrix_events' => [
        'main' => [
            'OnBeforeProlog' => array(
                // Присоединение конфига из шаблона
                'invokables' => ['Rzn\Library\EventListener\AttachTemplateConfig' =>
                    'Rzn\Library\EventListener\AttachTemplateConfig'],
            )
            , 'OnLocalRedirect' => array(
                'invokables' => [
                    'Rzn\Library\EventListener\ExecuteCompletionTasks' =>
                        'Rzn\Library\EventListener\ExecuteCompletionTasks'
                ]
            )
            , 'OnAfterEpilog' => array(
                'invokables' => [
                    'Rzn\Library\EventListener\ExecuteCompletionTasks' =>
                        'Rzn\Library\EventListener\ExecuteCompletionTasks'
                ]
            )

        ]
    ]


    /*
     * Шаблон для описания слушателей событий.
    'configurable_event_manager' => [
        'listeners' => [
            '<event_name>' => array(
                'invokables' => [],
                'factories'  => [],
                'services'   => []
            )
        ]
    ],
    // Продолжение произвольного события битрикса.
    'bitrix_events' => [
        '<module>' => [
            '<event_name>' => array(
                'invokables' => [],
                'factories'  => [],
                'services'   => []
            )
        ]
    ]

    */


);
