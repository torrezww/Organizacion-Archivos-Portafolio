import pandas as pd
import os
import csv
import json

from config import *

df = pd.DataFrame()

# ==========================================
# LIMPIAR PANTALLA
# ==========================================

def limpiar():
    os.system("cls" if os.name == "nt" else "clear")


# ==========================================
# ACTUALIZAR DATAFRAME
# ==========================================

def actualizar_dataframe():
    global df
    try:
        df = pd.read_csv(ARCHIVO_CSV)
    except:
        df = pd.DataFrame()


# ==========================================
# VALIDACIONES
# ==========================================

def validar_nombre(x): return x.strip() != ""
def validar_edad(x): return 0 < x <= 120
def validar_temp(x): return 30 <= x <= 45


# ==========================================
# AGREGAR PACIENTE (CONTROL TOTAL)
# ==========================================

def agregar_paciente():
    actualizar_dataframe()

    try:
        nombre = input("Nombre: ")
        if not validar_nombre(nombre):
            print("Nombre inválido")
            return

        edad = int(input("Edad: "))
        if not validar_edad(edad):
            print("Edad inválida")
            return

        # =========================
        # MES CONTROLADO (SIN ERRORES)
        # =========================
        print("\nSeleccione el mes:")

        for i, m in enumerate(meses, start=1):
            print(f"{i}. {m}")

        try:
            opcion_mes = int(input("\nMes (número): "))

            if opcion_mes < 1 or opcion_mes > len(meses):
                print("Mes inválido")
                return

            mes = meses[opcion_mes - 1]

        except:
            print("Entrada inválida")
            return

        temperatura = float(input("Temperatura: "))
        if not validar_temp(temperatura):
            print("Temperatura inválida")
            return

        presion = input("Presión: ")
        medicamento = input("Medicamento: ")
        especialidad = input("Especialidad: ")
        enfermedad = input("Enfermedad: ")

        nuevo_id = int(df["id"].max()) + 1 if not df.empty else 1

        # CSV
        with open(ARCHIVO_CSV, "a", newline="", encoding="utf-8") as f:
            writer = csv.writer(f)
            writer.writerow([
                nuevo_id, nombre, edad, mes,
                temperatura, presion,
                medicamento, especialidad, enfermedad
            ])

        # JSON
        registro_json = {
            "id": nuevo_id,
            "nombre": nombre,
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

        with open(ARCHIVO_JSON, "a", encoding="utf-8") as f:
            f.write(json.dumps(registro_json) + "\n")

        print(f"\nPaciente agregado con ID: {nuevo_id}")

    except:
        print("Error en datos")


# ==========================================
# RESTO FUNCIONES (SIN CAMBIOS IMPORTANTES)
# ==========================================

def buscar_por_id():
    actualizar_dataframe()
    try:
        id_paciente = int(input("ID: "))
    except:
        print("ID inválido")
        return

    r = df[df["id"] == id_paciente]

    if r.empty:
        print("No encontrado")
    else:
        print(r.to_string(index=False))


def buscar_por_nombre():
    actualizar_dataframe()

    nombre = input("Nombre: ").lower()

    r = df[df["nombre"].str.lower().str.contains(nombre)]

    if r.empty:
        print("No encontrado")
    else:
        print(r.to_string(index=False))


def mostrar_estadisticas():
    actualizar_dataframe()

    if df.empty:
        print("Sin datos")
        return

    print("\n=== ESTADÍSTICAS ===\n")

    print(f"Temp promedio: {df['temperatura'].mean():.2f}")
    print(f"Edad max: {df['edad'].max()}")
    print(f"Edad min: {df['edad'].min()}")

    print(f"Medicamento top: {df['medicamento'].value_counts().idxmax()}")
    print(f"Área crítica: {df['especialidad'].value_counts().idxmax()}")
    print(f"Mes más activo: {df['mes'].value_counts().idxmax()}")
    print(f"Enfermedad común: {df['enfermedad'].value_counts().idxmax()}")

    print(f"Urgentes: {len(df[df['temperatura'] >= 39])}")