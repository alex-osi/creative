<?php
try {
  $email = 'x_batman@mail.ru,enot.work@gmail.com,kuzmin_antony@mail.ru'; // адрес куда отправлять письмо, можно несколько через запятую
  $subject = 'Новое сообщение с сайта '.$_SERVER['HTTP_HOST']; // тема письма с указанием адреса сайта
  $message = 'Данные формы:'; // вводная часть письма

  $client_email = ''; // поле откуда брать адрес клиента
  $client_message = ''; // текст письма, которое будет отправлено клиенту
  $fields = "";
  foreach($_POST as $key => $value){
    if($value === 'on'){ $value = 'Да'; }
    if($key === 'sendto'){
      $email = $value;
    } elseif($key === 'required_fields'){
      $required = explode(',', $value);
    } else {
      if(in_array($key, $required) && $value === ''){ echo 'ERROR_REQUIRED'; die(); }
      if(is_array($value)){
        $fields .= str_replace('_',' ',$key).': <b>'.implode(', ', $value).'</b> <br />';
      }else{
        if($value !== ''){
            if ($key == 'Форма') {
                switch ($value) {
                    case "form 4":
                        $value = "заказать звонок";
                        break;
                    case "form 1":
                    case "form 2":
                    case "form 3":
                        $value = "ПОЛУЧИТЕ БЕСПЛАТНЫЙ ДИЗАЙН МАКЕТ И РАССРОЧКУ ПЛАТЕЖА";
                        break;
                    case "form 5":
                        $value = "ЗАПРОСИТЬ ПРАЙС: " . $_POST['title'];
                        break;
                }
            }
            $fields .= str_replace('_',' ',$key).': <b>'.$value.'</b> <br />';
        }
      }
    }
  }
  sendEmail($email, $subject, $message.'<br>'.$fields);

  if (isset($_POST['Имя']) && isset($_POST['Номер'])) {
    megaplan(preg_replace('/[^0-9]/', '', $_POST['Номер']), $_POST['Имя']);
  }
} catch (\Exception $e) {
  echo $e->getMessage();
}

function megaplan($phoneNumeral, $name) {

  $_config = array(
    // Доступ к Мегаплану
      'megaplan' => array(
          'host' => 'agcreative.megaplan.ru',
          'login' => 'x_batman@mail.ru',
          'password' => 'lioli9'
      ),

      'callback_email' => 'x_batman@mail.ru'
  );

  // Megaplan API
  // Подключаем библиотеку API
  include('api/megaplan/Request.php');

  // Авторизуемся в Мегаплане
  $request = new SdfApi_Request( '', '', $_config['megaplan']['host'], true );
  $response = json_decode(
      $request->get(
          '/BumsCommonApiV01/User/authorize.api',
          array(
              'Login' => $_config['megaplan']['login'],
              'Password' => md5( $_config['megaplan']['password'] )
          )
      )
  );

  // Получаем AccessId и SecretKey
  $accessId = $response->data->AccessId;
  $secretKey = $response->data->SecretKey;

  // Переподключаемся с полученными AccessId и SecretKey
  unset( $request );
  $request = new SdfApi_Request( $accessId, $secretKey, $_config['megaplan']['host'], true );
  // Создаем клиента
  $nameParts = explode(" ", $name);
  $firstName = $nameParts[0];
  $lastName = ( isset($nameParts[1]) ? $nameParts[1] : 'Неуказано' );
  $middleName = ( isset($nameParts[2]) ? $nameParts[2] : 'Неуказано' );
  if (strlen($phoneNumeral) == 11) {
    $phone = 'ph_m-' . $phoneNumeral[0] . '-' . $phoneNumeral[1].$phoneNumeral[2].$phoneNumeral[3] . '-'
        . $phoneNumeral[4].$phoneNumeral[5].$phoneNumeral[6].$phoneNumeral[7].$phoneNumeral[8].$phoneNumeral[9].$phoneNumeral[10];
  } else {
    $phone = 'ph_w-7-3952-' . $phoneNumeral;
  }
  $phone .= chr(9) . "Запрос с сайта";
  $result = $request->post( '/BumsCrmApiV01/Contractor/save.api',
      array(
          'Model[TypePerson]' => 'human', //Тип клиента
          'Model[FirstName]' => $firstName, //Имя, обязательное
          'Model[LastName]' => $lastName, //Фамилия, обязательное
          'Model[MiddleName]' => $middleName, //Отчество, обязательное
          'Model[Phones]' => array($phone)
      )
  );
}

function sendEmail($to, $subject, $content){

  $refer = getReferer();
  $utm = getUtmString();
  if ($utm) {
    $content .= "<br /><b>UTM-метка:</b> " . $utm;
  }
  if ($refer) {
    $content .= "<br /><b>Источник:</b> " . defineRefer($refer);
    $content .= "<br /><b>Рефер:</b> " . $refer;
  }

  $headers = array();
  // Для отправки HTML-письма должен быть установлен заголовок Content-type
  $headers[] = 'MIME-Version: 1.0';
  $headers[] = 'Content-type: text/html; charset=utf-8';
  // Дополнительные заголовки
  $headers[] = 'To: ' . $to;
  $headers[] = 'From: РК Креатив <noreply@agcreative.ru>';

  mail($to, $subject, $content, implode("\r\n", $headers));
  echo('success');
}

function reArrayFiles(&$file_post) {
  if($file_post === null){ return false; }
  $files_array = array();
  $file_count = count($file_post['name']);
  $file_keys = array_keys($file_post);
  for ($i=0; $i<$file_count; $i++) {
    foreach ($file_keys as $key) {
      $files_array[$i][$key] = $file_post[$key][$i];
    }
  }
  return $files_array;
}

function getReferer()
{
  if (isset($_SERVER['HTTP_REFERER']) && substr($_SERVER['HTTP_REFERER'], 0, 17 ) != 'http://www.agcreative.ru') {
    return $_SERVER['HTTP_REFERER'];
  } else if (isset($_COOKIE['externalRefer'])) {
    return $_COOKIE['externalRefer'];
  } else return null;
}

function getUtm()
{
  $utmTitles = array('utm_source','utm_medium','utm_campaign','utm_content','utm_term');
  $utm = array();
  foreach ( $utmTitles AS $title) {
    if (isset($_GET[$title])) $utm[$title] = $_GET[$title];
    else if (isset($_COOKIE[$title])) $utm[$title] = $_COOKIE[$title];
  }
  return $utm;
}

function getUtmString()
{
  $utm = getUtm();
  if (empty($utm)) return null;
  else {
    $string = "";
    foreach ($utm AS $title => $value) {
      $string .= $title . " => " . $value . "; ";
    }
  }
  return $string;
}

function defineRefer($refer)
{
  $arr = array(
      'ya.ru/' => 'Yandex',
      'yandex.ru/' => 'Yandex',
      'google.ru/' => 'Google'
  );
  $refer = str_replace("http://", "", $refer);
  $refer = str_replace("https://", "", $refer);
  $refer = str_replace("www.", "", $refer);
  foreach ($arr AS $link => $name) {
    if ( substr($refer, 0, strlen($link) ) == $link ) return $name;
  }

  return 'Не определен';
}