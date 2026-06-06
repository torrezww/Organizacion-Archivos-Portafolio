# =========================================================
# ARCHIVO: generar.py
# FUNCIÓN GENERAL:
# Genera el archivo maestro.txt con 300 órdenes simuladas
# para el restaurante de comida mexicana.
#
# Este módulo se ejecuta una sola vez para crear la
# base de datos inicial en archivo plano.
# =========================================================

import random
from datetime import datetime


# ---------------------------------------------------------
# Diccionario de platillos y precios
# Clave = nombre del platillo
# Valor = precio unitario
# ---------------------------------------------------------
platillos = {
    "Tacos": 25,
    "Gordas": 30,
    "Tamales": 20,
    "Enchiladas": 90,
    "Quesadillas": 35
}

# ---------------------------------------------------------
# Lista de meseros disponibles
# ---------------------------------------------------------
meseros = ["Jahaziel", "Zenqu", "Alex", "Torres"]


# ---------------------------------------------------------
# Se abre (o crea) el archivo maestro.txt en modo escritura
# ---------------------------------------------------------
with open("maestro.txt", "w", encoding="utf-8") as archivo:

    # Escribir encabezado
    archivo.write("ID|Mesa|Mesero|Platillo|Cantidad|PrecioUnitario|Total|Hora\n")

    # -----------------------------------------------------
    # Generar 300 órdenes simuladas
    # -----------------------------------------------------
    for i in range(1, 301):

        # ID formateado a 3 dígitos (001, 002, etc.)
        id_orden = str(i).zfill(3)

        # Datos aleatorios
        mesa = random.randint(1, 15)
        mesero = random.choice(meseros)
        platillo = random.choice(list(platillos.keys()))
        precio = platillos[platillo]
        cantidad = random.randint(1, 5)

        # Cálculo del total
        total = precio * cantidad

        # Generar hora aleatoria entre 8:00 y 21:59
        hora = random.randint(8, 21)
        minuto = random.randint(0, 59)
        hora_formato = f"{hora:02d}:{minuto:02d}"

        # Construcción de la línea con delimitador "|"
        linea = f"{id_orden}|{mesa}|{mesero}|{platillo}|{cantidad}|{precio}|{total}|{hora_formato}\n"

        # Escribir línea en archivo
        archivo.write(linea)

print("Archivo maestro.txt generado correctamente con 300 órdenes.")