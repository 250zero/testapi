TestApi

Es Una API de prueba minimalista, desarrollada sin utilizar ningún framework, diseñada para crear y gestionar una lista de contactos.
<br><br>
Estos son los End-points de la api
<br><br>
Para la creacion de un contacto:   
<br><br>
Descripcion: Crea un contacto con sus numeros telefonicos<br>
EndPoint : /contact<br>
Metodo: POST<br>
Parametros / Body:<br>
{<br>
"name": "adalberto",   ---- requerido<br>
"last_name": "turby", ---- requerido<br>
"email": "email",     ---- requerido <br>
"telephone": ["343434343434","829-759-66699"]<br>
}<br>
<br><br>
Descripcion: Agrega un numero telefonico a un contacto<br>
EndPoint : /contact/add-phone<br>
Metodo: POST<br>
Parametros / Body: {<br>
        "phone": "829-666-6666",   ---- requerido<br>
        "id_contact": "10", ---- requerido         <br>
}<br>
<br><br>
Descripcion: Elimina segun configuracion por delete o por estado<br>
EndPoint : /contact<br>
Metodo: DELETE<br>
Parametros / Body: {<br>
        "id_contact":10 ---- requerido<br>
}<br>
<br><br>
Descripcion: Poder ver todos los contactos activos<br>
EndPoint : /contact/list<br>
Metodo: GET<br>
 <br><br>

Descripcion: Poder ver la ficha de un contacto<br>
EndPoint : /contact/detail<br>
Metodo: GET<br>
Parametros / Body: {<br>
        "id_contact": "12",   ---- requerido <br>
}<br>
<br><br>
Aqui dejo el script de Base de datos: <br>
<br>
-- Volcando estructura de base de datos para testapi<br>
CREATE DATABASE IF NOT EXISTS `testapi` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;<br><br>
USE `testapi`;<br><br>

-- Volcando estructura para tabla testapi.contact<br>
CREATE TABLE IF NOT EXISTS `contact` (<br>
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,<br>
  `name` varchar(70) NOT NULL DEFAULT '',<br>
  `last_name` varchar(70) NOT NULL DEFAULT '',<br>
  `email` varchar(70) NOT NULL DEFAULT '',<br>
  `status` tinyint(4) NOT NULL DEFAULT 0,<br>
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),<br>
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),<br>
  PRIMARY KEY (`id_contact`)<br>
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;<br>
 <br>
CREATE TABLE IF NOT EXISTS `telephone` (<br>
  `id_telephone` int(11) NOT NULL AUTO_INCREMENT,<br>
  `id_contact` int(11) NOT NULL DEFAULT 0,<br>
  `phone_number` varchar(70) NOT NULL DEFAULT '',<br>
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),<br>
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),<br>
  PRIMARY KEY (`id_telephone`),<br>
  KEY `FK_contact` (`id_contact`),<br>
  CONSTRAINT `FK_contact` FOREIGN KEY (`id_contact`) REFERENCES `contact` (`id_contact`) ON DELETE CASCADE<br>
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;<br><br>
 <br>
 

