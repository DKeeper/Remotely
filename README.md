```
Тестовое задание для разработчиков Laravel или Yii2.

Назначение: Встраиваемая форма для сайта
Архитектура: SOA
Формат API: JSON-RPC
Описание:  Необходимо реализовать форму встраиваемую на любые контентные страницы  сайта. 
Основной сайт (назовем его site) не имеет БД и запрашивает данные  по протоколу http в 
формате json-rpc у сервиса data. Сервис data и site  должны быть реализованы как отдельные 
проекты.

Структура основного сайта (site):
Сайт  - это отдельный проект на фреймворке Laravel или Yii2. Должен содержать  простой http 
клиент для отправки json-rpc запросов в сервис data, а  также встраиваемый виджет в который 
передается параметр page_uid -  уникальный ID страницы. Виджет должен состоять из формы 
отправки данных  состоящую из любого количества полей на ваше усмотрение (минимум 2), а  
также отображать ранее введенные данные с привязкой к полю page_uid.

Для демонстрации работы задания необходимо наличие 2 разных страниц эмулирующих отображения 
формы и данных.

Структура сервиса data (api):
Сервис  data - это отдельный проект на фреймворке Laravel или Yii2, он стостоит  из API с 
которыми взаимодействует основной сайт. Вы можете использовать  любые БД для хранения 
данных.
Модель data имеет следующие поля: id,  {список ваших изменяемых полей}, page_uid (id 
страницы в формате string)  created (дата добавления).
Вам необходимо реализовать два метода json-rpc: добавление данных, получить данные по 
page_uid.
```

В качестве основы для разработки использовался фреймворк Yii2.

Структура репозитория:
-------------------

      data/           API сервис
      site/           клиентская часть

Подготовка к работе:
-------------------
Необходимо развернуть каждую папку как отдельный проект Yii2, выполнив внутри папки команду

~~~
composer install
~~~

Настройки хостинга стандартные - [Installation guide](https://www.yiiframework.com/doc/guide/2.0/ru/start-installation#configuring-web-servers)

Настройки клиентской части:

Необходимо в конфигурации приложения добавить адрес API сервиса - site/config/params.php
```php
return [
	...
    'service' => [
        'ajaxUrl' => URL_TO_ENDPOINT,
    ],
	...
];
```

URL_TO_ENDPOINT - должен быть настроен на контроллер service (http://url/service или http://url/index.php?r=service)

Клиентская часть
-------------------

Перейти по адресу
http://client_url/index.php?r=site/demo где должна быть доступна форма для отправки запросов к API

Поля форм:
- Select method (Требуемый метод для операции с данными - insert, update, list)
    - insert (Добавление данных)
    - update (Обновление данных)
    - list (Получение списка записей)
- Current page UUID (UUID текущей страницы, при обновлении страницы генерируется случайным образом)
- Extended field #N (Дополнительные поля)

Ниже формы расположен вывод запроса, отправленного с клиента и ответ сервера на запрос
