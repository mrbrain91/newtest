<nav class="navbar navbar-inverse navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="main.php">ORTOSAVDO</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="#"></a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Продажи</a>
        <ul class="dropdown-menu">
          <li><a href="order.php">Заказ</a></li>
          <li><a href="archive_order.php">Архив заказов</a></li>
          <li><a href="deleted_order.php">Удалённые заказы</a></li>
          <li><a href="return.php">Возврат</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Склад</a>
        <ul class="dropdown-menu">
          <!-- <li><a href="#">Склад</a></li> -->
          <li><a href="in_store.php">Приход на склад</a></li>
          <!-- <li><a href="#">Возврат поставщику</a></li> -->
          <li><a href="rest.php">Остатки</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Финансы</a>
        <ul class="dropdown-menu">
          <li><a href="settlements_clients.php">Вызаиморасчеты с клиентами</a></li>
          <li><a href="prepayment_list.php">Оплаты от контрагентов</a></li>
          <!-- <li><a href="#">Вызаиморасчеты с поставщиками</a></li> -->
          <!-- <li><a href="#">Оплаты поставщиком</a></li> -->
          <li><a href="#">Приход</a></li>
          <li><a href="#">Расход</a></li>
          <li><a href="#">Акт-сверки</a></li>
          <li><a href="#">Оплаты</a></li>


        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Справочник</a>
        <ul class="dropdown-menu">
          <li><a href="#"></a></li>
          <li><a href="counterparties.php">Контрагенты</a></li>
          <li><a href="products.php">Продукт</a></li>
          <li><a href="price.php">Цена</a></li>
          <li><a href="users.php">Пользователи</a></li>
          <!-- <li><a href="#">Роль</a></li> -->
        </ul>
      </li>
     
    </ul>
    <ul class="nav navbar-nav navbar-right r15" data-toggle="modal" data-target="#exampleModal">
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Выйти</a></li>
    </ul>
  </div>
</nav>