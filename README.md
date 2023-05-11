# Data Defenders

![UniManager Logo](storage/app/public/logos/unimanager.svg "UniManager Logo")

**UniManager** is the ultimate app to manage your University's job and scholarship offers!

## Descripción general

El proyecto consiste en una aplicación web que permita la gestión e inscripción a puestos laborales y becas que se ofrecen en una universidad.

Los interesados deberán registrarse en el sistema para inscribirse. Existirán usuarios administrativos que podrán
gestionar las ofertas, inscripciones y generar reportes.

Las ofertas tendrán requisitos distintos para la inscripción, tales como un CV o certificado analítico de materias, que
no son comunes entre las mismas.

## Descripción completa

`UniManager` permite a las universidades gestionar dos tipos de ofertas: laborales y becas.

Para ello, el sistema define la gestión de departamentos y carreras. Las carreras pertenecen a un único departamento.

Las ofertas laborales se corresponden con un único departamento. Cada departamento puede tener varias ofertas laborales.
Las ofertas de becas se corresponden con un conjunto de carreras. Estas carreras no tienen que ser necesariamente pertenecientes a un mismo departamento.

Cuando un usuario aplica a una oferta, ya sea laboral o de beca, debe subir cierta documentación especificada en los requisitos de la oferta.
Esta aplicación queda en estado pendiente para que un usuario administrador (con permisos suficientes) revise dicha documentación y tome un veredicto.

Los veredictos que la aplicación puede tener son:

- `Aceptada`: la aplicación está en orden y se puede admitir una entrevista. Esta entrevista está fuera del alcance de este sistema.
- `Requiere documentación`: la aplicación no tiene toda la documentación requerida o no está en condiciones y se le solicita al usuario que corrija mediante la subida de más documentación.
- `Rechazada`: la aplicación es correcta, pero no cumple con las expectativas de la oferta.

En el caso de requerirse una documentación adicional o rechazarse la aplicación, el sistema obligará al usuario a escribir la razón de rechazo o la descripción de la documentación requerida, según corresponda.

En cualquier caso, el usuario que aplicó podrá ver el estado de su aplicación en todo momento. Si el estado solicita adjuntar documentación, entonces el sistema le permitirá al usuario subir dichos archivos. Estos archivos deberán ser de tipo `PDF`.

Cuando un usuario sube documentación adicional, el estado de la aplicación cambia a `pendiente`.

El sistema cuenta con un módulo de recuperación de contraseña. Si uno se olvida la contraseña, puede solicitar un cambio mediante este módulo y se puede acceder desde la página de inicio de sesión.

El proceso de recuperación pide la dirección de correo electrónico del usuario cuya contraseña se quiere recuperar y se envía a dicha dirección un enlace que expira en 15 minutos luego de ser generado.

Si el usuario llega a tiempo no solo para ver el formulario de recuperación, sino que para enviar la nueva contraseña, entonces el sistema actualiza la contraseña y redirecciona al usuario a iniciar sesión.

## Consideraciones y limitaciones

- El sistema fue desplegado en la siguiente URL: https://unimanager.snowlinks.net
- La documentación de la `API` se encuentra en la siguiente URL: https://unimanager.snowlinks.net/api/documentation
- El módulo de recuperación de contraseña no tiene en cuenta el caso de que se use la misma contraseña que ya existía previamente.
- La interfaz gráfica de administración provista no es «*responsiva*». Entonces, no se verá bien en dispositivos móviles.
- La documentación de la `API` puede no estar completa en relación con el proyecto ya finalizado.
- Parte de las rutas definidas en la documentación de la `API` no están implementadas de la forma indicada porque eso se cambiará con el proyecto de `Vue.js`.
- El envío de correos electrónicos se realiza mediante autenticación de una cuenta instalada en el servidor de despliegue.
- El sitio web fue verificado en Safari (macOS) y Microsoft Edge (Windows).
- La interfaz gráfica se realizó con `Tailwind CSS` y no utiliza `JavaScript` excepto para la carga de `FontAwesome` para los íconos.
- La interfaz gráfica solo se encuentra disponible en idioma inglés.
- La entrega no solicita los reportes generables o visualizables y por eso no fueron implementados. Estos reportes se agregarán más adelante.

---

## Diagrama de Entidad-Relación

Se puede ver el diagrama [aquí](storage/app/ERD.pdf).

---

## Laravel

### Entidades actualizables

- User
- Application
- Job Offer
- Scholarship Offer
- Major

### Reportes generables o visualizables

- Inscriptos a una oferta (con o sin adjuntos).
- Comprobante de inscripción a una oferta.
- Ofertas (becas) según la carrera.
- Ofertas (laboral o beca) según el departamento.
- Promedios de aceptación de solicitudes de ciertas ofertas.

### Entidades obtenibles por API

Todas las entidades.

Crearemos una API completa y se utilizará una aplicación escrita en Vue con Vue Router para la
interfaz de usuario.

Se cargará la aplicación Vue a través de Blade y el enrutador de Laravel durante la visita inicial o recargas. Todo lo
restante se gestionará mediante la API con Laravel Sanctum y peticiones HTTP mediante Axios.

### Entidades modificables por API

- User
- Application
- Job Offer
- Scholarship Offer
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
    - Los departamentos.
    - Las carreras.
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
    - Solicitar documentación de una inscripción.
    - Rechazar una inscripción.
- **Rol Administrador de Ofertas**
    - Crear ofertas.
    - Actualizar oferta.
    - Borrar oferta.
    - Crear departamentos.
    - Actualizar departamentos.
    - Borrar departamentos.
    - Crear carreras.
    - Actualizar carreras.
    - Borrar carreras.
- **Rol Usuario General**
    - Inscribirse a las ofertas disponibles.
    - Cancelar una inscripción propia.
- **Visitante (sin cuenta)**
    - Iniciar sesión.
    - Registrar una cuenta.

![UniManager White Logo](storage/app/public/logos/unimanager-white.svg "UniManager White Logo")