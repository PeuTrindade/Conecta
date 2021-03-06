<style>
    <?php include "../addPost.css/.css"; ?>
</style>

<?php

function postForm($action,$buttonText,$imageLabel = null,$title = null,$author = null,$text = null){
    echo "
        <form action='$action' method='POST' class='form' enctype='multipart/form-data'>
            <label for='title'>Título</label> <br>
            <input value='$title' required placeholder='Ambientes de Coworking...' id='title' name='postTitle' type='text'></input> <br>
            <p id='p'>Imagem</p>
            <label id='imageLabel' for='image'>$imageLabel</label> <br>
            <input onSelect='handleSelect()' id='image' name='postImage' type='file'></input> <br>
            <label for='author'>Autor</label> <br>
            <input value='$author' required id='author' name='postAuthor' type='text'></input> <br>
            <label for='text'>Texto</label> <br>
            <textarea required id='text' name='postText' type='text'>$text</textarea> <br>
            <label for='category'>Categoria</label> <br>
            <select required name='postCategory' id='category'>
                <option value='Empreendedorismo' selected >Empreendedorismo</option>
                <option value='Trabalho'>Trabalho</option>
                <option value='Tecnologia'>Tecnologia</option>
            </select> <br>
            <button name='sendPost' type='submit'>$buttonText</button>
        </form>
    ";
}