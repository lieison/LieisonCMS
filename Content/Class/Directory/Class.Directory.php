<?php



/**
 * Description of Directorio
 *
 * @author rolandoantonio
 */
class _Directory {
    
    
    public function __construct() {
        
    }
    
    public function CreateDirectory($path , $nombre_directorio)
    {
        $direccion = $path."/$nombre_directorio";
        if (!file_exists($direccion)) {
            mkdir($direccion, 777);
            RETURN TRUE;
        } else {
            RETURN FALSE;
        }
    }
    
    public function CopyFullDirectory( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target , 777);
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if (is_dir($Entry)){
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }
         $d->close();
    }else {
        copy( $source, $target );
    }
}
    
    
    
}
