// Variável que armazena url da página
const url = window.location.href.slice(26);

// Função para gerenciar quais ícones vão estar ativos ou desabilitados
if(url === "1" || url === "2" || url === "3"){
const btn1 = document.getElementById("1");
const btn2 = document.getElementById("2");
const btn3 = document.getElementById("3");

if(url === "2"){
    btn1.className = "pageDisabled";
    btn2.className = "pageActive";
    btn3.className = "pageDisabled";
} else if(url === "3"){
    btn1.className = "pageDisabled";
    btn2.className = "pageDisabled";
    btn3.className = "pageActive";
}
}


// Funções de navegação dos posts
function handleLeft(){
    if(url === "3"){
        window.location.href = "http://localhost/Conecta/?2";
    }
    else if(url === "2"){
        window.location.href = "http://localhost/Conecta/?1";
    }
}

function handleRight(){
    if(!url){
        window.location.href = "http://localhost/Conecta/?2";
    }
    if(url === "1"){
        window.location.href = "http://localhost/Conecta/?2";
    }
    else if(url === "2"){
        window.location.href = "http://localhost/Conecta/?3";
    }
}

// Função para gerenciar quais tags vão estar ativas ou desabilitadas
if(url === "Empreendedorismo" || url === "Tecnologia" || url === "Trabalho"){
    const tag1 = document.getElementById("tag1");
    const tag2 = document.getElementById("tag2");
    const tag3 = document.getElementById("tag3");

    if(url === "Empreendedorismo"){
        tag1.className = "tagActive";
    } 
    else if(url === "Tecnologia"){
        tag2.className = "tagActive";
    }
    else {
        tag3.className = "tagActive";
    }
}