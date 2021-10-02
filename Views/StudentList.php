<script src="Views/js/deleteFunctions.js"></script>
<script>
    deletionUrl = "index.php?c=student&f=delete";
</script>
<?php include('_deleteModal.php');?>

<div class="row">
    <div class="col">
        
        <h2>Lista de Alunos</h2>
        <a href="index.php?c=student&f=add" class="btn btn-primary">+ Novo Aluno</a>

        <?php 
            include('Views/_messages.php');
        ?>

        <form action="index.php?c=student&f=search" method="POST">
            <div class="row mt-3">
                <div class="col-4">
                    <select name="course" class="form-control">
                        <option value="0">Todos os cursos</option>
                        <?php foreach($courses as $course):?>
                            <option 
                                value="<?php echo $course['id']?>"
                                <?php if(isset($_POST['course'])){ if($course['id'] == $_POST['course']){ echo 'selected';} } ?>>
                                    <?php echo $course['nameCourse']?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col">
                    <input 
                        name="name"
                        type="text"
                        class="form-control" 
                        placeholder="Buscar pelo nome"
                        value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>">    
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="index.php?c=student" class="btn btn-secondary">Limpar</a>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Curso</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $student):?>
                <tr>
                    <td><?php echo $student['name']?></td>
                    <td><?php echo $student['email']?></td>
                    <td><?php echo $student['phone']?></td>
                    <td><?php echo $student['nameCourse']?></td>
                    <td>
                        <a href="index.php?c=student&f=edit&id=<?php echo $student['id']?>" class="btn btn-primary">
                            Editar
                        </a>
                        <button 
                            type="button" 
                            class="btn btn-danger"
                            onclick="deleteItem(<?php echo $student['id']?>)"
                        >Excluir
                    </button>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>