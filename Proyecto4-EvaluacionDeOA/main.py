import csv
import json
import time
import random
import os

from tabulate import tabulate

from config import *
from funciones import *
from reportes import reporte_medico
from graficas import mostrar_graficas


# ==========================================
# GENERACIÓN DE DATOS
# ==========================================

print(f"\nGenerando {NUM_REGISTROS} registros...\n")


# ==========================================
# ESCRITURA CSV
# ==========================================

inicio_w_csv = time.time()

with open(ARCHIVO_CSV, mode="w", newline="", encoding="utf-8") as f_csv:

    escritor = csv.writer(f_csv)

    escritor.writerow([
        "id",
        "nombre",
        "edad",
        "mes",
        "temperatura",
        "presion",
        "medicamento",
        "especialidad",
        "enfermedad"
    ])

    for i in range(1, NUM_REGISTROS + 1):

        nombre_completo = f"{random.choice(nombres)} {random.choice(apellidos)}"
        edad = random.randint(1, 90)
        mes = random.choice(meses)
        temperatura = round(random.uniform(36.0, 39.5), 1)
        presion = f"{random.randint(110, 140)}/{random.randint(70, 90)}"
        medicamento = random.choice(medicamentos)
        especialidad = random.choice(especialidades)
        enfermedad = random.choice(enfermedades)

        escritor.writerow([
            i,
            nombre_completo,
            edad,
            mes,
            temperatura,
            presion,
            medicamento,
            especialidad,
            enfermedad
        ])

fin_w_csv = time.time()
tiempo_w_csv = fin_w_csv - inicio_w_csv


# ==========================================
# ESCRITURA JSON
# ==========================================

inicio_w_json = time.time()

with open(ARCHIVO_JSON, mode="w", encoding="utf-8") as f_json:

    for i in range(1, NUM_REGISTROS + 1):

        nombre_completo = f"{random.choice(nombres)} {random.choice(apellidos)}"
        edad = random.randint(1, 90)
        mes = random.choice(meses)
        temperatura = round(random.uniform(36.0, 39.5), 1)
        presion = f"{random.randint(110, 140)}/{random.randint(70, 90)}"
        medicamento = random.choice(medicamentos)
        especialidad = random.choice(especialidades)
        enfermedad = random.choice(enfermedades)

        registro = {
            "id": i,
            "nombre": nombre_completo,
            "edad": edad,
            "mes": mes,
            "consulta": {
                "temperatura": temperatura,
                "presion": presion,
                "medicamento": medicamento,
                "especialidad": especialidad,
                "enfermedad": enfermedad
            }
        }

        f_json.write(json.dumps(registro) + "\n")

fin_w_json = time.time()
tiempo_w_json = fin_w_json - inicio_w_json


# ==========================================
# LECTURA CSV
# ==========================================

inicio_r_csv = time.time()

with open(ARCHIVO_CSV, mode="r", encoding="utf-8") as f_csv:
    lector = csv.reader(f_csv)
    next(lector)

    for fila in lector:
        pass

fin_r_csv = time.time()
tiempo_r_csv = fin_r_csv - inicio_r_csv


# ==========================================
# LECTURA JSON
# ==========================================

inicio_r_json = time.time()

with open(ARCHIVO_JSON, mode="r", encoding="utf-8") as f_json:
    for linea in f_json:
        json.loads(linea)

fin_r_json = time.time()
tiempo_r_json = fin_r_json - inicio_r_json


# ==========================================
# TAMAÑOS
# ==========================================

tam_csv = os.path.getsize(ARCHIVO_CSV) / (1024 * 1024)
tam_json = os.path.getsize(ARCHIVO_JSON) / (1024 * 1024)


# ==========================================
# TABLA COMPARATIVA
# ==========================================

tabla_datos = [
    ["Tiempo Escritura", f"{tiempo_w_csv:.4f} s", f"{tiempo_w_json:.4f} s"],
    ["Tiempo Lectura", f"{tiempo_r_csv:.4f} s", f"{tiempo_r_json:.4f} s"],
    ["Tamaño Archivo", f"{tam_csv:.2f} MB", f"{tam_json:.2f} MB"]
]

tabla = tabulate(tabla_datos, headers=["Métrica", "CSV", "JSON"], tablefmt="fancy_grid")

print("\n=========== COMPARATIVA CSV VS JSON ===========\n")
print(tabla)

with open("comparativa_resultados.txt", "w", encoding="utf-8") as reporte:
    reporte.write(tabla)


# ==========================================
# INICIALIZAR DATAFRAME
# ==========================================

actualizar_dataframe()


# ==========================================
# MENÚ PRINCIPAL
# ==========================================

while True:

    limpiar()

    print("=========== SISTEMA HOSPITALARIO ===========\n")

    print("1. Buscar paciente por ID")
    print("2. Buscar paciente por nombre")
    print("3. Agregar nuevo paciente")
    print("4. Mostrar estadísticas")
    print("5. Generar reporte médico")
    print("6. Mostrar gráficas")
    print("7. Salir")

    opcion = input("\nSeleccione una opción: ")

    if opcion == "1":
        buscar_por_id()

    elif opcion == "2":
        buscar_por_nombre()

    elif opcion == "3":
        agregar_paciente()

    elif opcion == "4":
        mostrar_estadisticas()

    elif opcion == "5":
        reporte_medico()

    elif opcion == "6":
        mostrar_graficas()

    elif opcion == "7":
        print("\nSaliendo del sistema...")
        break

    else:
        print("\nOpción inválida.")

    # FIX DEL ENTER (sin crash)
    try:
        input("\nPresione ENTER para continuar...")
    except:
        pass