#!/bin/bash
home_dir=$(dirname $(dirname $(readlink -e $0)))
input_dir="${home_dir}/input/cellsites"
backup_dir="${home_dir}/backup"
server="mysql_pv"
usuario="root"
clave="inteliagencia"
bd="inteliagencia"
tabla="cellsites"
log_file="$home_dir/log/carga_base_datos.log"
cargados=0
control_file="${home_dir}/control_archivos_cargados.txt"
duplicated_file="${home_dir}/duplicados"

cd $input_dir
existe=$(ls *.csv|wc -l)


if [ $existe -gt 0 ]
then
	 echo "`date +'%Y%m%d%H%M%S'` .... Iniciando la carga de $existe archivos encontrados para cargar a la base de datos">>$log_file
	for file in  *.csv 
	do
		# Cargar archivo
		fname=${input_dir}/${file}
		comando="LOAD DATA \
			LOCAL \
			INFILE '$fname' \
			REPLACE \
			INTO TABLE $tabla \
			FIELDS TERMINATED BY '\t' OPTIONALLY ENCLOSED BY '\"' \
			LINES TERMINATED BY '\n' \
			IGNORE 1 LINES \
			(celda_id, tecnologia, celda_num, nombre, latitud, longitud, @prov, @muni, @dir) \
			SET id=NULL, \
			id_operadora=1, \
			direccion=CASE LENGTH(@dir) 
						WHEN  0 THEN CONCAT(@muni, ', ', @prov) 
						ELSE CONCAT (@dir, ', ', @muni, ', ', @prov)  
						END, \
			provincia=@prov, \
			municipio=@muni \
				;"

		mysql -h${server} -u${usuario} -p${clave} -e "$comando" $bd
		
		if [ $? -eq 0 ]
		then
			cargados=$((cargados + 1))
			echo "`date +'%Y%m%d%H%M%S'` .... archivo: $file Cargado exitosamente a la base de datos tabla:$tabla">>$log_file
			mv $fname $backup_dir/
			echo "$file ......Cargado  `date +'%Y%m%d%H%M%S'`" >>$control_file
		else
			echo "`date +'%Y%m%d%H%M%S'` .... archivo: $file ERROR al cargar a la base de datos tabla:$tabla">>$log_file
		fi		
	done
	 echo "`date +'%Y%m%d%H%M%S'` .... Hemos terminado de cargar los archivos..... $cargados archivos procesados ">>$log_file
else
	echo "`date +'%Y%m%d%H%M%S'` .... No Existen Archivos pendientes para cargar ... saliendo">>$log_file
fi
exit 0
