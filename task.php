<?php

require_once  '/home/user/test/vendor/autoload.php';

use RetailCrm\Api\Factory\SimpleClientFactory;
use RetailCrm\Api\Model\Entity\CustomersCorporate\Company;
use RetailCrm\Api\Model\Entity\Orders\Items\Offer;
use RetailCrm\Api\Model\Entity\Orders\Items\OrderProduct;
use RetailCrm\Api\Model\Entity\Orders\Order;
use RetailCrm\Api\Model\Request\Orders\OrdersCreateRequest;

$client = SimpleClientFactory::createClient(
'https://superposuda.retailcrm.ru', 
'QlnRWTTWw9lv3kjxy1A8byjUmBQedYqb'
);
 
$req = new OrdersCreateRequest();
$order = new Order();
$item = new OrderProduct();
$offer = new Offer();
$company = new Company();

$company->brand = 'Azalita';

$offer->article = 'AZ105R';

$item->productName = 'Маникюрный набор AZ105R Azalita';
$item->offer = $offer;

$order->status = 'trouble';
$order->orderType = 'fizik';
$order->site = 'test';
$order->orderMethod = 'test';
$order->number = '07112000';
$order->firstName = 'Ахмет-Султан';
$order->lastName = 'Алатау';
$order->patronymic = '';
$order->customFields = ['prim' => 'тестовое задание'];
$order->customerComment = 'https://github.com/AAS-Crypt/SuperPosuda_Test';
$order->items = [$item];
$order->company = $company;

$req->order = $order;
$req->site = 'test';

try {
    $response = $client->orders->create($req);
    echo 'Заказ '.$response->id.' создан! ';
} catch (ApiExceptionInterface | ClientExceptionInterface $exception) {
    echo $exception;
    exit(-1);
}

