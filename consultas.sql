-- empleados
select u.id_usuario, u.username, u.estado, r.nombre_rol, p.id_persona,
        p.nombre1, p.nombre2, p.apellido1, p.apellido2, p.genero, p.dpi
from usuario u
inner join rol r on u.rol_id = r.id_rol
inner join empleado e on u.id_usuario = e.id_usuario
inner join persona p on e.id_persona = p.id_persona
where u.rol_id != 3
order by estado desc;
-- buscar empleado
select u.id_usuario, u.username, u.estado, r.nombre_rol, p.id_persona,
        p.nombre1, p.nombre2, p.apellido1, p.apellido2, p.genero, p.dpi
from usuario u
inner join rol r on u.rol_id = r.id_rol
inner join empleado e on u.id_usuario = e.id_usuario
inner join persona p on e.id_persona = p.id_persona
where u.rol_id != 3
and u.id_usuario = ?
order by estado desc;
-- encargados
select u.id_usuario, u.username, u.estado, r.nombre_rol,
        p.id_persona, p.nombre1, p.nombre2, p.apellido1, p.apellido2, p.genero, p.dpi,
        e.correo, e.direccion, e.telefono
from usuario u
inner join rol r on u.rol_id = r.id_rol
inner join encargado e on u.id_usuario = e.id_usuario
inner join persona p on e.id_persona = p.id_persona
order by estado desc;
-- encargado por id
select u.id_usuario, u.username, u.estado, r.nombre_rol,
        p.id_persona, p.nombre1, p.nombre2, p.apellido1, p.apellido2, p.genero, p.dpi,
        e.id_encargado, e.correo, e.direccion, e.telefono
from usuario u
inner join rol r on u.rol_id = r.id_rol
inner join encargado e on u.id_usuario = e.id_usuario
inner join persona p on e.id_persona = p.id_persona
where u.id_usuario = ?
order by estado desc;
-- ocupantes
select
    o.id_ocupante, fecha_nacimiento, procedencia, o.estado, o.tipo, concat(m.nombre_municipio, ', ', d.nombre_departamento) as lugar,
    p.id_persona, nombre1, nombre2, apellido1, apellido2, genero, dpi
from ocupante o
inner join persona p on o.id_persona = p.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
inner join departamento d on m.id_depto = d.id_depto
where estado = 1
order by tipo;
-- contrato por ocupante
select c.id_contrato
from ocupante o
inner join persona p on o.id_persona = p.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
inner join departamento d on m.id_depto = d.id_depto
inner join contrato c on o.id_ocupante = c.id_ocupante
where o.estado = 1 and c.estado = 'ACTIVO' and c.id_ocupante = 1
order by tipo;
-- ocupante por dpi
select
    o.id_ocupante, fecha_nacimiento, procedencia, o.estado, o.tipo, o.fecha_fallecimiento,
    p.id_persona, nombre1, nombre2, apellido1, apellido2, genero, dpi,
    m.id_municipio, m.nombre_municipio, d.id_depto, d.nombre_departamento
from ocupante o
inner join persona p on o.id_persona = p.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
inner join departamento d on m.id_depto = d.id_depto
where estado = 1 and p.dpi = ''
limit  1;
-- nichos y ocupantes
-- nichos ocupados
select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
       c1.numero_calle as numero1, c2.numero_calle as numero2,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite,
       p.id_persona, concat(p.nombre1, ' ', p.nombre2,' ', p.apellido1,' ', p.apellido2) as nombre,
       p.genero, p.dpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join calle c1 on n.id_calle = c1.id_calle
inner join calle c2 on n.id_avenida = c2.id_calle
where n.status = 'NORMAL'
and n.estado = 'OCUPADO';
-- nichos disponibles
select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
        c1.numero_calle as numero1, c2.numero_calle as numero2
from nicho n
inner join calle c1 on n.id_calle = c1.id_calle
inner join calle c2 on n.id_avenida = c2.id_calle
where n.estado = 'DISPONIBLE';
-- FILTRACION DE NICHOS
-- buscar nicho por codigo
select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
       c1.numero_calle as numero1, c2.numero_calle as numero2,
       c1.id_calle as id_calle, c2.id_calle as id_avenida
