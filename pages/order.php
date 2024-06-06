<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аренда платья</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <header>
        <h1>Аренда платья</h1>
        <nav>
            <a href="../index.php">Главная</a>
            <a href="order.php">Заказать</a>
        </nav>
    </header>
    <form action="bill.php" method="post" enctype="multipart/form-data">
        <section>
            <h2>Длина</h2>
            <input type="radio" name="dressLength" value="Макси" checked> Макси
            <input type="radio" name="dressLength" value="Макси со шлейфом"> Макси со шлейфом
            <input type="radio" name="dressLength" value="Миди"> Миди
            <input type="radio" name="dressLength" value="Мини"> Мини
        </section>

        <section>
            <h2>Тип платья</h2>
            <select name="dressType">
                <option value="Вечернее">Вечернее</option>
                <optgroup label="Деловое">
                    <option value="Платье">Платье</option>
                    <option value="Брючный костюм">Брючный костюм</option>
                </optgroup>
                
                <option value="На выпускной">На выпускной</option>
            </select>

        </select>
        </section>

        <section>
            <h2>Вид аренды</h2>
            <input type="radio" name="rentalType" value="Фотосессия" checked> Фотосессия
            <input type="radio" name="rentalType" value="Мероприятие"> Мероприятие
        </section>

        <section>
            <h2>Дополнительные услуги</h2>
            <input type="checkbox" name="extraOptions[]" value="Подгонка по фигуре"> Подгонка по фигуре
            <input type="checkbox" name="extraOptions[]" value="Отпаривание"> Отпаривание
            <input type="checkbox" name="extraOptions[]" value="Упаковка"> Упаковка
        </section>

        <section>
            <h2>Ваши данные</h2>
            <input type="text" name="name" placeholder="Имя" required>
            <input type="text" name="adress" placeholder="Адрес" required>
            <input type="text" name="email" placeholder="Электронная почта" required>
            <input type="text" pattern="[0-9]*" name="days" placeholder="Количество дней числом"  required>
        </section>

        <section>
            <h2>Файл с базовыми ценами</h2>
            <input type="file" name="priceList" required>
        </section>

        <button type="submit">Оформить заказ</button>
    </form>
    
    <footer>
        <p>© <?php echo date("Y"); ?> Аренда платья. Все права защищены.</p>
    </footer>
</body>
</html>
