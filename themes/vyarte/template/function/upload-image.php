<?php
$upload_dir = wp_upload_dir(); /* Guardamos la ruta del directorio upload en una variable */
$currentDate = date('ymd_gis_'); /*  Fecha (para darle un nombre unico) */
$filename   = 'dsgn_' . $currentDate . $nombre_archivo; /* Nombramos la imagen con el nombre del archivo  */
$uploadfile = $upload_dir["path"] . "/" . $filename; /* Guardamos la ruta del archivo temporal */

if ( move_uploaded_file( $_FILES['persImage']['tmp_name'], $uploadfile ) ) {
  // Leemos el archivo desde su nueva ubicación y lo guardamos en una variable
  $image_data = file_get_contents( $uploadfile );

  if(wp_mkdir_p($upload_dir['path']))
      $file = $upload_dir['path'] . '/' . $filename;
  else
      $file = $upload_dir['basedir'] . '/' . $filename;

  file_put_contents($file, $image_data); /* Insertamos los datos de la imagen en la variable */
  $wp_filetype = wp_check_filetype($filename, null ); /* Comprobamos el tipo de archivo a partir de su nombre */

  $attachment = array(
      'post_mime_type' => $wp_filetype['type'],
      'post_title'   => sanitize_file_name($filename),
      'post_content'    => '',
      'post_status'     => 'inherit'
  );
  $attach_id = wp_insert_attachment( $attachment, $file, $my_post_id ); /* Creamos el nuevo post */

  require_once(ABSPATH . 'wp-admin/includes/image.php'); /* Involucramos el core de WP*/
  require_once(ABSPATH . 'wp-admin/includes/file.php');
  require_once(ABSPATH . 'wp-admin/includes/media.php');
  
  $attach_data = wp_generate_attachment_metadata( $attach_id, $file ); /* Generamos los metadatos */
  wp_update_attachment_metadata( $attach_id, $attach_data ); /* Añadimos los metadatos */
  set_post_thumbnail( $my_post_id, $attach_id ); /* Asignamos la imagen como imagen destacada*/
  
  $img_url = wp_get_attachment_url( $attach_id ); /* Sólo sirve para verificar que no está vacio y eliminar el thumbnail anterior cuando se carga uno nuevo*/
} ?>