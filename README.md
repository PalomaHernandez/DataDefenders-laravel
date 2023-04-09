# Data Defenders

## Descripción general

El proyecto consiste en una aplicación web que permita la gestión e inscripción a puestos laborales, becas, pasantías e
intercambios que se ofrecen en una universidad.

Los interesados deberán registrarse en el sistema para inscribirse. Existirán usuarios administrativos que podrán
gestionar las ofertas, inscripciones y generar reportes.

Las ofertas tendrán requisitos distintos para la inscripción, tales como un CV o certificado analítico de materias, que
no son comunes entre todas.

---

## Diagrama de Entidad-Relación

Se puede ver el diagrama [aquí](storage/app/ERD.pdf).

---

## Laravel

### Entidades actualizables

- User
- Request
- Job Offer
- Internship Offer
- Exchange Offer
- Scholarship Offer
- Major

### Reportes generables o visualizables

- Inscriptos a una oferta (con o sin adjuntos).
- Comprobante de inscripción a una oferta.
- Ofertas (becas o intercambio) según la carrera.
- Ofertas (laboral, beca o intercambio) según el departamento.
- Ofertas (pasantía) según la empresa.
- Ofertas (intercambio) según la universidad externa.
- Promedios de aceptación de solicitudes de ciertas ofertas.

### Entidades obtenibles por API

Todas las entidades.

Crearemos una API completa y se utilizará una aplicación escrita en Vue con Vue Router para la
interfaz de usuario.

Se cargará la aplicación Vue a través de Blade y el enrutador de Laravel durante la visita inicial o recargas. Todo lo
restante se gestionará mediante la API con Laravel Sanctum y peticiones HTTP mediante Axios.

### Entidades modificables por API

- User
- Request
- Internship Offer
- Job Offer
- Scholarship Offer
- Exchange Offer
- Major

---

## Vue

### Información visible por el usuario

- **Todos los roles**
    - La información de la cuenta propia.
- **Rol Administrador**
    - Toda la información contenida en el sistema.
- **Rol Administrador Ejecutivo**
    - Las inscripciones con sus adjuntos.
    - La información de los usuarios.
- **Rol Administrador de Ofertas**
    - Las ofertas.
    - Las empresas.
    - Los departamentos.
    - Las carreras.
    - Las universidades.
    - Las inscripciones a las ofertas sin sus adjuntos.
- **Rol Usuario General**
    - Las inscripciones propias a cualquier oferta.
    - Las ofertas disponibles.

### Acciones realizables por el usuario

- **Todos los roles**
    - Cerrar sesión.
    - Actualizar la información de su cuenta.
- **Rol Administrador**
    - Actualizar todas las entidades actualizables.
- **Rol Administrador Ejecutivo**
    - Aceptar una inscripción.
    - Rechazar una inscripción.
- **Rol Administrador de Ofertas**
    - Crear ofertas.
    - Actualizar oferta.
    - Crear empresas.
    - Crear departamentos.
    - Crear carreras.
    - Actualizar carreras.
    - Crear universidades.
- **Rol Usuario General**
    - Inscribirse a las ofertas disponibles.
    - Cancelar una inscripción propia.
- **Visitante (sin cuenta)**
    - Iniciar sesión.
    - Registrar una cuenta.