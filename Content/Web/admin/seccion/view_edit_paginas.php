
<?php 


$id = $_REQUEST['id'] ? : null;
$del = $_REQUEST['del'] ? : null;

if($id == null && $del == null){
    echo '<div class="alert alert-danger" role="alert">PAGINA NO ENCONTRADA </div><br>';
    echo "<a class='btn btn-primary' href='index.php'>Regresar </a>";
    exit();
}

$page = new PageController();

echo "<pre>";
print_r($page->get_dashboard_database($id));
echo "</pre>";
?>


