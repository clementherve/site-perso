
let $ = (e) => document.querySelector(e);

// load articles
let getArticles = () => {
    fetch("/admin/php/get-articles.php")
    .then(resp => resp.json())
    .then((resp) => {
        app.articles = []
        for(let i=0; i<resp.length; i++) {
            resp[i]["index"] = i;
            if (typeof(resp[i]["status"]) == "string") {
                resp[i]["status"] = !!(resp[i]["status"]);
            }
            console.log(typeof(resp[i]["status"]))
            app.articles.push(resp[i]);
        }
    })
    .catch(err => {
        alert(err);
    })
}
getArticles();



// toggle article publishing status
let toggleStatus = (id) => {
    return fetch("/admin/php/toggle-article.php?id=" + id)
        .then(resp => resp.text());
}

let saveArticle = (id, raw) => {
    const body = prepare(raw);
    console.log(body);
    if (body == false) {
        return new Promise((resolve, reject) => {});
    }

    return fetch("/admin/php/save-article.php", {
        method: "post",
        headers: {
            'Content-Type':'application/x-www-form-urlencoded',
        },
        body: body
    }).then(resp => resp.text());
}

let publishArticle = (id, raw) => {
    const body = prepare(raw);
    if (body == false) {
        return new Promise((resolve, reject) => {});
    }
    return fetch("/admin/php/publish-article.php", {
        method: "post",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: body
    }).then(resp => resp.text());
}

let deleteArticleAsync = (id) => {
    return fetch("/admin/php/delete-article.php?id=" + id)
        .then(resp => resp.text());
}


let popup = (app, msg) => {
    app.popupVisible = true;
    app.popupMessage = msg;
    setTimeout(() => {
        app.popupVisible = false;
    }, 2000);
}


let prepare = (raw) => {
    if (raw.title === "" || raw.content === "" || raw.tags === "" || raw.id === "") {
        return false;
    }

    return "title="+raw.title +
        "&content=" +raw.content +
        "&tags=" + raw.tags +
        "&id=" + raw.id +
        "&is-draft=" + raw.status
}