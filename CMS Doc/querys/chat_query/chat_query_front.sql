SELECT lieisoft_mensajeria.asunto as 'asunto' ,
lieisoft_mensajeria.fecha as 'fecha' ,
lieisoft_mensajeria.hora as 'hora' ,
concat(usuario.nombre ,  ' ' , usuario.apellido) as 'to_name',
usuario.imagen as 'avatar' , login.rol as 'to_rol' ,
privilegios.padre as 'parent_rol' 
FROM lieisoft_mensajeria
INNER JOIN usuario ON usuario.id_usuario=lieisoft_mensajeria.id_usuario_de
INNER JOIN login ON login.id_usuario = lieisoft_mensajeria.id_usuario_de
INNER JOIN privilegios ON privilegios.nombre = login.rol
WHERE lieisoft_mensajeria.id_usuario_para LIKE 'rolando55admin18894933';