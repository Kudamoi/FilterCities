<?php
define("mysql", mysqli_connect('localhost', 'root', '12345', 'cities'));

if (isset($_GET['generate']) && $_GET['generate'] === 'true') {
    $list = [
        'Пуна (Индия)',
        'Нью-Йорк (США)',
        'Киото (Япония)',
        'Манагуа (Никарагуа)',
        'Бангкок (Тайланд)',
        'Куала-Лумпур (Малайзия)',
        'Пномпень (Камбоджа)',
        'Тбилиси (Грузия)',
        'Сурабая (Индонезия)',
        'Тяньцзинь (Китай)',
        'Барселона (Испания)',
        'Лондон (Великобритания)',
        'Карачи (Пакистан)',
        'Мадрид (Испания)',
        'Сан-Диего (США)',
        'Майами (США)',
        'Колката (Индия)',
        'Ченнаи (Индия)',
        'Гуанчжоу (Китай)',
        'Сингапур (Сингапур)',
        'Портленд (США)',
        'Бангкок (Тайланд)',
        'Бангалор (Индия)',
        'Атланта (США)',
        'Токио (Япония)',
        'Дакка (Бангладеш)',
        'Хошимин (Вьетнам)',
        'Ченнаи (Индия)',
        'Бухарест (Румыния)',
        'Лахор (Пакистан)',
        'Сан-Диего (США)',
        'Бостон (США)',
        'Фукуока (Япония)',
        'Париж (Франция)',
        'Вена (Австрия)',
        'Нанкин (Китай)',
        'Нью-Дели (Индия)',
        'Богота (Колумбия)',
        'Медан (Индонезия)',
        'Киото (Япония)',
        'Куала-Лумпур (Малайзия)',
        'Тяньцзинь (Китай)',
        'Тегеран (Иран)',
        'Кобе (Япония)',
        'Монреаль (Канада)',
        'Бандунг (Индонезия)',
        'Каир (Египет)',
        'Прага (Чехия)',
        'Исламабад (Пакистан)',
        'Ухань (Китай)',
        'Токио (Япония)',
        'Буэнос-Айрес (Аргентина)',
        'Бейрут (Ливан)',
        'Дакка (Бангладеш)',
        'Бангкок (Тайланд)',
        'Хошимин (Вьетнам)',
        'Берлин (Германия)',
        'Лахор (Пакистан)',
        'Вашингтон (США)',
        'Лондон (Великобритания)',
        'Найроби (Кения)',
        'Чикаго (США)',
        'Нанкин (Китай)',
        'Тайбэй (Тайвань)',
        'Аккра (Гана)',
        'Атланта (США)',
        'Мадрид (Испания)',
        'Манила (Филиппины)',
        'Финикс (США)',
        'Джакарта (Индонезия)',
        'Бейрут (Ливан)',
        'Санкт-Петербург (Россия)',
        'Денвер (США)',
        'Шанхай (Китай)',
        'Рим (Италия)',
        'Киото (Япония)',
        'Тегеран (Иран)',
        'Сеул (Республика Корея)',
        'Ханой (Вьетнам)',
        'Джайпур (Индия)',
        'Чикаго (США)',
        'Осака (Япония)',
        'Монреаль (Канада)',
        'Нью-Йорк (США)',
        'Ченнаи (Индия)',
        'Барселона (Испания)',
        'Сидней (Австралия)',
        'Майами (США)',
        'Прага (Чехия)',
        'Богота (Колумбия)',
        'Каир (Египет)',
        'Гуанчжоу (Китай)',
        'Брюссель (Бельгия)',
        'Бандунг (Индонезия)',
        'Тунис (Тунис)',
        'Сендай (Япония)',
        'Джайпур (Индия)',
        'Сан-Хосе (Коста-Рика)',
        'Париж (Франция)',
        'Бостон (США)',
        'Пномпень (Камбоджа)',
        'Дакка (Бангладеш)',
        'Саппоро (Япония)',
        'Стокгольм (Швеция)',
        'Кобе (Япония)',
        'Джакарта (Индонезия)',
        'Хайдарабад (Индия)',
        'Сан-Паулу (Бразилия)',
        'Тегеран (Иран)',
        'Стамбул (Турция)',
        'Саитама (Япония)',
        'Баку (Азербайджан)',
        'Екатеринбург (Россия)',
        'Тяньцзинь (Китай)',
        'Гуанчжоу (Китай)',
        'Мадрид (Испания)',
        'Ниигата (Япония)',
        'Будапешт (Венгрия)',
        'Карачи (Пакистан)',
        'Вашингтон (США)',
        'Пуна (Индия)',
        'Буэнос-Айрес (Аргентина)',
        'Бейрут (Ливан)',
        'Сидней (Австралия)',
        'Аккра (Гана)',
        'Рио-де-Жанейро (Бразилия)',
        'Берлин (Германия)',
        'Джайпур (Индия)',
        'Монреаль (Канада)',
        'Дакка (Бангладеш)',
        'Тунис (Тунис)',
        'Сиань (Китай)',
        'Сеул (Республика Корея)',
        'Мадрид (Испания)',
        'Хайдарабад (Индия)',
        'Шанхай (Китай)',
        'Санкт-Петербург (Россия)',
        'Стамбул (Турция)',
        'Рим (Италия)',
        'Харьков (Украина)',
    ];

    function concat($acc, $el): string
    {
        return $acc .= (mb_strlen($acc) ? ', ' : ' ') . "('$el')";
    }

    $query = "INSERT INTO cities (name) VALUES " . array_reduce($list, "concat", '');
    mysqli_query(mysql, "CREATE TABLE IF NOT EXISTS cities (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, name VARCHAR(64));");
    mysqli_query(mysql, $query);
}

$query = "SELECT * FROM cities";

if (isset($_GET['query'])) {
    $paramsQuery = $_GET['query'];
    $query .= " WHERE LOWER(name) LIKE '%$paramsQuery%'";
}

$result = mysqli_query(mysql, $query);

echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));