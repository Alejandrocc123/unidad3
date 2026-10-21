<?php
function calcularIVA(float $precio, float $tasa = 0.19): float {
    return round($precio * (1 + $tasa), 2);
}

function formatearPrecio(float $valor): string {
    return '$' . number_format($valor, 0, ',', '.');
}

echo formatearPrecio(calcularIVA(50000)) . "\n";        
echo formatearPrecio(calcularIVA(50000, 0.05)) . "\n";  


function saludarCliente(string $nombre = "cliente"): string {
    return "Bienvenido a la tienda, " . $nombre . ".";
}

echo saludarCliente() . "\n";
echo saludarCliente("Castro") . "\n" ;


function aplicarDescuento(float $precio, float $porcentaje = 0): float {
    return $precio - ($precio * $porcentaje / 100);
}

echo formatearPrecio(aplicarDescuento(precio: 80000, porcentaje: 10)) . "\n";

function totalCarrito(float ...$precios): float {
    return array_sum($precios);
}

echo formatearPrecio(totalCarrito(15000, 22000, 8000)) . "\n";

function descontarStock(int &$stock, int $cantidad): void {
    $stock -= $cantidad;
}

$stockCuadernos = 10;
descontarStock($stockCuadernos, 3);
echo "Quedan $stockCuadernos cuadernos\n";

function promedioPrecios(float ...$precios): float {
    if (count($precios) === 0) {
        return 0.0; 
    }
    
    $suma = array_sum($precios);
    return $suma / count($precios);
}

$resultado = promedioPrecios(15.50, 29.99, 100.00, 4.25, 50.10);

echo "El promedio de los precios es: " . $resultado;

$productos = [
    ['nombre' => 'Cuaderno', 'precio' => 8000,  'stock' => 20],
    ['nombre' => 'Lápiz',    'precio' => 1500,  'stock' => 0],
    ['nombre' => 'Mochila',  'precio' => 95000, 'stock' => 4],
];

$nombres = array_column($productos, 'nombre');
echo "Catálogo: " . implode(', ', $nombres) . "\n";
echo "Total de productos: " . count($productos) . "\n";

$disponibles = array_filter($productos, fn($p) => $p['stock'] > 0);
echo "Con stock: " . count($disponibles) . "\n";

$precios = array_column($productos, 'precio');
echo "El más caro cuesta " . formatearPrecio(max($precios)) . "\n";

$productos = [
    ["nombre" => "camisa casual", "precio" => 50000.0],
    ["nombre" => "jeans slim fit", "precio" => 120000.0],
    ["nombre" => "tenis deportivos", "precio" => 220000.0]
];

$tasaIva = 1.19;

$productosConIva = array_map(function($producto) use ($tasaIva) {
    return [
        "nombre" => strtoupper($producto["nombre"]),
        "precio_con_iva" => round($producto["precio"] * $tasaIva, 2)
    ];
}, $productos);

foreach ($productosConIva as $item) {
    echo "Producto: " . $item["nombre"] . " | Precio con IVA: $" . number_format($item["precio_con_iva"], 2) . "<br>";
}

class ProductoAgotadoException extends Exception {
    public function __construct(string $producto) {
        parent::__construct("No hay unidades suficientes de «$producto».");
    }
}

function buscarProducto(array $productos, string $nombre): array {
    foreach ($productos as $p) {
        if ($p['nombre'] === $nombre) {
            return $p;
        }
    }
    throw new InvalidArgumentException("El producto «$nombre» no existe.");
}

function comprar(array $productos, string $nombre, int $cantidad): float {
    if ($cantidad <= 0) {
        throw new RangeException("La cantidad debe ser mayor que cero.");
    }
    $producto = buscarProducto($productos, $nombre);
    if ($producto['stock'] < $cantidad) {
        throw new ProductoAgotadoException($nombre);
    }
    return calcularIVA($producto['precio'] * $cantidad);
}

?>
