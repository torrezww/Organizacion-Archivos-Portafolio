import json
import datetime

def cargar_usuarios():
    try:
        with open("usuarios.json", "r") as f:
            return json.load(f)
    except FileNotFoundError:
        print("Archivo usuarios.json no encontrado")
        return []
    except json.JSONDecodeError as e:
        print("Error en el archivo JSON:", e)
        registrar_evento(f"ERROR - Archivo JSON mal formado: {e}")
        return []

def verificar_acceso(id_tarjeta, password):
    usuarios = cargar_usuarios()
    for usuario in usuarios:
        if usuario["id_tarjeta"] == id_tarjeta:
            # ✅ ID encontrado, ahora verificamos contraseña
            if usuario.get("password") == password:
                print("CERRADURA ABIERTA por 5 segundos")
                registrar_evento(
                    f"AUTORIZADO - ID:{usuario['id_tarjeta']} - {usuario['nombre_empleado']} - Nivel:{usuario['nivel_seguridad']}"
                )
            else:
                print("ALARMA ACTIVADA - Contrasena incorrecta")
                registrar_evento(
                    f"ALERTA - ID:{usuario['id_tarjeta']} - ACCESO DENEGADO - Contrasena incorrecta"
                )
            return  # salimos de la función después de validar
    # ❌ Si llegamos aquí, el ID no existe
    print("ALARMA ACTIVADA - Intento de acceso no autorizado")
    registrar_evento(f"ALERTA - ID:{id_tarjeta} - ACCESO DENEGADO - ID inexistente")

def registrar_evento(mensaje):
    with open("auditoria.txt", "a") as log:
        timestamp = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        log.write(f"{timestamp} - {mensaje}\n")

# Ejemplo de ejecución
if __name__ == "__main__":
    id_input = input("Ingrese ID de tarjeta: ")
    password_input = input("Ingrese contraseña: ")
    verificar_acceso(id_input, password_input)

