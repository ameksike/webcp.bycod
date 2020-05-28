# secretary-elephant
Librería ligera para abstracción de acceso a dato, su distro Elephant está orientada al lenguaje de programación PHP. Pertenece al proyecto Ksike por ello está contenida dentro de dicho espacio de nombres.

```php
	/*
	 * Ejemplo de utilizacion del la biblioteca LcFtp
	 * */
	//... paso 1: definir el espacio de nombres Ksike en el manejador de carga denominado LcFtp
    Carrier::active(array( 'Ksike'=> __DIR__ .'/lib/' ));
    
    //... paso 2: definir los espacios de nombres a utilizar
    use Ksike\lcftp\src\server\Main as LcFtp;
    
   	//... paso 3: cargar las variables de configuracion 
    $cfg = include 'config.php';
   
    //... paso 4: comenzar a utilizar el LcFtp
    $obj = new LcFtp($cfg['ftp']);
    
    //... paso 5: realizar una busqueda por el termino 'ciber' en la raiz del FTP y con 5 niveles de profundidad
    $data = $obj->find('ciber', '/', 5);
    
    //... paso 6: mostrar el resultado
    print_r($data);

```