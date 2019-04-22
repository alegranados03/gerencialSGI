import mysql.connector
from datetime import datetime

HOST = 'localhost'
USER = 'root'
PASSWORD = ''
PORT = 3306
DB_TRANS = 'transaccional_sgi'
DB_GEREN = 'gerencialpan'

fecha = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
valores = (1, 'Ejecución de script ETL', fecha)
lista_resultados = list()

"""Listado de tablas, campos de la BD transaccional y campos de la 
BD gerencial.
"""

tablas_trans = {
    'users': ('id', 'username', 'es_cliente', 'sexo', 'created_at'),
    'ordenes': ('id', 'tipo_orden', 'user_id', 'created_at'),
    'pagos': ('id', 'orden_id', 'tipo_pago', 'total_cancelar', 'created_at'),
    'categorias': ('id', 'nombre_categoria'),
    'productos': ('id', 'nombre_producto', 'categoria_id', 'precio'),
    'detalles_orden': ('id', 'orden_id', 'producto_id', 'cantidad_producto',
                       'total_parcial', 'created_at'),
    'materia_prima': ('id', 'nombre_materia', 'cantidad'),
    'proveedores': ('id', 'nombre_proveedor'),
    'lote': ('id', 'producto_id', 'total', 'proveedor_id', 'created_at'),
    'compras': ('id', 'materia_prima_id', 'proveedor_id', 'cantidad',
                'costo_compra', 'created_at')
}

tablas_geren = [
    'usuario', 'orden', 'pago', 'categoria', 'producto',
    'detalle_orden', 'materia_prima', 'proveedor', 'lote', 'compra'
]

"""Obtención de campos de la BD transaccional.

Primeramente se crea la conexion a la BD transaccional.
Se crea el cursor a utilizar para el manejo de resultados.
Durante cada ciclo se crea una nueva query formada a partir de los campos 
de cada tabla, y su nombre.
Se almacenan en la variable de lista_resultados.
Se cierra la conexion del cursor.
"""
mydb_trans = mysql.connector.connect(host=HOST, user=USER,
                                     passwd=PASSWORD, database=DB_TRANS, 
                                     port=PORT)

mycursor = mydb_trans.cursor()

for tabla, campos in tablas_trans.items():
    query = 'SELECT {} FROM {}'.format(','.join(campos), tabla)
    mycursor.execute(query)
    lista_resultados.append(mycursor.fetchall())
mycursor.close()

"""
Carga de valores a la base de datos.

Primeramente se crea la conexion a la BD gerencial.
Se crea el cursor a utilizar para el manejo de resultados.
Para cada ciclo se crea un formato de query.
Se ejecuta la query con sus respectivos datos.
Se cierra el cursor
Se confirman los cambios en la BD gerencial
"""

mydb_geren = mysql.connector.connect(host=HOST, user=USER,
                                     passwd=PASSWORD, database=DB_GEREN, 
                                     port=PORT)
mycursor = mydb_geren.cursor()

for i in range(len(tablas_geren)):
    query = 'INSERT INTO {} VALUES ({})'.format(
        'gerencial_' + tablas_geren[i],
        ','.join(['%s' for i in range(len(lista_resultados[i][0]))])
    )
    mycursor.executemany(query, lista_resultados[i])

mycursor.execute('INSERT INTO historial_actividad (registro_etl,'
                 'comentario_de_actividad, created_at) '
                 'VALUES (%s,%s,%s)', valores
                 )

mycursor.close()
mydb_geren.commit()

print('El proceso ETL ha terminado existosamente')
