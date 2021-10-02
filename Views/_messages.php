<?php
    if(isset($_SESSION['message'])){
    ?>
        <div class="mt-3 alert alert-<?php if($_SESSION['message']['type']==1){echo 'success';}else{echo 'danger';}?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']['text']?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION['message']);
    }
?>