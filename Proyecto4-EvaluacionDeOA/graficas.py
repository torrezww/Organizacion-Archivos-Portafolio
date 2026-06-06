import matplotlib.pyplot as plt
import funciones
import pandas as pd
from config import *


def mostrar_graficas():

    funciones.actualizar_dataframe()
    df = funciones.df.copy()

    if df.empty:
        print("Sin datos")
        return

    fig = plt.figure(figsize=(16, 12))
    plt.subplots_adjust(hspace=0.6, wspace=0.4)

    # ==========================================
    # 1. ESPECIALIDADES
    # ==========================================
    ax1 = plt.subplot(3, 2, 1)

    data1 = df["especialidad"].value_counts()

    ax1.bar(data1.index, data1.values,
            color=["#FF6B6B", "#4ECDC4", "#45B7D1", "#96CEB4", "#FFEEAD"])

    ax1.set_title("Consultas por especialidad")
    ax1.tick_params(axis='x', rotation=20)

    # ==========================================
    # 2. MES
    # ==========================================
    ax2 = plt.subplot(3, 2, 2)

    df["mes"] = pd.Categorical(df["mes"], categories=meses, ordered=True)
    data2 = df.groupby("mes", observed=False).size()

    ax2.plot(data2.index, data2.values,
             marker="o",
             color="#6C5CE7",
             linewidth=2)

    ax2.set_title("Actividad mensual")
    ax2.tick_params(axis='x', rotation=30)

    # ==========================================
    # 3. MEDICAMENTOS
    # ==========================================
    ax3 = plt.subplot(3, 2, 3)

    data3 = df["medicamento"].value_counts()

    ax3.pie(data3.values,
            labels=data3.index,
            autopct="%1.1f%%",
            colors=["#FDCB6E", "#E17055", "#00B894", "#0984E3", "#6C5CE7"])

    ax3.set_title("Medicamentos")

    # ==========================================
    # 4. EDADES
    # ==========================================
    ax4 = plt.subplot(3, 2, 4)

    ax4.hist(df["edad"],
             bins=15,
             color="#74B9FF",
             edgecolor="black")

    ax4.set_title("Distribución de edades")

    # ==========================================
    # 5. ENFERMEDADES
    # ==========================================
    ax5 = plt.subplot(3, 2, 5)

    data5 = df["enfermedad"].value_counts()

    ax5.bar(data5.index, data5.values,
            color=["#D63031", "#00B894", "#0984E3", "#6C5CE7", "#FDCB6E"])

    ax5.set_title("Enfermedades")
    ax5.tick_params(axis='x', rotation=20)

    # ==========================================
    # 6. RIESGO
    # ==========================================
    ax6 = plt.subplot(3, 2, 6)

    riesgo = df["temperatura"] >= 39

    ax6.bar(["Normal", "Crítico"],
            [len(df[~riesgo]), len(df[riesgo])],
            color=["#00B894", "#D63031"])

    ax6.set_title("Pacientes de riesgo")

    # ==========================================
    # TITULO
    # ==========================================
    plt.suptitle(
        f"Dashboard Hospitalario - {NUM_REGISTROS} registros",
        fontsize=16,
        fontweight="bold"
    )

    plt.show()