from nicho n
inner join calle c1 on n.id_calle = c1.id_calle
inner join calle c2 on n.id_avenida = c2.id_calle
where codigo = 106;
-- filtracion de nichos disponibles por codigo
select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
       c1.numero_calle as numero1, c2.numero_calle as numero2
from nicho n
inner join calle c1 on n.id_calle = c1.id_calle
inner join calle c2 on n.id_avenida = c2.id_calle
where n.estado = 'DISPONIBLE'
and codigo = 106;
-- por calle
select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
       c1.numero_calle as numero1, c2.numero_calle as numero2
from nicho n
inner join calle c1 on n.id_calle = c1.id_calle
inner join calle c2 on n.id_avenida = c2.id_calle
where n.estado = 'DISPONIBLE'
and c1.id_calle = 1;
-- por avenida
select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
       c1.numero_calle as numero1, c2.numero_calle as numero2
from nicho n
inner join calle c1 on n.id_calle = c1.id_calle
inner join calle c2 on n.id_avenida = c2.id_calle
where n.estado = 'DISPONIBLE'
and c2.id_calle = 1;
-- filtracion de nichos ocupados por codigo
select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
       c1.numero_calle as numero1, c2.numero_calle as numero2,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite,
       p.id_persona, concat(p.nombre1, ' ', p.nombre2,' ', p.apellido1,' ', p.apellido2) as nombre,
       p.genero, p.dpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join calle c1 on n.id_calle = c1.id_calle
inner join calle c2 on n.id_avenida = c2.id_calle
where n.estado = 'OCUPADO'
and codigo = 1;
-- por calle (ocupados)
select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
       c1.numero_calle as numero1, c2.numero_calle as numero2,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite,
       p.id_persona, concat(p.nombre1, ' ', p.nombre2,' ', p.apellido1,' ', p.apellido2) as nombre,
       p.genero, p.dpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join calle c1 on n.id_calle = c1.id_calle
inner join calle c2 on n.id_avenida = c2.id_calle
where n.estado = 'OCUPADO'
and c1.id_calle = 1;
-- por avenida (ocupados)
select n.codigo, n.estado as estado_nicho, n.status, n.tipo, c1.nombre_calle as calle, c2.nombre_calle as avenida,
       c1.numero_calle as numero1, c2.numero_calle as numero2,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite,
       p.id_persona, concat(p.nombre1, ' ', p.nombre2,' ', p.apellido1,' ', p.apellido2) as nombre,
       p.genero, p.dpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join calle c1 on n.id_calle = c1.id_calle
inner join calle c2 on n.id_avenida = c2.id_calle
where n.estado = 'OCUPADO'
and c2.id_calle = 1;
-- informacion del contrato nichos, contrato, ocupante, encargado
select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
       p.id_persona as oid, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
        p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
       p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join encargado e on c.id_encargado = e.id_encargado
inner join persona p1 on e.id_persona = p1.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
where n.status = 'NORMAL'
and c.estado = 'ACTIVO';
-- informacion del contrato nichos, contrato, ocupante, encargado por id
select n.codigo, n.estado as estado_nicho, n.status, n.tipo,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
       p.id_persona as o_id, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
        p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
       p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi,
       e.direccion, e.telefono, e.correo,
       m.nombre_municipio, d.nombre_departamento,
       ca.numero_calle, ca.nombre_calle, av.nombre_calle
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join encargado e on c.id_encargado = e.id_encargado
inner join persona p1 on e.id_persona = p1.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
inner join departamento d on m.id_depto = d.id_depto
inner join calle ca on n.id_calle = ca.id_calle
inner join calle av on n.id_avenida = av.id_calle
where id_contrato = ?;
-- informacion del contrato nichos, contrato, ocupante, encargado por encargago
select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
       p.id_persona as oid, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
        p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
       p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join encargado e on c.id_encargado = e.id_encargado
