<!-- Componente da Sidebar -->

<!-- Importando o css da Sidebar -->
<style>
    <?php include "../css/body_2.css"; ?>
</style>

<?php


function SideBar(){
    echo "
    <div class='sideBar'>
    <form action='' method='POST' class='search'>
        <input name='title_search' type='text' placeholder='Busque por um título'/> <br>
        <button name='search_btn'>Pesquisar</button>
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