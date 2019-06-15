import mysql.connector
from datetime import datetime
from time import sleep

HOST = 'localhost'
USER = 'root'
PASSWORD =''
PORT = 3306
DB_TRANS = 'transaccional_sgi'
DB_GEREN = 'gerencialpan'

lista_resultados = list()
mydb_trans = None
mydb_geren = None
extract_data = False
load_data = False

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

def get_fecha():
    return datetime.now().strftime('%Y-%m-%d %H:%M:%S')


def registrar_actividad(comentario):
    valor = (1, comentario, get_fecha())
    mycursor.execute('INSERT INTO gerencialpan.historial_actividad (registro_etl,'
                    'comentario_de_actividad, created_at) '
                    'VALUES (%s,%s,%s)', valor
                    )


def comprobar_tablas(my_cursor, bd):
    print('\nCOMPROBANDO EXISTENCIA DE TABLAS EN BD ' + bd)
    mycursor.execute('SHOW tables')
    resul = mycursor.fetchall()
    listado = set([elem[0] for elem in resul])
    if bd == 'transaccional_sgi':
        set_trans = set(tablas_trans.keys())
    else:
        geren = ['gerencial_'+elem for elem in tablas_geren]
        set_trans = set(geren)
    faltan = set_trans.difference(listado)
    if len(faltan) == 0:
        return True
    else:
        print('Las siguientes tablas no existen en la BD %s:' % bd)
        print('\t' + '\n\t'.join(list(faltan)))
        return False


"""Obtención de campos de la BD transaccional.

Primeramente se crea la conexion a la BD transaccional.
Se crea el cursor a utilizar para el manejo de resultados.
Durante cada ciclo se crea una nueva query formada a partir de los campos 
de cada tabla, y su nombre.
Se almacenan en la variable de lista_resultados.
Se cierra la conexion del cursor.
"""
try:
    mydb_trans = mysql.connector.connect(host=HOST, user=USER,
                                        passwd=PASSWORD, database=DB_TRANS, 
                                        port=PORT)
except mysql.connector.errors.InterfaceError:
    print('ERROR: No se puede conectar a la BD transaccional, por favor verifique su estado.')
except mysql.connector.errors.ProgrammingError as e:
    if str(e)[0:12] == '1045 (28000)':
        print('ERROR: Contraseña inválida para el usuario {} en BD transaccional.'.format(USER))

if mydb_trans is not None:
    try:
        mycursor = mydb_trans.cursor()

        if comprobar_tablas(mycursor, DB_TRANS):
            print('LAS TABLAS NECESARIAS EXISTEN')
            sleep(1)
            print('\nOBTENIENDO DATOS DE BD TRANSACCIONAL')
            registrar_actividad('OBTENIENDO DATOS DE BD TRANSACCIONAL')

            for tabla, campos in tablas_trans.items():
                query = 'SELECT {} FROM {}'.format(','.join(campos), tabla)
                mycursor.execute(query)
                lista_resultados.append(mycursor.fetchall())
                print('Datos obtenidos de la tabla {}'.format(tabla))
            registrar_actividad('DATOS OBTENIDOS DE BD TRANSACCIONAL')
            
            mycursor.close()
            extract_data = True
    
    except mysql.connector.errors.ProgrammingError as e:
        print('ERROR: Alguna tabla de la BD transaccional no existe, por favor verifique su existencia.')
        print(e)

"""
Carga de valores a la base de datos.

Primeramente se crea la conexion a la BD gerencial.
Se crea el cursor a utilizar para el manejo de resultados.
Para cada ciclo se crea un formato de query.
Se ejecuta la query con sus respectivos datos.
Se cierra el cursor
Se confirman los cambios en la BD gerencial
"""
try:
    mydb_geren = mysql.connector.connect(host=HOST, user=USER,
                                        passwd=PASSWORD, database=DB_GEREN, 
                                        port=PORT)
except mysql.connector.errors.InterfaceError:
    print('ERROR: No se puede conectar a la BD gerencial, por favor verifique su estado.')
except mysql.connector.errors.ProgrammingError as e:
    if str(e)[0:12] == '1045 (28000)':
        print('ERROR: Contraseña inválida para el usuario {} en BD gerencial.'.format(USER))

if mydb_geren is not None and extract_data:
    mycursor = mydb_geren.cursor()

    if comprobar_tablas(mycursor, DB_GEREN):
        try:
            mycursor.execute('SET FOREIGN_KEY_CHECKS=0')
            print('\nREVISION DE CLAVES FORANEAS DESACTIVADA')
            registrar_actividad('REVISION DE LLAVES DESACTIVADA')

            print('\nLIMPIANDO TABLAS DE LA BD GERENCIAL')
            registrar_actividad('LIMPIANDO TABLAS DE LA BD GERENCIAL')

            for i in range(len(tablas_geren)):
                query_truncate = 'TRUNCATE TABLE gerencial_{}'.format(tablas_geren[i])
                mycursor.execute(query_truncate)
                print('Tabla gerencial_{} vaciada'.format(tablas_geren[i]))
            
            mycursor.execute('SET FOREIGN_KEY_CHECKS=1')
            print('\nREVISION DE CLAVES FORANEAS ACTIVADA')
            registrar_actividad('REVISION DE LLAVES ACTIVADA')

            print('\nCARGANDO DATOS DENTRO DE LAS TABLAS DE BD GERENCIAL')
            registrar_actividad('CARGANDO DATOS EN BD GERENCIAL')

            for i in range(len(tablas_geren)):
                query = 'INSERT INTO {} VALUES ({})'.format(
                    'gerencial_' + tablas_geren[i],
                    ','.join(['%s' for i in range(len(lista_resultados[i][0]))])
                )
                mycursor.executemany(query, lista_resultados[i])
                print('Datos cargados exitosamente en tabla gerencial_{}'.format(tablas_geren[i]))
            
            registrar_actividad('DATOS CARGADOS EN BD GERENCIAL')

            mydb_geren.commit()
            load_data = True
        except mysql.connector.errors.ProgrammingError as e:
            print('ERROR: Alguna tabla de la BD transaccional no existe, por favor verifique su existencia.')
            print(e)
        except mysql.connector.IntegrityError as e:
            print('ERROR: Algún registro en la BD gerencial ya existe.')

if extract_data and load_data:
    print('\nEl proceso ETL ha terminado exitosamente.')
    registrar_actividad('PROCESO ETL FINALIZADO CORRECTAMENTE')
else:
    print('\nERROR: El proceso de ETL ha terminado con errores, por favor verifique los errores desplegados.')
    registrar_actividad('PROCESO ETL FINALIZADO INCORRECTAMENTE')
mycursor.close()
