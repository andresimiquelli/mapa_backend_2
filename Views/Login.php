<div class="row justify-content-center">
    <div class="col-5 ">
        <h3 class="mt-5">Painel de Controle</h3>
        <div class="card mb-5" style="width: 100%">
            <div class="card-body">
                <h5 class="card-title">Faça seu login</h5>

                <?php 
                    include('Views/_messages.php');
                ?>

                    <form action="index.php?c=login&f=login" method="POST">
                        <div class="form-group mb-3">
                            <input 
                                type="text"
                                name="username"
                                class="form-control"
                                placeholder="Usuário"
                                required>
                        </div>
                        <div class="form-group mb-3">
                            <input 
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Senha"
                                required>
                        </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>