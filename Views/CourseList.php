<script src="Views/js/deleteFunctions.js"></script>
<script>
    deletionUrl = "index.php?c=course&f=delete";
</script>
<?php include('_deleteModal.php');?>

<div class="row">
    <div class="col">

        <h2>Lista de Cursos</h2>
        <a class="btn btn-primary" href="index.php?c=course&f=add">+ Novo curso</a>

        <?php 
            include('Views/_messages.php');
        ?>

        <form action="index.php?c=course&f=search" method="POST">
            <div class="row mt-3">
                <div class="col">
                    <input 
                        type="text"
                        name="name"
                        class="form-control"
                        placeholder="Buscar por nome"
                        value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>">
                </div>
                <div class="col-3">
                    <select name="status" class="form-control">
                        <option value="1" <?php  if(isset($_POST['status'])){ if($_POST['status'] == 1){ echo 'selected';}}?>>Ativo</option>
                        <option value="0" <?php  if(isset($_POST['status'])){ if($_POST['status'] == 0){ echo 'selected';}}?>>Inativo</option>
                    </select>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="index.php?c=course" class="btn btn-secondary">Limpar</a>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Data início</th>
                    <th>Data fim</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $course):?>
                    <?php 
                        $dateStart = new DateTime($course['dateStart']);
                        $dateFinish = new DateTime($course['dateFinish']);
                    ?>
                <tr>
                    <td><?php echo $course['id']?></td>
                    <td><?php echo $course['nameCourse']?></td>
                    <td><?php echo $dateStart->format('d/m/Y')?></td>
                    <td><?php echo $dateFinish->format('d/m/Y')?></td>
                    <td>
                        <a href="index.php?c=course&f=edit&id=<?php echo $course['id']?>" class="btn btn-primary">
                            Editar
                        </a>
                        <button 
                            type="button" 
                            class="btn btn-danger"
                            onclick="deleteItem(<?php echo $course['id']?>)"
                        >Excluir
                        </button>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
