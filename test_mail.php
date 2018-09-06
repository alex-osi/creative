<?php
/**
 * Created by PhpStorm.
 * User: raccoon
 * Date: 06.09.18
 * Time: 12:04
 */
$headers = array();
// Для отправки HTML-письма должен быть установлен заголовок Content-type
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';
// Дополнительные заголовки
$headers[] = 'To: enot.work@gmail.com';
$headers[] = 'From: РК Креатив <noreply@agcreative.ru>';

mail(
    'enot.work@gmail.com',
    'Тест почты',
    'Проверяем отправку почты с креатива',
    implode("\r\n", $headers)
);