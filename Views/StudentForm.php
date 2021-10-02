<div class="row">
    <div class="col">
        <h2>
            <?php if(isset($student)):?>
                Editar aluno
            <?php else :?>
                Novo aluno
            <?php endif?>
        </h2>

        <form action="index.php?c=student&f=save<?php if(isset($student)){echo "&id=".$student['id'];}?>" method="POST">
            <div class="row mb-2">
                <div class="col">
                    <label for="input-name">Nome</label>
                    <input
                        id="input-name" 
                        placeholder="Informe o nome completo"
                        type="text" 
                        name="name" 
                        maxlength="255"
                        required
                        value="<?php if(isset($student)){echo $student['name'];}?>"
                        class="form-control">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <input 
                        placeholder="E-mail"
                        type="email"
                        name="email"
                        required
                        class="form-control"
                        value="<?php if(isset($student)){echo $student['email'];}?>">
                </div>
                <div class="col">
                    <input 
                        placeholder="Senha"
                        type="password"
                        name="password"
                        required
                        class="form-control"
                        maxlength="32"
                        value="<?php if(isset($student)){echo $student['password'];}?>"
                    >
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <input 
                        placeholder="Telefone"
                        type="text"
                        name="phone"
                        maxlength="20"
                        required
                        class="form-control"
                        value="<?php if(isset($student)){echo $student['phone'];}?>">
                </div>
                <div class="col">
                    <select name="course" class="form-control">
                        <?php foreach($courses as $course):?>
                            <option 
                                value="<?php echo $course['id']?>"
                                <?php if(isset($student)){ if($course['id'] == $student['course']){ echo 'selected';} } ?>>
                                    <?php echo $course['nameCourse']?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="col">
                    <select name="status" class="form-control">
                        <option value="1" <?php if(isset($student)){ if($student['status']==1){echo 'selected';} }?>>Ativo</option>
                        <option value="0" <?php if(isset($student)){ if($student['status']==0){echo 'selected';} }?>>Inativo</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <hr>
                    <a href="index.php?c=student" class="btn btn-danger">Cancelar</a>
                    <button class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>