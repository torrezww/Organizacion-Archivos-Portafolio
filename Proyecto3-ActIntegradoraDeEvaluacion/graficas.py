import pandas as pd
import matplotlib.pyplot as plt


# Leer archivo CSV
df = pd.read_csv("ventas_tecnologia.csv")

# Calcular ingresos
df["ingresos"] = df["cantidad"] * df["precio_unitario"]

# Reportes
ventas_producto = df.groupby("producto")["cantidad"].sum()
ventas_mes = df.groupby("mes")["cantidad"].sum()
ingresos_producto = df.groupby("producto")["ingresos"].sum()

print("Ventas totales por producto:\n", ventas_producto)
print("\nVentas totales por mes:\n", ventas_mes)
print("\nIngresos por producto:\n", ingresos_producto)

producto_mas_vendido = ventas_producto.idxmax()
print("\nProducto más vendido:", producto_mas_vendido)


# Gráfica de barras
ventas_producto.plot(kind="bar", title="Ventas por Producto")
plt.xlabel("Producto")
plt.ylabel("Cantidad Vendida")
plt.show()

# Gráfica de líneas
ventas_mes.plot(kind="line", marker="o", title="Ventas Mensuales")
plt.xlabel("Mes")
plt.ylabel("Cantidad Vendida")
plt.show()

# Gráfica circular
ventas_producto.plot(kind="pie", autopct="%1.1f%%", title="Porcentaje de Ventas por Producto")
plt.ylabel("")
plt.show()


producto_mayor_ingreso = ingresos_producto.idxmax()
producto_menos_vendido = ventas_producto.idxmin()
mes_mas_rentable = df.groupby("mes")["ingresos"].sum().idxmax()

print("\nProducto con mayores ingresos:", producto_mayor_ingreso)
print("Producto menos vendido:", producto_menos_vendido)
print("Mes más rentable:", mes_mas_rentable)
print("Producto prioritario para inventario:", producto_mas_vendido)

