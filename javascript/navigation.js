// Variável que armazena url da página
let pathname = window.location.pathname;
let search = window.location.search;
const cleanSearch = search.replace("?","");
const url = pathname + search;

// Constantes que armazenam informações sobre número de páginas para navegação
const postsLength = +document.getElementById("dataLength").value;
const postsPerPage = postsLength / 5;
const pageNavigation = document.getElementById("pageNavigation");

// Funções que adicionam páginas de navegação no HTML
if(postsLength > 5 && postsLength % 5 === 0){
    for (let i = 2; i <= postsPerPage; i++) {
        const li = document.createElement("li");
        const a = document.createElement("a");
        const content = document.createTextNode(i);

        a.appendChild(content);
        li.appendChild(a);

        a.href = `/Conecta/?${i}`;
        li.id = i;
        li.className = "pageDisabled";

        pageNavigation.appendChild(li);
    }
}

if(postsLength > 5 && postsLength % 5 !== 0) {
    for (let i = 2; i <= postsPerPage + 1; i++) {
        const li = document.createElement("li");
        const a = document.createElement("a");
        const content = document.createTextNode(i);

        a.appendChild(content);
        li.appendChild(a);

        a.href = `/Conecta/?${i}`;
        li.id = i;
        li.className = "pageDisabled";

        pageNavigation.appendChild(li);
    }
}

// Função para gerenciar quais ícones vão estar ativos ou desabilitados
pagesArray = Array.prototype.slice.call(pageNavigation.children);

if(pagesArray.length > 1){
    pagesArray.forEach(li => {
        if(url.includes(li.id)){
            li.className = "pageActive";
        }
    });
}


// Funções de navegação dos posts
function handleLeft(){
    if(cleanSearch){
    const page = +url.split("?")[1];

    if(typeof page === 'number' && page !== 1){
        const backPage = page - 1;
        const newSearch = "?" + backPage;
        window.location.href = pathname + newSearch;
    }
    }
}

function handleRight(){
    if(cleanSearch){
    const page = +url.split("?")[1];

    if(typeof page === 'number' && page < postsPerPage){
        const nextPage = page + 1;
        const newSearch = "?" + nextPage;
        window.location.href = pathname + newSearch;
    }
    } else {
        window.location.href = pathname + "?" + 2;
    }
}

// Função para gerenciar quais tags vão estar ativas ou desabilitadas
if(cleanSearch === "Empreendedorismo" || cleanSearch === "Tecnologia" || cleanSearch === "Trabalho"){
    const tag1 = document.getElementById("tag1");
    const tag2 = document.getElementById("tag2");
    const tag3 = document.getElementById("tag3");

    if(cleanSearch === "Empreendedorismo"){
        tag1.className = "tagActive";
    } 
    else if(cleanSearch === "Tecnologia"){
        tag2.className = "tagActive";
    }
    else {
        tag3.className = "tagActive";
    }
}

if(cleanSearch === "NaN"){
    window.location.href = pathname;
}