inner join persona p1 on e.id_persona = p1.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
where n.status = 'NORMAL'
and c.estado = 'CADUCADO'
and e.id_usuario = 1;
-- revisando contratos
select datediff(fecha_finalizacion, now()) from contrato where  datediff(fecha_finalizacion, now()) < 0
and datediff(fecha_finalizacion, now()) > -365;

select datediff(fecha_finalizacion, now()) from contrato where  datediff(fecha_limite, now()) > 0;

select datediff(fecha_finalizacion, now()) from contrato where  datediff(fecha_finalizacion, now()) >=0
and datediff(fecha_finalizacion, now()) < 60;

select datediff('2024-06-21', now());
-- contratos a punto de finalizar
select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
       p.id_persona as oid, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
        p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
       p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join encargado e on c.id_encargado = e.id_encargado
inner join persona p1 on e.id_persona = p1.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
where n.status = 'NORMAL'
and c.estado = 'ACTIVO'
and  datediff(fecha_finalizacion, now()) >=0
and datediff(fecha_finalizacion, now()) < 60;
-- contratos en año de gracia
select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
       p.id_persona as oid, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
        p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
       p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join encargado e on c.id_encargado = e.id_encargado
inner join persona p1 on e.id_persona = p1.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
where n.status = 'NORMAL'
and c.estado = 'ACTIVO'
and datediff(fecha_finalizacion, now()) < 0
and datediff(fecha_finalizacion, now()) > -365;
-- actualizar contratos
update contrato
set estado = 'EN AÑO DE GRACIA'
where datediff(fecha_finalizacion, now()) < 0
and datediff(fecha_finalizacion, now()) > -365;
-- contratos caducados
select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
       p.id_persona as oid, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
        p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
       p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join encargado e on c.id_encargado = e.id_encargado
inner join persona p1 on e.id_persona = p1.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
where n.status = 'NORMAL'
and c.estado = 'ACTIVO'
and datediff(fecha_finalizacion, now()) < -365;
-- contratos por encargado, a punto de finalizar
select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
       p.id_persona as oid, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
        p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
       p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join encargado e on c.id_encargado = e.id_encargado
inner join persona p1 on e.id_persona = p1.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
where c.estado = 'ACTIVO'
and  datediff(fecha_finalizacion, now()) >=0
and datediff(fecha_finalizacion, now()) <= 60
and e.id_usuario = ?;
-- contratos por encargado, en año de gracia
select n.codigo, id_calle, id_avenida, n.estado as estado_nicho, n.status, n.tipo,
       c.estado, c.fecha_inicio, c.fecha_finalizacion, c.fecha_limite, c.id_contrato,
       p.id_persona as oid, p.nombre1 as onombre1, p.nombre2 as onombre2, p.apellido1 as oapellido1,
        p.apellido2 as oapellido2, p.genero as ogenero, p.dpi  as odpi, o.fecha_nacimiento, o.fecha_fallecimiento, o.procedencia,
       p1.id_persona, p1.nombre1, p1.nombre2, p1.apellido1, p1.apellido2, p1.genero, p1.dpi
from nicho n
inner join contrato c on n.codigo = c.id_nicho
inner join ocupante o on c.id_ocupante = o.id_ocupante
inner join persona p on o.id_persona = p.id_persona
inner join encargado e on c.id_encargado = e.id_encargado
inner join persona p1 on e.id_persona = p1.id_persona
inner join municipio m on o.id_municipio = m.id_municipio
where c.estado = 'ACTIVO'
and datediff(fecha_finalizacion, now()) < 0
and datediff(fecha_finalizacion, now()) >= -365
and e.id_usuario = 1;
-- boletas por estado
select b.correlativo, id_usuario, costo, archivo, b.estado as estado_boleta, fecha_aprobacion, fecha_solicitado,
       c.id_contrato, id_boleta, id_encargado, id_ocupante, id_nicho, c.estado as estado_contrato, fecha_inicio, fecha_finalizacion, fecha_limite
