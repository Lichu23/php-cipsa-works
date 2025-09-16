<?php
if (file_exists(__DIR__ . '/../entidades/producto.class.php')) {
    require_once __DIR__ . '/../entidades/producto.class.php';
}

class Datos {
    public static function obtenerPrecios($id) {
        $producto = null;

        $jsonFile = __DIR__ . '/productos.json';

        if (!file_exists($jsonFile)) {
            return null;
        }

        $json = file_get_contents($jsonFile);
        $datos = json_decode($json, true); 

        if (!is_array($datos)) {
            return null;
        }

        $key = (string) $id;
        $entry = null;

        if (array_key_exists($key, $datos)) {
            $entry = $datos[$key];
        } else {
            // Si es una lista de objetos, buscamos por id
            foreach ($datos as $item) {
                if (isset($item['id']) && (string)$item['id'] === $key) {
                    $entry = $item;
                    break;
                }
            }
        }

        if ($entry !== null) {
            // Si existe la clase Producto la instanciamos, si no devolvemos el array
            if (class_exists('Producto')) {
                $producto = new Producto(
                    $entry['id'] ?? null,
                    $entry['producto'] ?? ($entry['nombre'] ?? ''),
                    $entry['categoria'] ?? '',
                    $entry['precio'] ?? 0
                );
            } else {
                $producto = $entry;
            }
        }

        return $producto;
    }

    public static function registrarCompra(Compra $compra) {
        $carpeta = __DIR__ . '/../compras';

        if (!is_dir($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $filename = $carpeta . '/' . time() . '.json';
        $json = json_encode($compra->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($filename, $json);

        return $filename;
    }
}
?>
