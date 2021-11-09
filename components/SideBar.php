<style>
    <?php include "../css/body_2.css"; ?>
</style>

<?php


function SideBar(){
    echo "
    <div class='sideBar'>
    <form class='search'>
        <input type='text' placeholder='Busque por um título'/> <br>
        <button>Pesquisar</button>
    </form>
    <h3>Tags</h3>
    <ul class='tags'>
        <li>Empreendedorismo</li>
        <li>Tecnologia</li>
        <li>Trabalho</li>
    </ul>
</div>
    ";
}