from boleta b
inner join contrato c on b.correlativo = c.id_boleta
where b.estado = 'SOLICITADO';
-- boletas por estado y por usuario encargado
select b.correlativo, id_usuario, costo, archivo, b.estado as estado_boleta, fecha_aprobacion, fecha_solicitado,
       c.id_contrato, id_boleta, id_encargado, id_ocupante, id_nicho, c.estado as estado_contrato, fecha_inicio, fecha_finalizacion, fecha_limite
from boleta b
inner join contrato c on b.correlativo = c.id_boleta
where b.estado = 'APROBADO'
and id_encargado = 2;
-- detalle de boleta
select b.correlativo, costo, archivo, b.estado as estado_boleta, fecha_aprobacion, fecha_solicitado,
       c.id_contrato, c.estado as estado_contrato, fecha_inicio, fecha_finalizacion, fecha_limite,
       concat(nombre1,' ', nombre2, ' ', apellido1,' ', apellido2) as nombre, dpi
from boleta b
inner join contrato c on b.correlativo = c.id_boleta
inner join encargado e on c.id_encargado = e.id_encargado
inner join persona p on e.id_persona = p.id_persona
where b.correlativo = ?;
-- analizando fecha de contratos
select fecha_inicio, fecha_finalizacion, datediff(fecha_finalizacion, now()) from contrato;
-- dinero recaudado
select sum(costo) from boleta where estado = 'PAGADO'
and fecha_aprobacion between '2018-03-10' and '2022-06-04';
select sum(costo) from boleta;
-- boleta solicitado
select b.correlativo, id_usuario, costo, archivo, b.estado, fecha_aprobacion, fecha_solicitado
from boleta b
inner join contrato c on b.correlativo = c.id_boleta
where id_ocupante = 12
and b.estado = 'SOLICITADO';
-- fotos de nichos
select f.id_foto, id_nicho, archivo_foto
from foto_nicho f
inner join nichos.nicho n on f.id_nicho = n.codigo
where id_nicho = 1;
-- reporte de ocupantes
-- cantidad por genero
select count(genero) as cantidad, p.genero
from ocupante o
inner join persona p on o.id_persona = p.id_persona
where o.estado = 1
group by genero;
-- niños
select count(*) as cantidad, genero
from ocupante o
inner join persona p on o.id_persona = p.id_persona
where datediff(o.fecha_fallecimiento, o.fecha_nacimiento) < 10
and o.estado = 1
group by genero;
-- jovenes entre 11-18
select count(*) as cantidad, genero
from ocupante o
inner join persona p on o.id_persona = p.id_persona
where datediff(o.fecha_fallecimiento, o.fecha_nacimiento) > 10 and datediff(o.fecha_fallecimiento, o.fecha_nacimiento) < 18
and o.estado = 1
group by genero;
-- mayores a 18
select count(*) as cantidad, genero
from ocupante o
inner join persona p on o.id_persona = p.id_persona
where datediff(o.fecha_fallecimiento, o.fecha_nacimiento) >=18 and datediff(o.fecha_fallecimiento, o.fecha_nacimiento) < 30
and o.estado = 1
group by genero;
-- adultos
select count(*) as cantidad
from ocupante o
inner join persona p on o.id_persona = p.id_persona
where datediff(o.fecha_fallecimiento, o.fecha_nacimiento) >= 30 and datediff(o.fecha_fallecimiento, o.fecha_nacimiento) < 60
and o.estado = 1
group by genero;
-- de terecera edad
select count(*) as cantidad
from ocupante o
inner join persona p on o.id_persona = p.id_persona
where datediff(o.fecha_fallecimiento, o.fecha_nacimiento) > 60
and o.estado = 1
group by genero;
-- encargado
select id_encargado
from encargado e
inner join usuario u on e.id_usuario = u.id_usuario
where e.id_usuario = ?;
-- ENCARGADOS ACTIVOS
select dpi
from encargado e
inner join usuario u on e.id_usuario = u.id_usuario
inner join persona p on e.id_persona = p.id_persona
where u.estado = 1;
-- OCUPANTES QUE NO TIENE NINGUN CONTRATO
select dpi
from ocupante o
inner join persona p on o.id_persona = p.id_persona
left join contrato c on o.id_ocupante = c.id_ocupante
where c.id_ocupante IS NULL;
