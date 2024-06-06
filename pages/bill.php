<?php
    $dressType;
    $dressTypePrice = 0;
    $dressTypeInfo ="";


    $lengthPrice = 0;
    $basePrices = [];
    $days;
    $email;
    $name;
    $adress;

    $rentalType;
    $rentalTypePrice = 0;
    $rentalTypeInfo ="";

    $extraOptions = [];
    $extraOptionsLine = "";
    $extraOptionsPrice = 0;
    $extraOptionsPriceLine = "";
    


    //Базовые цены
    if (isset($_FILES['priceList']) && !empty($_FILES['priceList']['name'])) {
        $fileName = $_FILES['priceList']['name'];
        $fileContent = file('../txt/' . $fileName);
        $length = count($fileContent);
        for ($i = 0; $i < $length; $i++) {
            // Разделяем строку на части по тире
            $parts = explode('-', $fileContent[$i]);
            if (count($parts) == 2){
                $basePrices[] = trim($parts[1]);
            }
        }
    } else {
        $basePrices[0] = 0;
        $basePrices[1] = 0;
    }
    //Цена за длину платья
    if(isset($_POST['dressLength'])){
        $dressLength = $_POST['dressLength'];
        switch($dressLength){
            case "Макси": 
                $lengthPrice = 100;
                break;
            case "Макси со шлейфом": 
                $lengthPrice = 150;
                break;
            case "Миди": 
                $lengthPrice = 50;
                break;
            case "Мини": 
                $lengthPrice = 0;
                break;
        }
    }
    //Цена за тип платья
    if(isset($_POST['dressType'])){
        $dressType = $_POST['dressType'];
        switch($dressType){
            case "Вечернее": 
                $dressTypePrice = 100;
                $dressTypeInfo = "Сочетание изысканного кружева и мягкой, плавно падающей ткани делает это платье воплощением роскоши и изящества.";
                break;
            case "Платье": 
                $dressTypePrice = 50;
                $dressTypeInfo = "Идеально подходит как для особых случаев, так и для повседневной носки.";
                break;
            case "Брючный костюм": 
                $dressTypePrice = 50;
                $dressTypeInfo = "Используются материалы первого класса премиум, эти материалы отличаются мягкостью и приятной текстурой на ощупь.";
                break;
            case "На выпускной": 
                $dressTypePrice = 10;
                $dressTypeInfo = " Элегантный дизайн сочетается с изысканными деталями, создавая великолепное впечатление.";
                break;
        }
    }
    //Цена за тип аренды(множитель)
    if(isset($_POST['rentalType'])){
        $rentalType = $_POST['rentalType'];
        switch($rentalType){
            case "Фотосессия": 
                $rentalTypePrice = 1;
                $rentalTypeInfo = "Клиент имеет право использовать фотографии исключительно для личного пользования и социальных сетей с указанием авторства.";
                break;
            case "Мероприятие": 
                $rentalTypePrice = 1.5;
                $rentalTypeInfo = "Возможно будет на улице";
                break;
        }
    }
    //Цена за дополнительные услуги
    if(isset($_POST['extraOptions'])){
        $extraOptions = $_POST['extraOptions'];
        foreach($extraOptions as $option){
            switch($option){
                case "Подгонка по фигуре": 
                    $extraOptionsPrice += 100;
                    $extraOptionsLine .= $option."<br>";
                    $extraOptionsPriceLine .= "100 рублей<br>";
                    break;
                case "Отпаривание": 
                    $extraOptionsPrice += 150;
                    $extraOptionsLine .= $option."<br>";
                    $extraOptionsPriceLine .= "150 рублей<br>";
                    break;
                case "Упаковка": 
                    $extraOptionsPrice += 50;
                    $extraOptionsLine .= $option."<br>";
                    $extraOptionsPriceLine .= "50 рублей<br>";
                    break;
            }
        }
        
    }
    //Кол-во дней
    if(isset($_POST['days'])){
        $days = $_POST['days'];
    }
    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }
    if(isset($_POST['adress'])){
        $adress = $_POST['adress'];
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    $finalRentalPrice = ($basePrices[0] + $dressTypePrice + $lengthPrice)* $rentalTypePrice;
    $finalServicesPrice = $basePrices[1] + $extraOptionsPrice;
    $finalPrice = ($finalRentalPrice + $finalServicesPrice)*$days;
    $rubles = intval($finalPrice);
    $kop = $finalPrice - $rubles; 
?>


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
    <div class="tableContainer">
        <h2>Аренда платья</h2>
        <h2>Базовая цена аренды <?php echo $basePrices[0]; ?></h2>
        <h2>Базовая цена услуг <?php echo $basePrices[1]; ?></h2>

        <table class="tableDress" border="2">
        <col style="width: 20%">
        <col style="width: 15%">
        <col style="width: 65%">
            <tr>
                <td>Тип платья</td>
                <td><?php echo $dressType?></td>
                <td>Наценка: <?php echo $dressTypePrice?> рублей<br><?php echo $dressTypeInfo?></td>
            </tr>
            <tr>
                <td>Длина</td>
                <td><?php echo $dressLength?></td>
                <td>Наценка: <?php echo $lengthPrice?> рублей</td>
            </tr>
            <tr>
                <td>Дополнительные услуги</td>
                <td><?php echo $extraOptionsLine?></td>
                <td><?php echo $extraOptionsPriceLine?></td>
            </tr>
            <tr>
                <td>Вид аренды</td>
                <td colspan="2"> <?php echo $rentalType?><br><?php echo $rentalTypeInfo ?></td>
            </tr>
            <tr>
                <td>Имя заказчика</td>
                <td colspan="2"><?php echo $name?></td>
            </tr>
            <tr>
                <td>Адрес</td>
                <td colspan="2"><?php echo $adress?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td colspan="2"><?php echo $email?></td>
            </tr>
            <tr>
                <td>Количество дней</td>
                <td colspan="2"><?php echo $days?></td>
            </tr>
            <tr>
                <td>Итого</td>
                <td colspan="2">Цена за <?php echo $days?> дней аренды <?php echo $rubles?> рублей <?php echo $kop?> коп.</td>
            </tr>
        </table>
    </div>
    
    <footer>
        <p>© <?php echo date("Y"); ?> Аренда платья. Все права защищены.</p>
    </footer>
</body>
</html>